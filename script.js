const menuToggle = document.querySelector("#menu-toggle");
const navigation = document.querySelector("#main-navigation");
const searchToggle = document.querySelector("#search-toggle");
const searchPanel = document.querySelector("#search-panel");
const searchInput = document.querySelector("#site-search");
const loginModal = document.querySelector("#login-modal");
const loginOpen = document.querySelector("#login-open");
const loginClose = document.querySelector("#login-close");
const loginForm = document.querySelector("#login-form");
const loginMessage = document.querySelector("#login-message");
const accountStatus = document.querySelector("#account-status");
const logoutModal = document.querySelector("#logout-modal");
const logoutCancel = document.querySelector("#logout-cancel");
const logoutConfirm = document.querySelector("#logout-confirm");
const logoutMessage = document.querySelector("#logout-message");
const accountRole = document.querySelector("#account-role");
const accountRoleButtons = document.querySelectorAll(".account-type-button");
const registrationToggle = document.querySelector("#registration-toggle");
const registrationNameField = document.querySelector("#registration-name-field");
const registrationPhoneField = document.querySelector("#registration-phone-field");
const registrationConfirmField = document.querySelector("#registration-confirm-field");
const registrationName = document.querySelector("#registration-name");
const registrationPhone = document.querySelector("#registration-phone");
const registrationConfirm = document.querySelector("#registration-confirm");
const loginSubmit = document.querySelector("#login-submit");
const destinationDetailModal = document.querySelector("#destination-detail-modal");
const destinationDetailClose = document.querySelector("#destination-detail-close");
const destinationDetailImage = document.querySelector("#destination-detail-image");
let pendingDestinationDetails = null;
let destinationDetailTrigger = null;
let isRegistering = false;
let isAuthenticated = false;
let currentUser = null;
let isLoggingOut = false;

function updateAuthDescription() {
  const selectedRole = accountRole.value;
  document.querySelector("#login-description").textContent = isRegistering
    ? `Create a ${selectedRole} account to ${selectedRole === "seller" ? "list your products and connect with visitors." : "explore Tapaz and plan your visit."}`
    : `Sign in as a ${selectedRole} to ${selectedRole === "seller" ? "manage your products and seller profile." : "explore Tapaz and plan your visit."}`;
}

accountRoleButtons.forEach((button) => {
  button.addEventListener("click", () => {
    accountRole.value = button.dataset.role;
    accountRoleButtons.forEach((option) => {
      const selected = option === button;
      option.classList.toggle("active", selected);
      option.setAttribute("aria-pressed", String(selected));
    });
    updateAuthDescription();
  });
});

registrationToggle.addEventListener("click", () => {
  isRegistering = !isRegistering;
  registrationNameField.hidden = !isRegistering;
  registrationPhoneField.hidden = !isRegistering;
  registrationConfirmField.hidden = !isRegistering;
  registrationName.required = isRegistering;
  registrationPhone.required = isRegistering;
  registrationConfirm.required = isRegistering;
  document.querySelector("#login-title").textContent = isRegistering ? "Create your account" : "Welcome back";
  updateAuthDescription();
  loginSubmit.textContent = isRegistering ? "Create account" : "Continue";
  registrationToggle.textContent = isRegistering ? "Sign in" : "Create an account";
  document.querySelector("#auth-switch").firstChild.textContent = isRegistering
    ? "Already have an account? "
    : "No account yet? ";
  loginMessage.textContent = "";
  loginMessage.classList.remove("error");
});

menuToggle.addEventListener("click", () => {
  const isOpen = menuToggle.getAttribute("aria-expanded") === "true";
  menuToggle.setAttribute("aria-expanded", String(!isOpen));
  menuToggle.setAttribute("aria-label", isOpen ? "Open navigation" : "Close navigation");
  navigation.classList.toggle("open", !isOpen);
});

navigation.addEventListener("click", (event) => {
  if (event.target.closest("a")) {
    navigation.classList.remove("open");
    menuToggle.setAttribute("aria-expanded", "false");
    menuToggle.setAttribute("aria-label", "Open navigation");
  }
});

searchToggle.addEventListener("click", () => {
  const isOpen = searchPanel.classList.toggle("open");
  searchToggle.setAttribute("aria-expanded", String(isOpen));
  if (isOpen) searchInput.focus();
  else {
    searchInput.value = "";
    filterSearch("");
  }
});

function filterSearch(query) {
  const searchTerms = query
    .normalize("NFD")
    .replace(/[\u0300-\u036f]/g, "")
    .toLocaleLowerCase()
    .match(/[a-z0-9]+/g) || [];
  let destinationCount = 0;
  let eventCount = 0;
  const destinationsExpanded = document.querySelector("#destinations-toggle").getAttribute("aria-expanded") === "true";
  const eventsExpanded = document.querySelector("#events-toggle").getAttribute("aria-expanded") === "true";

  document.querySelectorAll("#destination-grid .searchable").forEach((card) => {
    const searchableText = `${card.dataset.search || ""} ${card.textContent}`
      .normalize("NFD")
      .replace(/[\u0300-\u036f]/g, "")
      .toLocaleLowerCase();
    const matches = searchTerms.every((term) => searchableText.includes(term)) &&
      (searchTerms.length > 0 || destinationsExpanded || !card.classList.contains("extra-destination"));
    card.hidden = !matches;
    if (matches) destinationCount += 1;
  });
  document.querySelectorAll("#event-grid .searchable").forEach((card) => {
    const searchableText = `${card.dataset.search || ""} ${card.textContent}`
      .normalize("NFD")
      .replace(/[\u0300-\u036f]/g, "")
      .toLocaleLowerCase();
    const matches = searchTerms.every((term) => searchableText.includes(term)) &&
      (searchTerms.length > 0 || eventsExpanded || !card.classList.contains("extra-event"));
    card.hidden = !matches;
    if (matches) eventCount += 1;
  });
  document.querySelector("#destination-empty").classList.toggle("visible", destinationCount === 0);
  document.querySelector("#event-empty").classList.toggle("visible", eventCount === 0);
}

searchInput.addEventListener("input", (event) => filterSearch(event.target.value));

function setupExpandButton(buttonId, headingSelector) {
  const button = document.querySelector(buttonId);
  button.addEventListener("click", () => {
    const expanded = button.getAttribute("aria-expanded") === "true";
    button.setAttribute("aria-expanded", String(!expanded));
    button.querySelector("span").textContent = expanded ? "View all" : "Show less";
    filterSearch(searchInput.value);
    if (!expanded) document.querySelector(headingSelector).scrollIntoView({ behavior: "smooth", block: "start" });
  });
}

setupExpandButton("#destinations-toggle", "#destinations-title");
setupExpandButton("#events-toggle", "#events-title");

const cultureToggle = document.querySelector("#culture-toggle");
const cultureContent = document.querySelector("#culture-content");
cultureToggle.addEventListener("click", () => {
  const expanded = cultureToggle.getAttribute("aria-expanded") === "true";
  cultureToggle.setAttribute("aria-expanded", String(!expanded));
  cultureToggle.querySelector("span").textContent = expanded ? "Explore Culture" : "Hide Culture";
  cultureContent.hidden = expanded;

  if (expanded) {
    document.querySelector("#culture").scrollIntoView({ behavior: "smooth", block: "start" });
  } else {
    cultureContent.scrollIntoView({ behavior: "smooth", block: "start" });
  }
});

if (location.hash === "#culture-content" || /^#culture-product-\d+$/.test(location.hash)) {
  cultureToggle.setAttribute("aria-expanded", "true");
  cultureToggle.querySelector("span").textContent = "Hide Culture";
  cultureContent.hidden = false;
  if (location.hash === "#culture-content") {
    cultureContent.scrollIntoView({ behavior: "smooth", block: "start" });
  }
}

function openLogin() {
  loginModal.classList.add("open");
  document.body.classList.add("locked");
  document.querySelector("#login-description").textContent = pendingDestinationDetails
    ? "Sign in or create a visitor account to view destination details."
    : "Sign in to save places and plan your Tapaz trip.";
  loginMessage.textContent = "";
  loginMessage.classList.remove("error");
  document.querySelector("#login-email").focus();
}

function closeLogin() {
  loginModal.classList.remove("open");
  if (!destinationDetailModal.classList.contains("open")) document.body.classList.remove("locked");
  loginOpen.focus();
}

function closeDestinationDetails() {
  destinationDetailModal.classList.remove("open");
  if (!loginModal.classList.contains("open")) document.body.classList.remove("locked");
  if (destinationDetailTrigger) destinationDetailTrigger.focus();
}

function showDestinationDetails(details) {
  document.querySelector("#destination-detail-title").textContent = details.title;
  const categoryElement = document.querySelector("#destination-detail-category");
  categoryElement.textContent = details.category;
  document.querySelector("#destination-detail-location").textContent = details.location;
  const description = document.querySelector("#destination-detail-description");
  description.replaceChildren();
  const detailContentId = {
    "Marugo Lake": "marugo-detail-content",
    "Pangilatan Falls": "pangilatan-detail-content",
    "Minan Falls": "minan-detail-content",
    "St. Jerome Parish Church": "st-jerome-detail-content",
    "Tapaz Public Plaza": "tapaz-plaza-detail-content",
    "Aglinab Hanging Footbridge": "aglinab-bridge-detail-content",
    "Tapaz Public Market": "tapaz-market-detail-content",
    "Tagbak Falls": "tagbak-falls-detail-content"
  }[details.title];
  if (detailContentId) {
    description.append(document.querySelector(`#${detailContentId}`).content.cloneNode(true));
  } else {
    const paragraph = document.createElement("p");
    paragraph.textContent = details.description;
    description.append(paragraph);
  }
  document.querySelector("#destination-detail-map").href = details.mapUrl;
  destinationDetailImage.hidden = !details.image;
  destinationDetailImage.alt = details.title;
  if (details.image) destinationDetailImage.src = details.image;
  destinationDetailModal.classList.add("open");
  document.body.classList.add("locked");
  destinationDetailClose.focus();
}

function readDestinationDetails(button) {
  return {
    title: button.dataset.title,
    category: button.dataset.category,
    location: button.dataset.location,
    description: button.dataset.description,
    image: button.dataset.image,
    mapUrl: button.dataset.mapUrl
  };
}

document.querySelectorAll(".destination-details-button:not(.culture-details-toggle)").forEach((button) => {
  button.addEventListener("click", () => {
    const details = readDestinationDetails(button);
    destinationDetailTrigger = button;
    if (currentUser && currentUser.role === "visitor") {
      showDestinationDetails(details);
      return;
    }

    pendingDestinationDetails = details;
    accountRole.value = "visitor";
    accountRoleButtons.forEach((roleButton) => {
      const selected = roleButton.dataset.role === "visitor";
      roleButton.classList.toggle("active", selected);
      roleButton.setAttribute("aria-pressed", String(selected));
    });
    updateAuthDescription();
    openLogin();
    document.querySelector("#login-description").textContent = "Sign in or create a visitor account to view destination details.";
    loginMessage.textContent = "You can continue exploring culture and local products without signing in.";
  });
});

function setAuthenticated(user) {
  currentUser = user;
  isAuthenticated = Boolean(user);
  accountStatus.hidden = !user;
  accountStatus.textContent = user ? `Welcome, ${user.name}` : "";
  loginOpen.textContent = user && user.role === "seller"
    ? "Dashboard"
    : (isAuthenticated ? "Sign out" : "Login");
  loginOpen.setAttribute("aria-label", user && user.role === "seller"
    ? "Open seller dashboard"
    : (isAuthenticated ? "Sign out of your account" : "Log in to your account"));
}

loginOpen.addEventListener("click", async () => {
  if (currentUser && currentUser.role === "seller") {
    window.location.assign("seller-dashboard.php");
    return;
  }
  if (currentUser && currentUser.role === "visitor") {
    logoutMessage.textContent = "";
    logoutMessage.classList.remove("error");
    logoutModal.classList.add("open");
    document.body.classList.add("locked");
    logoutCancel.focus();
    return;
  }
  if (!isAuthenticated) {
    openLogin();
    return;
  }
});

function closeLogoutModal() {
  if (isLoggingOut) return;
  logoutModal.classList.remove("open");
  if (!loginModal.classList.contains("open") && !destinationDetailModal.classList.contains("open")) {
    document.body.classList.remove("locked");
  }
  loginOpen.focus();
}

logoutCancel.addEventListener("click", closeLogoutModal);
logoutModal.addEventListener("click", (event) => {
  if (event.target === logoutModal) closeLogoutModal();
});
logoutConfirm.addEventListener("click", async () => {
  isLoggingOut = true;
  logoutConfirm.disabled = true;
  logoutCancel.disabled = true;
  loginOpen.disabled = true;
  try {
    const response = await fetch("auth.php", {
      method: "POST",
      headers: { "Content-Type": "application/json", "Accept": "application/json" },
      body: JSON.stringify({ action: "logout" })
    });
    const result = await response.json();
    if (!response.ok) throw new Error(result.message || "Unable to sign out.");
    setAuthenticated(null);
    logoutModal.classList.remove("open");
    document.body.classList.remove("locked");
  } catch (error) {
    logoutMessage.textContent = error.message || "Unable to sign out. Please try again.";
    logoutMessage.classList.add("error");
  } finally {
    isLoggingOut = false;
    logoutConfirm.disabled = false;
    logoutCancel.disabled = false;
    loginOpen.disabled = false;
  }
});

loginClose.addEventListener("click", () => {
  pendingDestinationDetails = null;
  closeLogin();
});
loginModal.addEventListener("click", (event) => {
  if (event.target === loginModal) {
    pendingDestinationDetails = null;
    closeLogin();
  }
});
destinationDetailClose.addEventListener("click", closeDestinationDetails);
destinationDetailModal.addEventListener("click", (event) => {
  if (event.target === destinationDetailModal) closeDestinationDetails();
});

document.addEventListener("keydown", (event) => {
  if (event.key === "Escape") {
    if (loginModal.classList.contains("open")) {
      pendingDestinationDetails = null;
      closeLogin();
    }
    if (destinationDetailModal.classList.contains("open")) closeDestinationDetails();
    if (logoutModal.classList.contains("open")) closeLogoutModal();
    if (searchPanel.classList.contains("open")) {
      searchPanel.classList.remove("open");
      searchToggle.setAttribute("aria-expanded", "false");
      searchInput.value = "";
      filterSearch("");
    }
    navigation.classList.remove("open");
    menuToggle.setAttribute("aria-expanded", "false");
    menuToggle.setAttribute("aria-label", "Open navigation");
  }
});

async function checkSession() {
  try {
    const response = await fetch("auth.php", { headers: { "Accept": "application/json" } });
    const result = await response.json();
    if (!response.ok) throw new Error(result.message || "Unable to check your session.");
    setAuthenticated(result.user || null);
  } catch (error) {
    loginMessage.textContent = error.message || "Unable to check your sign-in status.";
    loginMessage.classList.add("error");
  }
}

checkSession();

loginForm.addEventListener("submit", async (event) => {
  event.preventDefault();
  loginMessage.classList.remove("error");
  loginSubmit.disabled = true;
  loginSubmit.textContent = isRegistering ? "Creating account..." : "Signing in...";

  const password = document.querySelector("#login-password").value;
  if (isRegistering && password !== registrationConfirm.value) {
    loginMessage.textContent = "Your passwords do not match.";
    loginMessage.classList.add("error");
    loginSubmit.disabled = false;
    loginSubmit.textContent = "Create account";
    registrationConfirm.focus();
    return;
  }

  try {
    const response = await fetch("auth.php", {
      method: "POST",
      headers: { "Content-Type": "application/json", "Accept": "application/json" },
      body: JSON.stringify({
        action: isRegistering ? "register" : "login",
        role: accountRole.value,
        name: registrationName.value,
        phone_number: registrationPhone.value,
        email: document.querySelector("#login-email").value,
        password,
        password_confirmation: registrationConfirm.value
      })
    });
    const result = await response.json();
    if (!response.ok) throw new Error(result.message || "Unable to sign in.");
    if (pendingDestinationDetails && result.user && result.user.role === "visitor") {
      const details = pendingDestinationDetails;
      pendingDestinationDetails = null;
      setAuthenticated(result.user);
      loginForm.reset();
      closeLogin();
      showDestinationDetails(details);
      return;
    }
    pendingDestinationDetails = null;
    if (result.user && result.user.role === "seller") {
      window.location.assign("seller-dashboard.php");
      return;
    }
    setAuthenticated(result.user || null);
    loginForm.reset();
    closeLogin();
  } catch (error) {
    loginMessage.textContent = error.message || "Something went wrong. Please try again.";
    loginMessage.classList.add("error");
  } finally {
    loginSubmit.disabled = false;
    loginSubmit.textContent = isRegistering ? "Create account" : "Continue";
  }
});
