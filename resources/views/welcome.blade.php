<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>FLIGHT MANAGER | Réservez votre vol</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<style>
*{margin:0;padding:0;box-sizing:border-box}
:root{
  --navy:#12306b;
  --navy-deep:#0b2653;
  --blue:#1558b0;
  --blue-soft:#e8f0fb;
  --orange:#f5a03a;
  --gray:#6b7a90;
  --bg:#f4f7fb;
  /* Placez vos images dans un dossier "images/" à côté de ce fichier (ou remplacez par asset('images/...')) */
  --hero-img:url('images/hero.jpg');
  --img-paris:url('images/paris.jpg');
  --img-dubai:url('images/dubai.jpg');
  --img-dakar:url('images/dakar.jpg');
  --img-newyork:url('images/newyork.jpg');
  --img-abidjan:url('images/abidjan.jpg');
}
body{font-family:'Inter',Arial,sans-serif;background:var(--bg);color:var(--navy)}
a{text-decoration:none;color:inherit}

/* ===== HERO ===== */
.hero{
  position:relative;min-height:505px;color:#fff;
  display:flex;flex-direction:column;
  padding:15px 24px 26px;
  background:
    linear-gradient(180deg,rgba(10,25,60,.32),rgba(10,25,60,.12) 45%,rgba(10,25,60,.42)),
    var(--hero-img),
    linear-gradient(180deg,#2b4a86,#e9964a 70%,#3a3f63);
  background-size:cover;background-position:center;
}

/* NAVBAR en pilule flottante */
.navbar{
  background:#fff;border-radius:50px;height:65px;
  padding:0 24px 0 42px;
  display:flex;align-items:center;justify-content:space-between;
  position:relative;z-index:10;
}
.logo{font-size:21px;font-weight:800;color:var(--navy);letter-spacing:.2px;white-space:nowrap}
.nav-links{display:flex;align-items:center;gap:40px}
.nav-links a{font-size:14px;font-weight:600;color:var(--navy);transition:.2s}
.nav-links a:hover{color:var(--blue)}
.nav-actions{display:flex;gap:9px}
.btn-login,.btn-register{
  height:38px;padding:0 17px;border-radius:30px;
  display:flex;align-items:center;font-size:13px;font-weight:700;
}
.btn-login{border:1.5px solid var(--navy);color:var(--navy);background:#fff}
.btn-register{background:var(--navy);color:#fff;border:1.5px solid var(--navy)}
.menu-toggle{display:none;border:none;background:none;font-size:26px;color:var(--navy);cursor:pointer}

/* Contenu hero */
.hero-content{position:relative;padding:12px 24px 0;flex:1}
.hero-arc{position:absolute;top:8px;left:20px;width:250px;height:50px}
.hero-content h1{
  margin-top:58px;font-size:46px;font-weight:700;line-height:1.1;letter-spacing:-.5px;
  text-shadow:0 2px 14px rgba(0,0,0,.28);
}
.hero-content h1 span{color:var(--orange)}
.hero-content p{
  margin-top:16px;font-size:17px;font-weight:300;line-height:1.35;max-width:440px;
  text-shadow:0 2px 10px rgba(0,0,0,.3);
}

/* ===== RECHERCHE ===== */
.search-card{
  position:relative;background:#fff;border-radius:30px;
  padding:0 26px 0 40px;height:123px;
  box-shadow:0 10px 35px rgba(0,0,0,.18);
}
.search-tab{
  position:absolute;top:-17px;left:16px;
  height:41px;padding:0 30px;border-radius:30px;
  background:var(--blue);color:#fff;font-size:14px;font-weight:700;
  display:flex;align-items:center;
}
.search-form{
  height:100%;display:grid;align-items:center;
  grid-template-columns:1.1fr 1fr 1fr .95fr auto;
}
.form-group{
  position:relative;display:flex;flex-direction:column;gap:7px;
  padding:0 28px;height:62px;justify-content:center;
}
.form-group:first-child{padding-left:0}
.form-group+.form-group{border-left:1px solid #dfe6f0}
.form-group label{font-size:13px;font-weight:400;color:var(--gray)}
.form-group select,.form-group input{
  border:none;outline:none;background:transparent;width:100%;
  font-family:inherit;font-size:17px;font-weight:600;color:var(--navy);
  appearance:none;-webkit-appearance:none;cursor:pointer;
}
.form-group input[type=date]::-webkit-calendar-picker-indicator{opacity:.5;cursor:pointer}
.swap-button{
  position:absolute;right:15px;top:50%;transform:translateY(-50%);z-index:2;
  width:38px;height:38px;border:none;border-radius:50%;
  background:var(--blue-soft);color:var(--blue);font-size:20px;cursor:pointer;
}
.swap-button:hover{background:#d6e5fa}
.search-button{
  height:55px;padding:0 33px;border:none;border-radius:30px;margin-left:16px;
  background:linear-gradient(90deg,#1558b0,#0e2d63);color:#fff;
  font-family:inherit;font-size:15px;font-weight:700;cursor:pointer;
}
.search-button:hover{filter:brightness(1.12)}

/* ===== AVANTAGES ===== */
.advantages{
  max-width:1000px;margin:0 auto;padding:14px 20px;
  display:grid;grid-template-columns:repeat(4,1fr);
}
.advantage{display:flex;align-items:center;justify-content:center;gap:16px;padding:6px 10px}
.advantage+.advantage{border-left:1px solid #d5deea}
.advantage-icon{font-size:26px;color:var(--blue);line-height:1}
.advantage h3{font-size:14px;font-weight:700;color:var(--blue)}
.advantage p{font-size:13px;color:var(--blue);margin-top:4px;font-weight:400}

/* ===== DESTINATIONS ===== */
.destinations{max-width:1200px;margin:0 auto;padding:22px 32px 29px}
.section-heading{display:flex;justify-content:space-between;align-items:center;margin-bottom:18px}
.section-heading h2{
  display:flex;align-items:center;gap:12px;
  font-size:24px;font-weight:700;color:var(--navy);
}
.section-heading h2::before{content:"";width:26px;height:4px;background:var(--orange);border-radius:2px}
.section-heading a{
  border:1.5px solid var(--navy);border-radius:30px;padding:9px 12px;
  font-size:12px;font-weight:700;color:var(--navy);
}
.destination-grid{display:grid;grid-template-columns:repeat(5,1fr);gap:19px}
.destination-card{
  position:relative;height:151px;border-radius:15px;overflow:hidden;cursor:pointer;
  color:#fff;transition:transform .25s;
  background-size:cover;background-position:center;
}
.destination-card:hover{transform:translateY(-4px)}
.destination-card::after{
  content:"";position:absolute;inset:0;
  background:linear-gradient(180deg,rgba(10,25,60,.12),rgba(10,25,60,.62));
  z-index:0;
}
.destination-card::before{
  content:"";position:absolute;inset:0;z-index:1;pointer-events:none;
  --b:linear-gradient(rgba(255,255,255,.22),rgba(255,255,255,.22));
  background:
    var(--b) 17% 100%/11% 36% no-repeat,
    var(--b) 30% 100%/11% 52% no-repeat,
    var(--b) 44% 100%/11% 30% no-repeat,
    var(--b) 58% 100%/11% 70% no-repeat,
    var(--b) 72% 100%/11% 42% no-repeat,
    var(--b) 86% 100%/11% 28% no-repeat;
}
.destination-card.paris{background-image:var(--img-paris)}
.destination-card.dubai{background-image:var(--img-dubai)}
.destination-card.dakar{background-image:var(--img-dakar)}
.destination-card.newyork{background-image:var(--img-newyork)}
.destination-card.abidjan{background-image:var(--img-abidjan)}
.destination-info{position:absolute;left:17px;bottom:16px;z-index:2}
.destination-info h3{font-size:18px;font-weight:600;text-shadow:0 1px 6px rgba(0,0,0,.4)}
.destination-info p{font-size:12px;margin-top:6px;font-weight:400;opacity:.95;text-shadow:0 1px 6px rgba(0,0,0,.4)}

/* ===== FOOTER ===== */
footer{
  background:var(--navy-deep);color:#fff;
  padding:42px 34px 75px;
  display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:20px;
}
.footer-left{display:flex;align-items:center}
.footer-logo{font-size:17px;font-weight:700;padding-right:22px;border-right:1px solid rgba(255,255,255,.25);height:38px;display:flex;align-items:center;gap:8px}
.footer-links{display:flex;align-items:center}
.footer-links a{font-size:12px;font-weight:600;padding:0 17px;border-left:1px solid rgba(255,255,255,.25);height:38px;display:flex;align-items:center}
.footer-links a:first-child{border-left:none}
.footer-links a:hover{text-decoration:underline}
.copyright{font-size:12px;font-weight:600}

/* ===== RESPONSIVE ===== */
@media(max-width:1100px){
  .nav-links{gap:20px}
  .search-card{height:auto;padding:34px 24px 24px}
  .search-form{grid-template-columns:1fr 1fr;row-gap:20px}
  .form-group{padding:0 20px}
  .form-group:first-child{padding-left:0}
  .form-group+.form-group{border-left:none}
  .form-group:nth-child(2n){border-left:1px solid #dfe6f0}
  .search-button{grid-column:1/-1;margin:0;width:100%}
  .advantages{grid-template-columns:repeat(2,1fr);row-gap:14px}
  .advantage:nth-child(3){border-left:none}
  .destination-grid{grid-template-columns:repeat(3,1fr)}
}
@media(max-width:800px){
  .navbar{flex-wrap:wrap;height:auto;min-height:65px;padding:12px 20px;border-radius:30px}
  .menu-toggle{display:block}
  .nav-links,.nav-actions{display:none;width:100%}
  .nav-links.active{display:flex;flex-direction:column;align-items:flex-start;gap:14px;padding:14px 0}
  .nav-links.active+.nav-actions{display:flex;padding-bottom:8px}
  .hero{padding:12px 12px 20px}
  .hero-content h1{font-size:34px}
  .search-form{grid-template-columns:1fr}
  .form-group,.form-group:nth-child(2n){padding:0;border-left:none}
  .form-group+.form-group{border-top:1px solid #dfe6f0;padding-top:14px;height:auto}
  .swap-button{top:auto;bottom:-24px;right:0;transform:none}
  .destination-grid{grid-template-columns:repeat(2,1fr)}
  footer{flex-direction:column;align-items:flex-start}
  .footer-left{flex-direction:column;align-items:flex-start;gap:14px}
  .footer-logo{border-right:none}
  .footer-links{flex-wrap:wrap}
}
@media(max-width:500px){
  .advantages{grid-template-columns:1fr}
  .advantage,.advantage+.advantage{border-left:none;justify-content:flex-start}
  .destination-grid{grid-template-columns:1fr}
  .section-heading{flex-direction:column;align-items:flex-start;gap:12px}
}
</style>
</head>
<body>

<!-- HERO + NAVIGATION + RECHERCHE -->
<section class="hero">

  <header class="navbar">
    <a href="{{ url('/') }}" class="logo">✈️ FLIGHT MANAGER</a>
    <button class="menu-toggle" id="menuToggle" aria-label="Ouvrir le menu">☰</button>
    <nav class="nav-links" id="navLinks">
      <a href="{{ url('/') }}">⌂ Accueil</a>
      <a href="#recherche">✈️ Vols</a>
      <a href="#destinations">◆ Destinations</a>
      <a href="{{ url('/mes-reservations') }}">▣ Mes réservations</a>
      <a href="#footer">ⓘ À propos</a>
    </nav>
    <div class="nav-actions">
      <a href="{{ url('/connexion') }}" class="btn-login">Connexion</a>
      <a href="{{ url('/inscription') }}" class="btn-register">S'inscrire</a>
    </div>
  </header>

  <div class="hero-content">
    <svg class="hero-arc" viewBox="0 0 250 50" fill="none" aria-hidden="true">
      <path d="M2 46 Q100 6 200 20" stroke="#f5a03a" stroke-width="3" stroke-linecap="round"/>
      <text x="205" y="30" font-size="30">✈️</text>
    </svg>
    <h1>Voyagez vers votre<br>prochaine <span>destination</span></h1>
    <p>Découvrez le monde avec FLIGHT MANAGER, réservez vos vols en toute simplicité.</p>
  </div>

  <div class="search-card" id="recherche">
    <div class="search-tab">⌕ Rechercher un vol</div>

    <form class="search-form" action="{{ url('/recherche-vols') }}" method="GET" id="flightSearchForm">

      <div class="form-group">
        <label for="depart">Départ</label>
        <select name="depart" id="depart" required>
          <option value="">Choisir une ville</option>
          <option value="Douala" selected>Douala</option>
          <option value="Yaoundé">Yaoundé</option>
          <option value="Paris">Paris</option>
          <option value="Dakar">Dakar</option>
          <option value="Dubai">Dubai</option>
          <option value="New York">New York</option>
          <option value="Abidjan">Abidjan</option>
        </select>
        <button type="button" class="swap-button" id="swapCities" title="Échanger les villes">⇄</button>
      </div>

      <div class="form-group">
        <label for="destination">Destination</label>
        <select name="destination" id="destination" required>
          <option value="">Choisir une destination</option>
          <option value="Paris" selected>Paris</option>
          <option value="Douala">Douala</option>
          <option value="Yaoundé">Yaoundé</option>
          <option value="Dakar">Dakar</option>
          <option value="Dubai">Dubai</option>
          <option value="New York">New York</option>
          <option value="Abidjan">Abidjan</option>
        </select>
      </div>

      <div class="form-group">
        <label for="date_depart">Date de départ</label>
        <input type="date" name="date_depart" id="date_depart" value="2026-11-23" min="{{ date('Y-m-d') }}" required>
      </div>

      <div class="form-group">
        <label for="passagers">Passagers</label>
        <select name="passagers" id="passagers" required>
          <option value="1">1 adulte</option>
          <option value="2">2 adultes</option>
          <option value="3">3 adultes</option>
          <option value="4">4 adultes</option>
          <option value="5">5 adultes</option>
          <option value="6">6 adultes</option>
        </select>
      </div>

      <button type="submit" class="search-button">⌕ Rechercher</button>
    </form>
  </div>

</section>

<main>

  <!-- AVANTAGES -->
  <section class="advantages">
    <div class="advantage"><span class="advantage-icon">⬟</span><div><h3>Réservation sécurisée</h3><p>et fiable</p></div></div>
    <div class="advantage"><span class="advantage-icon">◉</span><div><h3>Assistance 24/7</h3><p>à votre écoute</p></div></div>
    <div class="advantage"><span class="advantage-icon">◆</span><div><h3>Meilleurs prix</h3><p>garantis</p></div></div>
    <div class="advantage"><span class="advantage-icon">✈️</span><div><h3>Des destinations</h3><p>dans le monde entier</p></div></div>
  </section>

  <!-- DESTINATIONS POPULAIRES -->
  <section class="destinations" id="destinations">
    <div class="section-heading">
      <h2>Destinations populaires</h2>
      <a href="#destinations">Voir toutes les destinations →</a>
    </div>

    <div class="destination-grid">
      <article class="destination-card paris" data-city="Paris">
        <div class="destination-info"><h3>Paris</h3><p>France</p></div>
      </article>
      <article class="destination-card dubai" data-city="Dubai">
        <div class="destination-info"><h3>Dubai</h3><p>Émirats arabes unis</p></div>
      </article>
      <article class="destination-card dakar" data-city="Dakar">
        <div class="destination-info"><h3>Dakar</h3><p>Sénégal</p></div>
      </article>
      <article class="destination-card newyork" data-city="New York">
        <div class="destination-info"><h3>New York</h3><p>États-Unis</p></div>
      </article>
      <article class="destination-card abidjan" data-city="Abidjan">
        <div class="destination-info"><h3>Abidjan</h3><p>Côte d'Ivoire</p></div>
      </article>
    </div>
  </section>

</main>

<!-- PIED DE PAGE -->
<footer id="footer">
  <div class="footer-left">
    <div class="footer-logo">✈ FLIGHT MANAGER</div>
    <nav class="footer-links">
      <a href="#footer">À propos</a>
      <a href="#footer">Aide</a>
      <a href="#footer">Conditions d'utilisation</a>
      <a href="#footer">Confidentialité</a>
    </nav>
  </div>
  <div class="copyright">© 2026 Flight Manager. Tous droits réservés.</div>
</footer>

<script>
const menuToggle = document.getElementById('menuToggle');
const navLinks = document.getElementById('navLinks');
menuToggle.addEventListener('click', () => navLinks.classList.toggle('active'));

const depart = document.getElementById('depart');
const destination = document.getElementById('destination');

document.getElementById('swapCities').addEventListener('click', () => {
  const tmp = depart.value;
  depart.value = destination.value;
  destination.value = tmp;
});

document.querySelectorAll('.destination-card').forEach(carte => {
  carte.addEventListener('click', () => {
    const ville = carte.dataset.city;
    if (ville === depart.value) {
      alert("La destination ne peut pas être identique à la ville de départ.");
      return;
    }
    destination.value = ville;
    document.getElementById('recherche').scrollIntoView({ behavior: 'smooth', block: 'center' });
  });
});

document.getElementById('flightSearchForm').addEventListener('submit', e => {
  if (!depart.value || !destination.value) {
    e.preventDefault();
    alert("Veuillez choisir une ville de départ et une destination.");
    return;
  }
  if (depart.value === destination.value) {
    e.preventDefault();
    alert("La ville de départ et la destination doivent être différentes.");
  }
});
</script>
</body>
</html>