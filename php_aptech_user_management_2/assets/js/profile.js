document.addEventListener('DOMContentLoaded', function () {

    /* ── Profile Modal ── */

    var modal = document.getElementById('profileModal');
    var closeBtn = document.getElementById('profileModalClose');

    // Open modal when My Profile trigger is clicked
    document.querySelectorAll('.js-profile-trigger').forEach(function (el) {
        el.addEventListener('click', function (e) {
            e.preventDefault();
            if (modal) modal.classList.add('show');
        });
    });

    // Close modal
    function closeModal() {
        if (modal) modal.classList.remove('show');
    }

    if (closeBtn) {
        closeBtn.addEventListener('click', closeModal);
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

});
