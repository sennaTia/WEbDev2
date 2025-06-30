document.getElementById('zoekInput').addEventListener('keyup', function() {
  const input = this.value.toLowerCase();
  const bestemmingen = document.querySelectorAll('.bestemming');

  bestemmingen.forEach(b => {
    const titel = b.querySelector('h2').textContent.toLowerCase();
    const beschrijving = b.querySelector('p').textContent.toLowerCase();

    if (titel.includes(input) || beschrijving.includes(input)) {
      b.style.display = '';
    } else {
      b.style.display = 'none';
    }
  });
});
