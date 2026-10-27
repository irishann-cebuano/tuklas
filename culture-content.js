let isLoadingCultureContent = false;

function makeImage(path, alt) {
  if (typeof path !== "string" || !path.trim() || path.startsWith("//")) return null;
  if (!/^https?:\/\//i.test(path) &&
      !(path.startsWith("/") && !path.startsWith("//")) &&
      !(/^[A-Za-z0-9_.-]/.test(path) && !path.includes(":") && !path.includes("\\"))) return null;

  const image = document.createElement("img");
  image.src = path;
  image.alt = alt || "";
  image.className = "destination-photo";
  image.loading = "lazy";
  image.addEventListener("error", () => image.remove(), { once: true });
  return image;
}

function makeCard(titleText, imagePath, descriptionText, details = []) {
  const card = document.createElement("article");
  card.className = "destination-card";
  const image = makeImage(imagePath, titleText);
  if (image) card.append(image);

  const body = document.createElement("div");
  body.className = "card-body";
  const title = document.createElement("h3");
  title.className = "card-title";
  title.textContent = titleText;
  body.append(title);

  const description = document.createElement("p");
  description.className = "card-description";
  description.textContent = descriptionText || "";
  body.append(description);
  details.forEach((detail) => body.append(detail));
  card.append(body);
  return card;
}

function makeCultureCard(item) {
  const details = [];
  if (item.community_name) {
    const community = document.createElement("p");
    community.className = "card-location";
    community.textContent = item.community_name;
    details.push(community);
  }
  const card = makeCard(
    item.title,
    item.image_path || "assets/indigenous.jpg",
    item.description,
    details
  );
  const body = card.querySelector(".card-body");
  const description = card.querySelector(".card-description");
  description.classList.add("culture-card-description");

  const tag = document.createElement("span");
  tag.className = "tag cultural";
  tag.textContent = "Indigenous Culture";
  body.insertBefore(tag, description);

  const detailsButton = document.createElement("button");
  detailsButton.className = "destination-details-button";
  detailsButton.classList.add("culture-details-toggle");
  detailsButton.type = "button";
  detailsButton.textContent = "Read More";
  detailsButton.setAttribute("aria-expanded", "false");
  body.append(detailsButton);
  return card;
}

function makeProductCard(item) {
  const card = makeCard(item.product_name, item.image_path, "");
  card.id = `culture-product-${item.product_id}`;
  card.classList.add("culture-product-card");
  const body = card.querySelector(".card-body");
  const description = card.querySelector(".card-description");
  description.classList.add("product-card-description");
  description.textContent = item.description || "";

  if (item.price !== null && item.price !== undefined) {
    const price = document.createElement("p");
    price.className = "product-price";
    price.textContent = `₱${Number(item.price).toLocaleString("en-PH", { minimumFractionDigits: 2 })}`;
    body.append(price);
  }

  if (item.seller_name) {
    const seller = document.createElement("p");
    seller.className = "product-inquiry";
    seller.textContent = `Seller: ${item.seller_name}`;
    body.append(seller);
  }

  const productDetails = document.createElement("div");
  productDetails.className = "product-card-details";
  productDetails.hidden = true;

  const inquiry = document.createElement("p");
  inquiry.className = "product-inquiry";
  inquiry.textContent = `Inquiries: ${item.inquiry_information || "Contact the seller for details."}`;
  productDetails.append(inquiry);

  const contactLinks = document.createElement("div");
  contactLinks.className = "card-actions";
  if (item.seller_phone) {
    const phone = document.createElement("a");
    phone.className = "event-action";
    phone.href = `tel:${item.seller_phone}`;
    phone.textContent = `Call ${item.seller_phone}`;
    contactLinks.append(phone);
  }
  if (typeof item.seller_facebook === "string" && /^https?:\/\//i.test(item.seller_facebook)) {
    const facebook = document.createElement("a");
    facebook.className = "event-action";
    facebook.href = item.seller_facebook;
    facebook.target = "_blank";
    facebook.rel = "noopener noreferrer";
    facebook.textContent = "Message seller on Facebook";
    contactLinks.append(facebook);
  }
  if (contactLinks.childElementCount > 0) productDetails.append(contactLinks);

  body.append(productDetails);
  const detailsButton = document.createElement("button");
  detailsButton.className = "destination-details-button";
  detailsButton.type = "button";
  detailsButton.textContent = "View Details";
  detailsButton.setAttribute("aria-expanded", "false");
  detailsButton.addEventListener("click", () => {
    const expanded = detailsButton.getAttribute("aria-expanded") === "true";
    detailsButton.setAttribute("aria-expanded", String(!expanded));
    detailsButton.textContent = expanded ? "View Details" : "Show Less";
    productDetails.hidden = expanded;
    description.classList.toggle("expanded", !expanded);
  });
  body.append(detailsButton);
  return card;
}

function renderCards(containerId, emptyId, items, makeCard, emptyMessage) {
  const container = document.querySelector(containerId);
  container.replaceChildren(...items.map(makeCard));
  const empty = document.querySelector(emptyId);
  empty.textContent = emptyMessage;
  empty.classList.toggle("visible", items.length === 0);
}

const cultureStoryGrid = document.querySelector("#culture-story-grid");
const starterCultureCards = Array.from(cultureStoryGrid.children, (card) => card.cloneNode(true));
let hasPublishedCultureCards = false;

cultureStoryGrid.addEventListener("click", (event) => {
  const button = event.target.closest(".culture-details-toggle");
  if (!button) return;

  const description = button.closest(".destination-card").querySelector(".culture-card-description");
  const expanded = button.getAttribute("aria-expanded") === "true";
  button.setAttribute("aria-expanded", String(!expanded));
  button.textContent = expanded ? "Read More" : "Read Less";
  description.classList.toggle("expanded", !expanded);
});

async function loadCultureContent() {
  if (isLoadingCultureContent) return;
  isLoadingCultureContent = true;
  try {
    const response = await fetch("visitor.php", { headers: { Accept: "application/json" } });
    const data = await response.json();
    if (!response.ok) throw new Error(data.message || "Unable to load culture and products.");

    document.querySelector("#culture-content-error").hidden = true;
    const culture = Array.isArray(data.culture) ? data.culture : [];
    if (culture.length > 0) {
      renderCards(
        "#culture-story-grid",
        "#culture-story-empty",
        culture,
        makeCultureCard,
        "Cultural stories and photographs will appear here when published."
      );
      hasPublishedCultureCards = true;
    } else {
      if (hasPublishedCultureCards) {
        cultureStoryGrid.replaceChildren(...starterCultureCards.map((card) => card.cloneNode(true)));
        hasPublishedCultureCards = false;
      }
      document.querySelector("#culture-story-empty").classList.remove("visible");
    }
    renderCards(
      "#culture-product-grid",
      "#culture-product-empty",
      Array.isArray(data.products) ? data.products : [],
      makeProductCard,
      "Published local products will appear here when sellers add them."
    );
    if (/^#culture-product-\d+$/.test(window.location.hash)) {
      document.getElementById(window.location.hash.slice(1))?.scrollIntoView({
        behavior: "smooth",
        block: "center"
      });
    }
  } catch (error) {
    const message = document.querySelector("#culture-content-error");
    message.textContent = error.message || "Culture and product information could not be loaded.";
    message.hidden = false;
    document.querySelector("#culture-story-empty").classList.remove("visible");
    document.querySelector("#culture-product-empty").textContent = "Local products could not be loaded.";
    document.querySelector("#culture-product-empty").classList.add("visible");
  } finally {
    isLoadingCultureContent = false;
  }
}

loadCultureContent();
window.addEventListener("focus", loadCultureContent);
document.addEventListener("visibilitychange", () => {
  if (document.visibilityState === "visible") loadCultureContent();
});
window.setInterval(() => {
  if (document.visibilityState === "visible") loadCultureContent();
}, 30000);
