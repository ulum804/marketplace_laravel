  let currentProduct = '';
    let currentPrice = 0;

    // Header scroll effect
    window.addEventListener('scroll', function() {
      const header = document.getElementById('mainHeader');
      if (window.scrollY > 50) {
        header.classList.add('scrolled');
      } else {
        header.classList.remove('scrolled');
      }
    });

    function openModal(productName, imageSrc, description, price) {
      currentProduct = productName;
      currentPrice = price;
      
      document.getElementById('modalProductName').textContent = productName;
      document.getElementById('modalImage').src = imageSrc;
      document.getElementById('modalDescription').textContent = description;
      document.getElementById('modalPrice').textContent = formatRupiah(price);
      document.getElementById('quantity').value = 1;
      document.getElementById('orderNotes').value = '';
      updateTotal();
      
      document.getElementById('orderModal').style.display = 'block';
      document.body.style.overflow = 'hidden';
    }

    function closeModal() {
      document.getElementById('orderModal').style.display = 'none';
      document.body.style.overflow = 'auto';
    }

    function formatRupiah(angka) {
      return 'Rp ' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    function updateTotal() {
      const quantity = parseInt(document.getElementById('quantity').value) || 1;
      const total = currentPrice * quantity;
      document.getElementById('totalPrice').textContent = formatRupiah(total);
    }

    function increaseQuantity() {
      const input = document.getElementById('quantity');
      let value = parseInt(input.value);
      if (value < 100) {
        input.value = value + 1;
        updateTotal();
      }
    }

    function decreaseQuantity() {
      const input = document.getElementById('quantity');
      let value = parseInt(input.value);
      if (value > 1) {
        input.value = value - 1;
        updateTotal();
      }
    }

    function proceedToOrder() {
      const quantity = document.getElementById('quantity').value;
      const notes = document.getElementById('orderNotes').value.trim();
      const total = currentPrice * quantity;
      
      // Get existing cart array or create new one
      let orderDataArray = [];
      try {
        const existing = localStorage.getItem('orderDataArray');
        if (existing) {
          orderDataArray = JSON.parse(existing);
        }
      } catch(e) {
        orderDataArray = [];
      }
      
      // Add new item to array
      const newItem = {
        product: currentProduct,
        quantity: parseInt(quantity),
        price: currentPrice,
        total: total,
        image: document.getElementById('modalImage').src,
        notes: notes
      };
      orderDataArray.push(newItem);
      
      // Save updated array back to localStorage
      localStorage.setItem('orderDataArray', JSON.stringify(orderDataArray));
      
      // Close modal and go to order page
      closeModal();
      window.location.href = 'order.html';
    }

    // Close modal ketika klik di luar modal
    window.onclick = function(event) {
      const modal = document.getElementById('orderModal');
      if (event.target == modal) {
        closeModal();
      }
    }

    // Close modal dengan tombol Escape
    document.addEventListener('keydown', function(event) {
      if (event.key === 'Escape') {
        closeModal();
      }
    });