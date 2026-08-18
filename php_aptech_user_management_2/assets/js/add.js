document.addEventListener('DOMContentLoaded', function () {

    /* ── Sidebar "Add User" Interceptor ── */

    var addUserLink = document.querySelector('.sidebar-nav .nav-item a[href*="#add-user"]');
    var currentFile = window.location.pathname.split('/').pop();

    if (addUserLink) {
        addUserLink.addEventListener('click', function (e) {
            e.preventDefault();
            if (currentFile === 'index.php' || currentFile === '') {
                openAddModal();
            } else {
                window.location.href = '../dashboard/index.php#add-user';
            }
        });
    }


    /* ── Add Modal ── */

    var addModal = document.getElementById('addModal');
    var addCloseBtn = document.getElementById('addModalClose');

    function openAddModal() {
        if (addModal) {
            addModal.classList.add('show');
            document.body.style.overflow = 'hidden';
        }
    }

    function closeAddModal() {
        if (addModal) {
            addModal.classList.remove('show');
            document.body.style.overflow = '';
        }
    }

    var addCancelBtn = document.getElementById('addCancelBtn');

    if (addCloseBtn) {
        addCloseBtn.addEventListener('click', closeAddModal);
    }

    if (addCancelBtn) {
        addCancelBtn.addEventListener('click', closeAddModal);
    }

    if (addModal) {
        addModal.addEventListener('click', function (e) {
            if (e.target === addModal) closeAddModal();
        });
    }

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && addModal && addModal.classList.contains('show')) {
            closeAddModal();
        }
    });

    // Auto-open modal if URL hash is #add-user
    if (window.location.hash === '#add-user') {
        setTimeout(openAddModal, 100);
        if (window.location.search) history.replaceState(null, '', window.location.pathname);
    }


    /* ── Profile Image Preview & Error Clear ── */

    var profileCircle = document.getElementById('addProfileCircle');
    var imageInput = document.getElementById('addImageInput');
    var previewImg = document.getElementById('addPreviewImg');

    if (profileCircle && imageInput) {
        profileCircle.addEventListener('click', function () {
            imageInput.click();
        });

        imageInput.addEventListener('change', function (e) {
            var file = e.target.files[0];
            if (file) {
                var reader = new FileReader();
                reader.onload = function (ev) {
                    previewImg.src = ev.target.result;
                    previewImg.classList.add('visible');
                    profileCircle.classList.add('has-image');
                };
                reader.readAsDataURL(file);
            }

            var wrapper = this.closest('.profile-upload');
            if (wrapper) {
                wrapper.classList.remove('has-error');
                var circle = wrapper.querySelector('.profile-circle');
                if (circle) circle.classList.remove('input-error');
                var err = wrapper.querySelector('.field-error');
                if (err) err.classList.add('field-error-hidden');
            }
        });
    }


    /* ── Clear Field Error on Input / Change ── */

    function clearFieldError(input) {
        input.classList.remove('input-error');
        var group = input.closest('.form-group');
        if (group) {
            group.classList.remove('has-error');
            var err = group.querySelector('.field-error');
            if (err) err.classList.add('field-error-hidden');
        }
    }

    var form = document.querySelector('#addModal form');
    if (form) {
        form.addEventListener('input', function (e) {
            if (e.target.matches('input, select, textarea')) {
                clearFieldError(e.target);
            }
        });
        form.addEventListener('change', function (e) {
            if (e.target.matches('select')) {
                clearFieldError(e.target);
            }
        });
    }


    /* ── Password Toggle ── */

    var toggleBtn = document.querySelector('#addModal .password-toggle');
    if (toggleBtn) {
        toggleBtn.addEventListener('click', function () {
            var pw = document.getElementById('addPassword');
            var open = this.querySelector('.eye-open');
            var closed = this.querySelector('.eye-closed');
            if (pw && open && closed) {
                if (pw.type === 'password') {
                    pw.type = 'text';
                    open.style.display = 'none';
                    closed.style.display = 'block';
                } else {
                    pw.type = 'password';
                    open.style.display = 'block';
                    closed.style.display = 'none';
                }
            }
        });
    }


    /* ── Toast System ── */

    var toastTimer = null;
    var toastRemaining = 0;
    var toastStartTime = 0;
    var toastDuration = 3000;
    var toastElement = null;

    function showToast(type, message) {
        var container = document.getElementById('toastContainer');
        if (!container) return;

        if (toastTimer) { clearTimeout(toastTimer); toastTimer = null; }
        container.innerHTML = '';

        var icons = {
            success: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>',
            error: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>',
            warning: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>',
            info: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>'
        };

        var toast = document.createElement('div');
        toast.className = 'toast toast-' + type;
        toast.innerHTML =
            '<div class="toast-icon">' + (icons[type] || icons.info) + '</div>' +
            '<div class="toast-body">' +
            '<div class="toast-message">' + message + '</div>' +
            '<div class="toast-progress"><div class="toast-progress-bar"></div></div>' +
            '</div>' +
            '<button class="toast-close">&times;</button>';

        var closeBtn = toast.querySelector('.toast-close');
        if (closeBtn) closeBtn.addEventListener('click', dismissToast);

        container.appendChild(toast);
        toastElement = toast;

        requestAnimationFrame(function () {
            toast.classList.add('toast-visible');
        });

        var bar = toast.querySelector('.toast-progress-bar');
        if (bar) {
            bar.style.animation = 'none';
            bar.offsetHeight;
            bar.style.animation = 'progressShrink ' + toastDuration + 'ms linear forwards';
        }

        toastRemaining = toastDuration;
        toastStartTime = Date.now();

        toastTimer = setTimeout(dismissToast, toastDuration);

        toast.addEventListener('mouseenter', pauseToast);
        toast.addEventListener('mouseleave', resumeToast);
    }

    function dismissToast() {
        if (!toastElement || !toastElement.parentElement) return;
        if (toastTimer) { clearTimeout(toastTimer); toastTimer = null; }
        toastElement.classList.remove('toast-visible');
        setTimeout(function () {
            if (toastElement && toastElement.parentElement) toastElement.remove();
            toastElement = null;
        }, 300);
    }

    function pauseToast() {
        if (!toastElement || !toastTimer) return;
        clearTimeout(toastTimer);
        toastTimer = null;
        toastRemaining -= (Date.now() - toastStartTime);
        if (toastRemaining < 0) toastRemaining = 0;
        var bar = toastElement.querySelector('.toast-progress-bar');
        if (bar) bar.style.animationPlayState = 'paused';
    }

    function resumeToast() {
        if (!toastElement) return;
        if (toastRemaining <= 0) { dismissToast(); return; }
        toastStartTime = Date.now();
        var bar = toastElement.querySelector('.toast-progress-bar');
        if (bar) bar.style.animationPlayState = 'running';
        toastTimer = setTimeout(dismissToast, toastRemaining);
    }


    /* ── Toast from PHP Session Data ── */

    var container = document.getElementById('toastContainer');
    if (container) {
        var toastType = container.getAttribute('data-toast-type');
        var toastMessage = container.getAttribute('data-toast-message');
        if (toastType && toastMessage) {
            showToast(toastType, toastMessage);
        }
    }

});
