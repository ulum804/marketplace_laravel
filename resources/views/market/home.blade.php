<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>KNiverse — Keliling Nikmat, Penuh Rasa!</title>
  @vite('resources/css/home.css','resources/js/home.js')
  <!-- Styles -->
  <style>
   
  </style>
</head>
<body>

  <!-- Promo ribbon -->
  <div class="promo-ribbon" id="ribbon">FREE ONGKIR <small>Min. Rp50.000</small></div>

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
       <a href="{{ url('/market/home') }}" class="active" >Home</a>
      <a href="{{ url('/market/about') }}">About Us</a>
      <a href="{{ url('/market/menu') }}" >Menu</a>
      <a href="{{ url('/market/order') }}">Order</a>
        <a href="{{ url('/admin/login') }}" class="login-icon">
          <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 640 640" fill="currentColor">
              <path d="M409 337C418.4 327.6 418.4 312.4 409 303.1L265 159C258.1 152.1 247.8 150.1 238.8 153.8C229.8 157.5 224 166.3 224 176L224 256L112 256C85.5 256 64 277.5 64 304L64 336C64 362.5 85.5 384 112 384L224 384L224 464C224 473.7 229.8 482.5 238.8 486.2C247.8 489.9 258.1 487.9 265 481L409 337zM416 480C398.3 480 384 494.3 384 512C384 529.7 398.3 544 416 544L480 544C533 544 576 501 576 448L576 192C576 139 533 96 480 96L416 96C398.3 96 384 110.3 384 128C384 145.7 398.3 160 416 160L480 160C497.7 160 512 174.3 512 192L512 448C512 465.7 497.7 480 480 480L416 480z"/>
          </svg>
      </a>

    </nav>
  </header>
  <!-- Hero -->
  <section class="hero" role="region" aria-label="hero">
    <div class="hero-left">
      <div class="tagline">Sejuta Kenangan • Satu Rasa</div>
      <h2>KNIVERSE</h2>
      <p>Fresh daily. Resep rumahan. Packaging rapi. Rasa premium, service cepat, repeat-customer guaranteed.</p>

      <div class="cta-row">
        <!-- Pesan -> mengarah ke halaman order.html -->
        <a href="{{ url('/market/order') }}" class="btn-primary">Pesan Sekarang — ke Halaman Order</a>
        <!-- Ghost untuk info -->
        <a href="{{ url('/market/about') }}" class="btn-ghost">Tentang Kami</a>
      </div>

      <div style="margin-top:16px;color:rgba(255,255,255,0.92);font-weight:700">
        <span style="background:rgba(255,255,255,0.12);padding:6px 10px;border-radius:999px">Trusted • Homemade • Fast Delivery</span>
      </div>
    </div>

    <div class="hero-right">
      <img src="{{ asset('image/Bannerd.jpg') }}" alt="Banner KNiverse">
    </div>
  </section>

  <!-- USP -->
  <section class="usp" aria-label="keunggulan">
    <div class="usp-card">🍲 Fresh Daily<small>Siap setiap hari</small></div>
    <div class="usp-card">❤️ Homemade Quality<small>Sentuhan rumah, rasa premium</small></div>
    <div class="usp-card">🚚 Fast Delivery<small>Pengiriman cepat & aman</small></div>
    <div class="usp-card">🔥 Rasa Nagih<small>Repeat-order guarantee</small></div>
  </section>

  <!-- Highlight Promo Strip -->
  <div style="padding:14px 6%;text-align:center;background:#fff4e8;color:var(--orange);font-weight:800;font-size:.95rem;border-bottom:3px dashed var(--orange)">
    🎉 PROMO BULAN INI! Beli 3 menu bebas ongkir + Chili Oil GRATIS ✨
  </div>

 
  <!-- Menu preview -->
  <section class="menu-preview" id="menu" aria-label="menu favorit">
    <h3 style="text-align:center;color:var(--dark);margin-top:6px">Menu Favorit</h3>
    <div style="text-align:center;color:var(--muted);max-width:700px;margin:6px auto 22px">Pilih cepat, lalu ke halaman Order untuk mengisi data dan menyelesaikan pembayaran.</div>

    <div class="menu-grid">
      <article class="menu-card" data-id="wonton">
        <img src="{{ asset('image/wontonhome.jpg') }}" alt="Wonton Chili Oil">
        <h4>Wonton Chili Oil</h4>
        <p>Wonton lembut + chili oil homemade. Paket 6 pcs.</p>
      </article>

      <article class="menu-card" data-id="corndog">
        <img src="{{ asset('image/corndoghome.jpg') }}" alt="Corndog Crispy">
        <h4>Corndog Sosis Crispy</h4>
        <p>Renyah di luar, juicy di dalam. Saus sate khas.</p>
      </article>

      <article class="menu-card" data-id="dimsum">
        <img src="{{ asset('image/dimsumhome.jpg') }}" alt="Dimsum Premium">
        <h4>Dimsum Premium</h4>
        <p>Isi 6 pcs, tekstur lembut, cocok untuk sharing.</p>
      </article>
    </div>
  </section>
 <!-- Kenapa Harus KNiverse -->
  <section style="padding:60px 6%;background:white">
    <h2 style="text-align:center;margin:0;color:var(--dark);font-size:1.9rem;font-weight:800">Kenapa Harus KNiverse?</h2>
    <p style="text-align:center;color:var(--muted);max-width:700px;margin:10px auto 32px;font-size:1.05rem">
      Kami percaya camilan enak bukan cuma soal rasa — tapi pengalaman lengkap.
    </p>

    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:22px">
      <div style="background:#fff7ef;border-radius:14px;padding:18px;font-weight:600;box-shadow:0 8px 20px rgba(0,0,0,0.05)">
        👨‍🍳 Dibuat Setiap Hari <br><small style="color:var(--muted)">Selalu fresh, tanpa simpan lama</small>
      </div>

      <div style="background:#fff7ef;border-radius:14px;padding:18px;font-weight:600;box-shadow:0 8px 20px rgba(0,0,0,0.05)">
        🧴 Higienis & Aman <br><small style="color:var(--muted)">Quality control ketat</small>
      </div>

      <div style="background:#fff7ef;border-radius:14px;padding:18px;font-weight:600;box-shadow:0 8px 20px rgba(0,0,0,0.05)">
        ⭐ Rated 4.9/5 Customer <br><small style="color:var(--muted)">Dipercaya ratusan pelanggan</small>
      </div>

      <div style="background:#fff7ef;border-radius:14px;padding:18px;font-weight:600;box-shadow:0 8px 20px rgba(0,0,0,0.05)">
        🚀 Fast Response <br><small style="color:var(--muted)">Order cepat, packing rapi</small>
      </div>
    </div>
  </section>

  <!-- Signature Menu Extra -->
  <section class="menu-preview" style="padding-top:36px;padding-bottom:24px;background:linear-gradient(180deg,#fff9e9,#fff7ef)">
    <h3 style="text-align:center;color:var(--dark);margin-top:6px">Menu Signature Lainnya</h3>
    <div style="text-align:center;color:var(--muted);max-width:700px;margin:6px auto 22px">Klik menu untuk lihat detail di halaman Menu atau lanjut ke Order.</div>

    <div class="menu-grid">
      <article class="menu-card" data-id="gyoza">
        <img src="{{ asset('image/jamurenokiy.jpg') }}" alt="Gyoza Premium">
        <h4>Jamur enoki Crispy</h4>
        <p>jamur enoki yang cruncy, dibalut sauce spesial.</p>
      </article>

      <article class="menu-card" data-id="mochi">
        <img src="{{ asset('image/tahubaksohome.jpg') }}" alt="Mochi Dessert">
        <h4>Tahu bakso</h4>
        <p>daging lembut, dibalut dengan tahu yang premium serta sausage Tomat & Sambal.</p>
      </article>

      <article class="menu-card" data-id="sausage">
        <img src="{{ asset('image/risol-mayo.jpg') }}" alt="Saus Chili Garlic">
        <h4>Risol Mayo</h4>
        <p>crispiy pedas gurih — favorit pelanggan.</p>
      </article>
    </div>
  </section>

  <!-- Cara Order -->
  <section style="padding:60px 6%;background:linear-gradient(180deg,#fff8ef,#fff3e0)">
    <h2 style="text-align:center;color:var(--dark);margin-top:0;font-size:1.9rem;font-weight:800">Cara Order</h2>
    
    <div style="display:flex;flex-direction:column;gap:14px;max-width:520px;margin:22px auto;font-size:1.05rem">
      <div>1️⃣ Pilih menu di halaman Menu</div>
      <div>2️⃣ Klik tombol <strong>Pesan Sekarang</strong> untuk ke halaman Order</div>
      <div>3️⃣ Isi data & kirim (Nama / Menu / Jumlah / Alamat)</div>
      <div>4️⃣ Lakukan pembayaran (transfer / QRIS)</div>
      <div>5️⃣ Pesanan diproses & dikirim cepat 🚚✨</div>
    </div>

    <div style="text-align:center;margin-top:24px">
      <a href="{{ url('/market/order') }}" class="btn-primary" style="display:inline-block;font-size:1.05rem;padding:14px 26px">
        Lanjut ke Halaman Order 🚀
      </a>
    </div>
  </section>

  <!-- Testimonial -->
  <section class="testi" aria-label="testimoni pelanggan">
    <h3 style="text-align:center;color:var(--dark)">Apa Kata Mereka?</h3>
    <div class="testi-grid">
      <div class="testi-card">"Rasanya nagih! Sambalnya pas, recommended." — <strong>Aulia</strong></div>
      <div class="testi-card">"Pesanan datang rapi & cepat. Bakal order lagi." — <strong>Rizky</strong></div>
      <div class="testi-card">"Servis oke, packaging rapih. Mantap!" — <strong>Dinda</strong></div>
    </div>
  </section>

  <!-- FAQ -->
  <section style="padding:50px 6%;background:#fffaf3">
    <h2 style="text-align:center;color:var(--dark);font-weight:800;font-size:1.9rem;margin:0 0 18px">FAQ</h2>
    <div style="max-width:650px;margin:auto;color:var(--dark);font-weight:600;font-size:1rem">
      <p>❓ <strong>Bisa COD?</strong><br>✅ Bisa Khusus Area Surabaya sekitar.</p>
      <p>❓ <strong>Frozen ada?</strong><br>✅ Ada — cocok buat stok di rumah</p>
      <p>❓ <strong>Minimal order?</strong><br>✅ Tidak ada, bebas pesan satuan boleh 😎</p>
    </div>
  </section>

  <!-- Lokasi & Jam Operasional -->
  <section style="padding:50px 6%;background:white;text-align:center">
    <h2 style="margin:0;color:var(--dark);font-weight:800;font-size:1.9rem">Lokasi & Jam Operasional</h2>
    <p style="color:var(--muted)">Siap melayani kamu setiap hari!</p>

    <div style="margin-top:18px;font-weight:700;color:var(--dark)">
      📍 Surabaya, Jawa Timur<br>
      🕒 08.00 — 17.00 WIB (Setiap Hari)
    </div>
  </section>

<!-- FOOTER -->
<footer>
  <div class="footer-container">

    <!-- Brand Section -->
    <div class="footer-brand">
      <div class="footer-logo">
        <!-- Ganti link logo -->
        <img src="{{ asset('image/logoUsaha.png') }}" alt="KNiverse Logo">
        <h2>KNiverse</h2>
      </div>
      <p>Sejuta Kenangan Satu Rasa! 
        Kami menghadirkan cita rasa terbaik dengan sentuhan modern, cocok dinikmati kapan saja — baik untuk camilan, makan siang praktis, hingga momen santai bersama teman dan keluarga.</p>
    </div>

    <!-- Quick Links -->
    <div class="footer-section footer-links">
      <h3>Quick Links</h3>
      <ul>
                  <li><a href="{{ url('/market/home') }}">Home</a></li>
          <li><a href="{{ url('/market/about') }}">About Us</a></li>
          <li><a href="{{ url('/market/menu') }}">Menu</a></li>
          <li> <a href="{{ url('/market/order') }}">Order</a></li>
      </ul>
    </div>

    <!-- Social -->
    <div class="footer-section">
      <h3>Contact Us</h3>
      <div class="social-icons">
        <!-- IG icon -->
        <a href="https://www.instagram.com/kniversepenuhrasa_?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" target="_blank">
          <img src="{{ asset('image/instagram.png') }}" alt="Instagram">
        </a>
        <!-- WA icon -->
        <a href="https://wa.me/qr/JCZK4W73S5T7F1" target="_blank">
          <img src="{{ asset('image/whatsaap.png') }}" alt="WhatsApp">
        </a>
      </div>
    </div>

  </div>

  <div class="footer-line"></div>
</footer>

  <!-- WhatsApp helper (NOT for ordering) -->
  {{-- <a class="wa-btn" id="waBtn" href="https://wa.me/628xxxxxx?text=Halo%20KNiverse%2C%20saya%20butuh%20bantuan%20terkait%20website%20(atau%20pertanyaan%20lain):%20">
    📩 Butuh Bantuan?
  </a> --}}

  <!-- Promo popup (scroll) - sits above voucher (bottom:140px) -->
 <!--<div class="promo-popup" id="promoPopup" aria-hidden="true">
    <div>
      <strong>🎁 Promo Free Ongkir</strong>
      <div style="color:var(--muted);margin:6px 0">Gratis ongkir untuk pembelian ≥ Rp 50.000 (area tertentu).</div>
      <button onclick="hidePromo()" style="background:var(--orange);color:white;border:0;padding:8px 12px;border-radius:8px;cursor:pointer;font-weight:700">Tutup</button>
    </div>
  </div>--> 

  <!-- Voucher popup (auto show once) - bottom:20px -->
  <div class="voucher-popup" id="voucherPopup" style="display:none" aria-hidden="true">
    <div class="voucher-box" role="dialog" aria-labelledby="voucherTitle">
      <h3 id="voucherTitle">🎉 Selamat Datang!</h3>
      <p style="margin:8px 0">Klaim voucher <strong>Diskon Rp5.000</strong> untuk pesanan pertama. Klik klaim untuk dapatkan kode.</p>
      <button id="claimVoucher" class="claim-btn">Klaim Voucher</button>
    </div>
  </div>

  <!-- Floating limited promo (optional small pill) -->
  <div class="floating-promo" id="floatingPromo" aria-hidden="true">⚡ Promo Minggu Ini — <strong>Buy 2 Get 1!</strong></div>

  <!-- Scripts -->
  <script>
    
  </script>
</body>
</html>