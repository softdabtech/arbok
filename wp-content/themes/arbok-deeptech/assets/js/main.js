document.addEventListener('DOMContentLoaded', () => {
  const toggle = document.querySelector('.menu-toggle');
  const nav = document.querySelector('.primary-nav');
  const backToTop = document.querySelector('.back-to-top');

  if (toggle && nav) {
    const submenuToggles = nav.querySelectorAll('.submenu-toggle');
    const closeSubmenus = (except = null) => {
      submenuToggles.forEach((submenuToggle) => {
        const item = submenuToggle.closest('.menu-item-has-children');
        if (!item || item === except) return;
        item.classList.remove('submenu-open');
        submenuToggle.setAttribute('aria-expanded', 'false');
      });
    };

    toggle.addEventListener('click', () => {
      const open = nav.classList.toggle('open');
      document.body.classList.toggle('menu-open', open);
      toggle.setAttribute('aria-expanded', String(open));
      if (!open) closeSubmenus();
    });

    submenuToggles.forEach((submenuToggle) => {
      submenuToggle.addEventListener('click', (event) => {
        event.stopPropagation();
        const item = submenuToggle.closest('.menu-item-has-children');
        const open = !item.classList.contains('submenu-open');
        closeSubmenus(item);
        item.classList.toggle('submenu-open', open);
        submenuToggle.setAttribute('aria-expanded', String(open));
      });
    });

    nav.querySelectorAll('a').forEach((link) => link.addEventListener('click', () => {
      nav.classList.remove('open');
      document.body.classList.remove('menu-open');
      toggle.setAttribute('aria-expanded', 'false');
      closeSubmenus();
    }));

    document.addEventListener('click', (event) => {
      if (!nav.contains(event.target) && !toggle.contains(event.target)) closeSubmenus();
    });

    document.addEventListener('keydown', (event) => {
      if (event.key !== 'Escape') return;
      closeSubmenus();
      nav.classList.remove('open');
      document.body.classList.remove('menu-open');
      toggle.setAttribute('aria-expanded', 'false');
      toggle.focus();
    });
  }

  if (backToTop) {
    const updateBackToTop = () => backToTop.classList.toggle('visible', window.scrollY > 650);
    window.addEventListener('scroll', updateBackToTop, { passive: true });
    updateBackToTop();
    backToTop.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));
  }

  const filterForm = document.querySelector('[data-portfolio-filter]');
  if (filterForm) {
    filterForm.querySelectorAll('select').forEach((select) => {
      select.addEventListener('change', () => filterForm.classList.add('is-dirty'));
    });
    filterForm.addEventListener('submit', () => {
      filterForm.classList.add('is-loading');
      const button = filterForm.querySelector('button');
      if (button) button.textContent = 'Loading…';
    });
  }

  document.querySelectorAll('[data-arbok-inquiry]').forEach((link) => {
    link.addEventListener('click', () => {
      try {
        sessionStorage.setItem('arbokInquiry', JSON.stringify({
          subject: link.dataset.inquirySubject || 'Technology partnership',
          technology: link.dataset.technology || '',
        }));
      } catch (error) {
        // The clean contact link remains usable when storage is unavailable.
      }
    });
  });

  const savedInquiry = (() => {
    try {
      return JSON.parse(sessionStorage.getItem('arbokInquiry') || 'null');
    } catch (error) {
      return null;
    }
  })();

  document.querySelectorAll('.contact-form').forEach((form) => {
    const technologyField = form.querySelector('input[name="technology"]');
    const subjectField = form.querySelector('select[name="subject"]');
    if (savedInquiry && technologyField) technologyField.value = savedInquiry.technology || '';
    if (savedInquiry && subjectField && savedInquiry.subject) {
      const matchingOption = Array.from(subjectField.options).find((option) => option.value === savedInquiry.subject || option.textContent.trim() === savedInquiry.subject);
      if (matchingOption) subjectField.value = matchingOption.value;
    }

    const proofField = form.querySelector('input[name="arbok_js_proof"]');
    const nonceField = form.querySelector('input[name="arbok_contact_nonce"]');
    const issuedField = form.querySelector('input[name="arbok_form_issued_at"]');
    const tokenField = form.querySelector('input[name="arbok_form_token"]');
    if (!proofField || !nonceField || !issuedField || !tokenField || !window.arbokFrontend) return;

    let proofRequest = null;
    const requestProof = () => {
      if (proofField.value) return Promise.resolve(true);
      if (proofRequest) return proofRequest;

      const payload = new URLSearchParams({
        action: window.arbokFrontend.contactProofAction,
        nonce: nonceField.value,
        issued_at: issuedField.value,
        form_token: tokenField.value,
      });
      proofRequest = fetch(window.arbokFrontend.ajaxUrl, {
        method: 'POST',
        credentials: 'same-origin',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8' },
        body: payload.toString(),
      })
        .then((response) => response.json())
        .then((response) => {
          if (!response.success || !response.data || !response.data.proof) return false;
          proofField.value = response.data.proof;
          return true;
        })
        .catch(() => false)
        .finally(() => { proofRequest = null; });
      return proofRequest;
    };

    ['pointerdown', 'focusin', 'keydown', 'touchstart'].forEach((eventName) => {
      form.addEventListener(eventName, requestProof, { once: true, passive: eventName !== 'keydown' });
    });

    form.addEventListener('submit', async (event) => {
      if (proofField.value) {
        try { sessionStorage.removeItem('arbokInquiry'); } catch (error) { /* no-op */ }
        return;
      }
      event.preventDefault();
      const button = form.querySelector('button[type="submit"]');
      const originalText = button ? button.textContent : '';
      if (button) {
        button.disabled = true;
        button.textContent = 'Verifying…';
      }
      const verified = await requestProof();
      if (button) {
        button.disabled = false;
        button.textContent = originalText;
      }
      if (verified) form.requestSubmit();
      else {
        let notice = form.querySelector('.form-proof-error');
        if (!notice) {
          notice = document.createElement('p');
          notice.className = 'full form-proof-error';
          notice.setAttribute('role', 'alert');
          form.appendChild(notice);
        }
        notice.textContent = 'The security check could not be completed. Please refresh the page and try again.';
      }
    });
  });

  if (document.querySelector('[data-arbok-lead-success="true"]')) {
    if (typeof window.gtag === 'function') {
      window.gtag('event', 'generate_lead', { form_name: 'ARBOK contact inquiry' });
    } else {
      window.dataLayer = window.dataLayer || [];
      window.dataLayer.push({ event: 'generate_lead', form_name: 'ARBOK contact inquiry' });
    }
  }
});
