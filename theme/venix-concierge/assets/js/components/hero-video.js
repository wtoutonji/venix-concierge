document.addEventListener('DOMContentLoaded', () => {
  if (!window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;
  document.querySelectorAll('.venix-hero-video').forEach((video) => {
    video.pause();
    video.removeAttribute('autoplay');
  });
});
