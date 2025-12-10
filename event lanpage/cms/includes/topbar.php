<header class="top-bar">
    <div class="top-bar-left">
        <button class="mobile-menu-toggle" id="mobileMenuToggle">
            <i class="fas fa-bars"></i>
        </button>
        <h1 class="page-title">
            <?php 
            // Simple logic to get title from current filename if not set
            if (!isset($pageTitle)) {
                $path = basename($_SERVER['PHP_SELF'], ".php");
                $pageTitle = ucwords(str_replace("-", " ", $path));
                if ($pageTitle == 'Dashboard') $pageTitle = 'Dashboard';
            }
            // echo $pageTitle; // Title is usually handled in the page itself, but good as fallback
            ?>
        </h1>
    </div>
    <div class="top-bar-right">
        <div class="user-menu">
            <button class="user-menu-toggle" id="userMenuToggle">
                <div class="user-avatar">
                    <i class="fas fa-user"></i>
                </div>
                <span class="user-name"><?php echo htmlspecialchars($_SESSION['username'] ?? 'Admin'); ?></span>
                <i class="fas fa-chevron-down"></i>
            </button>
            <div class="user-dropdown" id="userDropdown">
                <a href="auth.php?action=logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
        </div>
    </div>
</header>
