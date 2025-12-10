<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - CSA XCON CMS</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/admin.css">
</head>
<body>
    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <div class="logo">
                <i class="fas fa-shield-alt"></i>
                <span>CSA XCON CMS</span>
            </div>
            <button class="sidebar-toggle" id="sidebarToggle">
                <i class="fas fa-bars"></i>
            </button>
        </div>

        <nav class="sidebar-nav">
            <ul class="nav-list">
                <li class="nav-item active">
                    <a href="dashboard.php" class="nav-link">
                        <i class="fas fa-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="nav-section">
                    <span class="nav-section-title">CONTENT</span>
                </li>

                <li class="nav-item">
                    <a href="hero-section.php" class="nav-link">
                        <i class="fas fa-star"></i>
                        <span>Hero Section</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="about-xcon.php" class="nav-link">
                        <i class="fas fa-info-circle"></i>
                        <span>About XCON</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="about-csa.php" class="nav-link">
                        <i class="fas fa-building"></i>
                        <span>About CSA</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="highlights.php" class="nav-link">
                        <i class="fas fa-lightbulb"></i>
                        <span>Highlights</span>
                    </a>
                </li>

                <li class="nav-section">
                    <span class="nav-section-title">APPEARANCE</span>
                </li>

                <li class="nav-item">
                    <a href="navigation.php" class="nav-link">
                        <i class="fas fa-bars"></i>
                        <span>Navigation Menu</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="footer.php" class="nav-link">
                        <i class="fas fa-shoe-prints"></i>
                        <span>Footer</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="colors-fonts.php" class="nav-link">
                        <i class="fas fa-palette"></i>
                        <span>Colors & Fonts</span>
                    </a>
                </li>

                <li class="nav-section">
                    <span class="nav-section-title">MEDIA</span>
                </li>

                <li class="nav-item">
                    <a href="media-library.php" class="nav-link">
                        <i class="fas fa-images"></i>
                        <span>Media Library</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="logo-branding.php" class="nav-link">
                        <i class="fas fa-copyright"></i>
                        <span>Logo & Branding</span>
                    </a>
                </li>

                <li class="nav-section">
                    <span class="nav-section-title">SEO & SETTINGS</span>
                </li>

                <li class="nav-item">
                    <a href="seo-settings.php" class="nav-link">
                        <i class="fas fa-search"></i>
                        <span>SEO Settings</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="site-settings.php" class="nav-link">
                        <i class="fas fa-cog"></i>
                        <span>Site Settings</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="sections-manager.php" class="nav-link">
                        <i class="fas fa-layer-group"></i>
                        <span>Sections Manager</span>
                    </a>
                </li>

                <li class="nav-section">
                    <span class="nav-section-title">SYSTEM</span>
                </li>

                <li class="nav-item">
                    <a href="users.php" class="nav-link">
                        <i class="fas fa-users"></i>
                        <span>Users</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="activity-log.php" class="nav-link">
                        <i class="fas fa-history"></i>
                        <span>Activity Log</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="backup.php" class="nav-link">
                        <i class="fas fa-database"></i>
                        <span>Backup & Restore</span>
                    </a>
                </li>
            </ul>
        </nav>

        <div class="sidebar-footer">
            <a href="../index.html" target="_blank" class="btn-view-site">
                <i class="fas fa-external-link-alt"></i>
                <span>View Website</span>
            </a>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Bar -->
        <header class="top-bar">
            <div class="top-bar-left">
                <button class="mobile-menu-toggle" id="mobileMenuToggle">
                    <i class="fas fa-bars"></i>
                </button>
                <h1 class="page-title">Dashboard</h1>
            </div>
            <div class="top-bar-right">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Search...">
                </div>
                <div class="user-menu">
                    <button class="user-menu-toggle" id="userMenuToggle">
                        <div class="user-avatar">
                            <i class="fas fa-user"></i>
                        </div>
                        <span class="user-name"><?php echo htmlspecialchars($_SESSION['username'] ?? 'Admin'); ?></span>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="user-dropdown" id="userDropdown">
                        <a href="profile.php"><i class="fas fa-user-circle"></i> Profile</a>
                        <a href="settings.php"><i class="fas fa-cog"></i> Settings</a>
                        <div class="dropdown-divider"></div>
                        <a href="auth.php?action=logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
                    </div>
                </div>
            </div>
        </header>

        <!-- Dashboard Content -->
        <div class="content-wrapper">
            <!-- Stats Cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <div class="stat-info">
                        <h3>Total Sections</h3>
                        <p class="stat-number">8</p>
                        <span class="stat-change positive">
                            <i class="fas fa-arrow-up"></i> All Active
                        </span>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon" style="background: linear-gradient(135deg, #00d4ff 0%, #7c3aed 100%);">
                        <i class="fas fa-images"></i>
                    </div>
                    <div class="stat-info">
                        <h3>Media Files</h3>
                        <p class="stat-number">24</p>
                        <span class="stat-change">
                            <i class="fas fa-image"></i> Images & Assets
                        </span>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                        <i class="fas fa-edit"></i>
                    </div>
                    <div class="stat-info">
                        <h3>Last Updated</h3>
                        <p class="stat-number">Today</p>
                        <span class="stat-change">
                            <i class="fas fa-clock"></i> 2 hours ago
                        </span>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon" style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-info">
                        <h3>Active Users</h3>
                        <p class="stat-number">3</p>
                        <span class="stat-change positive">
                            <i class="fas fa-user-check"></i> All Editors
                        </span>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="section-card">
                <div class="section-header">
                    <h2>Quick Actions</h2>
                    <p>Manage your website content efficiently</p>
                </div>
                <div class="quick-actions-grid">
                    <a href="hero-section.php" class="action-card">
                        <i class="fas fa-star"></i>
                        <h3>Edit Hero Section</h3>
                        <p>Update main banner and call-to-action</p>
                    </a>
                    <a href="highlights.php" class="action-card">
                        <i class="fas fa-lightbulb"></i>
                        <h3>Manage Highlights</h3>
                        <p>Add or edit event highlights</p>
                    </a>
                    <a href="media-library.php" class="action-card">
                        <i class="fas fa-upload"></i>
                        <h3>Upload Media</h3>
                        <p>Add images and assets</p>
                    </a>
                    <a href="colors-fonts.php" class="action-card">
                        <i class="fas fa-palette"></i>
                        <h3>Customize Design</h3>
                        <p>Change colors and typography</p>
                    </a>
                    <a href="navigation.php" class="action-card">
                        <i class="fas fa-bars"></i>
                        <h3>Edit Navigation</h3>
                        <p>Manage menu items</p>
                    </a>
                    <a href="seo-settings.php" class="action-card">
                        <i class="fas fa-search"></i>
                        <h3>SEO Settings</h3>
                        <p>Optimize for search engines</p>
                    </a>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="section-card">
                <div class="section-header">
                    <h2>Recent Activity</h2>
                    <a href="activity-log.php" class="btn-link">View All</a>
                </div>
                <div class="activity-list">
                    <div class="activity-item">
                        <div class="activity-icon">
                            <i class="fas fa-edit"></i>
                        </div>
                        <div class="activity-content">
                            <p><strong>Hero Section</strong> updated</p>
                            <span class="activity-time">2 hours ago</span>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-icon">
                            <i class="fas fa-image"></i>
                        </div>
                        <div class="activity-content">
                            <p><strong>New image</strong> uploaded to media library</p>
                            <span class="activity-time">5 hours ago</span>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-icon">
                            <i class="fas fa-palette"></i>
                        </div>
                        <div class="activity-content">
                            <p><strong>Color scheme</strong> modified</p>
                            <span class="activity-time">1 day ago</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Website Preview -->
            <div class="section-card">
                <div class="section-header">
                    <h2>Website Preview</h2>
                    <a href="../index.html" target="_blank" class="btn-link">Open in New Tab</a>
                </div>
                <div class="website-preview">
                    <iframe src="../index.html" frameborder="0"></iframe>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/admin.js"></script>
</body>
</html>
