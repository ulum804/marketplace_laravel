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