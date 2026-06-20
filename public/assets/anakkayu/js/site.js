const header = document.querySelector('.ak-header');
const revealItems = document.querySelectorAll('.ak-reveal');
const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

const toggleHeader = () => {
  if (!header) return;
  header.classList.toggle('ak-scrolled', window.scrollY > 24);
};

toggleHeader();
window.addEventListener('scroll', toggleHeader, { passive: true });

if (!reduceMotion && 'IntersectionObserver' in window) {
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

document.querySelectorAll('#akNav .nav-link').forEach((link) => {
  link.addEventListener('click', () => {
    const nav = document.querySelector('#akNav.show');
    if (nav && window.bootstrap) {
      bootstrap.Collapse.getOrCreateInstance(nav).hide();
    }
  });
});

const hero = document.querySelector('.ak-hero');
if (hero && !reduceMotion && window.matchMedia('(pointer: fine)').matches) {
  hero.addEventListener('pointermove', (event) => {
    const x = ((event.clientX / window.innerWidth) - .5) * 10;
    const y = ((event.clientY / window.innerHeight) - .5) * 6;
    hero.style.backgroundPosition = `calc(50% + ${x}px) calc(50% + ${y}px)`;
  });

  hero.addEventListener('pointerleave', () => {
    hero.style.backgroundPosition = 'center';
  });
}
