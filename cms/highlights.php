<?php
require_once 'config.php';
require_once 'auth.php';
requireLogin();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Highlights - CSA XCON CMS</title>
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
                    <h1 class="page-title"><i class="fas fa-lightbulb"></i> Highlights</h1>
                    <p class="page-description">Manage event highlights and key features</p>
                </div>
                <div class="page-actions">
                    <button class="btn btn-primary"><i class="fas fa-plus"></i> Add New Highlight</button>
                </div>
            </div>

            <div class="editor-grid">
                <div class="editor-main">
                    <div class="form-card">
                        <div class="form-card-header">
                            <h3>Existing Highlights</h3>
                        </div>
                        <!-- List of highlights would normally be fetched from DB here -->
                        <div class="stats-list">
                            <div class="stat-item">
                                <div class="stat-content">
                                    <strong>01 - Keynotes</strong>
                                    <p>Global leaders and innovators...</p>
                                </div>
                                <div class="stat-actions">
                                    <button class="btn-icon"><i class="fas fa-edit"></i></button>
                                    <button class="btn-icon btn-danger"><i class="fas fa-trash"></i></button>
                                </div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-content">
                                    <strong>02 - Panels</strong>
                                    <p>Technical sessions focused on...</p>
                                </div>
                                <div class="stat-actions">
                                    <button class="btn-icon"><i class="fas fa-edit"></i></button>
                                    <button class="btn-icon btn-danger"><i class="fas fa-trash"></i></button>
                                </div>
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
