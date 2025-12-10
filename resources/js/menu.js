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

    // Load products from API
    async function loadProducts() {
      try {
        const response = await fetch('/api/products');
        const products = await response.json();

        const menuItemsContainer = document.getElementById('menuItems');
        const loadingState = document.getElementById('loadingState');

        // Remove loading state
        if (loadingState) {
          loadingState.remove();
        }

        // Clear existing content
        menuItemsContainer.innerHTML = '';

        // Render products
        products.forEach(product => {
          const menuItem = createMenuItem(product);
          menuItemsContainer.appendChild(menuItem);
        });

      } catch (error) {
        console.error('Error loading products:', error);
        const menuItemsContainer = document.getElementById('menuItems');
        menuItemsContainer.innerHTML = '<div style="grid-column: 1/-1; text-align: center; padding: 40px; color: #ff6b6b;">Gagal memuat menu. Silakan refresh halaman.</div>';
      }
    }

    function createMenuItem(product) {
      const menuItem = document.createElement('div');
      menuItem.className = 'menu-item';

      menuItem.innerHTML = `
        <div class="menu-details">
          <div class="menu-image-wrapper">
            <img src="${product.gambar}" alt="${product.nama_produk}" onerror="this.src='/image/placeholder.jpg'">
          </div>
          <div class="menu-text-content">
            <h4>${product.nama_produk}</h4>
            <p>${product.deskripsi}</p>
            <div class="menu-price">Rp ${product.harga.toLocaleString('id-ID')}</div>
          </div>
        </div>
        <div class="menu-actions">
          <button class="cart-btn" onclick="openModal('${product.nama_produk}', '${product.gambar}', '${product.deskripsi}', ${product.harga})">🛒</button>
        </div>
      `;

      return menuItem;
    }

    // Load products when page loads
    document.addEventListener('DOMContentLoaded', loadProducts);

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