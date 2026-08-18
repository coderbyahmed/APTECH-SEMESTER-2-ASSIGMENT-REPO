document.addEventListener('DOMContentLoaded', function () {

    /* ── Logout Confirmation Modal ── */

    var modal = document.getElementById('logoutModal');
    var cancelBtn = document.getElementById('logoutCancel');
    var logoutForm = document.getElementById('logoutForm');
    var submitting = false;

    // Open modal when any logout trigger is clicked
    document.querySelectorAll('.js-logout-trigger').forEach(function (el) {
        el.addEventListener('click', function (e) {
            e.preventDefault();
            if (modal) modal.classList.add('show');
        });
    });

    // Close modal
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
    if (logoutForm) {
        logoutForm.addEventListener('submit', function () {
            if (submitting) return false;
            submitting = true;
            var submitBtn = this.querySelector('.btn-confirm');
            if (submitBtn) submitBtn.disabled = true;
        });
    }

});
