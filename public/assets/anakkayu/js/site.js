const header = document.querySelector('.ak-header');

const updateHeaderState = () => {
  if (!header) return;
  header.classList.toggle('ak-scrolled', window.scrollY > 24);
};

updateHeaderState();
window.addEventListener('scroll', updateHeaderState, { passive: true });

const revealSelectors = [
  '.ak-floating',
  '.ak-video-showcase',
  '.ak-about',
  '.ak-why',
  '.ak-services',
  '.ak-strip',
  '.ak-cinematic',
  '.ak-portfolio',
  '.ak-card',
  '.ak-float-card',
  '.ak-benefits article',
  '.ak-service-card'
];

const revealItems = document.querySelectorAll(revealSelectors.join(','));
revealItems.forEach((item) => item.classList.add('ak-reveal-target'));

if ('IntersectionObserver' in window) {
  const revealObserver = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        entry.target.classList.add('ak-visible');
        revealObserver.unobserve(entry.target);
      }
    });
  }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });

  revealItems.forEach((item) => revealObserver.observe(item));
} else {
  revealItems.forEach((item) => item.classList.add('ak-visible'));
}

document.querySelectorAll('.ak-copy').forEach((button) => {
  button.addEventListener('click', async () => {
    await navigator.clipboard.writeText(button.dataset.copy || window.location.href);
    button.textContent = 'Copied';
    setTimeout(() => { button.textContent = 'Copy link'; }, 1600);
  });
});
