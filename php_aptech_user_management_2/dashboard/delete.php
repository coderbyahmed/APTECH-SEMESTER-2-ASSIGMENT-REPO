<?php $extraJs = $extraJs ?? []; $extraJs[] = "../assets/js/delete.js"; ?>

<!-- Delete Confirmation Modal -->
<div class="modal-backdrop" id="deleteModal">
    <div class="modal-content">
        <div class="modal-icon modal-icon-warn">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                <circle cx="12" cy="12" r="10"/>
                <line x1="12" y1="8" x2="12" y2="12"/>
                <line x1="12" y1="16" x2="12.01" y2="16"/>
            </svg>
        </div>
        <h3 class="modal-title">Delete User</h3>
        <p class="modal-message">
            This action cannot be undone.<br>
            Are you sure you want to permanently delete this user?
        </p>
        <form action="../process/delete_process.php" method="POST" id="deleteForm">
            <input type="hidden" name="user_id" id="deleteUserId" value="">
            <div class="modal-actions">
                <button type="button" class="btn-cancel" id="cancelDelete">Cancel</button>
                <button type="submit" class="btn-confirm-delete">Delete</button>
            </div>
        </form>
    </div>
</div>
