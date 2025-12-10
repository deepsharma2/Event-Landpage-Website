<?php
require_once 'config.php';
require_once 'auth.php';
requireLogin();

// Update settings logic would go here
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Save logic
}

// Fetch settings
$stmt = $pdo->query("SELECT * FROM site_settings");
$settings = [];
while ($row = $stmt->fetch()) {
    $settings[$row['setting_key']] = $row['setting_value'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site Settings - CSA XCON CMS</title>
    <link rel="stylesheet" href="assets/css/admin.css">
    <link rel="stylesheet" href="assets/css/editor.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <?php include 'includes/sidebar.php'; ?>
    <div class="main-content">
        <?php include 'includes/topbar.php'; ?>
        <div class="content-wrapper">
             <div class="page-header">
                <div>
                    <h1 class="page-title"><i class="fas fa-cog"></i> Site Settings</h1>
                    <p class="page-description">General website configuration</p>
                </div>
                <div class="page-actions">
                    <button class="btn btn-primary"><i class="fas fa-save"></i> Save Changes</button>
                </div>
            </div>

            <div class="editor-grid">
                <div class="editor-main">
                    <div class="form-card">
                        <div class="form-card-header">
                            <h3>General</h3>
                        </div>
                        <div class="form-group">
                            <label>Site Name</label>
                            <input type="text" name="site_name" value="<?php echo htmlspecialchars($settings['site_name'] ?? ''); ?>">
                        </div>
                        <div class="form-group">
                            <label>Tagline</label>
                            <input type="text" name="site_tagline" value="<?php echo htmlspecialchars($settings['site_tagline'] ?? ''); ?>">
                        </div>
                    </div>

                    <div class="form-card">
                        <div class="form-card-header">
                            <h3>SEO</h3>
                        </div>
                        <div class="form-group">
                            <label>Meta Description</label>
                            <textarea name="meta_description"><?php echo htmlspecialchars($settings['meta_description'] ?? ''); ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Keywords</label>
                            <textarea name="meta_keywords"><?php echo htmlspecialchars($settings['meta_keywords'] ?? ''); ?></textarea>
                        </div>
                    </div>
                </div>
                
                <div class="editor-sidebar">
                    <div class="form-card">
                        <div class="form-card-header">
                            <h3>Branding</h3>
                        </div>
                        <div class="form-group">
                            <label>Primary Color</label>
                            <div style="display:flex; gap:0.5rem;">
                                <input type="color" value="<?php echo htmlspecialchars($settings['primary_color'] ?? '#00d4ff'); ?>">
                                <input type="text" value="<?php echo htmlspecialchars($settings['primary_color'] ?? '#00d4ff'); ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/admin.js"></script>
</body>
</html>
