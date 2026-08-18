<?php
$pageTitle = "Dashboard";
$extraCss = ["../assets/css/edit.css", "../assets/css/add.css", "../assets/css/delete.css", "../assets/css/logout.css", "../assets/css/profile.css"];
require_once "../config/database.php";

// Ensure session is active for auth guard and profile data
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Redirect unauthenticated users to login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}

// Read and clear session errors and form_data for both add and edit modals
$errors = $_SESSION["errors"] ?? [];
unset($_SESSION["errors"]);
$formData = $_SESSION["form_data"] ?? [];
unset($_SESSION["form_data"]);

// Handle edit_user_id query parameter for edit modal pre-fill
$editUser = null;
$editUserId = (int)($_GET["edit_user_id"] ?? 0);
if ($editUserId > 0) {
    $sql = "SELECT * FROM users WHERE id = ?";
    $stmt = mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($stmt, "i", $editUserId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $editUser = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
}

// Fetch all users from the database
$sql = "SELECT * FROM users ORDER BY id ASC";
$stmt = mysqli_prepare($connection, $sql);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$users = mysqli_fetch_all($result, MYSQLI_ASSOC);
$totalUsers = count($users);
mysqli_stmt_close($stmt);

// Fetch logged-in user's profile data
$profileUser = null;
$loggedInUserId = (int)($_SESSION['user_id'] ?? 0);
if ($loggedInUserId > 0) {
    $profileSql = "SELECT * FROM users WHERE id = ?";
    $profileStmt = mysqli_prepare($connection, $profileSql);
    mysqli_stmt_bind_param($profileStmt, "i", $loggedInUserId);
    mysqli_stmt_execute($profileStmt);
    $profileResult = mysqli_stmt_get_result($profileStmt);
    $profileUser = mysqli_fetch_assoc($profileResult);
    mysqli_stmt_close($profileStmt);
}

mysqli_close($connection);

function getBadgeClass($profession) {
    $map = [
        "Developer"  => "badge-dev",
        "Designer"   => "badge-designer",
        "Student"    => "badge-student",
        "Teacher"    => "badge-teacher",
        "Freelancer" => "badge-freelancer",
    ];
    return $map[$profession] ?? "badge-dev";
}
?>
<?php require_once "../includes/header.php"; ?>
<?php require_once "../includes/sidebar.php"; ?>

<div class="dashboard-wrapper">
    <?php require_once "../includes/navbar.php"; ?>

    <main class="main-content">

        <h1>Dashboard</h1>
        <p class="welcome">Welcome back! Manage your users efficiently from your dashboard.</p>

        <div class="stat-cards">
            <div class="stat-card">
                <div class="stat-card-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                    </svg>
                </div>
                <span class="stat-card-value"><?php echo $totalUsers; ?></span>
                <span class="stat-card-label">Total Users</span>
            </div>
        </div>

        <div class="table-section">
            <div class="table-header">
                <h2>All Users</h2>
            </div>
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>User ID</th>
                            <th>Profile Image</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Profession</th>
                            <th>Created Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php if ($totalUsers === 0): ?>

                            <tr>
                                <td colspan="8" class="empty-state">No users found.</td>
                            </tr>

                        <?php else: ?>

                            <?php $counter = 1; ?>
                            <?php foreach ($users as $user): ?>
                                <tr>
                                    <td><?php echo $counter++; ?></td>
                                    <td><?php echo htmlspecialchars($user["id"]); ?></td>
                                    <td>
                                        <?php
                                        $imagePath = "../uploads/" . $user["image"];
                                        ?>
                                        <?php if (!empty($user["image"]) && file_exists($imagePath)): ?>
                                            <img src="<?php echo $imagePath; ?>" alt="" class="table-avatar-img">
                                        <?php else: ?>
                                            <div class="table-avatar">
                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                                                    <circle cx="12" cy="7" r="4"/>
                                                </svg>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td class="td-name"><?php echo htmlspecialchars($user["fullName"]); ?></td>
                                    <td><?php echo htmlspecialchars($user["email"]); ?></td>
                                    <td><span class="badge <?php echo getBadgeClass($user["profession"]); ?>"><?php echo htmlspecialchars($user["profession"]); ?></span></td>
                                    <td><?php echo date("d M Y", strtotime($user["createdAt"])); ?></td>
                                    <td>
                                        <button class="btn-delete" data-id="<?php echo $user['id']; ?>" title="Delete user">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <polyline points="3 6 5 6 21 6"/>
                                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                                            </svg>
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                        <?php endif; ?>

                    </tbody>
                </table>
            </div>
        </div>

        <!-- Toast container -->
        <div id="toastContainer" class="toast-container"
            data-toast-type="<?php echo htmlspecialchars($_SESSION['toast']['type'] ?? ''); ?>"
            data-toast-message="<?php echo htmlspecialchars($_SESSION['toast']['message'] ?? ''); ?>">
        </div>
        <?php unset($_SESSION['toast']); ?>

    </main>

    <?php require_once "delete.php"; ?>
    <?php require_once "logout_modal.php"; ?>
    <?php require_once "profile.php"; ?>
    <?php require_once "search_modal.php"; ?>
    <?php require_once "add_modal.php"; ?>
    <?php if ($editUser): ?>
    <?php require_once "edit_modal.php"; ?>
    <?php endif; ?>

    <!-- Convert ?action= query param into window.location.hash so modals auto-open -->
    <?php if (isset($_GET['action'])): ?>
    <?php
    $hashMap = [
        'add' => 'add-user',
        'edit' => 'edit-user',
        'search' => 'search-modal',
    ];
    $hash = $hashMap[$_GET['action']] ?? $_GET['action'];
    ?>
    <script>window.location.hash = '<?php echo htmlspecialchars($hash); ?>';</script>
    <?php endif; ?>

    <?php
    $extraJs = $extraJs ?? [];
    $extraJs[] = "../assets/js/delete.js";
    $extraJs[] = "../assets/js/edit.js";
    $extraJs[] = "../assets/js/add.js";
    $extraJs = array_unique($extraJs);
    ?>
    <?php require_once "../includes/footer.php"; ?>
