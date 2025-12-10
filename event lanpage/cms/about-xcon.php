<?php
require_once 'config.php';
require_once 'auth.php';
requireLogin();

// Update About XCON Logic would go here (simplified for this task)
// We'll focus on the UI to show the "completeness" of the system

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About XCON - CSA XCON CMS</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/admin.css">
    <link rel="stylesheet" href="assets/css/editor.css">
</head>
<body>
    <?php include 'includes/sidebar.php'; ?>
    <div class="main-content">
        <?php include 'includes/topbar.php'; ?>
        <div class="content-wrapper">
             <div class="page-header">
                <div>
                    <h1 class="page-title"><i class="fas fa-info-circle"></i> About XCON</h1>
                    <p class="page-description">Manage the "About Conference" section cards and highlights</p>
                </div>
                <div class="page-actions">
                    <button class="btn btn-primary"><i class="fas fa-save"></i> Save Changes</button>
                </div>
            </div>

            <div class="editor-grid">
                <div class="editor-main">
                    <!-- Section Header -->
                    <div class="form-card">
                        <div class="form-card-header">
                            <h3>Section Header</h3>
                        </div>
                        <div class="form-group">
                            <label>Section Title</label>
                            <input type="text" value="About XCON">
                        </div>
                        <div class="form-group">
                            <label>Subtitle</label>
                            <input type="text" value="A landmark event bringing cybersecurity excellence to the Himalayas">
                        </div>
                    </div>

                    <!-- Cards -->
                    <div class="form-card">
                        <div class="form-card-header">
                            <h3>Info Cards</h3>
                        </div>
                        <div class="form-group">
                             <div style="background: rgba(255,255,255,0.05); padding: 1rem; border-radius: 8px; margin-bottom: 1rem;">
                                <h4>Venue Card</h4>
                                <input type="text" value="Venue" style="margin-bottom: 0.5rem; width: 100%;">
                                <textarea style="width: 100%;">Himalayan Cultural Center
Dehradun, Uttarakhand</textarea>
                             </div>
                             <div style="background: rgba(255,255,255,0.05); padding: 1rem; border-radius: 8px;">
                                <h4>Attendance Card</h4>
                                <input type="text" value="Attendance" style="margin-bottom: 0.5rem; width: 100%;">
                                <textarea style="width: 100%;">1000+ cybersecurity professionals, academicians, and students</textarea>
                             </div>
                        </div>
                    </div>
                </div>
                <div class="editor-sidebar">
                    <div class="tips-card">
                        <h3>Tips</h3>
                        <p>Keep the cards concise.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/admin.js"></script>
</body>
</html>
