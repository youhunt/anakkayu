const header = document.querySelector('.ak-header');
const revealItems = document.querySelectorAll('.ak-reveal');

const toggleHeader = () => {
  if (!header) return;
  header.classList.toggle('ak-scrolled', window.scrollY > 24);
};

toggleHeader();
window.addEventListener('scroll', toggleHeader, { passive: true });

if ('IntersectionObserver' in window) {
  const revealObserver = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        entry.target.classList.add('ak-visible');
        revealObserver.unobserve(entry.target);
      }
    });
  }, { threshold: 0.12 });

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
