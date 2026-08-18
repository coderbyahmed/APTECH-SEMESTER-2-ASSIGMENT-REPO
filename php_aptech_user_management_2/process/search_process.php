<?php

session_start();

require_once("../config/database.php");

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["search_submit"])) {

    $query = trim($_POST["search_query"] ?? "");

    if ($query === "") {
        $_SESSION["toast"] = ["type" => "error", "message" => "Please enter a User ID or Email."];
        header("Location: ../dashboard/index.php?action=search");
        exit();
    }

    // Search by User ID or Email using a prepared statement
    $sql = "SELECT id FROM users WHERE id = ? OR email = ?";
    $stmt = mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $query, $query);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
    mysqli_close($connection);

    if ($user) {
        header("Location: ../dashboard/index.php?edit_user_id=" . (int)$user["id"] . "&action=edit");
        exit();
    } else {
        $_SESSION["toast"] = ["type" => "error", "message" => "User not found."];
        header("Location: ../dashboard/index.php?action=search");
        exit();
    }

} else {
    header("Location: ../dashboard/index.php");
    exit();
}
