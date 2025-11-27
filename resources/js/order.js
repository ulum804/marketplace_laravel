    // Header scroll effect
    window.addEventListener('scroll', function() {
      const header = document.getElementById('mainHeader');
      if (window.scrollY > 50) {
        header.classList.add('scrolled');
      } else {
        header.classList.remove('scrolled');
      }
    });

    const menuData = [
      {id:'dimsum', name:'Dimsum Chili Oil', price:15000, desc:'Dimsum isi ayam udang lembut dengan chili oil khas KNiverse.'},
      {id:'wonton', name:'Wonton Chili Oil', price:12000, desc:'Wonton lembut dengan isian daging ayam dicampur dengan udang disiram chili oil pedas gurih.'},
      {id:'corndog', name:'Corndog Sosis Crispy', price:10000, desc:'Corndog sosis crispy luar dalam, gurihnya nagih!'},
      {id:'risol', name:'Risol Mayo', price:14000, desc:'Risol mayo isi ayam lembut dengan saus gurih.'},
      {id:'siomay', name:'Siomay Chili Oil', price:13000, desc:'Siomay udang segar lembut dan gurih.'},
      {id:'enoki', name:'Jamur Enoki Crispy', price:8000, desc:'Berisi jamur enoki yang gurih dan renyah dibalut dengan saus sambal atau tomat.'},
      {id:'tahu', name:'Tahu Bakso', price:5000, desc:'Tahu isi bakso ayam gurih berisi 2 tahu bakso yang cocok buat teman makan siang.'},
      {id:'brownies', name:'Brownies Jumnawa', price:10000, desc:'Memiliki beberapa rasa favorit sepanjang masa, terdiri dari rasa original, strawberry, melon, oreo, milo.'}
    ];
    
    const formatRupiah=n=>n.toLocaleString('id-ID',{style:'currency',currency:'IDR',maximumFractionDigits:0});

    const menuList=document.getElementById('menuList');
    const cartList=document.getElementById('cartList');
    const cartTotal=document.getElementById('cartTotal');
    const subtotal=document.getElementById('subtotal');
    const totalSummary=document.getElementById('totalSummary');
    const submitBtn=document.getElementById('submitBtn');
    const popup=document.getElementById('popupQris');
    const donePay=document.getElementById('donePay');

    // Tampilkan semua menu
    menuData.forEach(m=>{
      const el=document.createElement('div');
      el.className='menu-item';
      el.innerHTML=`<div class="title">${m.name}</div>
        <div class="desc">${m.desc}</div>
        <div class="price">${formatRupiah(m.price)}</div>
        <button data-id="${m.id}">+ Tambah ke Keranjang</button>`;
      menuList.appendChild(el);
    });

    // Sistem keranjang dengan quantity
    let cart=[];
    
    function renderCart(){
      if(cart.length===0){
        cartList.innerHTML='<div class="empty">Belum ada item ditambahkan.</div>';
        totalSummary.style.display='none';
        submitBtn.disabled=true;
        return;
      }
      
      cartList.innerHTML = '';
      totalSummary.style.display='block';
      
      cart.forEach((c,i)=>{
        const itemDiv = document.createElement('div');
        itemDiv.className = 'cart-item';
        itemDiv.innerHTML = `
          <div class="cart-item-info">
            <div class="cart-item-name">${c.name}</div>
            <div class="cart-item-price">${formatRupiah(c.price)} × ${c.quantity} = ${formatRupiah(c.price * c.quantity)}</div>
            <div class="quantity-controls">
              <button class="qty-btn" data-action="decrease" data-index="${i}">−</button>
              <input type="number" class="qty-input" value="${c.quantity}" min="1" data-index="${i}" readonly>
              <button class="qty-btn" data-action="increase" data-index="${i}">+</button>
            </div>
          </div>
          <button class="cart-item-remove" data-index="${i}">🗑️ Hapus</button>
        `;
        cartList.appendChild(itemDiv);
      });
      
      updateTotal();
      submitBtn.disabled=false;
    }

    function updateTotal() {
      const total = cart.reduce((t,c)=>t+(c.price * c.quantity),0);
      subtotal.textContent = formatRupiah(total);
      cartTotal.textContent = formatRupiah(total);
    }

    // Event listener untuk tombol tambah menu
    menuList.addEventListener('click',e=>{
      if(e.target.tagName==='BUTTON'){
        const id=e.target.dataset.id;
        const m=menuData.find(x=>x.id===id);
        const existingItem = cart.find(c=>c.id===id);
        
        if(existingItem) {
          existingItem.quantity += 1;
        } else {
          cart.push({...m, quantity: 1});
        }
        
        renderCart();
        document.querySelector('#order').scrollIntoView({behavior:'smooth'});
      }
    });

    // Event listener untuk quantity controls dan hapus
    cartList.addEventListener('click',e=>{
      const target = e.target;
      const index = parseInt(target.dataset.index);
      
      if(target.classList.contains('qty-btn')) {
        const action = target.dataset.action;
        if(action === 'increase') {
          cart[index].quantity += 1;
        } else if(action === 'decrease' && cart[index].quantity > 1) {
          cart[index].quantity -= 1;
        }
        renderCart();
      }
      
      if(target.classList.contains('cart-item-remove')) {
        cart.splice(index, 1);
        renderCart();
      }
    });



    // Submit form
    let pendingOrder=null;
    document.getElementById('orderForm').addEventListener('submit',e=>{
      e.preventDefault();
      const name=document.getElementById('custName').value.trim();
      const address=document.getElementById('custAddress').value.trim();
      const note=document.getElementById('custNote').value.trim();
      
      if(!name||!address||cart.length===0)return alert('Lengkapi semua data dan tambahkan pesanan!');
      
      const tanggal=new Date().toLocaleString('id-ID');
      const total=cart.reduce((t,c)=>t+(c.price * c.quantity),0);
      const itemList=cart.map(c=>`${c.name} (${c.quantity}x)`).join(', ');
      
      pendingOrder={nama:name,item:itemList,alamat:address,catatan:note,total:total,tanggal:tanggal};
      popup.classList.add('active');
    });

    donePay.addEventListener('click',()=>{
      if(!pendingOrder)return;
      pendingOrder=null;
      cart=[];
      renderCart();
      popup.classList.remove('active');
      alert('✅ Pembayaran diterima! Pesanan berhasil direkam');
      document.getElementById('orderForm').reset();
    });

    renderCart();

      // Merged cart array with global cart
      let cartData = [];

      // Capture cart changes for submission
      const originalRenderCart = renderCart;
      renderCart = function() {
        originalRenderCart();
        cartData = [];
        cart.forEach(c => cartData.push({...c}));
        updateSubmitButton();
      };

      function updateSubmitButton() {
        submitBtn.disabled = cart.length === 0;
      }

      // Update hidden produk field before submit
      function updateHiddenProduk() {
        if(cartData.length === 0) {
          document.getElementById('produk').value = '';
        } else {
          const itemList = cartData.map(c => `${c.name} (${c.quantity}x)`).join(', ');
          document.getElementById('produk').value = itemList;
        }
      }

      form.addEventListener('submit', async e => {
        e.preventDefault();

        updateHiddenProduk();

        const formData = new FormData(form);
        formData.set('produk', document.getElementById('produk').value);

        try {
          const response = await fetch(form.action, {
            method: 'POST',
            headers: {
              'X-CSRF-TOKEN': formData.get('_token'),
              'Accept': 'application/json',
            },
            body: formData
          });

          if (!response.ok) throw new Error('Terjadi kesalahan saat menyimpan data');

          const data = await response.json();

          if (data.success) {
            alert('Pesanan berhasil disimpan');
            form.reset();
            cart.length = 0;
            renderCart();
          } else {
            alert('Gagal menyimpan pesanan: ' + (data.message || 'Coba lagi'));
          }
        } catch (error) {
          alert(error.message);
        }
      });

      updateSubmitButton();