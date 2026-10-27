<?php
declare(strict_types=1);

header("Content-Type: application/json; charset=utf-8");
require __DIR__ . "/session.php";

function visitorRespond(int $status, array $body): void
{
    http_response_code($status);
    echo json_encode($body);
    exit;
}

$method = $_SERVER["REQUEST_METHOD"] ?? "";
if ($method === "GET") {
    try {
        require __DIR__ . "/database.php";

        $destinations = $pdo->query(
            "SELECT d.destination_id, d.destination_name, d.description, d.address, d.latitude, d.longitude,
                    c.category_name,
                    image.image_path,
                    rating.average_rating, rating.rating_count
             FROM destinations d
             LEFT JOIN categories c ON c.category_id = d.category_id
             LEFT JOIN (
                 SELECT destination_id, MIN(image_id) AS image_id
                 FROM destination_images
                 GROUP BY destination_id
             ) first_image ON first_image.destination_id = d.destination_id
             LEFT JOIN destination_images image ON image.image_id = first_image.image_id
             LEFT JOIN (
                 SELECT destination_id, ROUND(AVG(rating), 1) AS average_rating, COUNT(*) AS rating_count
                 FROM ratings_feedback
                 GROUP BY destination_id
             ) rating ON rating.destination_id = d.destination_id
             WHERE d.status = 'published'
             ORDER BY d.is_featured DESC, d.destination_name"
        )->fetchAll();

        $culture = $pdo->query(
            "SELECT profile.culture_id, profile.title, profile.community_name, profile.description, image.image_path
             FROM cultural_profiles profile
             LEFT JOIN (
                 SELECT culture_id, MIN(image_id) AS image_id
                 FROM cultural_images
                 GROUP BY culture_id
             ) first_image ON first_image.culture_id = profile.culture_id
             LEFT JOIN cultural_images image ON image.image_id = first_image.image_id
             ORDER BY profile.title"
        )->fetchAll();

        $events = $pdo->query(
            "SELECT events.event_id, events.event_name, events.description, events.event_date, events.venue,
                    COALESCE(events.poster_path, event_image.image_path) AS image_path, events.status
             FROM events
             LEFT JOIN (
                 SELECT event_id, MIN(image_id) AS image_id
                 FROM event_images
                 GROUP BY event_id
             ) first_image ON first_image.event_id = events.event_id
             LEFT JOIN event_images event_image ON event_image.image_id = first_image.image_id
             WHERE events.status = 'upcoming'
             ORDER BY events.event_date, events.event_name"
        )->fetchAll();

        $products = $pdo->query(
            "SELECT products.product_id, products.product_name, products.description, products.price,
                    products.image_path, products.inquiry_information, users.full_name AS seller_name,
                    users.phone_number AS seller_phone, users.facebook_url AS seller_facebook
             FROM products
             INNER JOIN users ON users.user_id = products.seller_id
             WHERE products.status = 'published'
             ORDER BY products.product_name"
        )->fetchAll();

        $announcements = $pdo->query(
            "SELECT title, content, COALESCE(published_at, created_at) AS published_at
             FROM announcements
             WHERE status = 'published'
             ORDER BY COALESCE(published_at, created_at) DESC"
        )->fetchAll();

        visitorRespond(200, [
            "destinations" => $destinations,
            "culture" => $culture,
            "events" => $events,
            "products" => $products,
            "announcements" => $announcements,
        ]);
    } catch (PDOException $exception) {
        error_log("Visitor content database error: " . $exception->getMessage());
        visitorRespond(503, ["message" => "Visitor information is temporarily unavailable."]);
    }
}

if ($method !== "POST") {
    header("Allow: GET, POST");
    visitorRespond(405, ["message" => "This request method is not supported."]);
}

$visitor = $_SESSION["auth_user"] ?? null;
if (!is_array($visitor) || empty($visitor["id"])) {
    visitorRespond(401, ["message" => "Sign in with a visitor account to continue."]);
}

$input = json_decode(file_get_contents("php://input"), true);
if (!is_array($input)) {
    visitorRespond(400, ["message" => "Invalid request. Please try again."]);
}

try {
    require __DIR__ . "/database.php";
    $roleQuery = $pdo->prepare("SELECT role FROM users WHERE user_id = :user_id");
    $roleQuery->execute(["user_id" => $visitor["id"]]);
    if ($roleQuery->fetchColumn() !== "visitor") {
        visitorRespond(403, ["message" => "This feature is available to visitor accounts."]);
    }

    $action = $input["action"] ?? "";
    if ($action === "feedback") {
        $destinationId = filter_var($input["destination_id"] ?? null, FILTER_VALIDATE_INT);
        $rating = filter_var($input["rating"] ?? null, FILTER_VALIDATE_INT);
        $feedback = trim((string)($input["feedback"] ?? ""));
        if (!$destinationId || !$rating || $rating < 1 || $rating > 5 || strlen($feedback) > 2000) {
            visitorRespond(422, ["message" => "Choose a destination, a 1–5 star rating, and a comment up to 2,000 characters."]);
        }

        $statement = $pdo->prepare(
            "INSERT INTO ratings_feedback (visitor_id, destination_id, rating, feedback)
             SELECT :visitor_id, destination_id, :rating, :feedback
             FROM destinations
             WHERE destination_id = :destination_id AND status = 'published'"
        );
        $statement->execute([
            "visitor_id" => $visitor["id"],
            "rating" => $rating,
            "feedback" => $feedback === "" ? null : $feedback,
            "destination_id" => $destinationId,
        ]);
        if ($statement->rowCount() !== 1) {
            visitorRespond(404, ["message" => "That destination is not available for feedback."]);
        }
        visitorRespond(201, ["message" => "Thank you for sharing your feedback."]);
    }

    if ($action === "update_account") {
        $name = trim((string)($input["name"] ?? ""));
        $email = strtolower(trim((string)($input["email"] ?? "")));
        if ($name === "" || strlen($name) > 150) {
            visitorRespond(422, ["message" => "Enter your name (up to 150 characters)."]);
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) > 150) {
            visitorRespond(422, ["message" => "Enter a valid email address."]);
        }

        $currentPassword = (string)($input["current_password"] ?? "");
        $newPassword = (string)($input["new_password"] ?? "");
        $confirmation = (string)($input["password_confirmation"] ?? "");
        $changingPassword = $currentPassword !== "" || $newPassword !== "" || $confirmation !== "";
        $parameters = ["name" => $name, "email" => $email, "user_id" => $visitor["id"]];

        if ($changingPassword) {
            if ($currentPassword === "" || strlen($newPassword) < 6 || strlen($newPassword) > 4096) {
                visitorRespond(422, ["message" => "Enter your current password and a new password of at least 6 characters."]);
            }
            if (!hash_equals($newPassword, $confirmation)) {
                visitorRespond(422, ["message" => "Your new passwords do not match."]);
            }
            $passwordQuery = $pdo->prepare("SELECT password_hash FROM users WHERE user_id = :user_id");
            $passwordQuery->execute(["user_id" => $visitor["id"]]);
            $passwordHash = $passwordQuery->fetchColumn();
            if (!$passwordHash || !password_verify($currentPassword, $passwordHash)) {
                visitorRespond(422, ["message" => "Your current password is incorrect."]);
            }
            $statement = $pdo->prepare(
                "UPDATE users SET full_name = :name, email = :email, password_hash = :password_hash WHERE user_id = :user_id"
            );
            $parameters["password_hash"] = password_hash($newPassword, PASSWORD_DEFAULT);
        } else {
            $statement = $pdo->prepare(
                "UPDATE users SET full_name = :name, email = :email WHERE user_id = :user_id"
            );
        }

        $statement->execute($parameters);
        session_regenerate_id(true);
        $_SESSION["auth_user"]["name"] = $name;
        $_SESSION["auth_user"]["email"] = $email;
        visitorRespond(200, ["user" => $_SESSION["auth_user"], "message" => "Your account settings have been saved."]);
    }

    visitorRespond(400, ["message" => "Choose a valid visitor action."]);
} catch (PDOException $exception) {
    if ($exception->getCode() === "23000") {
        visitorRespond(409, ["message" => "That email address is already in use."]);
    }
    error_log("Visitor account database error: " . $exception->getMessage());
    visitorRespond(503, ["message" => "The visitor service is temporarily unavailable."]);
}
