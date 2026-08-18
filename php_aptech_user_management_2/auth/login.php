<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Back</title>
    <link rel="stylesheet" href="../assets/css/login.css">
</head>

<body>

    <div class="background-shapes">
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
        <div class="shape shape-3"></div>
    </div>

    <div class="login-card">

        <!-- Toast notification container (PHP data passed via data attributes) -->
        <div id="toastContainer" class="toast-container"
            data-toast-type="<?php echo htmlspecialchars($_SESSION['toast']['type'] ?? ''); ?>"
            data-toast-message="<?php echo htmlspecialchars($_SESSION['toast']['message'] ?? ''); ?>"
            data-toast-redirect="<?php echo htmlspecialchars($_SESSION['toast_redirect'] ?? ''); ?>">
        </div>

        <?php unset($_SESSION['toast'], $_SESSION['toast_redirect']); ?>

        <?php
        $errors = $_SESSION["errors"] ?? [];
        unset($_SESSION["errors"]);
        $formData = $_SESSION["form_data"] ?? [];
        ?>

        <div class="login-header">
            <h1>Welcome Back</h1>
            <p>Sign in to continue to your account.</p>
        </div>

        <form action="../process/login_process.php" method="POST">

            <div class="form-group <?php echo isset($errors['email']) ? 'has-error' : ''; ?>">
                <label for="email">Email Address</label>
                <input type="email" name="email" id="email" placeholder="Enter your email address"
                    value="<?php echo htmlspecialchars($formData['email'] ?? ''); ?>"
                    class="<?php echo isset($errors['email']) ? 'input-error' : ''; ?>"
                    autocomplete="email">
                <?php if (isset($errors['email'])): ?>
                    <span class="field-error">
                        <svg class="field-error-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                        <?php echo $errors['email']; ?>
                    </span>
                <?php endif; ?>
            </div>

            <div class="form-group <?php echo isset($errors['password']) ? 'has-error' : ''; ?>">
                <label for="password">Password</label>
                <div class="password-wrapper">
                    <input type="password" name="password" id="password" placeholder="Enter your password"
                        class="<?php echo isset($errors['password']) ? 'input-error' : ''; ?>"
                        autocomplete="current-password">
                    <button type="button" class="password-toggle" id="passwordToggle" aria-label="Toggle password visibility">
                        <svg class="eye-icon eye-open" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                            <circle cx="12" cy="12" r="3"/>
                        </svg>
                        <svg class="eye-icon eye-closed" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="display:none">
                            <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/>
                            <line x1="1" y1="1" x2="23" y2="23"/>
                        </svg>
                    </button>
                </div>
                <?php if (isset($errors['password'])): ?>
                    <span class="field-error">
                        <svg class="field-error-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                        <?php echo $errors['password']; ?>
                    </span>
                <?php endif; ?>
            </div>

            <div class="form-row">
                <label class="remember-me">
                    <input type="checkbox" name="remember">
                    <span class="checkmark"></span>
                    Remember Me
                </label>
                <a href="#" class="forgot-link">Forgot Password?</a>
            </div>

            <button type="submit">Login</button>

        </form>

        <p class="signup-link">Don't have an account? <a href="./signup.php">Sign Up</a></p>

    </div>

    <script src="../assets/js/login.js"></script>
    <?php unset($_SESSION["form_data"]); ?>

</body>

</html>
