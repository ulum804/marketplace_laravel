<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Login & Register - KNiverse</title>
   @vite(['resources/css/login.css'])
  <style>
   
  </style>
</head>
<body>
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
      <a href="{{ url('/market/order') }}" >Order</a>
           <a href="{{ url('/login') }}" id="login-icon" class="active">
          <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 640 640" fill="currentColor">
              <path d="M409 337C418.4 327.6 418.4 312.4 409 303.1L265 159C258.1 152.1 247.8 150.1 238.8 153.8C229.8 157.5 224 166.3 224 176L224 256L112 256C85.5 256 64 277.5 64 304L64 336C64 362.5 85.5 384 112 384L224 384L224 464C224 473.7 229.8 482.5 238.8 486.2C247.8 489.9 258.1 487.9 265 481L409 337zM416 480C398.3 480 384 494.3 384 512C384 529.7 398.3 544 416 544L480 544C533 544 576 501 576 448L576 192C576 139 533 96 480 96L416 96C398.3 96 384 110.3 384 128C384 145.7 398.3 160 416 160L480 160C497.7 160 512 174.3 512 192L512 448C512 465.7 497.7 480 480 480L416 480z"/>
          </svg>
      </a>
    </nav>
  </header>
  <!-- Main Content -->
  <div class="auth-container">
    <!-- Left Side - Branding -->
    <div class="branding">
      <div class="branding-icon">
        <img src="asset/maskot.png" alt="Maskot" class="branding-maskot" onerror="this.style.display='none'">
      </div>
      <h2>Selamat Datang di Halaman Admin KNiverse!</h2>
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
            {{-- <div class="forgot-password">
              <a href="#" onclick="openForgotModal(); return false;">Lupa password?</a>
            </div> --}}
          </div>

          <button type="submit" class="submit-btn">Masuk Sekarang</button>

          @if ($errors->any())
              <div class="alert alert-danger" style="color: red; font-weight: 600";>
                  {{ $errors->first() }}
              </div>
          @endif

        </form>

        {{-- <div class="divider">
          <span>atau masuk dengan</span>
        </div> --}}

        {{-- <div class="social-login">
          <button class="social-btn" onclick="alert('Login dengan Google (demo)')">
            <img src="asset/google.png" alt="Google" onerror="this.style.display='none'"> Google
          </button>
          <button class="social-btn" onclick="alert('Login dengan Facebook (demo)')">
            <img src="asset/pngwing.com (1).png" alt="Facebook" onerror="this.style.display='none'"> Facebook
          </button>
        </div> --}}
      </div>

      <!-- Register Form -->
      <div id="registerTab" class="tab-content">
        <h3 class="auth-title">Buat Akun Baru</h3>
        <p class="auth-subtitle">Daftar Sebagai Admin</p>

        <form id="registerForm" method="POST" action="{{ route('admin.register.post') }}">
          @csrf
          <div class="form-group">
            <label>Nama Lengkap</label>
            <div class="input-wrapper">
              <span class="input-icon">👤</span>
              <input type="text" class="form-input" name="nama_user" placeholder="Masukkan nama lengkap" required>
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
              <input type="password" class="form-input" id="registerPassword"  name="password" placeholder="Minimal 6 karakter" required minlength="6">
              <button type="button" class="password-toggle" onclick="togglePassword('registerPassword')">
                👁
              </button>
            </div>
          </div>

          {{-- <div class="form-group">
            <label>Konfirmasi Password</label>
            <div class="input-wrapper">
              <span class="input-icon">🔒</span>
              <input type="password" class="form-input" id="confirmPassword" name="confirmPassword" placeholder="Masukkan password lagi" required minlength="6">
              <button type="button" class="password-toggle" onclick="togglePassword('confirmPassword')">
                👁
              </button>
            </div>
          </div> --}}

          <button type="submit" class="submit-btn">Daftar Sekarang</button>
        </form>

        {{-- <div class="divider">
          <span>atau daftar dengan</span>
        </div> --}}

        {{-- <div class="social-login">
          <button class="social-btn" onclick="alert('Daftar dengan Google (demo)')">
            <img src="asset/google.png" alt="Google" onerror="this.style.display='none'"> Google
          </button>
          <button class="social-btn" onclick="alert('Daftar dengan Facebook (demo)')">
            <img src="asset/pngwing.com (1).png" alt="Facebook" onerror="this.style.display='none'"> Facebook
          </button>
        </div> --}}
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
 window.addEventListener('scroll', function() {
      const header = document.getElementById('mainHeader');
      if (window.scrollY > 50) {
        header.classList.add('scrolled');
      } else {
        header.classList.remove('scrolled');
      }
    });
// ----- Tab Switch -----
function switchTab(tab) {
    document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
    document.querySelectorAll('.tab-content').forEach(tabEl => tabEl.classList.remove('active'));

    document.querySelector(`button[onclick="switchTab('${tab}')"]`).classList.add('active');
    document.getElementById(tab + 'Tab').classList.add('active');
}

// ----- Toggle Password Visibility -----
function togglePassword(id) {
    const input = document.getElementById(id);
    input.type = input.type === 'password' ? 'text' : 'password';
}

// ----- Forgot Password Modal -----
function openForgotModal() {
    document.getElementById("forgotModal").style.display = "flex";
}
function closeForgotModal() {
    document.getElementById("forgotModal").style.display = "none";
}

// ----- Reset Password Modal -----
function openResetModal() {
    document.getElementById("resetModal").style.display = "flex";
}
function closeResetModal() {
    document.getElementById("resetModal").style.display = "none";
}

</script>

</body>
</html>