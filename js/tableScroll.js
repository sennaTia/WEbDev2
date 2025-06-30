// js/tableScroll.js
document.addEventListener('DOMContentLoaded', function() {
  const container = document.querySelector('.scroll-container');

  // Optioneel: sticky table header
  const header = container.querySelector('thead');
  if (header) {
    header.style.position = 'sticky';
    header.style.top = '0';
    header.style.backgroundColor = '#fff';
  }
});
