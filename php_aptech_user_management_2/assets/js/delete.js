document.addEventListener('DOMContentLoaded', function () {

    /* ── Delete Confirmation Modal ── */

    var modal = document.getElementById('deleteModal');
    var deleteUserId = document.getElementById('deleteUserId');
    var cancelBtn = document.getElementById('cancelDelete');
    var deleteForm = document.getElementById('deleteForm');
    var submitting = false;

    // Open modal when any delete button is clicked
    document.querySelectorAll('.btn-delete').forEach(function (btn) {
        btn.addEventListener('click', function (e) {
            var userId = this.getAttribute('data-id');
            if (userId && modal && deleteUserId) {
                deleteUserId.value = userId;
                modal.classList.add('show');
            }
        });
    });

    // Close modal functions
    function closeModal() {
        if (modal) modal.classList.remove('show');
    }

    if (cancelBtn) {
        cancelBtn.addEventListener('click', closeModal);
    }

    // Close on backdrop click
    if (modal) {
        modal.addEventListener('click', function (e) {
            if (e.target === modal) closeModal();
        });
    }

    // Close on Escape key
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && modal && modal.classList.contains('show')) {
            closeModal();
        }
    });

    // Prevent double submission
    if (deleteForm) {
        deleteForm.addEventListener('submit', function () {
            if (submitting) return false;
            submitting = true;
            var submitBtn = this.querySelector('.btn-confirm-delete');
            if (submitBtn) submitBtn.disabled = true;
        });
    }

});
