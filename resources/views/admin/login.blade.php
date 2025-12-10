<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Login & Register - KNiverse</title>
  <style>
    :root {
      --orange: #ff8c42;
      --soft-orange: #ffbb7c;
      --light-orange: #ffe4c2;
      --cream: #fff8ef;
      --dark: #2b2b2b;
      --glass: rgba(255,255,255,0.92);
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: "Poppins", system-ui, -apple-system, sans-serif;
      background: linear-gradient(180deg, #fffaf0 0%, var(--cream) 100%);
      color: var(--dark);
      line-height: 1.6;
      min-height: 100vh;
    }


    header {
      position: sticky;
      top: 0;
      z-index: 80;
      backdrop-filter: blur(8px);
      background: var(--glass);
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 12px 28px;
      border-bottom: 3px solid rgba(255,140,66,0.06);
      box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }

    .logo {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .logo img {
      width: 54px;
      height: 54px;
      border-radius: 12px;
      object-fit: cover;
      box-shadow: 0 8px 24px rgba(255,140,66,0.14);
    }

    .logo h1 {
      margin: 0;
      font-size: 1.05rem;
      letter-spacing: 0.6px;
      font-weight: 700;
    }

    .logo p {
      font-size: 0.75rem;
      color: #666;
      margin: 0;
    }

    nav a {
      margin-left: 18px;
      text-decoration: none;
      color: var(--dark);
      font-weight: 600;
      opacity: 0.95;
      position: relative;
      transition: color 0.3s;
    }

    nav a::after {
      content: '';
      position: absolute;
      bottom: -5px;
      left: 0;
      width: 0;
      height: 2px;
      background: var(--orange);
      transition: width 0.3s;
    }

    nav a:hover::after,
    nav a.active::after {
      width: 100%;
    }

    nav a:hover,
    nav a.active {
      color: var(--orange);
    }

    /* Hamburger: smaller, centered, and transforms to a perfect X */
    .hamburger-toggle{
      display:none;
      background:none;
      border:none;
      cursor:pointer;
      position:relative;
      width:36px;
      height:32px;
      padding:6px;
      -webkit-tap-highlight-color: transparent;
      transition:opacity 0.18s ease;
    }

    .hamburger-toggle span{
      display:block;
      position:absolute;
      left:50%;
      transform:translateX(-50%);
      width:22px;
      height:2px;
      background:var(--dark);
      border-radius:2px;
      transition:transform 0.28s cubic-bezier(.2,.8,.2,1),opacity 0.18s ease,background 0.18s;
      transform-origin:center;
    }

    .hamburger-toggle span:nth-child(1){ top:8px }
    .hamburger-toggle span:nth-child(2){ top:15px }
    .hamburger-toggle span:nth-child(3){ top:22px }

    .hamburger-toggle.active span:nth-child(1){ transform: translateX(-50%) translateY(7px) rotate(45deg) }
    .hamburger-toggle.active span:nth-child(2){ opacity:0; transform: translateX(-50%) scaleX(0) }
    .hamburger-toggle.active span:nth-child(3){ transform: translateX(-50%) translateY(-7px) rotate(-45deg) }

    .nav-menu{position:absolute;top:calc(100% + 8px);right:20px;background:white;border-radius:12px;box-shadow:0 8px 24px rgba(0,0,0,0.15);padding:16px 0;min-width:200px;z-index:100;visibility:hidden;opacity:0;transform:translateY(-10px);transition:all 0.3s ease}
    .nav-menu.show{visibility:visible;opacity:1;transform:translateY(0)}
    .nav-menu a{display:block;padding:12px 20px;color:var(--dark);text-decoration:none;margin-left:0;font-weight:500;font-size:0.95rem;transition:all 0.3s ease;border-left:3px solid transparent}
    .nav-menu a:hover,.nav-menu a.active{background:var(--light-orange);border-left-color:var(--orange);color:var(--orange)}
    .header-right{display:flex;align-items:center;gap:8px}

    /* Main Container */
    .auth-container {
      max-width: 1200px;
      margin: 60px auto;
      padding: 0 20px;
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 40px;
      align-items: center;
    }

    /* Left Side - Branding */
    .branding {
      background: linear-gradient(135deg, var(--orange), #ff6f00);
      border-radius: 24px;
      padding: 60px 40px;
      color: white;
      box-shadow: 0 20px 60px rgba(255,140,66,0.3);
    }

    .branding-icon {
      font-size: 80px;
      margin-bottom: 20px;
      animation: float 3s ease-in-out infinite;
      display: flex;
      align-items: center;
      justify-content: flex-start;
    }

    .branding-icon img.branding-maskot {
      width: 120px;
      height: 120px;
      object-fit: contain;
      border-radius: 12px;
      box-shadow: 0 8px 24px rgba(0,0,0,0.12);
    }

    @keyframes float {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-10px); }
    }

    .branding h2 {
      font-size: 2.5rem;
      margin-bottom: 15px;
      font-weight: 700;
    }

    .branding-desc {
      color: rgba(255,255,255,0.9);
      font-size: 1.1rem;
      margin-bottom: 40px;
    }

    .feature-list {
      display: flex;
      flex-direction: column;
      gap: 20px;
    }

    .feature-item {
      display: flex;
      align-items: center;
      gap: 15px;
      background: rgba(255,255,255,0.1);
      backdrop-filter: blur(10px);
      padding: 20px;
      border-radius: 15px;
      transition: transform 0.3s;
    }

    .feature-item:hover {
      transform: translateX(5px);
    }

    .feature-icon {
      width: 50px;
      height: 50px;
      background: rgba(255,255,255,0.2);
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 24px;
      flex-shrink: 0;
    }

    .feature-text h4 {
      font-size: 1.1rem;
      margin-bottom: 5px;
    }

    .feature-text p {
      font-size: 0.9rem;
      color: rgba(255,255,255,0.8);
    }

    /* Right Side - Auth Form */
    .auth-box {
      background: white;
      border-radius: 24px;
      padding: 50px 40px;
      box-shadow: 0 20px 60px rgba(0,0,0,0.1);
    }

    /* Tab Switcher */
    .tab-switcher {
      display: flex;
      gap: 15px;
      margin-bottom: 40px;
    }

    .tab-btn {
      flex: 1;
      padding: 15px;
      border: none;
      border-radius: 12px;
      font-size: 1.1rem;
      font-weight: 700;
      cursor: pointer;
      transition: all 0.3s;
    }

    .tab-btn.active {
      background: var(--orange);
      color: white;
      box-shadow: 0 5px 15px rgba(255,140,66,0.3);
    }

    .tab-btn:not(.active) {
      background: #f5f5f5;
      color: #666;
    }

    .tab-btn:not(.active):hover {
      background: #e8e8e8;
    }

    /* Form */
    .auth-title {
      font-size: 1.8rem;
      font-weight: 700;
      margin-bottom: 10px;
      color: var(--dark);
    }

    .auth-subtitle {
      color: #666;
      margin-bottom: 30px;
    }

    .form-group {
      margin-bottom: 20px;
    }

    .form-group label {
      display: block;
      font-weight: 600;
      margin-bottom: 8px;
      color: var(--dark);
      font-size: 0.95rem;
    }

    .input-wrapper {
      position: relative;
    }

    .input-icon {
      position: absolute;
      left: 15px;
      top: 50%;
      transform: translateY(-50%);
      color: #999;
      font-size: 20px;
    }

    .form-input {
      width: 100%;
      padding: 15px 15px 15px 50px;
      border: 2px solid #e5e5e5;
      border-radius: 12px;
      font-size: 1rem;
      transition: all 0.3s;
      font-family: inherit;
    }

    .form-input:focus {
      outline: none;
      border-color: var(--orange);
      box-shadow: 0 0 0 4px rgba(255,140,66,0.1);
    }

    .password-toggle {
      position: absolute;
      right: 15px;
      top: 50%;
      transform: translateY(-50%);
      background: none;
      border: none;
      cursor: pointer;
      color: #999;
      font-size: 20px;
      padding: 5px;
    }

    .password-toggle:hover {
      color: var(--orange);
    }

    .forgot-password {
      text-align: right;
      margin-top: 10px;
    }

    .forgot-password a {
      color: var(--orange);
      text-decoration: none;
      font-size: 0.9rem;
      font-weight: 600;
    }

    .forgot-password a:hover {
      text-decoration: underline;
    }

    .submit-btn {
      width: 100%;
      padding: 16px;
      background: linear-gradient(135deg, var(--orange), #ff6f00);
      color: white;
      border: none;
      border-radius: 12px;
      font-size: 1.1rem;
      font-weight: 700;
      cursor: pointer;
      transition: all 0.3s;
      margin-top: 10px;
      box-shadow: 0 5px 15px rgba(255,140,66,0.3);
    }

    .submit-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 20px rgba(255,140,66,0.4);
    }

    .submit-btn:active {
      transform: translateY(0);
    }

    /* Tab Content */
    .tab-content {
      display: none;
    }

    .tab-content.active {
      display: block;
      animation: fadeIn 0.5s;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .divider {
      text-align: center;
      margin: 30px 0;
      position: relative;
    }

    .divider::before,
    .divider::after {
      content: '';
      position: absolute;
      top: 50%;
      width: 45%;
      height: 1px;
      background: #e5e5e5;
    }

    .divider::before { left: 0; }
    .divider::after { right: 0; }

    .divider span {
      background: white;
      padding: 0 15px;
      color: #999;
      font-size: 0.9rem;
    }

    .social-login {
      display: flex;
      gap: 15px;
      margin-top: 20px;
    }

    .social-btn {
      flex: 1;
      padding: 12px;
      border: 2px solid #e5e5e5;
      border-radius: 12px;
      background: white;
      cursor: pointer;
      font-weight: 600;
      transition: all 0.3s;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
    }

    .social-btn img {
      width: 22px;
      height: 22px;
      object-fit: contain;
      display: inline-block;
      margin-right: 8px;
    }

    .social-btn:hover {
      border-color: var(--orange);
      color: var(--orange);
    }

    /* Responsive */
    @media (max-width: 968px) {
      .hamburger-toggle{display:flex}
      header{padding:12px 20px;justify-content:space-between;align-items:center}
      nav{display:none}
      .header-right{display:flex}
      .auth-container {
        grid-template-columns: 1fr;
        margin: 40px auto;
      }

      .branding {
        padding: 40px 30px;
      }

      .branding h2 {
        font-size: 2rem;
      }

      .auth-box {
        padding: 40px 30px;
      }

      header {
        padding: 12px 20px;
      }

      nav a {
        margin-left: 10px;
        font-size: 0.9rem;
      }

      .branding-icon img.branding-maskot {
        width: 100px;
        height: 100px;
      }
    }

    @media (max-width: 640px) {
      .auth-container {
        grid-template-columns: 1fr;
        gap: 20px;
        margin: 30px auto;
      }

      .branding {
        padding: 40px 20px;
        order: 2;
      }

      .branding h2 {
        font-size: 1.8rem;
      }

      .auth-box {
        padding: 30px 20px;
        order: 1;
      }

      .form-input {
        padding: 12px 12px 12px 40px;
        font-size: 16px;
      }

      .submit-btn {
        padding: 14px;
        font-size: 1rem;
      }

      .auth-title {
        font-size: 1.5rem;
      }

      .tab-btn {
        padding: 12px;
        font-size: 0.95rem;
      }

      .feature-item {
        padding: 15px;
        gap: 10px;
      }

      .feature-icon {
        width: 40px;
        height: 40px;
        font-size: 20px;
      }

      .feature-text h4 {
        font-size: 0.95rem;
      }

      .feature-text p {
        font-size: 0.85rem;
      }
    }

    @media (max-width: 480px) {
      header {
        flex-direction: column;
        gap: 10px;
        padding: 10px 15px;
      }

      .logo {
        width: 100%;
      }

      .auth-container {
        margin: 20px auto;
      }

      .branding-icon img.branding-maskot {
        width: 80px;
        height: 80px;
      }

      .branding-desc {
        font-size: 0.95rem;
      }

      .feature-list {
        gap: 12px;
      }

      .auth-box {
        padding: 20px 15px;
      }

      .form-group {
        margin-bottom: 15px;
      }

      .form-group label {
        font-size: 0.9rem;
      }

      .social-login {
        flex-direction: column;
      }

      .social-btn {
        width: 100%;
      }

      .modal-content {
        padding: 20px 15px;
      }
    }

    /* Success Message */
    .success-message {
      background: #d4edda;
      color: #155724;
      padding: 15px;
      border-radius: 12px;
      margin-bottom: 20px;
      display: none;
      border: 1px solid #c3e6cb;
    }

    .success-message.show {
      display: block;
      animation: slideDown 0.5s;
    }

    @keyframes slideDown {
      from { opacity: 0; transform: translateY(-10px); }
      to { opacity: 1; transform: translateY(0); }
    }

    /* Forgot Password Modal */
    .modal {
      position: fixed;
      inset: 0;
      display: none;
      align-items: center;
      justify-content: center;
      background: rgba(0,0,0,0.5);
      z-index: 1000;
      padding: 20px;
    }

    .modal[aria-hidden="false"] {
      display: flex;
    }

    .modal-content {
      position: relative;
      background: #fff;
      border-radius: 12px;
      padding: 24px;
      max-width: 460px;
      width: 100%;
      box-shadow: 0 20px 60px rgba(0,0,0,0.2);
    }

    .modal-content h3 {
      margin: 0 0 8px 0;
      font-size: 1.25rem;
    }

    .modal-close {
      position: absolute;
      right: 12px;
      top: 8px;
      background: none;
      border: none;
      font-size: 24px;
      cursor: pointer;
      color: #666;
    }
  </style>
</head>
<body>
  <!-- Header - sama seperti index.html -->
  {{-- <header id="mainHeader">
    <div class="logo">
      <img src="asset/logoUsaha.png" alt="logo" onerror="this.style.display='none'">
      <div>
        <h1>KNIVERSE</h1>
        <p>Keliling Nikmat, Penuh Rasa</p>
      </div>
    </div>

    <nav>
      <a href="index.html">Home</a>
      <a href="about.html">About Us</a>
      <a href="menu.html">Menu</a>
      <a href="order.html">Order</a>
    </nav>

    <div class="header-right">
      <button class="hamburger-toggle" id="hamburgerToggle">
        <span></span>
        <span></span>
        <span></span>
      </button>
    </div>

    <div class="nav-menu" id="navMenu">
      <a href="index.html">Home</a>
      <a href="about.html">About Us</a>
      <a href="menu.html">Menu</a>
      <a href="order.html">Order</a>
    </div>
  </header> --}}

  <!-- Main Content -->
  <div class="auth-container">
    <!-- Left Side - Branding -->
    <div class="branding">
      <div class="branding-icon">
        <img src="asset/maskot.png" alt="Maskot" class="branding-maskot" onerror="this.style.display='none'">
      </div>
      <h2>Selamat Datang di KNiverse!</h2>
      <p class="branding-desc">
        Keliling Nikmat, Penuh Rasa! Bergabunglah dengan komunitas pecinta kuliner homemade terbaik.
      </p>

      <div class="feature-list">
        <div class="feature-item">
          <div class="feature-icon">🎯</div>
          <div class="feature-text">
            <h4>Fresh Daily</h4>
            <p>Dibuat segar setiap hari</p>
          </div>
        </div>

        <div class="feature-item">
          <div class="feature-icon">❤</div>
          <div class="feature-text">
            <h4>Premium Quality</h4>
            <p>Bahan berkualitas terbaik</p>
          </div>
        </div>

        <div class="feature-item">
          <div class="feature-icon">🚚</div>
          <div class="feature-text">
            <h4>Fast Delivery</h4>
            <p>Pengiriman cepat & aman</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Right Side - Auth Form -->
    <div class="auth-box">
      <!-- Success Message -->
      <div class="success-message" id="successMessage"></div>

      <!-- Tab Switcher -->
      <div class="tab-switcher">
        <button class="tab-btn active" onclick="switchTab('login')">Login</button>
        <button class="tab-btn" onclick="switchTab('register')">Register</button>
      </div>

      <!-- Login Form -->
      <div id="loginTab" class="tab-content active">
        <h3 class="auth-title">Masuk ke Akun Anda</h3>
        <p class="auth-subtitle">Masukkan email dan password untuk melanjutkan</p>

        <form id="loginForm" onsubmit="handleLogin(event)" method="POST" action="{{ route('admin.login.post')}}">
          @csrf
          <div class="form-group">
            <label>Email</label>
            <div class="input-wrapper">
              <span class="input-icon">📧</span>
              <input type="email" class="form-input" name="email" placeholder="contoh@email.com" required>
            </div>
          </div>

          <div class="form-group">
            <label>Password</label>
            <div class="input-wrapper">
              <span class="input-icon">🔒</span>
              <input type="password" class="form-input" id="loginPassword" name="password" placeholder="Masukkan password" required>
              <button type="button" class="password-toggle" onclick="togglePassword('loginPassword')">
                👁
              </button>
            </div>
            <div class="forgot-password">
              <a href="#" onclick="openForgotModal(); return false;">Lupa password?</a>
            </div>
          </div>

          <button type="submit" class="submit-btn">Masuk Sekarang</button>
        </form>

        <div class="divider">
          <span>atau masuk dengan</span>
        </div>

        <div class="social-login">
          <button class="social-btn" onclick="alert('Login dengan Google (demo)')">
            <img src="asset/google.png" alt="Google" onerror="this.style.display='none'"> Google
          </button>
          <button class="social-btn" onclick="alert('Login dengan Facebook (demo)')">
            <img src="asset/pngwing.com (1).png" alt="Facebook" onerror="this.style.display='none'"> Facebook
          </button>
        </div>
      </div>

      <!-- Register Form -->
      <div id="registerTab" class="tab-content">
        <h3 class="auth-title">Buat Akun Baru</h3>
        <p class="auth-subtitle">Daftar untuk menikmati promo dan kemudahan berbelanja</p>

        <form id="registerForm" method="POST" action="{{ route('admin.register.post') }}">
          @csrf
          <div class="form-group">
            <label>Nama Lengkap</label>
            <div class="input-wrapper">
              <span class="input-icon">👤</span>
              <input type="text" class="form-input" name="name" placeholder="Masukkan nama lengkap" required>
            </div>
          </div>

          <div class="form-group">
            <label>Email</label>
            <div class="input-wrapper">
              <span class="input-icon">📧</span>
              <input type="email" class="form-input" name="email" placeholder="contoh@email.com" required>
            </div>
          </div>

          {{-- <div class="form-group">
            <label>Nomor Telepon</label>
            <div class="input-wrapper">
              <span class="input-icon">📱</span>
              <input type="tel" class="form-input" name="phone" placeholder="08xx xxxx xxxx" required>
            </div>
          </div>

          <div class="form-group">
            <label>Alamat</label>
            <div class="input-wrapper">
              <span class="input-icon">📍</span>
              <input type="text" class="form-input" name="address" placeholder="Masukkan alamat lengkap" required>
            </div>
          </div> --}}

          <div class="form-group">
            <label>Password</label>
            <div class="input-wrapper">
              <span class="input-icon">🔒</span>
              <input type="password" class="form-input" id="registerPassword" name="password" placeholder="Minimal 6 karakter" required minlength="6">
              <button type="button" class="password-toggle" onclick="togglePassword('registerPassword')">
                👁
              </button>
            </div>
          </div>

          <div class="form-group">
            <label>Konfirmasi Password</label>
            <div class="input-wrapper">
              <span class="input-icon">🔒</span>
              <input type="password" class="form-input" id="confirmPassword" name="confirmPassword" placeholder="Masukkan password lagi" required minlength="6">
              <button type="button" class="password-toggle" onclick="togglePassword('confirmPassword')">
                👁
              </button>
            </div>
          </div>

          <button type="submit" class="submit-btn">Daftar Sekarang</button>
        </form>

        <div class="divider">
          <span>atau daftar dengan</span>
        </div>

        <div class="social-login">
          <button class="social-btn" onclick="alert('Daftar dengan Google (demo)')">
            <img src="asset/google.png" alt="Google" onerror="this.style.display='none'"> Google
          </button>
          <button class="social-btn" onclick="alert('Daftar dengan Facebook (demo)')">
            <img src="asset/pngwing.com (1).png" alt="Facebook" onerror="this.style.display='none'"> Facebook
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- Forgot Password Modal -->
  <div id="forgotModal" class="modal" aria-hidden="true">
    <div class="modal-content">
      <button class="modal-close" onclick="closeForgotModal()" aria-label="Close">&times;</button>
      <h3>Reset Password</h3>
      <p>Masukkan email Anda untuk menerima kode reset password.</p>

      <div class="form-group" style="margin-top:12px; margin-bottom:8px;">
        <input type="email" id="forgotEmail" class="form-input" placeholder="email@contoh.com" required>
      </div>

      <div style="display:flex; gap:10px; margin-top:8px;">
        <button class="submit-btn" onclick="sendResetCode()">Kirim Kode</button>
        <button class="tab-btn" onclick="closeForgotModal()" style="background:#f5f5f5; color:#666; border-radius:12px; padding:12px;">Batal</button>
      </div>

      <p id="forgotMsg" style="margin-top:12px; font-weight:600;"></p>
    </div>
  </div>

  <!-- Reset Password Modal -->
  <div id="resetModal" class="modal" aria-hidden="true">
    <div class="modal-content">
      <button class="modal-close" onclick="closeResetModal()" aria-label="Close">&times;</button>
      <h3>Masukkan Kode & Password Baru</h3>
      <p>Masukkan kode 6 digit yang dikirim ke email Anda, lalu masukkan password baru.</p>

      <div class="form-group" style="margin-top:12px;">
        <input type="text" id="resetCodeInput" class="form-input" placeholder="Kode 6 digit" inputmode="numeric" pattern="[0-9]*">
      </div>
      <div class="form-group">
        <input type="password" id="newPassword" class="form-input" placeholder="Password baru (minimal 6 karakter)">
      </div>
      <div class="form-group">
        <input type="password" id="confirmNewPassword" class="form-input" placeholder="Konfirmasi password baru">
      </div>

      <div style="display:flex; gap:10px; margin-top:8px;">
        <button class="submit-btn" onclick="verifyResetAndSave()">Simpan Password Baru</button>
        <button class="tab-btn" onclick="closeResetModal()" style="background:#f5f5f5; color:#666; border-radius:12px; padding:12px;">Batal</button>
      </div>

      <p id="resetMsg" style="margin-top:12px; font-weight:600;"></p>
    </div>
  </div>

  <script src="https://cdn.emailjs.com/sdk/2.3.2/email.min.js"></script>
  <script>
    // EmailJS setup notes:
    // 1) Create an account at https://www.emailjs.com/, add an email service and a template.
    // 2) Replace the placeholders below with your EmailJS values:
    //    - EMAILJS_USER_ID: public user ID (emailjs.init)
    //    - EMAILJS_SERVICE_ID: service id (e.g. 'service_xxx')
    //    - EMAILJS_TEMPLATE_ID: template id (e.g. 'template_xxx')
    // 3) In your EmailJS template, include variables like to_email and reset_code.
    // Example templateParams: { to_email: 'user@example.com', reset_code: '123456' }
    const EMAILJS_USER_ID = 'YOUR_EMAILJS_USER_ID';
    const EMAILJS_SERVICE_ID = 'your_service_id';
    const EMAILJS_TEMPLATE_ID = 'your_template_id';

    if (window.emailjs && EMAILJS_USER_ID && EMAILJS_USER_ID !== 'YOUR_EMAILJS_USER_ID') {
      try { emailjs.init(EMAILJS_USER_ID); } catch (e) { console.warn('emailjs init failed', e); }
    }
    // Header scroll effect
    window.addEventListener('scroll', function() {
      const header = document.getElementById('mainHeader');
      if (window.scrollY > 50) {
        header.style.boxShadow = '0 4px 20px rgba(0,0,0,0.1)';
      } else {
        header.style.boxShadow = '0 2px 10px rgba(0,0,0,0.05)';
      }
    });

    // Switch between Login and Register tabs
    function switchTab(tab) {
      const loginTab = document.getElementById('loginTab');
      const registerTab = document.getElementById('registerTab');
      const tabs = document.querySelectorAll('.tab-btn');
      
      // Hide success message when switching tabs
      document.getElementById('successMessage').classList.remove('show');
      
      if (tab === 'login') {
        loginTab.classList.add('active');
        registerTab.classList.remove('active');
        tabs[0].classList.add('active');
        tabs[1].classList.remove('active');
      } else {
        loginTab.classList.remove('active');
        registerTab.classList.add('active');
        tabs[0].classList.remove('active');
        tabs[1].classList.add('active');
      }
    }

    // Toggle password visibility
    function togglePassword(inputId) {
      const input = document.getElementById(inputId);
      const button = input.nextElementSibling;
      
      if (input.type === 'password') {
        input.type = 'text';
        button.textContent = '🙈';
      } else {
        input.type = 'password';
        button.textContent = '👁';
      }
    }

    // Show success message
    function showSuccess(message) {
      const successMsg = document.getElementById('successMessage');
      successMsg.textContent = message;
      successMsg.classList.add('show');
      
      setTimeout(() => {
        successMsg.classList.remove('show');
      }, 5000);
    }

    // Handle Login
    function handleLogin(event) {
      event.preventDefault();
      
      const formData = new FormData(event.target);
      const email = formData.get('email');
      const password = formData.get('password');
      
      console.log('Login attempt:', { email, password });
      
      // Check stored users
      const stored = getUsers();
      if (stored[email] && stored[email] === password) {
        showSuccess('✅ Login berhasil! Selamat datang kembali.');
        // set current user
        try { localStorage.setItem('kniverse_current_user', email); } catch (e) {}
        // Reset form
        event.target.reset();
        // Redirect ke halaman home setelah 1.2 detik
        setTimeout(() => { window.location.href = 'index.html'; }, 1200);
        return;
      }

      // If no stored user, show error
      alert('Email atau password salah. Pastikan Anda sudah terdaftar atau gunakan password yang benar.');
    }

    // Handle Register
    function handleRegister(event) {
      event.preventDefault();

      const formData = new FormData(event.target);
      const password = formData.get('password');
      const confirmPassword = formData.get('confirmPassword');

      // Validasi password match
      if (password !== confirmPassword) {
        alert('❌ Password tidak cocok! Silakan coba lagi.');
        return;
      }

      // Submit form to backend
      fetch(event.target.action, {
        method: 'POST',
        body: formData,
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          showSuccess('✅ ' + data.message);
          // Reset form
          event.target.reset();
          // Pindah ke tab login setelah 2 detik
          setTimeout(() => {
            switchTab('login');
          }, 2000);
        } else {
          alert('❌ Registrasi gagal: ' + (data.message || 'Terjadi kesalahan'));
        }
      })
      .catch(error => {
        console.error('Error:', error);
        alert('❌ Terjadi kesalahan saat registrasi. Silakan coba lagi.');
      });
    }

    // Prevent form resubmission on page refresh
    if (window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
    }

    // Simple client-side user store helpers (localStorage)
    function getUsers() {
      try {
        const raw = localStorage.getItem('kniverse_users');
        return raw ? JSON.parse(raw) : {};
      } catch (e) {
        return {};
      }
    }

    function saveUsers(obj) {
      try { localStorage.setItem('kniverse_users', JSON.stringify(obj)); } catch (e) {}
    }

    function saveUser(email, password) {
      if (!email) return;
      const users = getUsers();
      users[email] = password;
      saveUsers(users);
    }

    // Forgot-password modal functions
    function openForgotModal() {
      const m = document.getElementById('forgotModal');
      m.setAttribute('aria-hidden', 'false');
      setTimeout(() => {
        const e = document.getElementById('forgotEmail');
        if (e) e.focus();
      }, 100);
    }

    function closeForgotModal() {
      const m = document.getElementById('forgotModal');
      m.setAttribute('aria-hidden', 'true');
      const msg = document.getElementById('forgotMsg');
      if (msg) msg.textContent = '';
      const e = document.getElementById('forgotEmail');
      if (e) e.value = '';
    }

    function sendResetCode() {
      const email = (document.getElementById('forgotEmail') || {}).value || '';
      const msgEl = document.getElementById('forgotMsg');
      const emailTrim = email.trim();
      const emailRegex = /^\S+@\S+\.\S+$/;
      if (!emailTrim || !emailRegex.test(emailTrim)) {
        msgEl.textContent = 'Masukkan alamat email yang valid.';
        msgEl.style.color = 'red';
        return;
      }

      // Generate 6-digit code and store in sessionStorage (simulation)
      const code = Math.floor(100000 + Math.random() * 900000);
      try {
        sessionStorage.setItem('kniverse_reset_code_' + emailTrim, String(code));
      } catch (e) {
        // ignore storage errors
      }

      // Prepare email subject/body for fallback
      const subject = 'Kode Reset Password KNiverse';
      const body = 'Halo,\n\nGunakan kode berikut untuk mereset password Anda: ' + code + '\n\nJika Anda tidak meminta reset, abaikan pesan ini.\n\nTerima kasih.';

      // Try to send via EmailJS if configured (replace placeholders above)
      const templateParams = {
        to_email: emailTrim,
        reset_code: String(code),
        // add other template variables if your template requires them
      };

      function fallbackMailto() {
        window.location.href = 'mailto:' + encodeURIComponent(emailTrim) + '?subject=' + encodeURIComponent(subject) + '&body=' + encodeURIComponent(body);
        msgEl.textContent = 'Kode telah dibuat dan (simulasi) dikirim. Periksa email Anda.';
        msgEl.style.color = 'green';
        setTimeout(() => { closeForgotModal(); openResetModal(emailTrim); }, 900);
      }

      if (window.emailjs && EMAILJS_SERVICE_ID !== 'your_service_id' && EMAILJS_TEMPLATE_ID !== 'your_template_id') {
        emailjs.send(EMAILJS_SERVICE_ID, EMAILJS_TEMPLATE_ID, templateParams)
        .then(function() {
          msgEl.textContent = 'Kode telah dikirim ke email Anda.';
          msgEl.style.color = 'green';
          setTimeout(() => { closeForgotModal(); openResetModal(emailTrim); }, 900);
        }, function(err) {
          console.warn('EmailJS send error, falling back to mailto', err);
          fallbackMailto();
        });
      } else {
        // EmailJS not configured — fallback to mailto
        fallbackMailto();
      }
    }

    // Reset modal functions
    function openResetModal(email) {
      const m = document.getElementById('resetModal');
      m.setAttribute('aria-hidden', 'false');
      // store the email on the modal element for later use
      m.dataset.email = email || '';
      setTimeout(() => {
        const e = document.getElementById('resetCodeInput');
        if (e) e.focus();
      }, 100);
    }

    function closeResetModal() {
      const m = document.getElementById('resetModal');
      m.setAttribute('aria-hidden', 'true');
      const msg = document.getElementById('resetMsg');
      if (msg) msg.textContent = '';
      const codeEl = document.getElementById('resetCodeInput'); if (codeEl) codeEl.value = '';
      const np = document.getElementById('newPassword'); if (np) np.value = '';
      const cp = document.getElementById('confirmNewPassword'); if (cp) cp.value = '';
    }

    function verifyResetAndSave() {
      const m = document.getElementById('resetModal');
      const email = (m && m.dataset && m.dataset.email) ? m.dataset.email : '';
      const codeInput = (document.getElementById('resetCodeInput') || {}).value || '';
      const newPw = (document.getElementById('newPassword') || {}).value || '';
      const confirmPw = (document.getElementById('confirmNewPassword') || {}).value || '';
      const msgEl = document.getElementById('resetMsg');

      if (!email) { msgEl.textContent = 'Email tidak tersedia.'; msgEl.style.color = 'red'; return; }
      if (!codeInput || !/^[0-9]{6}$/.test(codeInput.trim())) { msgEl.textContent = 'Masukkan kode 6 digit.'; msgEl.style.color = 'red'; return; }
      if (newPw.length < 6) { msgEl.textContent = 'Password harus minimal 6 karakter.'; msgEl.style.color = 'red'; return; }
      if (newPw !== confirmPw) { msgEl.textContent = 'Password konfirmasi tidak cocok.'; msgEl.style.color = 'red'; return; }

      const saved = sessionStorage.getItem('kniverse_reset_code_' + email);
      if (!saved) { msgEl.textContent = 'Kode tidak ditemukan atau sudah kadaluwarsa.'; msgEl.style.color = 'red'; return; }
      if (saved !== codeInput.trim()) { msgEl.textContent = 'Kode tidak cocok.'; msgEl.style.color = 'red'; return; }

      // All good: save new password
      saveUser(email, newPw);
      // Remove the reset code
      try { sessionStorage.removeItem('kniverse_reset_code_' + email); } catch (e) {}

      msgEl.textContent = '✅ Password Anda telah diperbarui. Anda akan otomatis masuk.';
      msgEl.style.color = 'green';
      // set current user and redirect to home after short delay
      try { localStorage.setItem('kniverse_current_user', email); } catch (e) {}
      setTimeout(() => {
        closeResetModal();
        window.location.href = 'index.html';
      }, 1400);
    }

    // Hamburger menu toggle
    const hamburgerToggle = document.getElementById('hamburgerToggle');
    const navMenu = document.getElementById('navMenu');
    
    hamburgerToggle.addEventListener('click', () => {
      hamburgerToggle.classList.toggle('active');
      navMenu.classList.toggle('show');
    });

    // Close menu when clicking on a link
    document.querySelectorAll('.nav-menu a').forEach(link => {
      link.addEventListener('click', () => {
        hamburgerToggle.classList.remove('active');
        navMenu.classList.remove('show');
      });
    });

    // Close menu when clicking outside
    document.addEventListener('click', (e) => {
      if (!e.target.closest('header')) {
        hamburgerToggle.classList.remove('active');
        navMenu.classList.remove('show');
      }
    });
  </script>
</body>
</html>