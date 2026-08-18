<?php $extraJs = $extraJs ?? []; $extraJs[] = "../assets/js/profile.js"; ?>

<!-- Profile Modal -->
<div class="profile-backdrop" id="profileModal">
    <div class="profile-content">
        <button class="profile-close-btn" id="profileModalClose" aria-label="Close profile">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="18" y1="6" x2="6" y2="18"/>
                <line x1="6" y1="6" x2="18" y2="18"/>
            </svg>
        </button>

        <div class="profile-image-wrap">
            <?php if ($profileUser && !empty($profileUser['image']) && file_exists("../uploads/" . $profileUser['image'])): ?>
                <img src="../uploads/<?php echo htmlspecialchars($profileUser['image']); ?>" alt="" class="profile-img">
            <?php else: ?>
                <div class="profile-img-default">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                        <circle cx="12" cy="7" r="4"/>
                    </svg>
                </div>
            <?php endif; ?>
        </div>

        <span class="profile-badge">#<?php echo htmlspecialchars($profileUser['id'] ?? ''); ?></span>
        <h3 class="profile-name"><?php echo htmlspecialchars($profileUser['fullName'] ?? ''); ?></h3>

        <div class="profile-details">
            <div class="profile-row">
                <span class="profile-label">Email</span>
                <span class="profile-value"><?php echo htmlspecialchars($profileUser['email'] ?? ''); ?></span>
            </div>
            <div class="profile-row">
                <span class="profile-label">Profession</span>
                <span class="profile-value"><?php echo htmlspecialchars($profileUser['profession'] ?? ''); ?></span>
            </div>
            <div class="profile-row">
                <span class="profile-label">Member Since</span>
                <span class="profile-value"><?php echo isset($profileUser['createdAt']) ? date("d M Y", strtotime($profileUser['createdAt'])) : ''; ?></span>
            </div>
        </div>
    </div>
</div>
