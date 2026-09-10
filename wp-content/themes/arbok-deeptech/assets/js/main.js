document.addEventListener('DOMContentLoaded', () => {
  const toggle = document.querySelector('.menu-toggle');
  const nav = document.querySelector('.primary-nav');
  const backToTop = document.querySelector('.back-to-top');

  if (toggle && nav) {
    toggle.addEventListener('click', () => {
      const open = nav.classList.toggle('open');
      document.body.classList.toggle('menu-open', open);
      toggle.setAttribute('aria-expanded', String(open));
    });
    nav.querySelectorAll('a').forEach((link) => link.addEventListener('click', () => {
      nav.classList.remove('open');
      document.body.classList.remove('menu-open');
      toggle.setAttribute('aria-expanded', 'false');
    }));
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
});
