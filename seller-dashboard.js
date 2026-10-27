const sellerError = document.querySelector("#seller-error");
const productForm = document.querySelector("#seller-product-form");
const productList = document.querySelector("#seller-product-list");
const sellerMenuToggle = document.querySelector("#seller-menu-toggle");
const sellerNavigation = document.querySelector("#seller-navigation");
const productPublishModal = document.querySelector("#product-publish-modal");
const productPublishCancel = document.querySelector("#product-publish-cancel");
const productPublishConfirm = document.querySelector("#product-publish-confirm");
const productPublishMessage = document.querySelector("#product-publish-message");
let products = [];
let pendingProductValues = null;
let isSavingProduct = false;

sellerMenuToggle.addEventListener("click", () => {
  const expanded = sellerMenuToggle.getAttribute("aria-expanded") === "true";
  sellerMenuToggle.setAttribute("aria-expanded", String(!expanded));
  sellerMenuToggle.setAttribute("aria-label", expanded ? "Open navigation" : "Close navigation");
  sellerNavigation.classList.toggle("open", !expanded);
});

sellerNavigation.addEventListener("click", (event) => {
  if (!event.target.closest("a")) return;
  sellerNavigation.classList.remove("open");
  sellerMenuToggle.setAttribute("aria-expanded", "false");
  sellerMenuToggle.setAttribute("aria-label", "Open navigation");
});

async function sellerRequest(action, values = {}, method = "POST") {
  const response = await fetch("seller.php", {
    method,
    headers: { "Accept": "application/json", ...(method === "POST" ? { "Content-Type": "application/json" } : {}) },
    ...(method === "POST" ? { body: JSON.stringify({ action, ...values }) } : {})
  });
  const result = await response.json();
  if (!response.ok) throw new Error(result.message || "The seller service could not complete your request.");
  return result;
}

function setMessage(selector, message, isError = false) {
  const element = document.querySelector(selector);
  element.textContent = message;
  element.classList.toggle("error", isError);
}

function renderProducts() {
  productList.replaceChildren();
  document.querySelector("#seller-products-empty").hidden = products.length > 0;
  document.querySelector("#summary-total").textContent = String(products.length);
  document.querySelector("#summary-published").textContent = String(products.filter((item) => item.status === "published").length);
  document.querySelector("#summary-drafts").textContent = String(products.filter((item) => item.status === "draft").length);

  products.forEach((product) => {
    const card = document.createElement("article");
    card.className = "seller-product-card";
    if (typeof product.image_path === "string" && product.image_path.trim()) {
      const imagePath = product.image_path.trim();
      const isWebImage = /^https?:\/\//i.test(imagePath);
      const isLocalImage = imagePath.startsWith("/") && !imagePath.startsWith("//") ||
        /^[A-Za-z0-9_.-]/.test(imagePath) && !imagePath.includes(":") && !imagePath.includes("\\");
      if (isWebImage || isLocalImage) {
        const image = document.createElement("img");
        image.className = "seller-product-image";
        image.src = imagePath;
        image.alt = product.product_name;
        image.loading = "lazy";
        image.addEventListener("error", () => image.remove(), { once: true });
        card.append(image);
      }
    }
    const detail = document.createElement("div");
    detail.className = "seller-product-detail";
    const title = document.createElement("h3");
    title.textContent = product.product_name;
    detail.append(title);
    const status = document.createElement("span");
    status.className = `seller-status seller-status-${product.status}`;
    status.textContent = product.status;
    detail.append(status);
    const description = document.createElement("p");
    description.textContent = product.description;
    detail.append(description);
    if (product.price !== null) {
      const price = document.createElement("p");
      price.className = "product-price";
      price.textContent = `₱${Number(product.price).toLocaleString("en-PH", { minimumFractionDigits: 2 })}`;
      detail.append(price);
    }
    if (product.inquiry_information) {
      const inquiry = document.createElement("p");
      inquiry.textContent = `Inquiries: ${product.inquiry_information}`;
      detail.append(inquiry);
    }
    const actions = document.createElement("div");
    actions.className = "seller-product-actions";
    const edit = document.createElement("button");
    edit.className = "inline-button";
    edit.type = "button";
    edit.textContent = "Edit";
    edit.addEventListener("click", () => editProduct(product));
    actions.append(edit);
    if (product.status === "published") {
      const publicLink = document.createElement("a");
      publicLink.className = "inline-button";
      publicLink.href = `index.php?product_id=${encodeURIComponent(product.product_id)}#culture-product-${encodeURIComponent(product.product_id)}`;
      publicLink.target = "_blank";
      publicLink.rel = "noopener noreferrer";
      publicLink.textContent = "View on website";
      actions.append(publicLink);
    }
    const remove = document.createElement("button");
    remove.className = "seller-delete-button";
    remove.type = "button";
    remove.textContent = "Delete";
    remove.addEventListener("click", async () => {
      if (!window.confirm(`Delete "${product.product_name}"? This cannot be undone.`)) return;
      remove.disabled = true;
      try {
        const result = await sellerRequest("delete_product", { product_id: product.product_id });
        await loadSeller();
        setMessage("#seller-product-message", result.message);
      } catch (error) {
        setMessage("#seller-product-message", error.message, true);
        remove.disabled = false;
      }
    });
    actions.append(remove);
    card.append(detail, actions);
    productList.append(card);
  });
}

function editProduct(product) {
  document.querySelector("#seller-product-id").value = product.product_id;
  document.querySelector("#product-name").value = product.product_name;
  document.querySelector("#product-description").value = product.description;
  document.querySelector("#product-price").value = product.price ?? "";
  document.querySelector("#product-image").value = product.image_path ?? "";
  document.querySelector("#product-inquiry").value = product.inquiry_information;
  document.querySelector("#product-status").value = product.status;
  document.querySelector("#seller-product-form-title").textContent = "Edit product";
  document.querySelector("#seller-product-submit").textContent = "Save changes";
  document.querySelector("#seller-product-cancel").hidden = false;
  document.querySelector("#seller-products").scrollIntoView({ behavior: "smooth" });
}

function resetProductForm() {
  productForm.reset();
  document.querySelector("#seller-product-id").value = "";
  document.querySelector("#seller-product-form-title").textContent = "Add a product";
  document.querySelector("#seller-product-submit").textContent = "Add product";
  document.querySelector("#seller-product-cancel").hidden = true;
}

async function loadSeller() {
  const result = await sellerRequest("", {}, "GET");
  products = result.products;
  renderProducts();
  document.querySelector("#seller-phone").value = result.user.phone_number || "";
  document.querySelector("#seller-facebook").value = result.user.facebook_url || "";
  document.querySelector("#seller-name").value = result.user.name;
  document.querySelector("#seller-email").value = result.user.email;
  sellerError.hidden = true;
}

async function saveProduct(values) {
  const submit = document.querySelector("#seller-product-submit");
  submit.disabled = true;
  try {
    const result = await sellerRequest("save_product", values);
    resetProductForm();
    await loadSeller();
    setMessage("#seller-product-message", result.message);
  } catch (error) {
    setMessage("#seller-product-message", error.message, true);
    throw error;
  } finally {
    submit.disabled = false;
  }
}

function closeProductPublishModal() {
  if (isSavingProduct) return;
  productPublishModal.classList.remove("open");
  document.body.classList.remove("locked");
  document.querySelector("#seller-product-submit").focus();
}

productForm.addEventListener("submit", async (event) => {
  event.preventDefault();
  const values = Object.fromEntries(new FormData(productForm).entries());
  if (values.status === "published") {
    pendingProductValues = values;
    productPublishMessage.textContent = "";
    productPublishMessage.classList.remove("error");
    productPublishModal.classList.add("open");
    document.body.classList.add("locked");
    productPublishCancel.focus();
    return;
  }

  try {
    await saveProduct(values);
  } catch {
    // saveProduct displays the error beside the product form.
  }
});

productPublishCancel.addEventListener("click", () => {
  pendingProductValues = null;
  closeProductPublishModal();
});
productPublishModal.addEventListener("click", (event) => {
  if (event.target === productPublishModal) {
    pendingProductValues = null;
    closeProductPublishModal();
  }
});
document.addEventListener("keydown", (event) => {
  if (event.key === "Escape" && productPublishModal.classList.contains("open")) {
    pendingProductValues = null;
    closeProductPublishModal();
  }
});
productPublishConfirm.addEventListener("click", async () => {
  if (!pendingProductValues) return;
  isSavingProduct = true;
  productPublishCancel.disabled = true;
  productPublishConfirm.disabled = true;
  try {
    await saveProduct(pendingProductValues);
    pendingProductValues = null;
    productPublishModal.classList.remove("open");
    document.body.classList.remove("locked");
  } catch (error) {
    productPublishMessage.textContent = error.message || "Unable to publish this product. Please try again.";
    productPublishMessage.classList.add("error");
  } finally {
    isSavingProduct = false;
    productPublishCancel.disabled = false;
    productPublishConfirm.disabled = false;
  }
});

document.querySelector("#seller-product-cancel").addEventListener("click", resetProductForm);

document.querySelector("#seller-contact-form").addEventListener("submit", async (event) => {
  event.preventDefault();
  const form = event.currentTarget;
  const button = form.querySelector("button[type=submit]");
  button.disabled = true;
  try {
    const result = await sellerRequest("update_contact", Object.fromEntries(new FormData(form).entries()));
    setMessage("#seller-contact-message", result.message);
  } catch (error) {
    setMessage("#seller-contact-message", error.message, true);
  } finally {
    button.disabled = false;
  }
});

document.querySelector("#seller-profile-form").addEventListener("submit", async (event) => {
  event.preventDefault();
  const form = event.currentTarget;
  const button = form.querySelector("button[type=submit]");
  button.disabled = true;
  try {
    const result = await sellerRequest("update_profile", Object.fromEntries(new FormData(form).entries()));
    setMessage("#seller-profile-message", result.message);
    document.querySelector("#seller-welcome").textContent = `Welcome, ${result.user.name}!`;
    document.querySelector("#seller-current-password").value = "";
    document.querySelector("#seller-new-password").value = "";
    document.querySelector("#seller-confirm-password").value = "";
  } catch (error) {
    setMessage("#seller-profile-message", error.message, true);
  } finally {
    button.disabled = false;
  }
});

const logoutButton = document.querySelector("#seller-logout");
const logoutModal = document.querySelector("#logout-modal");
const logoutCancel = document.querySelector("#logout-cancel");
const logoutConfirm = document.querySelector("#logout-confirm");
const logoutMessage = document.querySelector("#logout-message");
let isLoggingOut = false;

function closeLogoutModal() {
  if (isLoggingOut) return;
  logoutModal.classList.remove("open");
  logoutButton.focus();
}

logoutButton.addEventListener("click", () => {
  logoutMessage.textContent = "";
  logoutMessage.classList.remove("error");
  logoutModal.classList.add("open");
  logoutCancel.focus();
});

logoutCancel.addEventListener("click", closeLogoutModal);
logoutModal.addEventListener("click", (event) => {
  if (event.target === logoutModal) closeLogoutModal();
});
document.addEventListener("keydown", (event) => {
  if (event.key === "Escape" && logoutModal.classList.contains("open")) closeLogoutModal();
});

logoutConfirm.addEventListener("click", async () => {
  isLoggingOut = true;
  logoutButton.disabled = true;
  logoutCancel.disabled = true;
  logoutConfirm.disabled = true;
  try {
    const response = await fetch("auth.php", {
      method: "POST",
      headers: { "Content-Type": "application/json", "Accept": "application/json" },
      body: JSON.stringify({ action: "logout" })
    });
    const result = await response.json();
    if (!response.ok) throw new Error(result.message || "Unable to sign out.");
    window.location.assign("index.php");
  } catch (error) {
    logoutMessage.textContent = error.message || "Unable to sign out. Please try again.";
    logoutMessage.classList.add("error");
    isLoggingOut = false;
    logoutButton.disabled = false;
    logoutCancel.disabled = false;
    logoutConfirm.disabled = false;
  }
});

loadSeller().catch((error) => {
  sellerError.hidden = false;
  sellerError.textContent = error.message;
});
