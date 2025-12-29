<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Menu - KNiverse</title>
  @vite('resources/css/menu.css','resources/js/menu.js')
  <style>

  </style>
</head>
<body>
  <!-- Header -->
  <header id="mainHeader">
    <div class="logo">
     <img src="{{ asset('image/logoUsaha.png') }}" alt="Logo">
      <div class="logo-text">
        <h1>KNIVERSE</h1>
        <p>Keliling Nikmat, Penuh Rasa</p>
      </div>
    </div>
    <nav>
       <a href="{{ url('/market/home') }}" >Home</a>
      <a href="{{ url('/market/about') }}">About Us</a>
      <a href="{{ url('/market/menu') }}" class="active">Menu</a>
      <a href="{{ url('/market/order') }}">Order</a>
           <a href="{{ url('/admin/login') }}" class="login-icon">
          <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 640 640" fill="currentColor">
              <path d="M409 337C418.4 327.6 418.4 312.4 409 303.1L265 159C258.1 152.1 247.8 150.1 238.8 153.8C229.8 157.5 224 166.3 224 176L224 256L112 256C85.5 256 64 277.5 64 304L64 336C64 362.5 85.5 384 112 384L224 384L224 464C224 473.7 229.8 482.5 238.8 486.2C247.8 489.9 258.1 487.9 265 481L409 337zM416 480C398.3 480 384 494.3 384 512C384 529.7 398.3 544 416 544L480 544C533 544 576 501 576 448L576 192C576 139 533 96 480 96L416 96C398.3 96 384 110.3 384 128C384 145.7 398.3 160 416 160L480 160C497.7 160 512 174.3 512 192L512 448C512 465.7 497.7 480 480 480L416 480z"/>
          </svg>
      </a>
    </nav>
  </header>

  {{-- <!-- Best Menu Section -->
  <section class="best-menu">
    <h2>Best Menu Kami</h2>
    <div class="best-grid">
      <div class="menu-card">
          <img src="{{ asset('image/dimsumhome.jpg') }}" alt="Logo">
        <div class="menu-info">
          <h3>Dimsum Chili Oil</h3>
          <p>Rasa gurih lembut dimsum berpadu pedas khas KNiverse.</p>
        </div>
      </div>
      <div class="menu-card">
         <img src="{{ asset('image/corndoghome.jpg') }}" alt="Logo">
        <div class="menu-info">
          <h3>Corndog Saus Crispy</h3>
          <p>Balutan tepung lembut dengan isian sosis premium.</p>
        </div>
      </div>
      <div class="menu-card">
          <img src="{{ asset('image/wontonhome.jpg') }}" alt="Logo">
        <div class="menu-info">
          <h3>Wonton Chili Oil</h3>
          <p>Paduan gurih, pedas, dan harum khas KNiverse.</p>
        </div>
      </div>
    </div>
  </section> --}}

  <!-- Menu List Section -->
  <section class="menu-list">
    <h2>Menu Kami</h2>
    <p class="menu-subtitle">Pilihan menu terbaik dengan cita rasa yang menggugah selera</p>
    <!-- Menu Filter Buttons -->
    <div class="menu-filter-buttons">
      <button class="filter-btn active" onclick="filterMenu('semua')">📋 Semua Menu</button>
      <button class="filter-btn" onclick="filterMenu('andalan')">⭐ Menu Andalan</button>
      <button class="filter-btn" onclick="filterMenu('utama')">🍽️ Menu Utama</button>
      <button class="filter-btn" onclick="filterMenu('secret')">🎁 Secret Paket</button>
    </div>
    <div class="menu-items">
      @foreach ($produk as $item)
      <div class="menu-item" data-category="{{ $item->kategori ?? 'utama' }}">
        <div class="menu-details">
          <div class="menu-image-wrapper">
             <img src="/{{ $item->gambar }}" alt="{{ $item->nama_produk }}" onerror="this.src='https://via.placeholder.com/300x180?text=No+Image'">
          </div>
          <div class="menu-text-content">
            <h4>{{ $item->nama_produk }}</h4>
            <p>{{ $item->deskripsi }}</p>
            @if (strtolower(trim($item->kategori)) === 'secret' && !empty($item->bundle_items))
              <div class="bundle-items">
                <strong>isi paket :</strong>
                <ul>
                  @php
                    $bundleItems = is_string($item->bundle_items) ? json_decode($item->bundle_items, true) : $item->bundle_items;
                  @endphp
                  @if(is_array($bundleItems))
                    @foreach ($bundleItems as $bundleItem)
                      @if (isset($produkMap[$bundleItem['product_id']]))
                      <li>
                         {{ $produkMap[$bundleItem['product_id']] ?? 'Produk tidak ditemukan' }} × {{ $bundleItem['qty'] }}
                      </li>
                      @endif
                    @endforeach
                  @endif
                </ul>
              </div>
            @endif
            {{-- @if($item->kategori === 'secret' && $item->bundle_items)
              <div class="bundle-items">
                <strong>Isi Paket:</strong>
                <ul> --}}
                  {{-- @foreach ($item->bundle_items as $bundleItem)
                     <li>
                        {{ $produkMap[$bundleItem['product_id']] ?? 'Produk tidak ditemukan' }} × {{ $bundleItem['qty'] }}
                     </li>
                  @endforeach --}}
                  {{-- @foreach(json_decode($item->bundle_items, true) as $bundleItem)
                    @php
                      $product = \App\Models\ProdukModel::find($bundleItem['product_id']);
                    @endphp
                    @if($product)
                      <li>{{ $product->nama_produk }} × {{ $bundleItem['qty'] }}</li>
                    @endif
                  @endforeach --}}
                      {{-- @foreach($item->bundle_items as $bundleItem)
                        <li>
                         {{ \App\Models\ProdukModel::find($bundleItem['product_id'])->nama_produk ?? 'Produk tidak ditemukan' }}
                         × {{ $bundleItem['qty'] }}
                         </li>
                      @endforeach --}}
                {{-- </ul>
              </div>
            @endif --}}
            <div class="menu-price">Rp {{ number_format($item->harga, 0, ',', '.') }}</div>
          </div>
        </div>
        {{-- <div class="menu-actions">
          <button class="cart-btn" onclick="addToCart({{ $item->id }}, {!! json_encode($item->nama_produk) !!}, {!! json_encode('/' . $item->gambar) !!}, {{ $item->harga }})">🛒</button>
        </div> --}}
      </div>
      @endforeach
    </div>
  </section>

  <!-- Modal Pop-up -->
  <div id="orderModal" class="modal">
    <div class="modal-content">
      <div class="modal-header">
        <h2>🛒 Detail Pesanan</h2>
        <span class="close" onclick="closeModal()">&times;</span>
      </div>
      <div class="modal-body">
        <div class="product-image-container">
          <img id="modalImage" class="product-image" src="" alt="Product">
          <div class="badge-popular">⭐ Best Seller</div>
        </div>
        
        <div class="product-header">
          <h3 id="modalProductName" class="product-name"></h3>
          <div class="product-price" id="modalPrice">Rp 0</div>
        </div>
        
        <p id="modalDescription" class="product-description"></p>
        
        <div class="product-features">
          <div class="feature-badge">✓ Bahan Premium</div>
          <div class="feature-badge">🔥 Freshly Made</div>
          <div class="feature-badge">📦 Packaging Aman</div>
        </div>

        <div class="divider"></div>
        
        <div class="quantity-section">
          <label for="quantity">🍽 Pilih Jumlah Pesanan</label>
          <div class="quantity-control">
            <button class="quantity-btn" onclick="decreaseQuantity()">−</button>
            <input type="number" id="quantity" class="quantity-input" value="1" min="1" max="100" onchange="updateTotal()">
            <button class="quantity-btn" onclick="increaseQuantity()">+</button>
          </div>
        </div>

        <div class="divider"></div>

        <div class="quantity-section">
          <label for="orderNotes">📝 Catatan Pesanan (Opsional)</label>
          <textarea id="orderNotes" placeholder="Contoh: Pedas extra, tanpa MSG, dll..." style="width: 100%; padding: 12px; border: 2px solid var(--light-orange); border-radius: 12px; font-family: 'Poppins', sans-serif; font-size: 0.9rem; resize: vertical; min-height: 80px; transition: all 0.3s ease;" onchange="this.value = this.value.substring(0, 200)"></textarea>
          <small style="color: #999; display: block; margin-top: 6px;">Maksimal 200 karakter</small>
        </div>

        <div class="total-section">
          <div class="total-label">Total Harga</div>
          <div class="total-price" id="totalPrice">Rp 0</div>
        </div>
        
        <button class="order-btn" onclick="proceedToOrder()">🛒 Pesan Sekarang</button>
      </div>
    </div>
  </div>

  <!-- FOOTER -->
  <footer>
    <div class="footer-container">
      <div class="footer-brand">
        <div class="footer-logo">
       <img src="{{ asset('image/logoUsaha.png') }}" alt="Logo">
          <h2>KNiverse</h2>
        </div>
        <p>Sejuta Kenangan Satu Rasa! 
          Kami menghadirkan cita rasa terbaik dengan sentuhan modern, cocok dinikmati kapan saja — baik untuk camilan, makan siang praktis, hingga momen santai bersama teman dan keluarga.</p>
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
    </div>
    </div>

    <div class="footer-line"></div>
  </footer>

  <script>
        let currentProduct = '';
    let currentPrice = 0;

        // Filter menu by category (semua, andalan, utama, secret)
        function filterMenu(category) {
          // toggle active class on buttons
          document.querySelectorAll('.menu-filter-buttons .filter-btn').forEach(btn => {
            btn.classList.toggle('active', btn.getAttribute('onclick')?.includes("filterMenu('" + category + "')"));
          });

          const items = document.querySelectorAll('.menu-items .menu-item');
          items.forEach(item => {
            const cat = (item.getAttribute('data-category') || 'utama').toLowerCase();
            if (category === 'semua' || cat === category.toLowerCase()) {
              item.style.display = '';
            } else {
              item.style.display = 'none';
            }
          });
        }

        // Add product to local order cart and redirect to order page
        function addToCart(id, name, image, price) {
          try {
            const existing = localStorage.getItem('orderDataArray');
            const arr = existing ? JSON.parse(existing) : [];
            arr.push({ productId: id, product: name, quantity: 1, price: price, total: price, image: image, notes: '' });
            localStorage.setItem('orderDataArray', JSON.stringify(arr));
            // redirect to order page
            window.location.href = "{{ url('/market/order') }}";
          } catch (e) {
            console.error('addToCart error', e);
            alert('Gagal menambahkan ke pesanan. Coba lagi.');
          }
        }

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

    // Load products when page loads (only if client-side container exists)
    document.addEventListener('DOMContentLoaded', function() {
      const menuItemsContainer = document.getElementById('menuItems');
      if (menuItemsContainer) {
        loadProducts();
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
      window.location.href = "{{ url('/market/order') }}";
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

    // Ensure default filter applied on load
    document.addEventListener('DOMContentLoaded', function() {
      try { filterMenu('semua'); } catch (e) { /* ignore */ }
    });
  </script>
</body>
</html>