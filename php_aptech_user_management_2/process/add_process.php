<?php

session_start();

require_once("../config/database.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $fullName = trim($_POST["full_name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $password = trim($_POST["password"] ?? "");
    $profession = trim($_POST["profession"] ?? "");
    $image = $_FILES["image"];

    $imageName = $image["name"] ?? "";
    $imageTmpName = $image["tmp_name"] ?? "";
    $imageSize = $image["size"] ?? 0;
    $imageError = $image["error"] ?? 4;

    // Store field-specific errors for inline display
    $fieldErrors = [];

    if ($imageError !== 0) {
        $fieldErrors["image"] = "Please select a profile image.";
    }

    if (empty($fullName)) {
        $fieldErrors["full_name"] = "Full Name is required.";
    }

    if (empty($email)) {
        $fieldErrors["email"] = "Email is required.";
    }

    if (empty($password)) {
        $fieldErrors["password"] = "Password is required.";
    }

    if (empty($profession)) {
        $fieldErrors["profession"] = "Please select a profession.";
    }

    $imageExtension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));

    $newImageName = uniqid("IMG_", true) . "." . $imageExtension;

    $allowedExtensions = ["jpg", "jpeg", "png"];

    if (!in_array($imageExtension, $allowedExtensions)) {
        if (!isset($fieldErrors["image"])) {
            $fieldErrors["image"] = "Only JPG, JPEG and PNG images are allowed.";
        }
    }

    if ($imageSize > 5 * 1024 * 1024) {
        if (!isset($fieldErrors["image"])) {
            $fieldErrors["image"] = "Image size must be less than 5 MB.";
        }
    }

    if (!empty($fieldErrors)) {
        $_SESSION["errors"] = $fieldErrors;
        $_SESSION["form_data"] = $_POST;
        header("Location: ../dashboard/index.php?action=add");
        exit();
    }

    // Check if the email already exists in the database
    $sql = "SELECT * FROM users WHERE email = ?";

    $stmt = mysqli_prepare($connection, $sql);

    mysqli_stmt_bind_param($stmt, "s", $email);

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        mysqli_stmt_close($stmt);
        mysqli_close($connection);
        $_SESSION["errors"]["email"] = "This email is already registered. Please use a different email.";
        $_SESSION["form_data"] = $_POST;
        header("Location: ../dashboard/index.php?action=add");
        exit();
    }

    mysqli_stmt_close($stmt);

    // Move the uploaded image to the uploads directory
    $uploadPath = "../uploads/" . $newImageName;

    if (!move_uploaded_file($imageTmpName, $uploadPath)) {
        $_SESSION["toast"] = ["type" => "error", "message" => "Failed to upload image. Please try again."];
        $_SESSION["form_data"] = $_POST;
        header("Location: ../dashboard/index.php?action=add");
        exit();
    }

    // Hash the password securely using bcrypt
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert user into the database using a prepared statement
    $insertSql = "INSERT INTO users (image, fullName, email, password, profession) VALUES (?, ?, ?, ?, ?)";

    $insertStmt = mysqli_prepare($connection, $insertSql);

    if (!$insertStmt) {

        // Clean up the uploaded image if insert statement fails to prepare
        if (file_exists($uploadPath)) {
            unlink($uploadPath);
        }

        mysqli_close($connection);
        $_SESSION["toast"] = ["type" => "error", "message" => "Something went wrong. Please try again."];
        header("Location: ../dashboard/index.php?action=add");
        exit();
    }

    // Bind parameters: s = string (all five are strings)
    mysqli_stmt_bind_param($insertStmt, "sssss", $newImageName, $fullName, $email, $hashedPassword, $profession);

    // Execute the insert
    if (mysqli_stmt_execute($insertStmt)) {

        // Close the statement and connection
        mysqli_stmt_close($insertStmt);
        mysqli_close($connection);

        // Set success toast and redirect back to dashboard
        $_SESSION["toast"] = ["type" => "success", "message" => "User added successfully."];
        header("Location: ../dashboard/index.php");
        exit();

    } else {

        // Delete uploaded image if database insert fails
        if (file_exists($uploadPath)) {
            unlink($uploadPath);
        }

        mysqli_stmt_close($insertStmt);
        mysqli_close($connection);
        $_SESSION["toast"] = ["type" => "error", "message" => "Failed to create user. Please try again."];
        header("Location: ../dashboard/index.php?action=add");
        exit();
    }

}
