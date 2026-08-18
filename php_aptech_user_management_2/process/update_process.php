<?php

session_start();

require_once("../config/database.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $userId = (int)($_POST["user_id"] ?? 0);
    $fullName = trim($_POST["full_name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $password = trim($_POST["password"] ?? "");
    $profession = trim($_POST["profession"] ?? "");
    $existingImage = trim($_POST["existing_image"] ?? "");

    $fieldErrors = [];

    // Validate user ID
    if ($userId <= 0) {
        $_SESSION["toast"] = ["type" => "error", "message" => "Invalid user ID."];
        header("Location: ../dashboard/index.php");
        exit();
    }

    // Validate required fields
    if (empty($fullName)) {
        $fieldErrors["full_name"] = "Full Name is required.";
    }

    if (empty($email)) {
        $fieldErrors["email"] = "Email is required.";
    }

    if (empty($profession)) {
        $fieldErrors["profession"] = "Please select a profession.";
    }

    // Validate email format
    if (empty($fieldErrors["email"]) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $fieldErrors["email"] = "Please enter a valid email address.";
    }

    // Validate password only if provided
    if (!empty($password) && strlen($password) < 6) {
        $fieldErrors["password"] = "Password must be at least 6 characters.";
    }

    // Handle image upload
    $image = $_FILES["image"] ?? null;
    $imageName = $image["name"] ?? "";
    $newImageName = null;
    $uploadPath = null;

    if (!empty($imageName)) {
        $imageTmpName = $image["tmp_name"] ?? "";
        $imageSize = $image["size"] ?? 0;
        $imageError = $image["error"] ?? 4;

        $imageExtension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
        $allowedExtensions = ["jpg", "jpeg", "png"];

        if ($imageError !== 0) {
            $fieldErrors["image"] = "Please upload a valid image.";
        } elseif (!in_array($imageExtension, $allowedExtensions)) {
            $fieldErrors["image"] = "Only JPG, JPEG and PNG images are allowed.";
        } elseif ($imageSize > 5 * 1024 * 1024) {
            $fieldErrors["image"] = "Image size must be less than 5 MB.";
        } else {
            $newImageName = uniqid("IMG_", true) . "." . $imageExtension;
        }
    }

    // Check for duplicate email (excluding current user)
    if (empty($fieldErrors["email"])) {
        $checkSql = "SELECT id FROM users WHERE email = ? AND id != ?";
        $checkStmt = mysqli_prepare($connection, $checkSql);
        mysqli_stmt_bind_param($checkStmt, "si", $email, $userId);
        mysqli_stmt_execute($checkStmt);
        $checkResult = mysqli_stmt_get_result($checkStmt);

        if (mysqli_num_rows($checkResult) > 0) {
            $fieldErrors["email"] = "This email is already in use by another user.";
        }

        mysqli_stmt_close($checkStmt);
    }

    // If validation errors, redirect back to edit page
    if (!empty($fieldErrors)) {
        $_SESSION["errors"] = $fieldErrors;
        $_SESSION["form_data"] = $_POST;
        header("Location: ../dashboard/index.php?edit_user_id=" . $userId . "&action=edit");
        exit();
    }

    // Upload new image to the uploads directory if provided
    if ($newImageName) {
        $uploadPath = "../uploads/" . $newImageName;

        if (!move_uploaded_file($imageTmpName, $uploadPath)) {
            $_SESSION["toast"] = ["type" => "error", "message" => "Failed to upload image. Please try again."];
            $_SESSION["form_data"] = $_POST;
            header("Location: ../dashboard/index.php?edit_user_id=" . $userId . "&action=edit");
            exit();
        }
    }

    // Build the UPDATE query based on which fields changed
    $hasNewImage = $newImageName !== null;
    $hasNewPassword = !empty($password);

    if ($hasNewImage && $hasNewPassword) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $updateSql = "UPDATE users SET image = ?, fullName = ?, email = ?, password = ?, profession = ? WHERE id = ?";
        $updateStmt = mysqli_prepare($connection, $updateSql);
        mysqli_stmt_bind_param($updateStmt, "sssssi", $newImageName, $fullName, $email, $hashedPassword, $profession, $userId);
    } elseif ($hasNewImage) {
        $updateSql = "UPDATE users SET image = ?, fullName = ?, email = ?, profession = ? WHERE id = ?";
        $updateStmt = mysqli_prepare($connection, $updateSql);
        mysqli_stmt_bind_param($updateStmt, "ssssi", $newImageName, $fullName, $email, $profession, $userId);
    } elseif ($hasNewPassword) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $updateSql = "UPDATE users SET fullName = ?, email = ?, password = ?, profession = ? WHERE id = ?";
        $updateStmt = mysqli_prepare($connection, $updateSql);
        mysqli_stmt_bind_param($updateStmt, "ssssi", $fullName, $email, $hashedPassword, $profession, $userId);
    } else {
        $updateSql = "UPDATE users SET fullName = ?, email = ?, profession = ? WHERE id = ?";
        $updateStmt = mysqli_prepare($connection, $updateSql);
        mysqli_stmt_bind_param($updateStmt, "sssi", $fullName, $email, $profession, $userId);
    }

    if (!$updateStmt) {
        // Clean up uploaded image if statement preparation fails
        if ($newImageName && $uploadPath && file_exists($uploadPath)) {
            unlink($uploadPath);
        }
        mysqli_close($connection);
        $_SESSION["toast"] = ["type" => "error", "message" => "Something went wrong. Please try again."];
        header("Location: ../dashboard/index.php?edit_user_id=" . $userId . "&action=edit");
        exit();
    }

    // Execute update
    if (mysqli_stmt_execute($updateStmt)) {

        // Delete old image from filesystem if a new one was uploaded
        if ($hasNewImage && !empty($existingImage)) {
            $oldImagePath = "../uploads/" . $existingImage;
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }

        mysqli_stmt_close($updateStmt);
        mysqli_close($connection);

        // Refresh session variables if the logged-in user edited their own profile
        $loggedInUserId = (int)($_SESSION['user_id'] ?? 0);
        if ($userId === $loggedInUserId) {
            $_SESSION['user_name'] = $fullName;
            $_SESSION['user_email'] = $email;
            $_SESSION['user_profession'] = $profession;
        }

        $_SESSION["toast"] = ["type" => "success", "message" => "User updated successfully."];
        header("Location: ../dashboard/index.php");
        exit();

    } else {

        // Clean up uploaded image if update fails
        if ($newImageName && $uploadPath && file_exists($uploadPath)) {
            unlink($uploadPath);
        }

        mysqli_stmt_close($updateStmt);
        mysqli_close($connection);
        $_SESSION["toast"] = ["type" => "error", "message" => "Failed to update user. Please try again."];
        header("Location: ../dashboard/index.php?edit_user_id=" . $userId . "&action=edit");
        exit();
    }

}
