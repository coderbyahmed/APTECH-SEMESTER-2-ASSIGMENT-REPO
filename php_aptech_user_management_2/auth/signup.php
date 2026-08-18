<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <link rel="stylesheet" href="../assets/css/signup.css">
</head>

<body>

    <div class="background-shapes">
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
        <div class="shape shape-3"></div>
    </div>

    <div class="signup-card">

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

        <form action="../process/signup_process.php" method="POST" enctype="multipart/form-data">

            <div class="profile-upload <?php echo isset($errors['image']) ? 'has-error' : ''; ?>">
                <div class="profile-circle <?php echo isset($errors['image']) ? 'input-error' : ''; ?>" id="profileCircle">
                    <div class="camera-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/>
                            <circle cx="12" cy="13" r="4"/>
                        </svg>
                    </div>
                    <div class="overlay">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/>
                            <circle cx="12" cy="13" r="4"/>
                        </svg>
                        <span>Change Photo</span>
                    </div>
                    <img src="" alt="" class="preview-img" id="previewImg">
                </div>
                <input type="file" name="image" id="imageInput" accept="image/*">
                <?php if (isset($errors['image'])): ?>
                    <span class="field-error">
                        <svg class="field-error-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                        <?php echo $errors['image']; ?>
                    </span>
                <?php endif; ?>
            </div>

            <div class="form-group <?php echo isset($errors['full_name']) ? 'has-error' : ''; ?>">
                <label for="fullName">Full Name</label>
                <input type="text" name="full_name" id="fullName" placeholder="Enter your full name"
                    value="<?php echo htmlspecialchars($formData['full_name'] ?? ''); ?>"
                    class="<?php echo isset($errors['full_name']) ? 'input-error' : ''; ?>"
                    autocomplete="name">
                <?php if (isset($errors['full_name'])): ?>
                    <span class="field-error">
                        <svg class="field-error-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                        <?php echo $errors['full_name']; ?>
                    </span>
                <?php endif; ?>
            </div>

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
                    <input type="password" name="password" id="password" placeholder="Create a password"
                        class="<?php echo isset($errors['password']) ? 'input-error' : ''; ?>"
                        autocomplete="new-password">
                    <button type="button" class="password-toggle" aria-label="Toggle password visibility">
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

            <div class="form-group <?php echo isset($errors['profession']) ? 'has-error' : ''; ?>">
                <label for="profession">Profession</label>
                <select name="profession" id="profession" class="<?php echo isset($errors['profession']) ? 'input-error' : ''; ?>">
                    <option value="" disabled <?php echo !isset($formData['profession']) || $formData['profession'] === '' ? 'selected' : ''; ?>>Select your profession</option>
                    <option value="Student" <?php echo isset($formData['profession']) && $formData['profession'] === 'Student' ? 'selected' : ''; ?>>Student</option>
                    <option value="Teacher" <?php echo isset($formData['profession']) && $formData['profession'] === 'Teacher' ? 'selected' : ''; ?>>Teacher</option>
                    <option value="Developer" <?php echo isset($formData['profession']) && $formData['profession'] === 'Developer' ? 'selected' : ''; ?>>Developer</option>
                    <option value="Designer" <?php echo isset($formData['profession']) && $formData['profession'] === 'Designer' ? 'selected' : ''; ?>>Designer</option>
                    <option value="Freelancer" <?php echo isset($formData['profession']) && $formData['profession'] === 'Freelancer' ? 'selected' : ''; ?>>Freelancer</option>
                </select>
                <?php if (isset($errors['profession'])): ?>
                    <span class="field-error">
                        <svg class="field-error-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                        <?php echo $errors['profession']; ?>
                    </span>
                <?php endif; ?>
            </div>

            <button type="submit">Create Account</button>

        </form>

        <p class="login-link">Already have an account? <a href="./login.php">Login</a></p>

    </div>

    <script src="../assets/js/signup.js"></script>
    <?php unset($_SESSION["form_data"]); ?>

</body>

</html>
