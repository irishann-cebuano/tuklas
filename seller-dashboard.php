<?php
require __DIR__ . "/session.php";

$seller = $_SESSION["auth_user"] ?? null;
if (!is_array($seller) || ($seller["role"] ?? "") !== "seller") {
    header("Location: index.php");
    exit;
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="theme-color" content="#fff9ec">
  <meta name="description" content="Manage your Tapaz Tourism products, seller contact information, and profile.">
  <link rel="stylesheet" href="style.css">
  <title>Seller Dashboard | Discover Tapaz</title>
</head>
<body class="seller-dashboard">
  <header class="topbar">
    <div class="shell nav-wrap">
      <a class="brand" href="#seller-home" aria-label="Seller dashboard home">
        <img src="assets/tapaz-tourism-logo.webp" alt="">
        <span class="brand-copy"><span class="brand-name">Tapaz</span><span class="brand-label">TOURISM</span><span class="brand-tagline">Nature. Culture. Community.</span></span>
      </a>
      <nav class="nav-links dashboard-nav" id="seller-navigation" aria-label="Seller dashboard navigation">
        <a href="#seller-home">Dashboard</a>
        <a href="#seller-products">My Products</a>
        <a href="index.php#culture-content" target="_blank" rel="noopener noreferrer">View public website</a>
        <a href="#seller-contact">Contact Information</a>
        <a href="#seller-profile">My Profile</a>
      </nav>
      <div class="nav-actions">
        <button class="login-button" id="seller-logout" type="button">Logout</button>
        <button class="menu-button" id="seller-menu-toggle" type="button" aria-label="Open navigation" aria-expanded="false" aria-controls="seller-navigation">
          <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M4 7h16M4 12h16M4 17h16" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
        </button>
      </div>
    </div>
  </header>

  <section class="visitor-hero seller-hero" id="seller-home" aria-labelledby="seller-welcome">
    <div class="shell visitor-hero-inner">
      <p class="eyebrow">Seller dashboard</p>
      <h1 id="seller-welcome">Welcome, <?= htmlspecialchars($seller["name"], ENT_QUOTES, "UTF-8") ?>!</h1>
      <p>Manage your products, contact information, and seller profile.</p>
      <div class="visitor-quick-links" aria-label="Seller dashboard quick links">
        <a href="#seller-products">Manage products</a>
        <a href="index.php#culture-content" target="_blank" rel="noopener noreferrer">View public website</a>
        <a href="#seller-contact">Contact information</a>
        <a href="#seller-profile">My profile</a>
      </div>
    </div>
  </section>

  <main class="shell visitor-main seller-main">
    <p class="form-message error" id="seller-error" role="alert" hidden></p>

    <section class="section seller-section" aria-labelledby="seller-summary-title">
      <div class="section-heading"><div><h2 id="seller-summary-title">Dashboard</h2><p>View a summary of your products.</p></div></div>
      <div class="seller-summary" id="seller-summary">
        <article><span>Total products</span><strong id="summary-total">—</strong></article>
        <article><span>Published</span><strong id="summary-published">—</strong></article>
        <article><span>Drafts</span><strong id="summary-drafts">—</strong></article>
      </div>
    </section>

    <section class="section seller-section" id="seller-products" aria-labelledby="seller-products-title">
      <div class="section-heading"><div><h2 id="seller-products-title">My Products</h2><p>Add, edit, and delete products listed under your seller account.</p></div></div>
      <form class="visitor-form seller-form" id="seller-product-form">
        <input id="seller-product-id" name="product_id" type="hidden">
        <h3 id="seller-product-form-title">Add a product</h3>
        <label class="form-label" for="product-name">Product name</label>
        <input class="form-input" id="product-name" name="product_name" maxlength="200" required>
        <label class="form-label" for="product-description">Description</label>
        <textarea class="form-input form-textarea" id="product-description" name="description" maxlength="5000" rows="4" required></textarea>
        <label class="form-label" for="product-price">Price (optional)</label>
        <input class="form-input" id="product-price" name="price" type="number" min="0" max="99999999.99" step="0.01">
        <label class="form-label" for="product-image">Image URL or project-relative path (optional)</label>
        <input class="form-input" id="product-image" name="image_path" type="text" maxlength="255" placeholder="https://... or assets/product.jpg">
        <label class="form-label" for="product-inquiry">Product inquiry information</label>
        <textarea class="form-input form-textarea" id="product-inquiry" name="inquiry_information" maxlength="2000" rows="3" required placeholder="How should visitors ask about this product?"></textarea>
        <label class="form-label" for="product-status">Status</label>
        <select class="form-input" id="product-status" name="status">
          <option value="draft">Draft</option>
          <option value="published" selected>Published</option>
          <option value="archived">Archived</option>
        </select>
        <p class="form-hint">Published products appear in the public Local Products section for visitors to view.</p>
        <div class="seller-form-actions">
          <button class="gold-button" id="seller-product-submit" type="submit">Add product</button>
          <button class="inline-button" id="seller-product-cancel" type="button" hidden>Cancel edit</button>
        </div>
        <p class="form-message" id="seller-product-message" role="status" aria-live="polite"></p>
      </form>
      <div class="section-heading seller-posted-heading">
        <div><h3>Your posted products</h3><p>Products saved to your seller account, with their current status.</p></div>
      </div>
      <div class="seller-product-list" id="seller-product-list" aria-live="polite"></div>
      <p class="empty-state seller-products-empty" id="seller-products-empty" role="status">You have not added any products yet. Add a product above and it will appear here.</p>
    </section>

    <section class="section seller-section" id="seller-contact" aria-labelledby="seller-contact-title">
      <div class="section-heading"><div><h2 id="seller-contact-title">Contact Information</h2><p>Add or update a phone number or Facebook link so visitors can contact you.</p></div></div>
      <form class="visitor-form seller-form" id="seller-contact-form">
        <label class="form-label" for="seller-phone">Phone number</label>
        <input class="form-input" id="seller-phone" name="phone_number" type="tel" maxlength="30" autocomplete="tel">
        <label class="form-label" for="seller-facebook">Facebook link</label>
        <input class="form-input" id="seller-facebook" name="facebook_url" type="url" maxlength="255" placeholder="https://www.facebook.com/your-page">
        <button class="gold-button" type="submit">Save contact information</button>
        <p class="form-message" id="seller-contact-message" role="status" aria-live="polite"></p>
      </form>
    </section>

    <section class="section seller-section" id="seller-profile" aria-labelledby="seller-profile-title">
      <div class="section-heading"><div><h2 id="seller-profile-title">My Profile</h2><p>View and update your account information.</p></div></div>
      <form class="visitor-form seller-form" id="seller-profile-form">
        <label class="form-label" for="seller-name">Name</label>
        <input class="form-input" id="seller-name" name="name" type="text" maxlength="150" required>
        <label class="form-label" for="seller-email">Email address</label>
        <input class="form-input" id="seller-email" name="email" type="email" maxlength="150" required>
        <h3 class="account-settings-title">Change password (optional)</h3>
        <label class="form-label" for="seller-current-password">Current password</label>
        <input class="form-input" id="seller-current-password" name="current_password" type="password" autocomplete="current-password">
        <label class="form-label" for="seller-new-password">New password</label>
        <input class="form-input" id="seller-new-password" name="new_password" type="password" minlength="6" autocomplete="new-password">
        <label class="form-label" for="seller-confirm-password">Confirm new password</label>
        <input class="form-input" id="seller-confirm-password" name="password_confirmation" type="password" minlength="6" autocomplete="new-password">
        <button class="gold-button" type="submit">Save profile</button>
        <p class="form-message" id="seller-profile-message" role="status" aria-live="polite"></p>
      </form>
    </section>
  </main>
  <footer class="footer">
    <div class="shell footer-inner">
      <a class="footer-brand" href="#seller-home" aria-label="Back to seller dashboard"><img src="assets/tapaz-tourism-logo.webp" alt="Tapaz Tourism"></a>
      <p class="footer-note">Manage your Tapaz Tourism products and connect with visitors.</p>
      <div class="footer-links"><a href="#seller-products">My products</a><a href="#seller-contact">Contact information</a><a href="#seller-profile">My profile</a></div>
    </div>
  </footer>

  <div class="modal-backdrop" id="logout-modal" role="presentation">
    <section class="modal" role="dialog" aria-modal="true" aria-labelledby="logout-title" aria-describedby="logout-description">
      <h2 id="logout-title">Log out?</h2>
      <p class="modal-intro" id="logout-description">Are you sure you want to log out of your seller account?</p>
      <div class="logout-modal-actions">
        <button class="inline-button" id="logout-cancel" type="button">Cancel</button>
        <button class="gold-button" id="logout-confirm" type="button">Log out</button>
      </div>
      <p class="form-message" id="logout-message" role="status" aria-live="polite"></p>
    </section>
  </div>

  <div class="modal-backdrop" id="product-publish-modal" role="presentation">
    <section class="modal" role="dialog" aria-modal="true" aria-labelledby="product-publish-title" aria-describedby="product-publish-description">
      <h2 id="product-publish-title">Publish product?</h2>
      <p class="modal-intro" id="product-publish-description">This product will be visible to visitors in the public Local Products section. Do you want to continue?</p>
      <div class="logout-modal-actions">
        <button class="inline-button" id="product-publish-cancel" type="button">Cancel</button>
        <button class="gold-button" id="product-publish-confirm" type="button">Publish product</button>
      </div>
      <p class="form-message" id="product-publish-message" role="status" aria-live="polite"></p>
    </section>
  </div>

  <script src="seller-dashboard.js"></script>
</body>
</html>
