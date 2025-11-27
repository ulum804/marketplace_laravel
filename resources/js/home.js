// --- Promo popup show on scroll (but don't overlap voucher) ---
    (function(){
      const promo = document.getElementById('promoPopup');
      let shown = false;
      window.addEventListener('scroll', ()=> {
        if (!shown && window.scrollY > 300) {
          shown = true;
          promo.style.display = 'block';
        }
      });
    })();

    // --- Voucher popup (show once per session) ---
    (function(){
      const vp = document.getElementById('voucherPopup');
      const claimBtn = document.getElementById('claimVoucher');
      if(!localStorage.getItem('kniverse_voucher_claimed')){
        // show after slight delay
        setTimeout(()=> { vp.style.display = 'flex'; }, 1200);
      }
      claimBtn.addEventListener('click', ()=>{
        localStorage.setItem('kniverse_voucher_claimed','1');
        vp.style.display = 'none';
        // show small confirmation toast (use alert for simplicity)
        alert('Voucher Rp5.000 berhasil diklaim. Gunakan pada saat checkout!');
      });
    })();

    // --- Floating promo (small pill) show briefly ---
    (function(){
      const fp = document.getElementById('floatingPromo');
      // show for discovery, but only on wide screens
      if(window.innerWidth >= 480){
        fp.style.display = 'block';
        setTimeout(()=>{ fp.style.display = 'none'; }, 6500);
      }
    })();

    // --- Accessibility: close both via Escape ---
    document.addEventListener('keydown', (e)=> {
      if(e.key === 'Escape'){
        const vp = document.getElementById('voucherPopup');
        if(vp) vp.style.display = 'none';
        const pp = document.getElementById('promoPopup');
        if(pp) pp.style.display = 'none';
        const fp = document.getElementById('floatingPromo');
        if(fp) fp.style.display = 'none';
      }
    });

    // --- Hide promo handler (button) ---
    //function hidePromo(){
      //document.getElementById('promoPopup').style.display = 'none';
    //}

    // --- Ribbon small animation on scroll ---
    (function(){
      const ribbon = document.getElementById('ribbon');
      window.addEventListener('scroll', ()=> {
        if(!ribbon) return;
        if(window.scrollY > 150) ribbon.style.transform = 'rotate(0deg) translateY(-6px)';
        else ribbon.style.transform = 'rotate(-6deg) translateY(0)';
      });
    })();

    // --- Smooth scroll for internal anchors (if needed) ---
    (function(){ 
      document.querySelectorAll('a[href^="#"]').forEach(a=>{
        a.addEventListener('click', (e)=>{
          e.preventDefault();
          const target = document.querySelector(a.getAttribute('href'));
          if(target) target.scrollIntoView({behavior:'smooth'});
        });
      });
    })();