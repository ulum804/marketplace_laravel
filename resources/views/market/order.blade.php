<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>KNiverse – Pemesanan</title>
  @vite('resources/css/order.css')
  <style>
  
  </style>
</head>
<body>
  <!-- Header - Same as about.html -->
  <header id="mainHeader">
    <div class="logo">
      <img src="{{ asset('image/logoUsaha.png') }}" alt="Logo">
      <div class="logo-text">
        <h1>KNIVERSE</h1>
        <p>Sejuta Kenangan Satu Rasa</p>
      </div>
    </div>
    <nav>
      <a href="{{ url('/market/home') }}">Home</a>
      <a href="{{ url('/market/about') }}">About Us</a>
      <a href="{{ url('/market/menu') }}">Menu</a>
      <a href="{{ url('/market/order') }}" class="active">Order</a>
           <a href="{{ url('/admin/login') }}" class="login-icon">
          <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 640 640" fill="currentColor">
              <path d="M409 337C418.4 327.6 418.4 312.4 409 303.1L265 159C258.1 152.1 247.8 150.1 238.8 153.8C229.8 157.5 224 166.3 224 176L224 256L112 256C85.5 256 64 277.5 64 304L64 336C64 362.5 85.5 384 112 384L224 384L224 464C224 473.7 229.8 482.5 238.8 486.2C247.8 489.9 258.1 487.9 265 481L409 337zM416 480C398.3 480 384 494.3 384 512C384 529.7 398.3 544 416 544L480 544C533 544 576 501 576 448L576 192C576 139 533 96 480 96L416 96C398.3 96 384 110.3 384 128C384 145.7 398.3 160 416 160L480 160C497.7 160 512 174.3 512 192L512 448C512 465.7 497.7 480 480 480L416 480z"/>
          </svg>
      </a>
    </nav>
  </header>

  <main class="container">
    <div class="grid">
      <!-- MENU -->
      <section>
        <div class="card">
          <h2>🍽️ Menu Kami</h2>
          <p style="color:var(--muted);font-size:14px;margin-bottom:16px">Pilih menu yang ingin Anda pesan</p>
          <div class="menu-list" id="">
                @foreach ($produk as $item)
                  <div class="menu-item">
                    <div class="menu-details">
                      {{-- <div class="menu-image-wrapper"> 
                        <img src="{{ $item->gambar }}"  alt="gambar">
                      </div> --}}
                      <div class="menu-image-wrapper">
                        <img src="/{{ $item->gambar }}" alt="{{ $item->nama_produk }}" onerror="this.src='https://via.placeholder.com/300x180?text=No+Image'">
                      </div>
                      <div class="menu-text-content">
                        <h4>{{ $item->nama_produk }}</h4>
                        <p>{{ $item->deskripsi }}</p>
                        <div class="menu-price">Rp {{ number_format($item->harga, 0, ',', '.') }}</div>
                      </div>
                    </div>
                    <div class="menu-actions">
                      <button class="cart-btn" onclick="addToCart('{{ $item->nama_produk }}', {{ $item->harga }}, '{{ $item->deskripsi }}')">🛒</button>
                    </div>
                  </div>
                @endforeach
          </div>
        </div>
      </section>

      <!-- FORM -->
      <aside>
        <div class="card" id="order">
          <h2>📝 Form Pemesanan</h2>
          <form id="orderForm"  action="{{ route('market.store')}}" method="post">
            @csrf
            <label style="font-weight:600;color:var(--dark)">Nama Pemesan
              <input type="text" id="custName" name="nama" required placeholder="Masukkan nama lengkap">
            </label>

            <label style="font-weight:600;color:var(--dark);margin-top:12px;display:block">Alamat Pengiriman
              <textarea id="custAddress" name="alamat" rows="2" required placeholder="Masukkan alamat lengkap"></textarea>
            </label>

            <label style="font-weight:600;color:var(--dark);margin-top:12px;display:block">Catatan (Opsional)
              <textarea id="custNote" name="catatan" rows="2" placeholder="Contoh: tanpa saos, level pedas sedang"></textarea>
            </label>
            
            <label style="font-weight:600;color:var(--dark);margin-top:12px;display:block">Masukkan Voucher
              <input type="text" id="voucher" name="voucher" placeholder="Masukkan kode voucher jika ada">
            </label>

            <div style="margin-top:20px">
              <input type="hidden" id="produk" name="produk">
              <h3 style="color:var(--orange)">🛒 Keranjang Belanja</h3>
              <div id="cartList" class="empty" style="margin-top:12px">Belum ada item ditambahkan.</div>
              
              <div class="total-summary" id="totalSummary" style="display:none">
                <div class="total-summary-row">
                  <span>Subtotal:</span>
                  <span id="subtotal">Rp 0</span>
                </div>
                <div class="total-summary-row grand-total">
                  <input type="hidden" id="total" name="total">
                  <span>Total Pembayaran:</span>
                  <span id="cartTotal">Rp 0</span>
                </div>
              </div>

              <button class="btn" type="submit" id="submitBtn" disabled>💳 Submit Pesanan</button>
                {{-- @if (session('success'))
                  <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
                      {{ session('success') }}
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
               @endif --}}
            </div>
          </form>
        </div>
      </aside>
    </div>
  </main>

  <!-- FOOTER -->
  <footer>
    <div class="footer-container">
      <div class="footer-brand">
        <div class="footer-logo">
    <img src="{{ asset('image/logoUsaha.png') }}" alt="Logo">
          <h2>KNiverse</h2>
        </div>
        <p>Sejuta Kenangan Satu Rasa! 
          Kami menghadirkan cita rasa terbaik dengan sentuhan modern, cocok dinikmati kapan saja – baik untuk camilan, makan siang praktis, hingga momen santai bersama teman dan keluarga.</p>
      </div>

      <div class="footer-section footer-links">
        <h3>Quick Links</h3>
        <ul>
          <li><a href="{{ url('/market/home') }}">Home</a></li>
          <li><a href="{{ url('/market/about') }}">About Us</a></li>
          <li><a href="{{ url('/market/menu') }}">Menu</a></li>
          <li> <a href="{{ url('/market/order') }}">Order</a></li>
        </ul>
      </div>

       <div class="footer-section">
      <h3>Contact Us</h3>
      <div class="social-icons">
        <!-- IG icon -->
        <a href="https://www.instagram.com/kniversepenuhrasa_?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" target="_blank">
           <img src="{{ asset('image/instagram.png') }}" alt="Logo">
        </a>
        <!-- WA icon -->
        <a href="https://wa.me/qr/JCZK4W73S5T7F1" target="_blank">
            <img src="{{ asset('image/whatsaap.png') }}" alt="Logo">
        </a>
      </div>

    <div class="footer-line"></div>
  </footer>

  <!-- POPUP QRIS -->
  <div class="popup-overlay" id="popupQris">
    <div class="popup">
      <h3 style="color:var(--orange);margin-top:0">💳 Scan QRIS untuk Pembayaran</h3>
      <img src="{{ asset('image/qris.jpg') }}" alt="QRIS BCA">
      <p style="font-size:14px;color:var(--muted)">Setelah selesai bayar, klik tombol di bawah.</p>
      <button id="donePay">✅ Selesai Bayar</button>
    </div>
  </div>

  <script>
        // Header scroll effect
    window.addEventListener('scroll', function() {
      const header = document.getElementById('mainHeader');
      if (window.scrollY > 50) {
        header.classList.add('scrolled');
      } else {
        header.classList.remove('scrolled');
      }
    });

    const formatRupiah=n=>n.toLocaleString('id-ID',{style:'currency',currency:'IDR',maximumFractionDigits:0});

    const cartList=document.getElementById('cartList');
    const cartTotal=document.getElementById('cartTotal');
    const subtotal=document.getElementById('subtotal');
    const totalSummary=document.getElementById('totalSummary');
    const submitBtn=document.getElementById('submitBtn');
    const popup=document.getElementById('popupQris');
    const donePay=document.getElementById('donePay');

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

    // Fungsi untuk menambah item ke keranjang
    function addToCart(name, price, desc) {
      const existingItem = cart.find(c => c.name === name);
      if (existingItem) {
        existingItem.quantity += 1;
      } else {
        cart.push({ name, price, desc, quantity: 1 });
      }
      renderCart();
      document.querySelector('#order').scrollIntoView({ behavior: 'smooth' });
    }

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

    donePay.addEventListener('click', async () => {
      if(!pendingOrder)return;
      const form = document.getElementById('orderForm');
      const formData = new FormData(form);
      formData.set('produk', pendingOrder.item);
      formData.set('nama', pendingOrder.nama);
      formData.set('alamat', pendingOrder.alamat);
      formData.set('catatan', pendingOrder.catatan);
      formData.set('total', pendingOrder.total);

      try {
        const response = await fetch(form.action, {
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json',
          },
          body: formData
        });

        if (!response.ok) throw new Error('Terjadi kesalahan saat menyimpan data');

        const data = await response.json();

        if (data.success) {
          alert('✅ Pembayaran diterima! Pesanan berhasil disimpan');
          pendingOrder = null;
          cart = [];
          renderCart();
          popup.classList.remove('active');
          form.reset();
        } else {
          alert('Gagal menyimpan pesanan: ' + (data.message || 'Coba lagi'));
        }
      } catch (error) {
        alert(error.message);
      }
    });

    renderCart();

    // Voucher system - read from localStorage (set by admin)
    const VOUCHERS_KEY = 'kniverse_vouchers';
    let appliedVoucher = null;

    function getVouchersFromAdmin() {
      try {
        const data = localStorage.getItem(VOUCHERS_KEY);
        return data ? JSON.parse(data) : [];
      } catch (e) {
        console.error('Error reading vouchers:', e);
        return [];
      }
    }

    // Event listener untuk input voucher
    document.getElementById('voucher').addEventListener('change', function() {
      const voucherCode = this.value.trim().toUpperCase();
      
      if (!voucherCode) {
        appliedVoucher = null;
        updateTotal();
        return;
      }

      const vouchers = getVouchersFromAdmin();
      const foundVoucher = vouchers.find(v => v.code === voucherCode);

      if (!foundVoucher) {
        alert('❌ Kode voucher tidak ditemukan!');
        this.value = '';
        appliedVoucher = null;
        updateTotal();
        return;
      }

      // Check if expired
      if (foundVoucher.expiry) {
        const expiryDate = new Date(foundVoucher.expiry);
        if (new Date() > expiryDate) {
          alert('⏰ Voucher sudah expired!');
          this.value = '';
          appliedVoucher = null;
          updateTotal();
          return;
        }
      }

      // Check minimum purchase
      const subtotalAmount = cart.reduce((t, c) => t + (c.price * c.quantity), 0);
      if (foundVoucher.minPurchase && subtotalAmount < foundVoucher.minPurchase) {
        alert(`⚠️ Pembelian minimal Rp ${foundVoucher.minPurchase.toLocaleString('id-ID')} untuk voucher ini!`);
        this.value = '';
        appliedVoucher = null;
        updateTotal();
        return;
      }

      appliedVoucher = foundVoucher;
      alert(`✅ Voucher diterima! ${foundVoucher.description || ''}`);
      updateTotal();
    });

    // Update total dengan diskon voucher
    const originalUpdateTotal = updateTotal;
    window.updateTotal = function() {
      const subtotalAmount = cart.reduce((t, c) => t + (c.price * c.quantity), 0);
      let finalTotal = subtotalAmount;

      if (appliedVoucher) {
        if (appliedVoucher.type === 'percent') {
          const discount = (subtotalAmount * appliedVoucher.discount) / 100;
          finalTotal = subtotalAmount - discount;
        } else if (appliedVoucher.type === 'fixed') {
          finalTotal = subtotalAmount - appliedVoucher.discount;
        } else if (appliedVoucher.type === 'freeShipping') {
          // FreeShipping logic bisa ditambahkan jika ada shipping cost
          finalTotal = subtotalAmount;
        }
        finalTotal = Math.max(0, finalTotal); // Jangan negatif
      }

      subtotal.textContent = formatRupiah(subtotalAmount);
      cartTotal.textContent = formatRupiah(finalTotal);
      document.getElementById('total').value = finalTotal;
    };
  </script>
</body>
</html>
