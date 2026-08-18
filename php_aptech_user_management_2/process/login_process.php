<?php

session_start();

require_once("../config/database.php");

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../auth/login.php");
    exit();
}

// Receive and trim input values
$email = trim($_POST["email"] ?? "");
$password = trim($_POST["password"] ?? "");

// Store field-specific errors for inline display
$errors = [];

if (empty($email)) {
    $errors["email"] = "Email is required.";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors["email"] = "Please enter a valid email address.";
}

if (empty($password)) {
    $errors["password"] = "Password is required.";
}

// If validation fails, store errors and redirect back to login
if (!empty($errors)) {
    $_SESSION["errors"] = $errors;
    $_SESSION["form_data"] = ["email" => $email];
    header("Location: ../auth/login.php");
    exit();
}

// Check whether the email exists using a prepared statement
$sql = "SELECT * FROM users WHERE email = ?";
$stmt = mysqli_prepare($connection, $sql);

if (!$stmt) {
    $_SESSION["toast"] = ["type" => "error", "message" => "Something went wrong. Please try again."];
    header("Location: ../auth/login.php");
    exit();
}

mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) === 0) {
    mysqli_stmt_close($stmt);
    mysqli_close($connection);
    $_SESSION["toast"] = ["type" => "error", "message" => "Account does not exist."];
    $_SESSION["form_data"] = ["email" => $email];
    header("Location: ../auth/login.php");
    exit();
}

// Fetch the user record
$user = mysqli_fetch_assoc($result);

mysqli_stmt_close($stmt);

// Verify the password using password_verify()
if (!password_verify($password, $user["password"])) {
    mysqli_close($connection);
    $_SESSION["toast"] = ["type" => "error", "message" => "Invalid email or password."];
    $_SESSION["form_data"] = ["email" => $email];
    header("Location: ../auth/login.php");
    exit();
}

// Password is correct — store user info in session
$_SESSION["user_id"] = $user["id"];
$_SESSION["user_name"] = $user["fullName"];
$_SESSION["user_email"] = $user["email"];
$_SESSION["user_profession"] = $user["profession"];

mysqli_close($connection);

// Redirect to dashboard
header("Location: ../dashboard/index.php");
exit();
