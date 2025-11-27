<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Menu - KNiverse</title>
  @vite('resources/js/menu.js')
  <style>
        :root {
      --orange: #ff8c42;
      --light-orange: #ffe4c2;
      --cream: #fff8ef;
      --dark: #2b2b2b;
    }

    body {
      margin: 0;
      font-family: "Poppins", sans-serif;
      background-color: var(--cream);
      color: var(--dark);
      line-height: 1.6;
    }

    /* Header */
    header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 20px 60px;
      background: transparent;
      position: sticky;
      top: 0;
      z-index: 10;
      transition: all 0.3s ease;
    }

    header.scrolled {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(10px);
      box-shadow: 0 2px 20px rgba(0,0,0,0.08);
    }

    .logo {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .logo img {
      width: 50px;
      height: 50px;
      border-radius: 12px;
      object-fit: cover;
    }

    .logo-text h1 {
      font-size: 1.5rem;
      font-weight: 700;
      margin: 0;
      color: var(--dark);
      letter-spacing: 0.5px;
    }

    .logo-text p {
      font-size: 0.75rem;
      margin: 0;
      color: #666;
      font-weight: 400;
    }

    nav a {
      text-decoration: none;
      color: var(--dark);
      margin-left: 32px;
      font-weight: 500;
      font-size: 1rem;
      transition: all 0.3s ease;
      position: relative;
    }

    nav a::after {
      content: '';
      position: absolute;
      bottom: -5px;
      left: 0;
      width: 0;
      height: 2px;
      background: var(--orange);
      transition: width 0.3s ease;
    }

    nav a:hover::after,
    nav a.active::after {
      width: 100%;
    }

    nav a:hover,
    nav a.active {
      color: var(--orange);
    }

    /* Best Menu Section */
    .best-menu {
      background: var(--light-orange);
      text-align: center;
      padding: 60px 20px;
    }

    .best-menu h2 {
      color: var(--dark);
      margin-bottom: 40px;
      font-size: 1.8rem;
    }

    .best-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 30px;
      max-width: 1000px;
      margin: auto;
    }

    .menu-card {
      background: #fff;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 3px 10px rgba(0,0,0,0.1);
      transition: 0.3s;
    }

    .menu-card:hover {
      transform: translateY(-5px);
    }

    .menu-card img {
      width: 100%;
      height: 180px;
      object-fit: cover;
    }

    .menu-info {
      padding: 15px;
    }

    .menu-info h3 {
      color: var(--orange);
      margin: 0;
      font-size: 1.1rem;
    }

    .menu-info p {
      font-size: 0.95rem;
      margin-top: 6px;
      color: #444;
    }

    /* Menu List Section */
    .menu-list {
      background: linear-gradient(135deg, #fff8ef 0%, #ffe4c2 100%);
      padding: 80px 20px;
      text-align: center;
      position: relative;
    }

    .menu-list::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 100px;
      background: linear-gradient(to bottom, rgba(255,140,66,0.05), transparent);
    }

    .menu-list h2 {
      color: var(--dark);
      margin-bottom: 20px;
      font-size: 2.5rem;
      font-weight: 700;
      position: relative;
    }

    .menu-subtitle {
      color: #666;
      font-size: 1.1rem;
      margin-bottom: 50px;
      font-weight: 400;
    }

    .menu-items {
      max-width: 900px;
      margin: auto;
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(380px, 1fr));
      gap: 25px;
    }

    .menu-item {
      display: flex;
      align-items: center;
      justify-content: space-between;
      background: white;
      padding: 20px 25px;
      border-radius: 20px;
      box-shadow: 0 5px 20px rgba(0,0,0,0.08);
      transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
      position: relative;
      overflow: hidden;
    }

    .menu-item::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(135deg, var(--orange), #ff6f00);
      opacity: 0;
      transition: opacity 0.4s ease;
      z-index: 0;
    }

    .menu-item:hover::before {
      opacity: 0.03;
    }

    .menu-item:hover {
      transform: translateY(-8px);
      box-shadow: 0 15px 35px rgba(255,140,66,0.25);
    }

    .menu-details {
      display: flex;
      align-items: center;
      gap: 20px;
      text-align: left;
      flex: 1;
      position: relative;
      z-index: 1;
    }

    .menu-image-wrapper {
      position: relative;
      flex-shrink: 0;
    }

    .menu-details img {
      width: 90px;
      height: 90px;
      object-fit: cover;
      border-radius: 15px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.15);
      transition: transform 0.3s ease;
    }

    .menu-item:hover .menu-details img {
      transform: scale(1.05);
    }

    .menu-text-content {
      flex: 1;
    }

    .menu-details div h4 {
      margin: 0 0 8px 0;
      color: var(--orange);
      font-size: 1.2rem;
      font-weight: 600;
    }

    .menu-details div p {
      margin: 0 0 8px 0;
      font-size: 0.9rem;
      color: #666;
      line-height: 1.5;
    }

    .menu-price {
      font-size: 1.1rem;
      font-weight: 700;
      color: var(--dark);
      margin-top: 8px;
    }

    .menu-actions {
      display: flex;
      flex-direction: column;
      gap: 10px;
      align-items: center;
      position: relative;
      z-index: 1;
    }

    .cart-btn {
      background: var(--orange);
      border: none;
      padding: 10px 14px;
      border-radius: 8px;
      cursor: pointer;
      color: white;
      font-weight: bold;
      transition: 0.3s;
      font-size: 1.2rem;
    }

    .cart-btn:hover {
      background: #ff6f00;
      transform: scale(1.1);
    }

    /* Modal/Pop-up Styles */
    .modal {
      display: none;
      position: fixed;
      z-index: 1000;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.6);
      backdrop-filter: blur(5px);
      animation: fadeIn 0.3s ease;
    }

    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }

    .modal-content {
      background-color: #fff;
      margin: 2% auto;
      padding: 0;
      border-radius: 20px;
      width: 90%;
      max-width: 600px;
      box-shadow: 0 10px 40px rgba(0,0,0,0.3);
      animation: slideDown 0.4s ease;
      overflow: hidden;
      max-height: 90vh;
    }

    @keyframes slideDown {
      from {
        transform: translateY(-50px);
        opacity: 0;
      }
      to {
        transform: translateY(0);
        opacity: 1;
      }
    }

    .modal-header {
      background: linear-gradient(135deg, var(--orange), #ff6f00);
      color: white;
      padding: 20px 30px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .modal-header h2 {
      margin: 0;
      font-size: 1.3rem;
    }

    .close {
      color: white;
      font-size: 32px;
      font-weight: bold;
      cursor: pointer;
      transition: 0.3s;
      line-height: 1;
    }

    .close:hover {
      transform: rotate(90deg);
    }

    .modal-body {
      padding: 25px;
      max-height: 75vh;
      overflow-y: auto;
    }

    .modal-body::-webkit-scrollbar {
      width: 8px;
    }

    .modal-body::-webkit-scrollbar-track {
      background: #f1f1f1;
      border-radius: 10px;
    }

    .modal-body::-webkit-scrollbar-thumb {
      background: var(--orange);
      border-radius: 10px;
    }

    .product-image-container {
      position: relative;
      margin-bottom: 20px;
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }

    .product-image {
      width: 100%;
      height: 280px;
      object-fit: cover;
      transition: transform 0.3s ease;
    }

    .product-image-container:hover .product-image {
      transform: scale(1.05);
    }

    .badge-popular {
      position: absolute;
      top: 15px;
      right: 15px;
      background: linear-gradient(135deg, #ff6f00, var(--orange));
      color: white;
      padding: 6px 14px;
      border-radius: 20px;
      font-size: 0.75rem;
      font-weight: 600;
      box-shadow: 0 4px 12px rgba(255,140,66,0.4);
    }

    .product-header {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      margin-bottom: 12px;
      gap: 15px;
    }

    .product-name {
      font-size: 1.4rem;
      color: var(--orange);
      margin: 0;
      font-weight: 700;
      flex: 1;
    }

    .product-price {
      font-size: 1.3rem;
      font-weight: 700;
      color: var(--dark);
      background: var(--light-orange);
      padding: 8px 16px;
      border-radius: 12px;
      white-space: nowrap;
    }

    .product-description {
      font-size: 0.9rem;
      color: #666;
      margin-bottom: 20px;
      line-height: 1.6;
      padding: 12px;
      background: #f9f9f9;
      border-radius: 12px;
      border-left: 4px solid var(--orange);
    }

    .product-features {
      display: flex;
      gap: 10px;
      margin-bottom: 20px;
      flex-wrap: wrap;
    }

    .feature-badge {
      background: white;
      border: 2px solid var(--light-orange);
      color: var(--dark);
      padding: 6px 12px;
      border-radius: 20px;
      font-size: 0.75rem;
      font-weight: 500;
      display: flex;
      align-items: center;
      gap: 5px;
    }

    .divider {
      height: 1px;
      background: linear-gradient(to right, transparent, #ddd, transparent);
      margin: 20px 0;
    }

    .quantity-section {
      margin-bottom: 20px;
      background: #f9f9f9;
      padding: 18px;
      border-radius: 15px;
    }

    .quantity-section label {
      display: block;
      font-weight: 600;
      margin-bottom: 12px;
      color: var(--dark);
      font-size: 0.95rem;
    }

    .quantity-control {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 15px;
    }

    .quantity-btn {
      background: var(--orange);
      border: none;
      width: 40px;
      height: 40px;
      border-radius: 12px;
      font-size: 1.3rem;
      color: white;
      cursor: pointer;
      transition: all 0.3s ease;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 600;
      box-shadow: 0 4px 10px rgba(255,140,66,0.3);
    }

    .quantity-btn:hover {
      background: #ff6f00;
      transform: scale(1.1);
      box-shadow: 0 6px 15px rgba(255,140,66,0.5);
    }

    .quantity-btn:active {
      transform: scale(0.95);
    }

    .quantity-input {
      width: 85px;
      text-align: center;
      font-size: 1.2rem;
      font-weight: 700;
      border: 3px solid var(--light-orange);
      border-radius: 12px;
      padding: 10px;
      color: var(--dark);
      background: white;
      transition: all 0.3s ease;
    }

    .quantity-input:focus {
      outline: none;
      border-color: var(--orange);
      box-shadow: 0 0 0 3px rgba(255,140,66,0.2);
    }

    .total-section {
      background: linear-gradient(135deg, var(--light-orange), #ffe4c2);
      padding: 18px;
      border-radius: 15px;
      margin-bottom: 20px;
      text-align: center;
    }

    .total-label {
      font-size: 0.85rem;
      color: #666;
      margin-bottom: 6px;
    }

    .total-price {
      font-size: 1.6rem;
      font-weight: 700;
      color: var(--orange);
    }

    .order-btn {
      width: 100%;
      background: linear-gradient(135deg, var(--orange), #ff6f00);
      color: white;
      border: none;
      padding: 13px;
      border-radius: 12px;
      font-size: 1rem;
      font-weight: 600;
      cursor: pointer;
      transition: 0.3s;
      text-transform: uppercase;
      letter-spacing: 1px;
      box-shadow: 0 5px 15px rgba(255, 140, 66, 0.4);
    }

    .order-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 20px rgba(255, 140, 66, 0.6);
    }

    footer {
      background: #0f1624;
      color: #fff;
      padding: 60px 20px 30px;
    }

    .footer-container {
      max-width: 1200px;
      margin: auto;
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      gap: 40px;
    }

    .footer-brand {
      max-width: 350px;
    }

    .footer-logo {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .footer-logo img {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background: #ff8c42;
      object-fit: cover;
    }

    .footer-logo h2 {
      font-size: 1.4rem;
      font-weight: 600;
      margin: 0;
    }

    .footer-brand p {
      margin-top: 10px;
      color: #dcdcdc;
      font-size: 0.9rem;
      line-height: 1.5;
    }

    .footer-section h3 {
      font-size: 1rem;
      font-weight: 600;
      margin-bottom: 15px;
    }

    .footer-links ul {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    .footer-links li {
      margin-bottom: 10px;
    }

    .footer-links a {
      color: #dcdcdc;
      text-decoration: none;
      transition: 0.3s;
    }

    .footer-links a:hover {
      color: #ff8c42;
    }

    .social-icons {
      display: flex;
      gap: 12px;
    }

    .social-icons a {
      width: 38px;
      height: 38px;
      background: #1a2435;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: 0.3s;
    }

    .social-icons img {
      width: 18px;
      height: 18px;
    }

    .social-icons a:hover {
      background: #ff8c42;
    }

    .footer-line {
      width: 100%;
      height: 1px;
      background: rgba(255,255,255,0.16);
      margin-top: 40px;
    }

    @media(max-width: 768px) {
      .footer-container {
        flex-direction: column;
      }
      
      .modal-content {
        width: 95%;
        margin: 5% auto;
      }
      
      .product-image {
        height: 220px;
      }
      
      header {
        padding: 12px 20px;
      }
      
      nav a {
        margin-left: 10px;
        font-size: 0.9rem;
      }
    }
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
    </nav>
  </header>

  <!-- Best Menu Section -->
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
  </section>

  <!-- Menu List Section -->
  <section class="menu-list">
    <h2>Menu Kami</h2>
    <p class="menu-subtitle">Pilihan menu terbaik dengan cita rasa yang menggugah selera</p>
    <div class="menu-items">
      <div class="menu-item">
        <div class="menu-details">
          <div class="menu-image-wrapper">
             <img src="{{ asset('image/dimsumhome.jpg') }}" alt="Logo">
          </div>
          <div class="menu-text-content">
            <h4>Dimsum Chili Oil</h4>
            <p>Dimsum 6pcs isi ayam lembut dengan sambal chili oil khas KNiverse.</p>
            <div class="menu-price">Rp 12.000</div>
          </div>
        </div>
        {{-- <div class="menu-actions">
          <button class="cart-btn" onclick="openModal('Dimsum Chili Oil', 'asset/gallery2.png', 'Dimsum isi ayam lembut dengan sambal chili oil khas KNiverse yang gurih dan pedas. Cocok untuk camilan atau makan siang.', 12000)">🛒</button>
        </div> --}}
      </div>

      <div class="menu-item">
        <div class="menu-details">
          <div class="menu-image-wrapper">
         <img src="{{ asset('image/jamurenokiy.jpg') }}" alt="Logo">
          </div>
          <div class="menu-text-content">
            <h4>Jamur Enoki Crispy</h4>
            <p>Cemilan renyah yang cocok jadi teman nongkrong.</p>
            <div class="menu-price">Rp 8.000</div>
          </div>
        </div>
        {{-- <div class="menu-actions">
          <button class="cart-btn" onclick="openModal('Jamur Enoki Crispy', 'asset/jamurenokiy.jpg', 'Cemilan renyah yang cocok jadi teman nongkrong. Pedas, gurih, dan bikin nagih! Tersedia dalam berbagai level kepedasan.', 8000)">🛒</button>
        </div> --}}
      </div>

      <div class="menu-item">
        <div class="menu-details">
          <div class="menu-image-wrapper">
              <img src="{{ asset('image/wontonhome.jpg') }}" alt="Logo">
          </div>
          <div class="menu-text-content">
            <h4>Wonton Chili Oil</h4>
            <p>Wonton 6pcs dengan rasanya yang lembut, dan pedasnya pas bikin nagih!</p>
            <div class="menu-price">Rp 12.000</div>
          </div>
        </div>
        {{-- <div class="menu-actions">
          <button class="cart-btn" onclick="openModal('Wonton Chili Oil', 'asset/wontonmenu.jpeg', 'Gurih, lembut, dan pedasnya pas bikin nagih! Wonton dengan isian premium dan saus chili oil yang khas. Satu porsi berisi 5 pcs.', 12000)">🛒</button>
        </div> --}}
      </div>

      <div class="menu-item">
        <div class="menu-details">
          <div class="menu-image-wrapper">
              <img src="{{ asset('image/tahubaksohome.jpg') }}" alt="Logo">
          </div>
          <div class="menu-text-content">
            <h4>Tahu Bakso (2pcs)</h4>
            <p>Tahu isi bakso lezat buatan tangan khas KNiverse.</p>
            <div class="menu-price">Rp 6.000</div>
          </div>
        </div>
        {{-- <div class="menu-actions">
          <button class="cart-btn" onclick="openModal('Tahu Bakso (2pcs)', 'asset/tahubaksohome.jpg', 'Tahu isi bakso lezat buatan tangan khas KNiverse. Perpaduan sempurna antara tahu yang lembut dan bakso yang juicy.', 6000)">🛒</button>
        </div> --}}
      </div>

      <div class="menu-item">
        <div class="menu-details">
          <div class="menu-image-wrapper">
              <img src="{{ asset('image/corndoghome.jpg') }}" alt="Logo">
          </div>
          <div class="menu-text-content">
            <h4>Corndog Saus Crispy</h4>
            <p>Corndog dengan lapisan tepung renyah dan saus manis gurih.</p>
            <div class="menu-price">Rp 10.000</div>
          </div>
        </div>
        {{-- <div class="menu-actions">
          <button class="cart-btn" onclick="openModal('Corndog Saus Crispy', 'asset/Cara-Membuat-Resep-Corndog-Simpel-Renyah-Untuk-Makanan-Sehari-hari.jpg', 'Corndog dengan lapisan tepung renyah dan saus manis gurih. Sosis premium dibungkus tepung Korea yang crispy dan lezat.', 10000)">🛒</button>
        </div> --}}
      </div>

      <div class="menu-item">
        <div class="menu-details">
          <div class="menu-image-wrapper">
             <img src="{{ asset('image/brownies.jpg') }}" alt="Logo">
          </div>
          <div class="menu-text-content">
            <h4>Brownies Jumnawa</h4>
            <p>berisi brownies yang memiliki 5 varian best seller kami.</p>
            <div class="menu-price">Rp 10.000</div>
          </div>
        </div>
        {{-- <div class="menu-actions">
          <button class="cart-btn" onclick="openModal('Brownies Jumnawa', 'asset/brownies.jpg', 'berisi brownies yang memiliki 5 varian best seller kami. Cocok untuk acara, arisan, atau ngemil bareng keluarga. Hemat dan lengkap!', 10000)">🛒</button>
        </div> --}}
      </div>
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
  
  </script>
</body>
</html>