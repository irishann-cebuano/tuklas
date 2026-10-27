<?php
declare(strict_types=1);

header("Content-Type: application/json; charset=utf-8");

function sellerRespond(int $status, array $body): void
{
    http_response_code($status);
    echo json_encode($body);
    exit;
}

require __DIR__ . "/session.php";
$seller = $_SESSION["auth_user"] ?? null;
if (!is_array($seller) || empty($seller["id"])) {
    sellerRespond(401, ["message" => "Sign in with a seller account to continue."]);
}

try {
    require __DIR__ . "/database.php";
    $roleQuery = $pdo->prepare("SELECT role FROM users WHERE user_id = :user_id");
    $roleQuery->execute(["user_id" => $seller["id"]]);
    if ($roleQuery->fetchColumn() !== "seller") {
        sellerRespond(403, ["message" => "This feature is available to seller accounts."]);
    }

    if (($_SERVER["REQUEST_METHOD"] ?? "") === "GET") {
        $userQuery = $pdo->prepare(
            "SELECT full_name AS name, email, phone_number, facebook_url
             FROM users WHERE user_id = :user_id"
        );
        $userQuery->execute(["user_id" => $seller["id"]]);
        $user = $userQuery->fetch();
        if (!$user) {
            sellerRespond(401, ["message" => "Your seller account is no longer available."]);
        }
        $productQuery = $pdo->prepare(
            "SELECT product_id, product_name, description, price, image_path, inquiry_information, status
             FROM products WHERE seller_id = :seller_id ORDER BY updated_at DESC, product_id DESC"
        );
        $productQuery->execute(["seller_id" => $seller["id"]]);
        $products = $productQuery->fetchAll();
        $summary = ["total" => count($products), "published" => 0, "drafts" => 0, "archived" => 0];
        foreach ($products as $product) {
            if ($product["status"] === "published") {
                $summary["published"]++;
            } elseif ($product["status"] === "draft") {
                $summary["drafts"]++;
            } elseif ($product["status"] === "archived") {
                $summary["archived"]++;
            }
        }
        sellerRespond(200, ["user" => $user, "products" => $products, "summary" => $summary]);
    }

    if (($_SERVER["REQUEST_METHOD"] ?? "") !== "POST") {
        header("Allow: GET, POST");
        sellerRespond(405, ["message" => "This request method is not supported."]);
    }

    $input = json_decode(file_get_contents("php://input"), true);
    if (!is_array($input)) {
        sellerRespond(400, ["message" => "Invalid request. Please try again."]);
    }
    $action = $input["action"] ?? "";

    if ($action === "save_product") {
        $productId = filter_var($input["product_id"] ?? null, FILTER_VALIDATE_INT);
        $name = trim((string)($input["product_name"] ?? ""));
        $description = trim((string)($input["description"] ?? ""));
        $priceInput = trim((string)($input["price"] ?? ""));
        $imagePath = trim((string)($input["image_path"] ?? ""));
        $inquiry = trim((string)($input["inquiry_information"] ?? ""));
        $status = (string)($input["status"] ?? "draft");
        if ($name === "" || strlen($name) > 200 || $description === "" || strlen($description) > 5000 ||
            $inquiry === "" || strlen($inquiry) > 2000 || !in_array($status, ["draft", "published", "archived"], true)) {
            sellerRespond(422, ["message" => "Enter a product name, description, inquiry details, and a valid status."]);
        }
        if ($imagePath !== "" && (strlen($imagePath) > 255 || str_contains($imagePath, "\\") ||
            (!preg_match("~^https?://~i", $imagePath) && !preg_match("~^(?:/|[A-Za-z0-9_.-])~", $imagePath)))) {
            sellerRespond(422, ["message" => "Enter a valid image URL or project-relative path."]);
        }
        if ($priceInput !== "" && (!is_numeric($priceInput) || (float)$priceInput < 0 || (float)$priceInput > 99999999.99)) {
            sellerRespond(422, ["message" => "Enter a valid non-negative price."]);
        }
        $price = $priceInput === "" ? null : number_format((float)$priceInput, 2, ".", "");
        if ($productId) {
            $statement = $pdo->prepare(
                "UPDATE products
                 SET product_name = :name, description = :description, price = :price,
                     image_path = :image_path, inquiry_information = :inquiry, status = :status
                 WHERE product_id = :product_id AND seller_id = :seller_id"
            );
            $statement->execute([
                "name" => $name, "description" => $description, "price" => $price,
                "image_path" => $imagePath === "" ? null : $imagePath, "inquiry" => $inquiry,
                "status" => $status, "product_id" => $productId, "seller_id" => $seller["id"],
            ]);
            if ($statement->rowCount() === 0) {
                $exists = $pdo->prepare("SELECT 1 FROM products WHERE product_id = :id AND seller_id = :seller_id");
                $exists->execute(["id" => $productId, "seller_id" => $seller["id"]]);
                if (!$exists->fetchColumn()) {
                    sellerRespond(404, ["message" => "That product was not found in your account."]);
                }
            }
            sellerRespond(200, ["message" => "Product updated."]);
        }
        $statement = $pdo->prepare(
            "INSERT INTO products (seller_id, product_name, description, price, image_path, inquiry_information, status)
             VALUES (:seller_id, :name, :description, :price, :image_path, :inquiry, :status)"
        );
        $statement->execute([
            "seller_id" => $seller["id"], "name" => $name, "description" => $description, "price" => $price,
            "image_path" => $imagePath === "" ? null : $imagePath, "inquiry" => $inquiry, "status" => $status,
        ]);
        sellerRespond(201, ["message" => "Product added."]);
    }

    if ($action === "delete_product") {
        $productId = filter_var($input["product_id"] ?? null, FILTER_VALIDATE_INT);
        if (!$productId) {
            sellerRespond(422, ["message" => "Choose a valid product to delete."]);
        }
        $statement = $pdo->prepare("DELETE FROM products WHERE product_id = :product_id AND seller_id = :seller_id");
        $statement->execute(["product_id" => $productId, "seller_id" => $seller["id"]]);
        if ($statement->rowCount() !== 1) {
            sellerRespond(404, ["message" => "That product was not found in your account."]);
        }
        sellerRespond(200, ["message" => "Product deleted."]);
    }

    if ($action === "update_contact") {
        $phone = trim((string)($input["phone_number"] ?? ""));
        $facebook = trim((string)($input["facebook_url"] ?? ""));
        if (strlen($phone) > 30 || ($phone !== "" && !preg_match("/^[+0-9().\\s-]+$/", $phone))) {
            sellerRespond(422, ["message" => "Enter a valid phone number up to 30 characters."]);
        }
        if (strlen($facebook) > 255) {
            sellerRespond(422, ["message" => "Facebook links must be 255 characters or fewer."]);
        }
        if ($facebook !== "") {
            $parts = parse_url($facebook);
            $host = strtolower((string)($parts["host"] ?? ""));
            if (!filter_var($facebook, FILTER_VALIDATE_URL) || ($parts["scheme"] ?? "") !== "https" ||
                !preg_match("/(^|\\.)(facebook\\.com|fb\\.com|m\\.me)$/", $host)) {
                sellerRespond(422, ["message" => "Enter a valid HTTPS Facebook page or profile link."]);
            }
        }
        $statement = $pdo->prepare(
            "UPDATE users SET phone_number = :phone, facebook_url = :facebook WHERE user_id = :user_id"
        );
        $statement->execute([
            "phone" => $phone === "" ? null : $phone,
            "facebook" => $facebook === "" ? null : $facebook,
            "user_id" => $seller["id"],
        ]);
        sellerRespond(200, ["message" => "Contact information saved."]);
    }

    if ($action === "update_profile") {
        $name = trim((string)($input["name"] ?? ""));
        $email = strtolower(trim((string)($input["email"] ?? "")));
        if ($name === "" || strlen($name) > 150) {
            sellerRespond(422, ["message" => "Enter your name (up to 150 characters)."]);
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) > 150) {
            sellerRespond(422, ["message" => "Enter a valid email address."]);
        }
        $currentPassword = (string)($input["current_password"] ?? "");
        $newPassword = (string)($input["new_password"] ?? "");
        $confirmation = (string)($input["password_confirmation"] ?? "");
        $changingPassword = $currentPassword !== "" || $newPassword !== "" || $confirmation !== "";
        if ($changingPassword) {
            if ($currentPassword === "" || strlen($newPassword) < 6 || strlen($newPassword) > 4096) {
                sellerRespond(422, ["message" => "Enter your current password and a new password of at least 6 characters."]);
            }
            if (!hash_equals($newPassword, $confirmation)) {
                sellerRespond(422, ["message" => "Your new passwords do not match."]);
            }
            $passwordQuery = $pdo->prepare("SELECT password_hash FROM users WHERE user_id = :user_id");
            $passwordQuery->execute(["user_id" => $seller["id"]]);
            $passwordHash = $passwordQuery->fetchColumn();
            if (!$passwordHash || !password_verify($currentPassword, $passwordHash)) {
                sellerRespond(422, ["message" => "Your current password is incorrect."]);
            }
            $statement = $pdo->prepare(
                "UPDATE users SET full_name = :name, email = :email, password_hash = :password_hash WHERE user_id = :user_id"
            );
            $parameters = [
                "name" => $name, "email" => $email,
                "password_hash" => password_hash($newPassword, PASSWORD_DEFAULT), "user_id" => $seller["id"],
            ];
        } else {
            $statement = $pdo->prepare("UPDATE users SET full_name = :name, email = :email WHERE user_id = :user_id");
            $parameters = ["name" => $name, "email" => $email, "user_id" => $seller["id"]];
        }
        $statement->execute($parameters);
        session_regenerate_id(true);
        $_SESSION["auth_user"]["name"] = $name;
        $_SESSION["auth_user"]["email"] = $email;
        sellerRespond(200, ["user" => $_SESSION["auth_user"], "message" => "Profile updated."]);
    }

    sellerRespond(400, ["message" => "Choose a valid seller action."]);
} catch (PDOException $exception) {
    if ($exception->getCode() === "23000") {
        sellerRespond(409, ["message" => "That email address is already in use."]);
    }
    error_log("Seller dashboard database error: " . $exception->getMessage());
    sellerRespond(503, ["message" => "The seller service is temporarily unavailable."]);
}
