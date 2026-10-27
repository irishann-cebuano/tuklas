<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="theme-color" content="#fff9ec">
  <meta name="description" content="Discover the nature, culture, and community of Tapaz, Capiz. Find destinations and upcoming local events.">
  <link rel="stylesheet" href="style.css">
  <title>Discover Tapaz | Tourism</title>
</head>
<body>
  <header class="topbar">
    <div class="shell nav-wrap">
      <a class="brand" href="#home" aria-label="Tapaz Tourism home">
        <img src="assets/tapaz-tourism-logo.webp" alt="">
        <span class="brand-copy"><span class="brand-name">Tapaz</span><span class="brand-label">TOURISM</span><span class="brand-tagline">Nature. Culture. Community.</span></span>
      </a>
      <nav class="nav-links" id="main-navigation" aria-label="Main navigation">
        <a href="#home">Home</a>
        <a href="#destinations">Explore</a>
        <a href="#culture">Culture &amp; Community</a>
        <a href="https://www.openstreetmap.org/#map=11/11.27/122.42" target="_blank" rel="noopener noreferrer">Map</a>
        <a href="#events">Events</a>
        <a href="#announcements">Announcements</a>
        <a href="#about">About</a>
      </nav>
      <div class="nav-actions">
        <button class="icon-button" id="search-toggle" type="button" aria-label="Search destinations and events" aria-expanded="false" aria-controls="search-panel">
          <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><circle cx="10.8" cy="10.8" r="6.6" stroke="currentColor" stroke-width="2.2"/><path d="m16 16 4.5 4.5" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"/></svg>
        </button>
        <span class="account-status" id="account-status" hidden></span>
        <button class="login-button" id="login-open" type="button">Login</button>
        <button class="menu-button" id="menu-toggle" type="button" aria-label="Open navigation" aria-expanded="false" aria-controls="main-navigation">
          <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M4 7h16M4 12h16M4 17h16" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
        </button>
      </div>
    </div>
    <div class="shell search-panel" id="search-panel">
      <label class="search-box">
        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><circle cx="10.8" cy="10.8" r="6.6" stroke="currentColor" stroke-width="2"/><path d="m16 16 4.5 4.5" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
        <input id="site-search" type="search" placeholder="Search places and events..." aria-label="Search places and events">
      </label>
    </div>
  </header>

  <section class="hero" id="home" aria-labelledby="hero-title">
    <div class="hero-content">
      <p class="eyebrow">Discover</p>
      <h1 id="hero-title">TAPAZ</h1>
      <p class="hero-subtitle">Explore nature, culture, and community.</p>
      <a class="gold-button" href="#destinations">Explore Destinations
        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M4 12h15m-6-6 6 6-6 6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
      </a>
    </div>
  </section>

  <main class="shell">
    <section class="section" id="destinations" aria-labelledby="destinations-title">
      <div class="section-heading">
        <div><h2 id="destinations-title">Featured Destinations</h2><p>Find your next favorite place in Tapaz.</p></div>
        <button class="text-link" id="destinations-toggle" type="button" aria-expanded="false">
          <span>View all</span>
          <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m6 9 6 6 6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </button>
      </div>
      <div class="destination-grid" id="destination-grid">
        <article class="destination-card searchable" data-search="marugo lake nature tapaz capiz">
          <img class="destination-photo" src="assets/marugo.jpg" alt="Marugo Lake in Tapaz" loading="lazy">
          <div class="card-body"><h3 class="card-title">Marugo Lake</h3><p class="card-location">● San Antonio, Tapaz, Capiz</p><span class="tag category-natural">Natural Attraction</span><button class="destination-details-button" type="button" data-title="Marugo Lake" data-location="San Antonio, Tapaz, Capiz" data-category="Natural Attraction" data-description="Enjoy the peaceful lake and scenic natural surroundings in San Antonio, Tapaz." data-image="assets/marugo.jpg" data-map-url="https://www.openstreetmap.org/?mlat=11.28902&amp;mlon=122.55102#map=14/11.28902/122.55102">View Details</button></div>
        </article>
        <article class="destination-card searchable" data-search="pangilatan falls nature waterfall tapaz capiz">
          <img class="destination-photo" src="assets/pangilatan.jpg" alt="Pangilatan Falls in Tapaz" loading="lazy">
          <div class="card-body"><h3 class="card-title">Pangilatan Falls</h3><p class="card-location">● Artuz, Tapaz, Capiz</p><span class="tag category-waterfall">Waterfall</span><button class="destination-details-button" type="button" data-title="Pangilatan Falls" data-location="Artuz, Tapaz, Capiz" data-category="Waterfall / Natural Attraction" data-description="Visit Pangilatan Falls, a waterfall destination surrounded by the natural landscape of Artuz, Tapaz." data-image="assets/pangilatan.jpg" data-map-url="https://www.openstreetmap.org/?mlat=11.33161&amp;mlon=122.48313#map=14/11.33161/122.48313">View Details</button></div>
        </article>
        <article class="destination-card searchable" data-search="minan falls nature waterfall tapaz capiz">
          <img class="destination-photo" src="assets/minan.jpg" alt="Minan Falls in Tapaz" loading="lazy">
          <div class="card-body"><h3 class="card-title">Minan Falls</h3><p class="card-location">● Minan, Tapaz, Capiz</p><span class="tag category-waterfall">Waterfall</span><button class="destination-details-button" type="button" data-title="Minan Falls" data-location="Minan, Tapaz, Capiz" data-category="Waterfall / Natural Attraction" data-description="Explore the waterfall and surrounding scenery in Minan, Tapaz." data-image="assets/minan.jpg" data-map-url="https://www.openstreetmap.org/?mlat=11.25114&amp;mlon=122.36598#map=14/11.25114/122.36598">View Details</button></div>
        </article>
        <article class="destination-card searchable" data-search="st jerome parish church cultural history tapaz capiz">
          <img class="destination-photo" src="assets/St.%20jerome.jpg" alt="St. Jerome Parish Church in Tapaz" loading="lazy">
          <div class="card-body"><h3 class="card-title">St. Jerome Parish Church</h3><p class="card-location">● Poblacion, Tapaz, Capiz</p><span class="tag category-religious">Religious &amp; Historical</span><button class="destination-details-button" type="button" data-title="St. Jerome Parish Church" data-location="Poblacion, Tapaz, Capiz" data-category="Religious and Historical Site" data-description="Visit St. Jerome Parish Church in the Poblacion of Tapaz." data-image="assets/St.%20jerome.jpg" data-map-url="https://www.openstreetmap.org/?mlat=11.26381&amp;mlon=122.53386#map=15/11.26381/122.53386">View Details</button></div>
        </article>
        <article class="destination-card searchable extra-destination" data-search="tapaz public plaza poblacion culture tapaz capiz" hidden>
          <img class="destination-photo" src="assets/plaza.jpg" alt="Tapaz Public Plaza, Tapaz" loading="lazy">
          <div class="card-body"><h3 class="card-title">Tapaz Public Plaza</h3><p class="card-location">● Poblacion, Tapaz, Capiz</p><span class="tag category-community">Community Landmark</span><button class="destination-details-button" type="button" data-title="Tapaz Public Plaza" data-location="Poblacion, Tapaz, Capiz" data-category="Public Park / Community Landmark" data-description="A central community gathering place in Poblacion, Tapaz." data-image="assets/plaza.jpg" data-map-url="https://www.openstreetmap.org/?mlat=11.26381&amp;mlon=122.53386#map=15/11.26381/122.53386">View Details</button></div>
        </article>
        <article class="destination-card searchable extra-destination" data-search="aglinab hanging footbridge river nature tapaz capiz" hidden>
          <img class="destination-photo" src="assets/aglinab%20bridge.jpg" alt="Aglinab Hanging Footbridge" loading="lazy">
          <div class="card-body"><h3 class="card-title">Aglinab Hanging Footbridge</h3><p class="card-location">● Aglinab, Tapaz, Capiz</p><span class="tag category-landmark">Landmark</span><button class="destination-details-button" type="button" data-title="Aglinab Hanging Footbridge" data-location="Aglinab, Tapaz, Capiz" data-category="Landmark / Infrastructure Attraction" data-description="Cross the Aglinab Hanging Footbridge and take in the surrounding riverside scenery." data-image="assets/aglinab%20bridge.jpg" data-map-url="https://www.openstreetmap.org/?mlat=11.22210&amp;mlon=122.47893#map=14/11.22210/122.47893">View Details</button></div>
        </article>
        <article class="destination-card searchable extra-destination" data-search="tapaz public market poblacion local culture tapaz capiz" hidden>
          <img class="destination-photo" src="assets/market.jpg" alt="Tapaz Public Market" loading="lazy">
          <div class="card-body"><h3 class="card-title">Tapaz Public Market</h3><p class="card-location">● Poblacion, Tapaz, Capiz</p><span class="tag category-market">Local Market</span><button class="destination-details-button" type="button" data-title="Tapaz Public Market" data-location="Poblacion, Tapaz, Capiz" data-category="Market / Commercial Center" data-description="Browse the local market in Poblacion and experience a part of everyday community life in Tapaz." data-image="assets/market.jpg" data-map-url="https://www.openstreetmap.org/?mlat=11.262424&amp;mlon=122.536933#map=18/11.262424/122.536933">View Details</button></div>
        </article>
        <article class="destination-card searchable extra-destination" data-search="tagbak falls hilwan nature tapaz capiz" hidden>
          <img class="destination-photo" src="assets/tagbak.jpg" alt="Tagbak Falls in Hilwan, Tapaz" loading="lazy">
          <div class="card-body"><h3 class="card-title">Tagbak Falls</h3><p class="card-location">● Hilwan, Tapaz, Capiz</p><span class="tag category-waterfall">Waterfall</span><button class="destination-details-button" type="button" data-title="Tagbak Falls" data-location="Hilwan, Tapaz, Capiz" data-category="Waterfall / Natural Attraction" data-description="Discover Tagbak Falls in Hilwan, a natural destination in Tapaz." data-image="assets/tagbak.jpg" data-map-url="https://www.openstreetmap.org/?mlat=11.23397&amp;mlon=122.27732#map=14/11.23397/122.27732">View Details</button></div>
        </article>
      </div>
      <p class="empty-state" id="destination-empty">No destinations match your search. Try another place or keyword.</p>
    </section>

    <section class="section culture-banner" id="culture" aria-labelledby="culture-title">
      <div class="culture-image" aria-hidden="true"></div>
      <div class="culture-copy">
        <p class="overline">Rooted in community</p>
        <h2 id="culture-title">Indigenous &amp; Community-Based Tourism</h2>
        <p>Learn about the rich culture, traditions, and way of life of Tapaz indigenous communities.</p>
        <button class="gold-button" id="culture-toggle" type="button" aria-expanded="false" aria-controls="culture-content"><span>Explore Culture</span>
          <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m6 9 6 6 6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </button>
      </div>
    </section>

    <section class="section culture-content" id="culture-content" aria-labelledby="culture-content-title" hidden>
      <div class="section-heading">
        <div><h2 id="culture-content-title">Indigenous Culture &amp; Local Products</h2><p>Learn about Tapaz's Indigenous heritage and discover products shared by local sellers.</p></div>
      </div>
      <p class="form-message error" id="culture-content-error" role="alert" hidden></p>
      <section class="culture-content-group" aria-labelledby="indigenous-culture-title">
        <div class="section-heading"><div><h3 id="indigenous-culture-title">Indigenous culture</h3><p>Stories, traditions, and community heritage from Tapaz.</p></div></div>
        <div class="destination-grid" id="culture-story-grid" aria-live="polite">
          <article class="destination-card">
            <img class="destination-photo" src="assets/ip community.jpg" alt="IP Community cultural heritage" loading="lazy">
            <div class="card-body">
              <h3 class="card-title">IP Community</h3>
              <p class="card-location">Community stories</p>
              <span class="tag cultural">Indigenous Culture</span>
              <p class="card-description culture-card-description">Suludnon (Panay-Bukidnon) Community
 The Suludnon are the indigenous people of Tapaz, Capiz, known for preserving the ancient traditions, epic chants, music, dances, and cultural practices of the Panay highlands. Their enduring heritage remains one of the municipality's most treasured cultural treasures.</p>
              <button class="destination-details-button culture-details-toggle" type="button" aria-expanded="false">View Details</button>
            </div>
          </article>
          <article class="destination-card">
            <img class="destination-photo" src="assets/gong.jpg" alt="Traditional Gong Ritual cultural heritage" loading="lazy">
            <div class="card-body">
              <h3 class="card-title">Traditional Gong Ritual</h3>
              <p class="card-location">Ritual Traditions</p>
              <span class="tag cultural">Indigenous Culture</span>
              <p class="card-description culture-card-description">The traditional gong-playing practice of the Suludnon people of Tapaz, Capiz reflects their rich indigenous heritage, serving as an important part of ceremonies, celebrations, storytelling, and cultural preservation.</p>
              <button class="destination-details-button culture-details-toggle" type="button" aria-expanded="false">View Details</button>
            </div>
          </article>
          <article class="destination-card">
            <img class="destination-photo" src="assets/suguidanon.jpg" alt="Sugidanon cultural heritage" loading="lazy">
            <div class="card-body">
              <h3 class="card-title">Sugidanon</h3>
              <p class="card-location">Epic Chanting Traditions</p>
              <span class="tag cultural">Indigenous Culture</span>
              <p class="card-description culture-card-description">Sugidanon is the sacred epic chanting tradition of the Suludnon (Panay-Bukidnon) indigenous people of Tapaz, Capiz. Through rhythmic oral storytelling, skilled chanters recount tales of heroes, ancestral journeys, cultural values, and community traditions that have been preserved for generations. As one of the most treasured expressions of indigenous heritage in Panay, Sugidanon reflects the rich history, identity, and creativity of the Suludnon people.</p>
              <button class="destination-details-button culture-details-toggle" type="button" aria-expanded="false">View Details</button>
            </div>
          </article>
          <article class="destination-card">
            <img class="destination-photo" src="assets/custome.jpg" alt="Sugidanon cultural heritage" loading="lazy">
            <div class="card-body">
              <h3 class="card-title">Traditional Indigenous Attire</h3>
              <p class="card-location">Traditional Clothing</p>
              <span class="tag cultural">Indigenous Culture</span>
              <p class="card-description culture-card-description">Traditional Indigenous attire reflects the cultural identity, creativity, and heritage of Indigenous communities. The colorful garments, embroidered designs, patterned skirts, headpieces, and accessories showcase traditional craftsmanship and artistic expression. These pieces represent the importance of preserving cultural traditions and passing them on to future generations. Through traditional clothing, visitors can appreciate the rich cultural heritage and diversity of Indigenous Peoples.

</p>
              <button class="destination-details-button culture-details-toggle" type="button" aria-expanded="false">View Details</button>
            </div>
          </article>
          <article class="destination-card">
            <img class="destination-photo" src="assets/binanog.jpg" alt="Binanog cultural heritage" loading="lazy">
            <div class="card-body">
              <h3 class="card-title">Binanog</h3>
              <p class="card-location">Traditional Dance</p>
              <span class="tag cultural">Indigenous Culture</span>
              <p class="card-description culture-card-description">Binanog is a traditional dance of the Panay Bukidnon people of Tapaz. Inspired by the flight of the hawk, the dance showcases graceful movements that reflect the community's deep connection to nature, heritage, and indigenous identity.</p>
              <button class="destination-details-button culture-details-toggle" type="button" aria-expanded="false">View Details</button>
            </div>
          </article>
          <article class="destination-card">
            <img class="destination-photo" src="assets/binukot.jpg" alt="Stories and traditions of Tapaz" loading="lazy">
            <div class="card-body">
              <h3 class="card-title">Binukot</h3>
              <p class="card-location">Community stories</p>
              <span class="tag cultural">Indigenous Culture</span>
              <p class="card-description culture-card-description">Binukot is a cherished Panay Bukidnon tradition in Tapaz, Capiz. A Binukot is a woman entrusted with preserving indigenous epics, songs, and cultural knowledge, symbolizing the community's commitment to safeguarding its heritage and identity.</p>
              <button class="destination-details-button culture-details-toggle" type="button" aria-expanded="false">View Details</button>
            </div>
          </article>
          <article class="destination-card">
            <img class="destination-photo" src="assets/panubok.jpg" alt="Indigenous community life in Tapaz" loading="lazy">
            <div class="card-body">
              <h3 class="card-title">Panubok</h3>
              <p class="card-location">Traditional Embroidery</p>
              <span class="tag cultural">Indigenous Culture</span>
              <p class="card-description culture-card-description">Panubok is the traditional embroidery heritage of the Panay Bukidnon people of Tapaz. Characterized by intricate hand-stitched patterns inspired by nature and indigenous culture, Panubok reflects the artistry, identity, and rich traditions of the community.</p>
              <button class="destination-details-button culture-details-toggle" type="button" aria-expanded="false">View Details</button>
            </div>
          </article>
        </div>
        <p class="empty-state" id="culture-story-empty">Loading cultural stories...</p>
      </section>
      <section class="culture-content-group" aria-labelledby="local-products-title">
        <div class="section-heading"><div><h3 id="local-products-title">Products from local sellers</h3><p>Explore published products and seller inquiry details.</p></div></div>
        <div class="destination-grid" id="culture-product-grid" aria-live="polite"></div>
        <p class="empty-state" id="culture-product-empty">Loading local products...</p>
      </section>
    </section>

    <section class="section" id="events" aria-labelledby="events-title">
      <div class="section-heading">
        <div><h2 id="events-title">Upcoming Events</h2><p>Save the date and celebrate with the community.</p></div>
        <button class="text-link" id="events-toggle" type="button" aria-expanded="false">
          <span>View all</span>
          <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m6 9 6 6 6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </button>
      </div>
      <div class="event-grid" id="event-grid">
        <article class="event-card searchable" data-search="patabang festival september municipal plaza event">
          <img class="event-poster" src="assets/patabang.jpg" alt="Patabang Festival celebration" loading="lazy">
          <div class="event-info"><h3>Patabang Festival</h3><p class="event-detail">▣ Sept. 21, 2026</p><p class="event-detail">● Tapaz Public Plaza</p><a class="event-action" href="https://www.openstreetmap.org/?mlat=11.26381&amp;mlon=122.53386#map=15/11.26381/122.53386" target="_blank" rel="noopener noreferrer">View venue →</a></div>
        </article>
        <article class="event-card searchable" data-search="religious fiesta september poblacion tapaz event">
          <img class="event-poster" src="assets/fiesta.jpg" alt="Religious Fiesta in Tapaz" loading="lazy">
          <div class="event-info"><h3>Religious Fiesta</h3><p class="event-detail">▣ Sept. 22, 2026</p><p class="event-detail">● Poblacion, Tapaz</p><a class="event-action" href="https://www.openstreetmap.org/?mlat=11.26381&amp;mlon=122.53386#map=15/11.26381/122.53386" target="_blank" rel="noopener noreferrer">View venue →</a></div>
        </article>
        <article class="event-card searchable" data-search="opening namit food festival september tapaz public plaza">
          <img class="event-poster" src="assets/food%20festival.jpg" alt="Food at the Namit Food Festival" loading="lazy">
          <div class="event-info"><h3>Opening of Namit Food Festival</h3><p class="event-detail">▣ Sept. 15, 2026</p><p class="event-detail">● Tapaz Public Plaza</p><a class="event-action" href="https://www.openstreetmap.org/?mlat=11.26381&amp;mlon=122.53386#map=15/11.26381/122.53386" target="_blank" rel="noopener noreferrer">View venue →</a></div>
        </article>
      </div>
      <p class="empty-state" id="event-empty">No events match your search. Try another place or keyword.</p>
    </section>

    <section class="section public-extra" id="announcements" aria-labelledby="announcements-title">
      <div class="section-heading"><div><h2 id="announcements-title">Announcements</h2><p>Keep an eye out for travel updates and community news.</p></div></div>
    </section>
    <section class="section public-extra about-section" id="about" aria-labelledby="about-title">
      <div class="section-heading"><div><h2 id="about-title">About Tapaz</h2><p>Discover Tapaz, a municipality in Capiz known for its stunning natural landscapes, rich Panay Bukidnon heritage, and welcoming community. From scenic mountains and waterfalls to cultural experiences and local traditions, Tapaz offers travelers a unique and unforgettable journey into the beauty and culture of Western Visayas.</p></div></div>
    </section>
  </main>

  <footer class="footer">
    <div class="shell footer-inner">
      <a class="footer-brand" href="#home" aria-label="Back to Tapaz Tourism home"><img src="assets/tapaz-tourism-logo.webp" alt="Tapaz Tourism"></a>
      <p class="footer-note">Discover the nature, culture, and community of Tapaz, Capiz. Plan a thoughtful visit and support local experiences.</p>
      <div class="footer-links"><a href="#destinations">Destinations</a><a href="#events">Events</a><a href="#about">About Tapaz</a></div>
    </div>
  </footer>

  <div class="modal-backdrop" id="login-modal" role="presentation">
    <section class="modal" role="dialog" aria-modal="true" aria-labelledby="login-title" aria-describedby="login-description">
      <button class="modal-close" id="login-close" type="button" aria-label="Close login dialog">✕</button>
      <h2 id="login-title">Welcome back</h2>
      <p class="modal-intro" id="login-description">Sign in to save places and plan your Tapaz trip.</p>
      <form id="login-form">
        <input id="account-role" name="role" type="hidden" value="visitor">
        <span class="form-label" id="account-role-label">Choose your account type</span>
        <div class="account-type" role="group" aria-labelledby="account-role-label">
          <button class="account-type-button active" type="button" data-role="visitor" aria-pressed="true">Visitor</button>
          <button class="account-type-button" type="button" data-role="seller" aria-pressed="false">Seller</button>
        </div>
        <div class="registration-only" id="registration-name-field" hidden>
          <label class="form-label" for="registration-name">Name</label>
          <input class="form-input" id="registration-name" name="name" type="text" autocomplete="name" maxlength="150" placeholder="Your name">
        </div>
        <div class="registration-only" id="registration-phone-field" hidden>
          <label class="form-label" for="registration-phone">Phone number</label>
          <input class="form-input" id="registration-phone" name="phone_number" type="tel" autocomplete="tel" maxlength="30" placeholder="+63 912 345 6789">
        </div>
        <label class="form-label" for="login-email">Email address</label>
        <input class="form-input" id="login-email" name="email" type="email" autocomplete="email" maxlength="150" placeholder="you@example.com" required>
        <label class="form-label" for="login-password">Password</label>
        <input class="form-input" id="login-password" name="password" type="password" autocomplete="current-password" minlength="6" placeholder="At least 6 characters" required>
        <div class="registration-only" id="registration-confirm-field" hidden>
          <label class="form-label" for="registration-confirm">Confirm password</label>
          <input class="form-input" id="registration-confirm" name="password_confirmation" type="password" autocomplete="new-password" minlength="6" placeholder="Enter your password again">
        </div>
        <button class="gold-button modal-submit" id="login-submit" type="submit">Continue</button>
        <p class="form-message" id="login-message" role="status" aria-live="polite"></p>
      </form>
      <p class="auth-switch" id="auth-switch">No account yet? <button type="button" id="registration-toggle">Create an account</button></p>
    </section>
  </div>
  <div class="modal-backdrop" id="destination-detail-modal" role="presentation">
    <section class="modal destination-detail-modal" role="dialog" aria-modal="true" aria-labelledby="destination-detail-title" aria-describedby="destination-detail-description">
      <button class="modal-close" id="destination-detail-close" type="button" aria-label="Close destination details">✕</button>
      <img class="destination-detail-image" id="destination-detail-image" alt="" hidden>
      <p class="eyebrow destination-detail-category" id="destination-detail-category"></p>
      <h2 id="destination-detail-title"></h2>
      <p class="destination-detail-location" id="destination-detail-location"></p>
      <div class="modal-intro destination-detail-description" id="destination-detail-description"></div>
      <a class="gold-button" id="destination-detail-map" href="#" target="_blank" rel="noopener noreferrer">View on map</a>
    </section>
  </div>
  <template id="marugo-detail-content">
    <section class="destination-detail-section">
      <h3>Overview</h3>
      <p>Nestled in the highlands of Tapaz, Capiz, Marugo Lake is a serene natural attraction known for its calm waters, scenic surroundings, and peaceful atmosphere. Surrounded by lush greenery and rolling hills, the lake offers visitors a refreshing escape into nature and a glimpse of the natural beauty that defines Tapaz.</p>
    </section>
    <section class="destination-detail-section">
      <h3>Highlights</h3>
      <ul>
        <li>Scenic freshwater lake</li>
        <li>Picturesque mountain and forest views</li>
        <li>Peaceful and relaxing environment</li>
        <li>Ideal for photography and sightseeing</li>
        <li>Rich local folklore and cultural significance</li>
      </ul>
    </section>
    <section class="destination-detail-section">
      <h3>Activities</h3>
      <ul>
        <li>Nature appreciation</li>
        <li>Photography</li>
        <li>Sightseeing</li>
        <li>Picnicking</li>
        <li>Birdwatching</li>
        <li>Cultural and eco-tourism tours</li>
      </ul>
    </section>
    <section class="destination-detail-section">
      <h3>Cultural and Environmental Significance</h3>
      <p>Marugo Lake is an important natural landmark in Tapaz, reflecting the municipality's rich ecological heritage. The lake and its surrounding landscape contribute to local biodiversity and serve as a valuable natural resource for nearby communities.</p>
    </section>
    <section class="destination-detail-section">
      <h3>Best Time to Visit</h3>
      <ul>
        <li>November to May (dry season)</li>
        <li>Early morning or late afternoon for the best views and cooler weather</li>
      </ul>
    </section>
    <section class="destination-detail-section">
      <h3>Visitor Tips</h3>
      <ul>
        <li>Wear comfortable outdoor clothing.</li>
        <li>Bring drinking water and sun protection.</li>
        <li>Help preserve the environment by practicing proper waste disposal.</li>
        <li>Respect local customs and natural habitats.</li>
      </ul>
    </section>
    <section class="destination-detail-section">
      <h3>Quick Facts</h3>
      <ul>
        <li><strong>Location:</strong> San Antonio, Tapaz, Capiz</li>
        <li><strong>Category:</strong> Natural Attraction</li>
        <li><strong>Best for:</strong> Nature lovers, photographers, and eco-tourists</li>
        <li><strong>Environment:</strong> Freshwater lake surrounded by forests and highland landscapes</li>
      </ul>
    </section>
  </template>
  <template id="pangilatan-detail-content">
    <section class="destination-detail-section">
      <h3>Overview</h3>
      <p>Pangilatan Falls is a captivating natural attraction in Tapaz, Capiz, known for its cascading waters, scenic surroundings, and tranquil environment. Hidden within the lush highlands of Tapaz, the waterfall offers visitors a refreshing escape and an opportunity to experience the municipality's rich natural beauty.</p>
    </section>
    <section class="destination-detail-section">
      <h3>Description</h3>
      <p>Nestled amidst verdant forests and rolling landscapes, Pangilatan Falls is a perfect destination for nature enthusiasts and adventure seekers. The cool, flowing waters and serene atmosphere create an ideal setting for relaxation, sightseeing, and outdoor exploration. Its untouched beauty makes it one of Tapaz's emerging eco-tourism destinations.</p>
    </section>
    <section class="destination-detail-section">
      <h3>Highlights</h3>
      <ul>
        <li>Multi-tiered cascading waterfall</li>
        <li>Crystal-clear freshwater</li>
        <li>Lush natural surroundings</li>
        <li>Excellent photography spot</li>
        <li>Peaceful and refreshing ambiance</li>
      </ul>
    </section>
    <section class="destination-detail-section">
      <h3>Activities</h3>
      <ul>
        <li>Nature trekking</li>
        <li>Sightseeing</li>
        <li>Photography</li>
        <li>Swimming (when safe and permitted)</li>
        <li>Picnicking</li>
        <li>Eco-tourism exploration</li>
      </ul>
    </section>
    <section class="destination-detail-section">
      <h3>Why Visit?</h3>
      <blockquote>Discover the pristine beauty of Pangilatan Falls, where cascading waters and lush greenery provide a refreshing retreat for visitors seeking adventure and relaxation in the heart of Tapaz.</blockquote>
    </section>
    <section class="destination-detail-section">
      <h3>Visitor Tips</h3>
      <ul>
        <li>Wear comfortable hiking shoes.</li>
        <li>Bring water and essential outdoor gear.</li>
        <li>Observe proper waste disposal practices.</li>
        <li>Respect the natural environment and local community.</li>
      </ul>
    </section>
    <section class="destination-detail-section">
      <h3>Quick Information</h3>
      <ul>
        <li><strong>Location:</strong> Artuz, Tapaz, Capiz</li>
        <li><strong>Category:</strong> Waterfall / Natural Attraction</li>
        <li><strong>Best for:</strong> Nature lovers, hikers, photographers, and adventure seekers</li>
        <li><strong>Popular activities:</strong> Trekking, sightseeing, and nature photography</li>
      </ul>
    </section>
  </template>
  <template id="minan-detail-content">
    <section class="destination-detail-section">
      <h3>Overview</h3>
      <p>Minan Falls is one of the natural gems of Tapaz, Capiz, offering visitors a refreshing retreat amidst the municipality's lush highland landscapes. Known for its cascading waters and tranquil surroundings, the falls provide a perfect destination for relaxation, nature appreciation, and outdoor adventure.</p>
    </section>
    <section class="destination-detail-section">
      <h3>Description</h3>
      <p>Nestled within the scenic countryside of Tapaz, Minan Falls captivates visitors with its pristine waters and natural beauty. Surrounded by greenery and fresh mountain air, the waterfall serves as an ideal spot for those seeking a peaceful escape from urban life. Its untouched charm makes it a favorite destination for eco-tourism and nature exploration.</p>
    </section>
    <section class="destination-detail-section">
      <h3>Highlights</h3>
      <ul>
        <li>Beautiful cascading waterfall</li>
        <li>Refreshing natural waters</li>
        <li>Scenic highland surroundings</li>
        <li>Excellent photography opportunities</li>
        <li>Peaceful and relaxing atmosphere</li>
      </ul>
    </section>
    <section class="destination-detail-section">
      <h3>Activities</h3>
      <ul>
        <li>Nature trekking</li>
        <li>Sightseeing</li>
        <li>Photography</li>
        <li>Swimming (if safe and permitted)</li>
        <li>Picnicking</li>
        <li>Eco-tourism activities</li>
      </ul>
    </section>
    <section class="destination-detail-section">
      <h3>Why Visit?</h3>
      <blockquote>Discover the serene beauty of Minan Falls, where crystal-clear waters and lush natural landscapes create a memorable outdoor experience in the heart of Tapaz.</blockquote>
    </section>
    <section class="destination-detail-section">
      <h3>Visitor Tips</h3>
      <ul>
        <li>Wear comfortable trekking shoes.</li>
        <li>Bring sufficient drinking water.</li>
        <li>Keep the area clean by practicing proper waste disposal.</li>
        <li>Follow local safety guidelines and respect the environment.</li>
      </ul>
    </section>
    <section class="destination-detail-section">
      <h3>Quick Information</h3>
      <ul>
        <li><strong>Location:</strong> Minan, Tapaz, Capiz</li>
        <li><strong>Category:</strong> Waterfall / Natural Attraction</li>
        <li><strong>Best for:</strong> Nature lovers, adventurers, and photographers</li>
        <li><strong>Popular activities:</strong> Trekking, sightseeing, and nature photography</li>
      </ul>
    </section>
  </template>
  <template id="st-jerome-detail-content">
    <section class="destination-detail-section">
      <h3>Overview</h3>
      <p>St. Jerome Parish Church is one of the most significant religious landmarks in Tapaz, Capiz. Serving as a center of faith and community life, the church reflects the town's deep spiritual heritage and continues to be a place of worship, reflection, and celebration for residents and visitors alike.</p>
    </section>
    <section class="destination-detail-section">
      <h3>Description</h3>
      <p>Located in the heart of Tapaz, St. Jerome Parish Church stands as a symbol of the municipality's strong Catholic faith and rich history. Dedicated to Saint Jerome, the patron saint of the parish, the church welcomes devotees, pilgrims, and tourists seeking a place for prayer and cultural appreciation. Its peaceful atmosphere and historical significance make it an important destination within the town.</p>
    </section>
    <section class="destination-detail-section">
      <h3>Highlights</h3>
      <ul>
        <li>Historic Catholic church</li>
        <li>Center of religious and cultural activities</li>
        <li>Beautiful place for prayer and reflection</li>
        <li>Significant landmark in Tapaz</li>
        <li>Venue for religious celebrations and parish events</li>
      </ul>
    </section>
    <section class="destination-detail-section">
      <h3>Activities</h3>
      <ul>
        <li>Attend Holy Mass</li>
        <li>Personal prayer and reflection</li>
        <li>Religious pilgrimages</li>
        <li>Cultural and heritage visits</li>
        <li>Photography and sightseeing</li>
      </ul>
    </section>
    <section class="destination-detail-section">
      <h3>Historical and Cultural Significance</h3>
      <p>St. Jerome Parish Church has played an important role in the spiritual development of the Tapaz community. For generations, it has been a gathering place for worship, celebrations, and religious traditions that continue to strengthen the faith and unity of the people.</p>
    </section>
    <section class="destination-detail-section">
      <h3>Why Visit?</h3>
      <blockquote>Visit St. Jerome Parish Church to experience the spiritual heritage of Tapaz, admire its religious significance, and appreciate its role as a cornerstone of the community's faith and culture.</blockquote>
    </section>
    <section class="destination-detail-section">
      <h3>Visitor Tips</h3>
      <ul>
        <li>Dress respectfully when entering the church.</li>
        <li>Observe silence and proper decorum during religious services.</li>
        <li>Follow church guidelines and schedules.</li>
        <li>Respect ongoing worship activities.</li>
      </ul>
    </section>
    <section class="destination-detail-section">
      <h3>Quick Information</h3>
      <ul>
        <li><strong>Location:</strong> Poblacion, Tapaz, Capiz</li>
        <li><strong>Category:</strong> Religious and Historical Site</li>
        <li><strong>Best for:</strong> Pilgrims, devotees, cultural tourists, and visitors seeking spiritual reflection</li>
        <li><strong>Popular activities:</strong> Worship, heritage visits, and photography</li>
      </ul>
    </section>
  </template>
  <template id="tapaz-plaza-detail-content">
    <section class="destination-detail-section">
      <h3>Overview</h3>
      <p>Tapaz Public Plaza is the heart of the municipality and a popular gathering place for residents and visitors alike. Located in the town center, the plaza serves as a venue for community events, cultural activities, public celebrations, and leisure activities.</p>
    </section>
    <section class="destination-detail-section">
      <h3>Description</h3>
      <p>As one of the most recognizable landmarks in Tapaz, the Public Plaza reflects the town's vibrant community spirit and local culture. Surrounded by important establishments, including government offices, businesses, and religious sites, it provides a welcoming space where people can relax, socialize, and participate in various town activities. The plaza comes alive during festivals, civic events, and cultural celebrations, making it an important part of daily life in Tapaz.</p>
    </section>
    <section class="destination-detail-section">
      <h3>Highlights</h3>
      <ul>
        <li>Central gathering place of the municipality</li>
        <li>Well-maintained open recreational space</li>
        <li>Venue for festivals and community events</li>
        <li>Accessible location in the town center</li>
        <li>Ideal spot for relaxation and sightseeing</li>
      </ul>
    </section>
    <section class="destination-detail-section">
      <h3>Activities</h3>
      <ul>
        <li>Walking and leisure strolls</li>
        <li>Community gatherings</li>
        <li>Attending local events and celebrations</li>
        <li>Photography</li>
        <li>Family recreation</li>
        <li>Cultural and civic activities</li>
      </ul>
    </section>
    <section class="destination-detail-section">
      <h3>Cultural Significance</h3>
      <p>The Tapaz Public Plaza serves as a symbol of community unity and local pride. It provides a shared space where traditions, celebrations, and public activities bring residents together while welcoming visitors to experience the town's warm and vibrant atmosphere.</p>
    </section>
    <section class="destination-detail-section">
      <h3>Why Visit?</h3>
      <blockquote>Experience the lively atmosphere of Tapaz at its central public plaza, where community life, culture, and local traditions come together in a welcoming public space.</blockquote>
    </section>
    <section class="destination-detail-section">
      <h3>Visitor Tips</h3>
      <ul>
        <li>Visit during local festivals and town events for a more vibrant experience.</li>
        <li>Explore nearby attractions such as St. Jerome Parish Church and the municipal hall.</li>
        <li>Bring a camera to capture community activities and the town's atmosphere.</li>
      </ul>
    </section>
    <section class="destination-detail-section">
      <h3>Quick Information</h3>
      <ul>
        <li><strong>Location:</strong> Poblacion, Tapaz, Capiz</li>
        <li><strong>Category:</strong> Public Park / Community Landmark</li>
        <li><strong>Best for:</strong> Families, tourists, and community gatherings</li>
        <li><strong>Popular activities:</strong> Sightseeing, relaxation, and event participation</li>
      </ul>
    </section>
  </template>
  <template id="aglinab-bridge-detail-content">
    <section class="destination-detail-section">
      <h3>Overview</h3>
      <p>Aglinab Hanging Bridge is one of the notable landmarks in Tapaz, Capiz, connecting communities and offering visitors a unique experience of crossing above a flowing river while enjoying the scenic beauty of the surrounding countryside.</p>
    </section>
    <section class="destination-detail-section">
      <h3>Description</h3>
      <p>Suspended over a river and surrounded by natural landscapes, Aglinab Hanging Bridge serves as both a functional crossing and a local attraction. The bridge provides visitors with stunning views of the river, lush vegetation, and the peaceful rural environment of Tapaz. Its simple yet distinctive structure makes it a popular spot for sightseeing, photography, and experiencing the charm of the municipality's outdoor attractions.</p>
    </section>
    <section class="destination-detail-section">
      <h3>Highlights</h3>
      <ul>
        <li>Scenic hanging bridge experience</li>
        <li>Panoramic river views</li>
        <li>Picturesque natural surroundings</li>
        <li>Unique photography location</li>
        <li>Important community landmark</li>
      </ul>
    </section>
    <section class="destination-detail-section">
      <h3>Activities</h3>
      <ul>
        <li>Walking across the bridge</li>
        <li>Sightseeing</li>
        <li>Photography</li>
        <li>Nature appreciation</li>
        <li>Exploring nearby attractions</li>
      </ul>
    </section>
    <section class="destination-detail-section">
      <h3>Cultural Significance</h3>
      <p>Aglinab Hanging Bridge symbolizes connectivity and community in Tapaz. It serves as an important link for local residents while also welcoming visitors to experience the area's natural beauty and rural way of life.</p>
    </section>
    <section class="destination-detail-section">
      <h3>Why Visit?</h3>
      <blockquote>Experience the thrill of crossing Aglinab Hanging Bridge while taking in breathtaking views of the surrounding river and countryside, making it a memorable stop during your visit to Tapaz.</blockquote>
    </section>
    <section class="destination-detail-section">
      <h3>Visitor Tips</h3>
      <ul>
        <li>Walk carefully and follow safety guidelines.</li>
        <li>Take photos during daylight hours for the best views.</li>
        <li>Be mindful of other visitors crossing the bridge.</li>
        <li>Help keep the area clean and well-preserved.</li>
      </ul>
    </section>
    <section class="destination-detail-section">
      <h3>Quick Information</h3>
      <ul>
        <li><strong>Location:</strong> Aglinab, Tapaz, Capiz</li>
        <li><strong>Category:</strong> Landmark / Infrastructure Attraction</li>
        <li><strong>Best for:</strong> Sightseeing, photography, and nature appreciation</li>
        <li><strong>Environment:</strong> River and countryside landscape</li>
      </ul>
    </section>
  </template>
  <template id="tapaz-market-detail-content">
    <section class="destination-detail-section">
      <h3>Overview</h3>
      <p>Tapaz Public Market is the municipality's primary trading center, where local products, fresh produce, and everyday goods are bought and sold. Serving as a vital hub of commerce and community interaction, the market offers visitors a glimpse into the daily life, culture, and livelihood of the people of Tapaz.</p>
    </section>
    <section class="destination-detail-section">
      <h3>Description</h3>
      <p>Located at the heart of the municipality, Tapaz Public Market is a bustling center where farmers, vendors, artisans, and residents come together to trade goods and support local businesses. Visitors can explore a variety of fresh agricultural products, native delicacies, handicrafts, and locally sourced items that showcase the richness of Tapaz's economy and traditions.</p>
    </section>
    <section class="destination-detail-section">
      <h3>Highlights</h3>
      <ul>
        <li>Central marketplace of Tapaz</li>
        <li>Fresh fruits, vegetables, and agricultural products</li>
        <li>Local delicacies and native products</li>
        <li>Friendly community atmosphere</li>
        <li>Opportunity to support local vendors and producers</li>
      </ul>
    </section>
    <section class="destination-detail-section">
      <h3>Activities</h3>
      <ul>
        <li>Shopping for local products</li>
        <li>Exploring native delicacies</li>
        <li>Supporting local businesses</li>
        <li>Experiencing local culture and daily life</li>
        <li>Photography and cultural immersion</li>
      </ul>
    </section>
    <section class="destination-detail-section">
      <h3>Cultural Significance</h3>
      <p>The Tapaz Public Market plays an important role in the local economy and community life. It serves as a meeting place where residents connect, conduct business, and preserve traditional trade practices that have been part of the municipality for generations.</p>
    </section>
    <section class="destination-detail-section">
      <h3>Why Visit?</h3>
      <blockquote>Experience the vibrant local culture of Tapaz by visiting its public market, where fresh produce, local delicacies, and community spirit come together in a lively and authentic setting.</blockquote>
    </section>
    <section class="destination-detail-section">
      <h3>Visitor Tips</h3>
      <ul>
        <li>Visit early in the morning for the freshest products.</li>
        <li>Bring cash for convenient purchases.</li>
        <li>Support local farmers and small business owners by purchasing locally made products.</li>
        <li>Be respectful of vendors and fellow shoppers.</li>
      </ul>
    </section>
    <section class="destination-detail-section">
      <h3>Quick Information</h3>
      <ul>
        <li><strong>Location:</strong> Poblacion, Tapaz, Capiz</li>
        <li><strong>Category:</strong> Market / Commercial Center</li>
        <li><strong>Best for:</strong> Shopping, cultural immersion, and local food exploration</li>
        <li><strong>Popular products:</strong> Fresh produce, native delicacies, handicrafts, and household goods</li>
      </ul>
    </section>
  </template>
  <template id="tagbak-falls-detail-content">
    <section class="destination-detail-section">
      <h3>Overview</h3>
      <p>Tagbak Falls is a breathtaking natural attraction in Tapaz, Capiz, known for its cascading waters, refreshing atmosphere, and scenic surroundings. Hidden within the municipality's lush landscapes, the falls offer visitors a peaceful retreat and a chance to experience the beauty of nature up close.</p>
    </section>
    <section class="destination-detail-section">
      <h3>Description</h3>
      <p>Nestled amidst verdant forests and rolling highland terrain, Tagbak Falls showcases the natural splendor of Tapaz. The cool waters flowing down its rocky formations create a relaxing environment perfect for unwinding and connecting with nature. Its picturesque setting makes it a favorite destination for outdoor enthusiasts, photographers, and travelers seeking a refreshing escape.</p>
    </section>
    <section class="destination-detail-section">
      <h3>Highlights</h3>
      <ul>
        <li>Stunning cascading waterfall</li>
        <li>Crystal-clear freshwater</li>
        <li>Beautiful natural surroundings</li>
        <li>Relaxing and peaceful ambiance</li>
        <li>Excellent spot for photography and sightseeing</li>
      </ul>
    </section>
    <section class="destination-detail-section">
      <h3>Activities</h3>
      <ul>
        <li>Nature trekking</li>
        <li>Sightseeing</li>
        <li>Photography</li>
        <li>Swimming (if safe and permitted)</li>
        <li>Picnicking</li>
        <li>Nature appreciation</li>
      </ul>
    </section>
    <section class="destination-detail-section">
      <h3>Natural Significance</h3>
      <p>Tagbak Falls contributes to the ecological richness of Tapaz and highlights the municipality's commitment to preserving its natural attractions. The surrounding environment supports local biodiversity and provides visitors with an authentic eco-tourism experience.</p>
    </section>
    <section class="destination-detail-section">
      <h3>Why Visit?</h3>
      <blockquote>Experience the refreshing beauty of Tagbak Falls, where cascading waters, lush greenery, and the tranquility of nature create a memorable getaway in the highlands of Tapaz.</blockquote>
    </section>
    <section class="destination-detail-section">
      <h3>Visitor Tips</h3>
      <ul>
        <li>Wear comfortable footwear for trekking.</li>
        <li>Bring drinking water and outdoor essentials.</li>
        <li>Practice proper waste disposal.</li>
        <li>Respect the natural environment and local community.</li>
      </ul>
    </section>
    <section class="destination-detail-section">
      <h3>Quick Information</h3>
      <ul>
        <li><strong>Location:</strong> Hilwan, Tapaz, Capiz</li>
        <li><strong>Category:</strong> Waterfall / Natural Attraction</li>
        <li><strong>Best for:</strong> Nature lovers, hikers, photographers, and adventure seekers</li>
        <li><strong>Popular activities:</strong> Trekking, sightseeing, swimming, and photography</li>
      </ul>
    </section>
  </template>
  <div class="modal-backdrop" id="logout-modal" role="presentation">
    <section class="modal" role="dialog" aria-modal="true" aria-labelledby="logout-title" aria-describedby="logout-description">
      <h2 id="logout-title">Log out?</h2>
      <p class="modal-intro" id="logout-description">Are you sure you want to log out of your visitor account?</p>
      <div class="logout-modal-actions">
        <button class="inline-button" id="logout-cancel" type="button">Cancel</button>
        <button class="gold-button" id="logout-confirm" type="button">Log out</button>
      </div>
      <p class="form-message" id="logout-message" role="status" aria-live="polite"></p>
    </section>
  </div>
  <script src="script.js"></script>
  <script src="culture-content.js"></script>
</body>
</html>
