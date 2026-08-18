<!-- Edit User Modal -->
<div class="edit-backdrop" id="editModal">
    <div class="edit-box">

        <div class="edit-box-header">
            <div>
                <h2>Edit User</h2>
                <p class="edit-box-subtitle">Update user account details</p>
            </div>
            <button type="button" class="btn-modal-close" id="editModalClose">&times;</button>
        </div>

        <form action="../process/update_process.php" method="POST" enctype="multipart/form-data">

            <input type="hidden" name="user_id" value="<?php echo $editUser["id"]; ?>">
            <input type="hidden" name="existing_image" value="<?php echo htmlspecialchars($editUser["image"] ?? ""); ?>">

            <?php
            $imageFullPath = "../uploads/" . $editUser["image"];
            $hasImage = !empty($editUser["image"]) && file_exists($imageFullPath);
            ?>

            <div class="profile-section">
                <div class="profile-upload <?php echo isset($errors['image']) ? 'has-error' : ''; ?>">
                    <div class="profile-circle <?php echo $hasImage ? 'has-image' : ''; echo isset($errors['image']) ? ' input-error' : ''; ?>" id="editProfileCircle">
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
                        <img src="<?php echo $hasImage ? htmlspecialchars($imageFullPath) : ''; ?>" alt="" class="preview-img <?php echo $hasImage ? 'visible' : ''; ?>" id="editPreviewImg">
                    </div>
                    <input type="file" name="image" id="editImageInput" accept="image/*">
                    <?php if (isset($errors['image'])): ?>
                        <span class="field-error" style="display:flex;justify-content:center">
                            <svg class="field-error-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                            <?php echo $errors['image']; ?>
                        </span>
                    <?php endif; ?>
                </div>
            </div>

            <div class="form-grid">
                <div class="form-group <?php echo isset($errors['full_name']) ? 'has-error' : ''; ?>">
                    <label for="editFullName">Full Name</label>
                    <input type="text" name="full_name" id="editFullName" placeholder="Enter full name"
                        value="<?php echo htmlspecialchars($formData['full_name'] ?? $editUser['fullName']); ?>"
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
                    <label for="editEmail">Email Address</label>
                    <input type="email" name="email" id="editEmail" placeholder="Enter email address"
                        value="<?php echo htmlspecialchars($formData['email'] ?? $editUser['email']); ?>"
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
                    <label for="editPassword">Password <span class="pw-hint">(leave blank to keep current)</span></label>
                    <div class="password-wrapper">
                        <input type="password" name="password" id="editPassword" placeholder="New password (optional)"
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
                    <label for="editProfession">Profession</label>
                    <select name="profession" id="editProfession" class="<?php echo isset($errors['profession']) ? 'input-error' : ''; ?>">
                        <option value="" disabled <?php echo ($formData['profession'] ?? $editUser['profession']) === '' ? 'selected' : ''; ?>>Select a profession</option>
                        <option value="Student" <?php echo ($formData['profession'] ?? $editUser['profession']) === 'Student' ? 'selected' : ''; ?>>Student</option>
                        <option value="Teacher" <?php echo ($formData['profession'] ?? $editUser['profession']) === 'Teacher' ? 'selected' : ''; ?>>Teacher</option>
                        <option value="Developer" <?php echo ($formData['profession'] ?? $editUser['profession']) === 'Developer' ? 'selected' : ''; ?>>Developer</option>
                        <option value="Designer" <?php echo ($formData['profession'] ?? $editUser['profession']) === 'Designer' ? 'selected' : ''; ?>>Designer</option>
                        <option value="Freelancer" <?php echo ($formData['profession'] ?? $editUser['profession']) === 'Freelancer' ? 'selected' : ''; ?>>Freelancer</option>
                    </select>
                    <?php if (isset($errors['profession'])): ?>
                        <span class="field-error">
                            <svg class="field-error-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                            <?php echo $errors['profession']; ?>
                        </span>
                    <?php endif; ?>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn-cancel" id="editCancelBtn">Cancel</button>
                <button type="submit" class="btn-submit">Update User</button>
            </div>

        </form>

    </div>
</div>
