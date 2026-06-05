<!-- Az oldalt fejlesztette: RISKATELY | Az oldal kódjainak lelopása, vagy felhasználása tilos | Az oldal forráskódja NEM a Hungarian Major tulajdona-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hungarian Major | CS2 Tournaments</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600&family=Space+Grotesk:wght@500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body class="dark-theme">
    <div class="bg-blob blob-1"></div>
    <div class="bg-blob blob-2"></div>
    <div class="bg-blob blob-3"></div>

    <header class="navbar">
        <div class="logo">
            <i class="fa-solid fa-crosshairs"></i> HUNGARIAN <span>MAJOR</span>
        </div>
        <nav class="nav-links">
            <a href="#hero">Home</a>
            <a href="#about">About</a>
            <a href="#tournaments">Tournaments</a>
            <a href="teams/csapatok.php">Teams</a>
            <a href="standing/helyezes.php">Standings</a>
        </nav> 
        </nav>
        </nav>
        <div class="nav-actions">
            <button id="theme-toggle" class="btn-icon" aria-label="Toggle Theme">
                <i class="fa-solid fa-sun"></i>
            </button>
            <a href="https://discord.gg/UFTUpCfgu" class="btn-primary-sm">Register</a>
        </div>
    </header>

    <main>
        <section id="hero" class="hero-section">
            <div class="glass-card hero-card">
                <span class="badge">Counter-Strike 2 Tournament Series</span>
                <h1>Hungarian Major</h1>
                <p class="tagline">majd ide jon valami de nem tudom mi lowkirk</p>
                <div class="hero-actions">
                    <a href="https://discord.gg/UFTUpCfgu" class="btn-primary">Csatlakozz a versenyhez</a>
                    <a href="#about" class="btn-secondary">Tudj meg többet</a>
                </div>
            </div>
        </section>

<!--PCEtLSBBeiBvbGRhbHQgZmVqbGVzenRldHRlOiBSSVNLQVRFTEUgfCBBeiBvbGRhbCBrw7NkamFpbmFrIGxlbG9ww6FzYSwgdmFneSBmZWxoYXN6bsOhbMOhc2EgdGlsb3MgfCBBeiBvbGRhbCBmb3Jyw6Fza8OzZGphIE5FTSBhIEh1bmdhcmlhbiBNYWpvciB0dWxhamRvbmEtLT4K-->

        <section id="about" class="section-container">
            <div class="glass-card about-card">
                <div class="about-content">
                    <h2>A versenysorozatról</h2>
                    <p>A Hungarian Major a Counter-Strike 2 versenysorozata nevezési díj nélkül. A szerver legfőbb célja, a fejlődés és a magas szintű versenyzés lehetősége, egy közösség kiépítésével együtt. A versenyek minden héten Szombaton és Vasárnap kerülnek lebonyolításra.</p>
                    <div class="stats-grid">
                        <div class="stat-item">
                            <span class="stat-number">1000+</span>
                            <span class="stat-label">Tag</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">20+</span>
                            <span class="stat-label">Regisztrált csapatok</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">24/7</span>
                            <span class="stat-label">Ticket Support</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="tournaments" class="section-container">
            <h2 class="section-title">Active Events</h2>
            <div class="glass-card tournament-card">
                <div class="tournament-details">
                    <span class="status-live"><span class="dot"></span> Registration Open</span>
                    <h3>Tier 3 versenyek</h3>
                    <p><i class="fa-regular fa-calendar"></i> Június 5-7, 2026 &nbsp;|&nbsp; <i class="fa-solid fa-users"></i> 5v5 Competitive</p>
                </div>
                <div class="tournament-prize">
                    <span class="prize-label">Prize Pool</span>
                    <span class="prize-amount">-</span>
                </div>
                <button class="btn-primary" onclick="alert('Az oldal jelenleg nem elérhető!')">Több a versenyről</button>
            </div>
        </section>
    </main>

    <footer>
        <div class="footer-content">
            <p>&copy; 2026 Hungarian Major. Minden jog fenntartva.</p>
            <div class="social-links">
                <a href="https://www.tiktok.com/@hungarian.major" aria-label="TikTok"><i class="fa-brands fa-tiktok"></i></a>
                <a href="https://discord.gg/UFTUpCfgu" aria-label="Discord"><i class="fa-brands fa-discord"></i></a>
                <a href="https://www.twitch.tv/hungarian_major" aria-label="Twitch"><i class="fa-brands fa-twitch"></i></a>
                <a href="#" aria-label="YouTube"><i class="fa-brands fa-youtube"></i></a>
            </div>
        </div>
    </footer>

    <script src="theme.js"></script>
</body>
</html>