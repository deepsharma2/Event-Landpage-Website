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
    <title>Media Library - CSA XCON CMS</title>
    <link rel="stylesheet" href="assets/css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .media-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 1.5rem;
        }
        .media-item {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 8px;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        .media-item:hover {
            transform: translateY(-5px);
            border-color: var(--primary-color);
        }
        .media-preview {
            height: 150px;
            background: rgba(0,0,0,0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }
        .media-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .media-info {
            padding: 0.75rem;
        }
        .media-name {
            font-size: 0.85rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            margin-bottom: 0.5rem;
        }
    </style>
</head>
<body>
    <?php include 'includes/sidebar.php'; ?>
    <div class="main-content">
        <?php include 'includes/topbar.php'; ?>
        <div class="content-wrapper">
             <div class="page-header">
                <div>
                    <h1 class="page-title"><i class="fas fa-images"></i> Media Library</h1>
                    <p class="page-description">Manage your images and documents</p>
                </div>
                <div class="page-actions">
                    <button class="btn btn-primary"><i class="fas fa-upload"></i> Upload New</button>
                </div>
            </div>

            <div class="media-grid">
                <!-- Placeholder for Logo -->
                 <div class="media-item">
                    <div class="media-preview">
                        <img src="../logo.svg" alt="logo.svg">
                    </div>
                    <div class="media-info">
                        <div class="media-name">logo.svg</div>
                        <button class="btn-icon btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/admin.js"></script>
</body>
</html>
