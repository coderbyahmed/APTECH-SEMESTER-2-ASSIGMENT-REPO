<?php $extraJs = $extraJs ?? []; $extraJs[] = "../assets/js/logout.js"; ?>

<!-- Logout Confirmation Modal -->
<div class="logout-backdrop" id="logoutModal">
    <div class="logout-content">
        <div class="modal-icon modal-icon-warn">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                <polyline points="16 17 21 12 16 7"/>
                <line x1="21" y1="12" x2="9" y2="12"/>
            </svg>
        </div>
        <h3 class="modal-title">Logout</h3>
        <p class="modal-message">Are you sure you want to logout from your account?</p>
        <form action="../process/logout_process.php" method="POST" id="logoutForm">
            <div class="modal-actions">
                <button type="button" class="btn-cancel" id="logoutCancel">Cancel</button>
                <button type="submit" class="btn-confirm">Yes, Logout</button>
            </div>
        </form>
    </div>
</div>
