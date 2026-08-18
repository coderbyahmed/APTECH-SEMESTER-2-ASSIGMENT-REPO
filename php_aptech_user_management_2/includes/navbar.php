<header class="navbar">
    <div class="navbar-left">
        <h2 class="navbar-title"><?php echo htmlspecialchars($pageTitle ?? 'Dashboard'); ?></h2>
    </div>

    <div class="navbar-right">
        <!-- User Dropdown -->
        <div class="user-dropdown">
            <button class="user-dropdown-toggle" aria-label="User menu">
                <span class="user-name"><?php echo htmlspecialchars($_SESSION['user_name'] ?? 'Admin'); ?></span>
                <svg class="dropdown-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="6 9 12 15 18 9"/>
                </svg>
            </button>

            <div class="dropdown-menu">
                <a href="#" class="dropdown-item js-profile-trigger">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                        <circle cx="12" cy="7" r="4"/>
                    </svg>
                    My Profile
                </a>
                <a href="#" class="dropdown-item dropdown-logout js-logout-trigger">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                        <polyline points="16 17 21 12 16 7"/>
                        <line x1="21" y1="12" x2="9" y2="12"/>
                    </svg>
                    Logout
                </a>
            </div>
        </div>
    </div>
</header>
