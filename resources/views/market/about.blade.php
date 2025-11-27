<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tentang Kami - KNiverse</title>
  @vite('resources/css/about.css')

  <!-- AOS Animation Library -->
  <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

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
        <p>Sejuta Kenangan Satu Rasa</p>
      </div>
    </div>
    <nav>
     <a href="{{ url('/market/home') }}">Home</a>
      <a href="{{ url('/market/about') }}" class="active">About Us</a>
      <a href="{{ url('/market/menu') }}">Menu</a>
      <a href="{{ url('/market/order') }}">Order</a>
    </nav>
  </header>

  <!-- Promo Popup -->
  <div id="promo-popup" style="position:fixed;bottom:20px;right:20px;background:white;padding:18px 22px;border-radius:14px;box-shadow:0 10px 30px rgba(0,0,0,0.1);display:none;z-index:999;border:2px solid var(--orange);animation:pop-in .6s ease forwards">
    <strong style="color:var(--orange);font-size:1.1rem">🎉 Promo Spesial!</strong>
    <p style="margin:6px 0 10px;color:#444;font-size:.95rem">Belanja di atas <b>Rp 50.000</b> dapat <b>FREE ONGKIR</b> area surabaya!</p>
    <button onclick="document.getElementById('promo-popup').style.display='none'" style="background:var(--orange);color:#fff;border:0;padding:6px 12px;border-radius:8px;cursor:pointer;font-weight:600">Tutup</button>
  </div>

  <!-- particle layer removed -->

  <!-- CTA Modal Backdrop and Modal (hidden by default) -->
  <div id="ctaBackdrop" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.45);z-index:1500;opacity:0;transition:opacity .28s ease"></div>

<div id="ctaModal" role="dialog" aria-hidden="true" aria-labelledby="ctaTitle" style="position:fixed;left:65%;top:50%;transform:translate(-50%,100vh);max-width:420px;width:92%;background:white;padding:20px 18px;border-radius:14px;box-shadow:0 24px 60px rgba(0,0,0,0.25);z-index:1600;opacity:0;transition:transform .45s cubic-bezier(.22,.9,.36,1),opacity .32s ease">
    <div style="display:flex;align-items:center;justify-content:space-between;gap:10px">
      <div>
        <h3 id="ctaTitle" style="margin:0;color:var(--dark);font-size:1.15rem">Siap pesan? Pilih langkah selanjutnya</h3>
        <p style="margin:6px 0 0;color:#666;font-size:.95rem">Lihat menu kami atau langsung lanjut ke order.</p>
      </div>
      <button id="ctaClose" aria-label="Tutup" style="background:transparent;border:0;font-size:20px;cursor:pointer;color:#888">✕</button>
    </div>

    <div style="display:flex;gap:10px;justify-content:center;margin-top:16px">
       
      <a href="{{ url('/market/menu') }}" class="btn" style="flex:1;text-align:center">Lihat Menu</a>
      <a href="{{ url('/market/order') }}" class="btn-outline" style="flex:1;text-align:center">Pesan Sekarang</a>
    </div>
  </div>

  <section class="hero" data-aos="fade-up">
    <div class="card">
      <div class="card-text">
        <h2 class="reveal-text-up">Mengenal KNiverse</h2>
        <p class="reveal-text-up">Berawal dari dapur kecil dengan mimpi besar — menghadirkan jajanan rumahan yang hangat, lezat, dan penuh nostalgia ke setiap sudut kota. Kami membawa cita rasa yang membuat momen sederhana jadi istimewa.</p>

        <div class="hero-badges">
          <div class="hero-badge">🥟 Homemade</div>
          <div class="hero-badge">🚚 Fast Delivery</div>
          <div class="hero-badge">⭐ Premium Taste</div>
        </div>

      </div>

      <div class="card-media">
        <img src="{{ asset('image/maskot.png') }}" alt="Versa Maskot" class="hero-maskot reveal-img clickable-img">
      </div>
    </div>
  </section>

  <section class="badge-section" data-aos="zoom-in">
    <div class="badge-item"><span>🔥</span><p>Freshly Made Daily</p></div>
    <div class="badge-item"><span>⭐</span><p>Authentic Flavor</p></div>
    <div class="badge-item"><span>🍽</span><p>Diverse Menu</p></div>
    <div class="badge-item"><span>💛</span><p>Made with Care</p></div>
  </section>

  <main>
    <section class="about-section" data-aos="fade-right">
      <div class="story">
        {{-- <img src="{{ asset('image/aboutus1.jpeg') }}" alt="Proses Membuat Dimsum KNiversuuuue" class="food-item ribbon reveal-img-slide clickable-img" /> --}}
        <div>
          <h3 class="reveal-text">Awal Perjalanan</h3>
          <p class="reveal-text">KNiverse berdiri pada April 2025 dengan misi sederhana: membawa rasa jajanan sekolah dan jajanan rumahan yang bikin kangen, tapi dengan kualitas premium yang bisa dinikmati semua kalangan.</p>
          <p class="reveal-text">Kami memulai produksi dari dapur kecil, satu kukusan kecil, dan modal keberanian. Perlahan tapi pasti, rasa kami dikenali — karena kami percaya, makanan yang dibuat dengan hati selalu menemukan tempatnya.</p>
          <div class="highlight-box reveal-text-up">Kami percaya: makanan bukan sekadar mengenyangkan — tapi menciptakan momen, cerita, dan senyum.</div>

          <h4 class="reveal-text">Visi</h4>
          <p class="reveal-text">Menjadi pilihan utama camilan hangat yang menyatukan rasa tradisi dan inovasi modern.</p>
          <h4 class="reveal-text">Misi</h4>
          <ul class="reveal-text">
            <li>Menggunakan bahan berkualitas dan proses higienis.</li>
            <li>Menciptakan menu yang familiar namun punya sentuhan unik.</li>
            <li>Menyediakan pengalaman pemesanan cepat dan aman.</li>
          </ul>
        </div>
      </div>

      <div class="story" data-aos="fade-left" style="margin-top:18px">
        <div>
          <h3 class="reveal-text-right">Kenapa Homemade?</h3>
          <p class="reveal-text-right">Di KNiverse, setiap produk dibuat fresh setiap hari tanpa bahan pengawet. Kami mengutamakan kualitas bahan, kebersihan, dan proses pembuatan yang detail.</p>
          <p class="reveal-text-right">Dari Dimsum, Wonton, Corndog, hingga Tahu bakso kami — semuanya dibuat dengan tangan, dengan kualitas yang selalu kami jaga.</p>
        </div>
        {{-- <img src="{{ asset('image/about2.jpeg') }}" alt="Proses Homemade KNiverse" class="food-item reveal-img clickable-img" /> --}}
      </div>

      <div class="values" data-aos="fade-up">
        <div class="value-card">🥣 Bahan Premium</div>
        <div class="value-card">🧼 Higienis & Aman</div>
        <div class="value-card">❤ Cita Rasa Rumahan</div>
        <div class="value-card">✨ Selalu Fresh</div>
        <div class="value-card">🚀 Inovasi Rasa</div>
      </div>
    </section>
    
    <section class="gallery" data-aos="zoom-in">
      <h3 style="color:var(--orange);" class="reveal-text-up">Menu Favorit</h3>
      <p style="color:#555;" class="reveal-text-up">Klik foto untuk memperbesar dan lihat animasinya!</p>
      <div class="gallery-grid">
        <img src="{{ asset('image/gallery1.jpg') }}" alt="Dimsum" onclick="openLightbox('asset/gallery1.jpg')" class="clickable-img reveal-img" />
        <img src="{{ asset('image/gallery2.png') }}" onclick="openLightbox('asset/gallery2.png')" class="clickable-img reveal-img" />
        <img src="{{ asset('image/gallery3.jpg') }}" onclick="openLightbox('asset/gallery3.jpg')" class="clickable-img reveal-img" />
        <img src="{{ asset('image/gallery4.jpg') }}" alt="Saus Signature" onclick="openLightbox('asset/gallery4.jpg')" class="clickable-img reveal-img" />
      </div>
    </section>

    <section class="testi-section" data-aos="fade-up">
      <h3 style="color:var(--orange);" class="reveal-text-up">Apa Kata Mereka?</h3>
      <div class="testi-grid">
        <div class="testi-card">"Dimsumnya lembut dan juicy banget! Rasanya autentik dan bikin nagih 🤤✨"<br><strong>- Rina, Mahasiswa</strong></div>
        <div class="testi-card">"Pelayanan ramah, pengiriman cepat, dan rasanya TOP! Wajib repeat order 🔥"<br><strong>- Dimas, Content Creator</strong></div>
        <div class="testi-card">"Nostalgia jajanan semasa masih sekolah! Cocok buat camilan keluarga 🥰"<br><strong>- Ibu Santi</strong></div>
      </div>
    </section>

    <!-- Maskot -->
    <section style="padding:36px 6%;text-align:center;background:#fff7ea;border-radius:12px;margin:18px 6%" data-aos="zoom-in">
      <img src="{{ asset('image/maskot.png') }}" alt="Maskot KNiverse" style="width:180px;border-radius:12px" class="reveal-img clickable-img" />
      <h3 style="color:var(--orange)" class="reveal-text-up">Kenalkan: Versa</h3>
      <p class="reveal-text-up">Versa si maskot ceria yang suka mengantar camilan manis ke semua orang!</p>
      <div style="font-size:2rem" class="reveal-text-up">🍤 🧀 🥟 🍡</div>
    </section>
    
    <section class="delivery" data-aos="fade-up">
      <h3 style="color:var(--orange);" class="reveal-text-up">Area Pengiriman & Ongkos Kirim</h3>
      <table>
        <tr style="background:var(--orange);color:white"><th>Area</th><th>Ongkir</th></tr>
        <tr><td>surabaya timur</td><td>Rp 5.000</td></tr>
        <tr><td>surabaya pusat</td><td>Rp 8.000</td></tr>
        <tr><td>Surabaya Utara</td><td>Rp 10.000</td></tr>
        <tr><td>Surabaya Selatan</td><td>Rp 15.000</td></tr>
        <tr><td>Surabaya Barat</td><td>Rp 20.000</td></tr>
      </table>
      <p style="margin-top:12px;font-weight:700;color:var(--red);background:#fff3d6;padding:10px;border-radius:8px;border-left:6px solid var(--orange);">
        🎁 Promo spesial: Setiap pembelian di atas Rp 50.000 mendapatkan FREE ONGKIR! 🚚✨
      </p>
    </section>

    <section class="map" data-aos="fade-up">
      <h3 style="color:var(--orange);" class="reveal-text-up">Lokasi Pickup / Outlet</h3>
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.482751821274!2d112.77295041043126!3d-7.29953289267768!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fa5a0e1c41a7%3A0xfbdb6671c5dde1b7!2sJl.%20Semolowaru%20Utara%20III%20B%20No.40%2C%20RT.004%2FRW.01%2C%20Semolowaru%2C%20Kec.%20Sukolilo%2C%20Surabaya%2C%20Jawa%20Timur%2060119!5e0!3m2!1sid!2sid!4v1761974928884!5m2!1sid!2sid"></iframe>
    </section>
  </main>

  <!-- Lightbox modal -->
  <div id="lightbox" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.85);align-items:center;justify-content:center;z-index:200;cursor:pointer">
    <img id="lightbox-img" src="" style="max-width:90%;max-height:90%;border-radius:12px;box-shadow:0 10px 30px rgba(0,0,0,0.6)" />
  </div>

  <!-- Footer -->
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
        <h3>Quick Button</h3>
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

  <!-- Scripts -->
  <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
  <script>
    window.addEventListener('scroll', function() {
      const header = document.getElementById('mainHeader');
      if (window.scrollY > 50) {
        header.classList.add('scrolled');
      } else {
        header.classList.remove('scrolled');
      }
    });

    // Scroll reveal animations for text and images
    function revealOnScroll() {
      const revealElements = document.querySelectorAll('.reveal-text, .reveal-text-right, .reveal-text-up, .reveal-img, .reveal-img-slide');
      
      revealElements.forEach(element => {
        const elementTop = element.getBoundingClientRect().top;
        const elementVisible = 150;
        
        if (elementTop < window.innerHeight - elementVisible) {
          element.classList.add('active');
        }
      });
    }

    // Call on scroll and on load
    window.addEventListener('scroll', revealOnScroll);
    window.addEventListener('load', revealOnScroll);

    // Random animation for ALL clickable images
    const animations = ['animate-shake', 'animate-pulse', 'animate-bounce', 'animate-spin', 'animate-wiggle'];
    
    document.querySelectorAll('.clickable-img').forEach(img => {
      img.addEventListener('click', function(e) {
        // Prevent default action for social media icons inside links
        if (this.closest('.social-icons')) {
          e.stopPropagation();
        }
        
        // Random animation
        const randomAnim = animations[Math.floor(Math.random() * animations.length)];
        this.classList.add(randomAnim);
        
        // Remove animation after it completes
        setTimeout(() => {
          this.classList.remove(randomAnim);
        }, 800);
      });
    });

    // show popup after scroll
    let popupShown = false;
    window.addEventListener('scroll', () => {
      if (!popupShown && window.scrollY > 300) {
        popupShown = true;
        document.getElementById('promo-popup').style.display = 'block';
      }
    });

    // add ribbon animation on scroll
    const ribbonEl = document.querySelector('.ribbon');
    window.addEventListener('scroll', () => {
      if (ribbonEl && window.scrollY > 200) {
        ribbonEl.classList.add('ribbon-animate');
      }
    });

    AOS.init({duration: 800, once: true});

    // particle animation removed to reduce visual noise and improve performance

    // CTA modal: show after short delay and allow closing via backdrop, close button, or ESC
    (function(){
      const backdrop = document.getElementById('ctaBackdrop');
      const modal = document.getElementById('ctaModal');
      const closeBtn = document.getElementById('ctaClose');
      if(!backdrop || !modal) return;

      function showModal(){
        backdrop.style.display = 'block';
        // small timeout to allow CSS transition
        setTimeout(()=>{
          backdrop.classList.add('show');
          modal.classList.add('show');
          modal.setAttribute('aria-hidden','false');
        },40);
      }

      function hideModal(){
        modal.classList.remove('show');
        backdrop.classList.remove('show');
        modal.setAttribute('aria-hidden','true');
        setTimeout(()=>{ backdrop.style.display = 'none'; },320);
      }

      // show modal after 1.2s, unless voucher popup already claimed (avoid overlapping)
      setTimeout(()=>{
        if(!localStorage.getItem('kniverse_cta_dismissed')) showModal();
      },1200);

      backdrop.addEventListener('click', hideModal);
      closeBtn.addEventListener('click', ()=>{ localStorage.setItem('kniverse_cta_dismissed','1'); hideModal(); });

      document.addEventListener('keydown', e=>{
        if(e.key === 'Escape') hideModal();
      });
    })();

    // lightbox
    function openLightbox(src) {
      const lb = document.getElementById('lightbox');
      const img = document.getElementById('lightbox-img');
      img.src = src;
      lb.style.display = 'flex';
    }
    
    document.getElementById('lightbox').addEventListener('click', function() {
      this.style.display = 'none';
      document.getElementById('lightbox-img').src = '';
    });

    // micro interaction: small shake on badges
    document.querySelectorAll('.badge-item').forEach((b, i) => {
      b.addEventListener('mouseenter', () => b.style.transform = 'scale(1.03) rotate(-1deg)');
      b.addEventListener('mouseleave', () => b.style.transform = '');
    });

    // small accessibility: keyboard close lightbox
    document.addEventListener('keydown', e => {
      if (e.key === 'Escape') {
        document.getElementById('lightbox').style.display = 'none';
        document.getElementById('lightbox-img').src = '';
      }
    });
  </script>
</body>
</html>