<?php
declare(strict_types=1);

header("Content-Type: application/json; charset=utf-8");

function respond(int $status, array $body): void
{
    http_response_code($status);
    echo json_encode($body);
    exit;
}

require __DIR__ . "/session.php";

$method = $_SERVER["REQUEST_METHOD"] ?? "";
if ($method === "GET") {
    respond(200, ["user" => $_SESSION["auth_user"] ?? null]);
}

if ($method !== "POST") {
    header("Allow: GET, POST");
    respond(405, ["message" => "This request method is not supported."]);
}

$input = json_decode(file_get_contents("php://input"), true);
if (!is_array($input)) {
    respond(400, ["message" => "Invalid request. Please try again."]);
}

$action = $input["action"] ?? "";
if ($action === "logout") {
    $_SESSION = [];
    if (ini_get("session.use_cookies")) {
        $cookie = session_get_cookie_params();
        setcookie(session_name(), "", [
            "expires" => time() - 42000,
            "path" => $cookie["path"],
            "domain" => $cookie["domain"],
            "secure" => $cookie["secure"],
            "httponly" => $cookie["httponly"],
            "samesite" => "Lax",
        ]);
    }
    session_destroy();
    respond(200, ["message" => "You have been signed out."]);
}

if ($action !== "login" && $action !== "register") {
    respond(400, ["message" => "Choose a valid account action."]);
}

$email = strtolower(trim((string)($input["email"] ?? "")));
$password = (string)($input["password"] ?? "");
$role = (string)($input["role"] ?? "visitor");
if (!in_array($role, ["visitor", "seller"], true)) {
    respond(422, ["message" => "Choose Visitor or Seller as your account type."]);
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) > 150) {
    respond(422, ["message" => "Enter a valid email address."]);
}
if (strlen($password) < 6 || strlen($password) > 4096) {
    respond(422, ["message" => "Password must be at least 6 characters."]);
}

try {
    require __DIR__ . "/database.php";

    if ($action === "register") {
        $name = trim((string)($input["name"] ?? ""));
        $phoneNumber = trim((string)($input["phone_number"] ?? ""));
        if ($name === "" || strlen($name) > 150) {
            respond(422, ["message" => "Enter your name (up to 150 characters)."]);
        }
        if (strlen($phoneNumber) > 30 || !preg_match("/^[+0-9().\\s-]{7,30}$/", $phoneNumber)) {
            respond(422, ["message" => "Enter a valid phone number (7–30 characters)."]);
        }
        if (!hash_equals($password, (string)($input["password_confirmation"] ?? ""))) {
            respond(422, ["message" => "Your passwords do not match."]);
        }

        $statement = $pdo->prepare(
            "INSERT INTO users (full_name, email, phone_number, password_hash, role)
             VALUES (:name, :email, :phone_number, :password_hash, :role)"
        );
        try {
            $statement->execute([
                "name" => $name,
                "email" => $email,
                "phone_number" => $phoneNumber,
                "password_hash" => password_hash($password, PASSWORD_DEFAULT),
                "role" => $role,
            ]);
        } catch (PDOException $exception) {
            if ($exception->getCode() === "23000") {
                respond(409, ["message" => "An account with this email already exists."]);
            }
            throw $exception;
        }
        $user = [
            "id" => (int)$pdo->lastInsertId(), "name" => $name, "email" => $email,
            "phone_number" => $phoneNumber, "role" => $role,
        ];
    } else {
        $statement = $pdo->prepare(
            "SELECT user_id AS id, full_name AS name, email, password_hash, role FROM users WHERE email = :email LIMIT 1"
        );
        $statement->execute(["email" => $email]);
        $record = $statement->fetch();
        if (!$record || !password_verify($password, $record["password_hash"])) {
            respond(401, ["message" => "Email or password is incorrect."]);
        }
        if (in_array($record["role"], ["visitor", "seller"], true) && $record["role"] !== $role) {
            respond(403, ["message" => "Choose the account type registered to this email address."]);
        }
        $user = [
            "id" => (int)$record["id"],
            "name" => $record["name"],
            "email" => $record["email"],
            "role" => $record["role"],
        ];
    }

    session_regenerate_id(true);
    $_SESSION["auth_user"] = $user;
    respond(200, ["user" => $user]);
} catch (PDOException $exception) {
    error_log("Authentication database error: " . $exception->getMessage());
    respond(503, ["message" => "The account service is temporarily unavailable. Please try again later."]);
}
