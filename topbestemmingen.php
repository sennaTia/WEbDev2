<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8" />
  <title>Top Bestemmingen</title>
  <link rel="stylesheet" href="../css/style.css" />
</head>
<body>
  <h1>Top Bestemmingen</h1>
  <input type="text" id="zoekInput" placeholder="Zoek een bestemming..." />

  <div id="bestemmingenLijst">
    <!-- Azië -->
    <div class="bestemming" data-continent="Azie">
      <h2>Bangkok</h2>
      <p>De bruisende hoofdstad van Thailand.</p>
    </div>
    <div class="bestemming" data-continent="Azie">
      <h2>Tokyo</h2>
      <p>Traditie en technologie komen samen.</p>
    </div>

    <!-- Amerika -->
    <div class="bestemming" data-continent="Amerika">
      <h2>New York</h2>
      <p>De stad die nooit slaapt.</p>
    </div>
    <div class="bestemming" data-continent="Amerika">
      <h2>Los Angeles</h2>
      <p>Stranden en Hollywood glamour.</p>
    </div>

    <!-- Europa -->
    <div class="bestemming" data-continent="Europa">
      <h2>Parijs</h2>
      <p>De stad van de liefde.</p>
    </div>
    <div class="bestemming" data-continent="Europa">
      <h2>Rome</h2>
      <p>Historie op elke straathoek.</p>
    </div>
  </div>

  <script src="../js/zoekBestemming.js"></script>
  <script>
    // Filter direct op basis van hash (continent)
    window.addEventListener('load', () => {
      const hash = window.location.hash.substring(1); // Bijv. "Azie"
      const bestemmingen = document.querySelectorAll('.bestemming');
      if (hash) {
        bestemmingen.forEach(b => {
          b.style.display = (b.dataset.continent === hash) ? '' : 'none';
        });
      }
    });
  </script>
</body>
</html>
