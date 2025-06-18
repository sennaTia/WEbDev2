<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TwinWings</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

   <header class="site-header">
    <div class="brand-name">
        <span><em>Twin</em><strong>Wings</strong></span> Luchtvaartmaatschappij
    </div>
    <nav class="main-nav">
        <ul>
            <li><a href="#home">Home</a></li>
            <li><a href="#features">Aanbiedingen</a></li>
            <li><a href="#bestemmingen">Bestemmingen</a></li>
            <li><a href="#signup">Inschrijven</a></li>
            <li><a href="book.php">Boek Nu</a></li>
            <li><a href="boekingen.php">Boekingen</a></li> 
        </ul>
    </nav>
    <a href="login.php" class="login-link">Login</a>
</header>


    <section class="home-section" id="home">
        <div class="home-content">
            <h1 class="main-heading">Vlieg goedkoper</h1>
            <p class="subheading">50% korting op reguliere stoelprijzen</p>
            <a href="book.php" class="cta-button">Vliegen met vreugde</a>
        </div>
    </section>

    <section class="features-section" id="features">
        <div class="features-content">
            <div class="features-text">
                <h1 class="features-title">Inclusief vluchten naar alle bestemmingen*</h1>
                <p class="features-dates">
                    Boek voor 31 mei 2026<br />
                    Vlieg op elk moment t/m 31 mei 2027!
                </p>
                <p class="features-footnote">*NIET GELDIG VOOR BUSINESSCLASS</p>
            </div>
            <div class="features-list-box">
                <ul class="features-list">
                    <li>Mobiel inchecken</li>
                    <li>VIP-loungetoegang</li>
                    <li>Premium in-flight entertainment</li>
                    <li>Prioriteit upgrades</li>
                </ul>
            </div>
        </div>
    </section>

    <section class="top-destinations" id="bestemmingen">
        <h2 class="section-title">Topbestemmingen</h2>
        <div class="destinations-grid">
            <div class="destination-card">
                <img src="images/afbeeldingazie.png" alt="Azië" class="destination-image" />
                <span class="destination-label">Azië</span>
            </div>
            <div class="destination-card">
                <img src="images/afbeeldingamerika.png" alt="Amerika" class="destination-image" />
                <span class="destination-label">Amerika</span>
            </div>
            <div class="destination-card">
                <img src="images/afbeeldingeuropa.png" alt="Europa" class="destination-image" />
                <span class="destination-label">Europa</span>
            </div>
        </div>
        <div class="cta-button-wrapper">
            <a href="book.php" class="book-button">Boek een vlucht</a>
        </div>
    </section>

    <section class="signup-section" id="signup">
        <div class="signup-image"></div>
        <div class="signup-content">
            <h1 class="signup-title">Mis toekomstige aanbiedingen niet.</h1>
            <p class="signup-subtitle">Word vandaag nog lid van de TwinWings-mailinglijst!</p>
            <form action="signup.php" method="POST" class="signup-form">
                <input type="email" name="email" placeholder="Jouw e-mailadres" required>
                <button type="submit" class="signup-button">Meld me aan</button>
            </form>
        </div>
    </section>

</body>
</html>
