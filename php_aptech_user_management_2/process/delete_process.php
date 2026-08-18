<?php

session_start();

require_once("../config/database.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $userId = trim($_POST["user_id"] ?? "");

    // Validate user ID
    if (empty($userId) || !is_numeric($userId) || $userId <= 0) {
        $_SESSION["toast"] = ["type" => "error", "message" => "Invalid user ID."];
        header("Location: ../dashboard/index.php");
        exit();
    }

    $userId = (int) $userId;

    // Check whether the user exists and fetch their image filename
    $selectSql = "SELECT image FROM users WHERE id = ?";
    $selectStmt = mysqli_prepare($connection, $selectSql);

    if (!$selectStmt) {
        $_SESSION["toast"] = ["type" => "error", "message" => "Something went wrong. Please try again."];
        header("Location: ../dashboard/index.php");
        exit();
    }

    mysqli_stmt_bind_param($selectStmt, "i", $userId);
    mysqli_stmt_execute($selectStmt);
    $selectResult = mysqli_stmt_get_result($selectStmt);
    $user = mysqli_fetch_assoc($selectResult);

    if (!$user) {
        mysqli_stmt_close($selectStmt);
        mysqli_close($connection);
        $_SESSION["toast"] = ["type" => "error", "message" => "User not found."];
        header("Location: ../dashboard/index.php");
        exit();
    }

    $imageName = $user["image"];
    mysqli_stmt_close($selectStmt);

    // Delete the user from the database using a prepared statement
    $deleteSql = "DELETE FROM users WHERE id = ?";
    $deleteStmt = mysqli_prepare($connection, $deleteSql);

    if (!$deleteStmt) {
        mysqli_close($connection);
        $_SESSION["toast"] = ["type" => "error", "message" => "Something went wrong. Please try again."];
        header("Location: ../dashboard/index.php");
        exit();
    }

    mysqli_stmt_bind_param($deleteStmt, "i", $userId);

    if (mysqli_stmt_execute($deleteStmt)) {

        // Database deletion succeeded — delete the profile image if it exists
        if (!empty($imageName)) {
            $imagePath = "../uploads/" . $imageName;
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        mysqli_stmt_close($deleteStmt);
        mysqli_close($connection);

        $_SESSION["toast"] = ["type" => "success", "message" => "User deleted successfully."];
        header("Location: ../dashboard/index.php");
        exit();

    } else {

        mysqli_stmt_close($deleteStmt);
        mysqli_close($connection);
        $_SESSION["toast"] = ["type" => "error", "message" => "Failed to delete user. Please try again."];
        header("Location: ../dashboard/index.php");
        exit();
    }

}
