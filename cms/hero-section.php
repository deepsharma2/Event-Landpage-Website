<?php
require_once 'config.php';
require_once 'auth.php';
requireLogin();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $stmt = $pdo->prepare("
            UPDATE hero_section SET 
                badge_text = ?,
                title = ?,
                subtitle = ?,
                description = ?,
                primary_button_text = ?,
                primary_button_link = ?,
                secondary_button_text = ?,
                secondary_button_link = ?
            WHERE id = 1
        ");
        
        $stmt->execute([
            $_POST['badge_text'],
            $_POST['title'],
            $_POST['subtitle'],
            $_POST['description'],
            $_POST['primary_button_text'],
            $_POST['primary_button_link'],
            $_POST['secondary_button_text'],
            $_POST['secondary_button_link']
        ]);

        // Log activity
        $logStmt = $pdo->prepare("INSERT INTO activity_log (user_id, action, table_name, description) VALUES (?, ?, ?, ?)");
        $logStmt->execute([$_SESSION['user_id'], 'update', 'hero_section', 'Updated hero section content']);

        $success = "Hero section updated successfully!";
    } catch (PDOException $e) {
        $error = "Error updating hero section: " . $e->getMessage();
    }
}

// Fetch current hero section data
$stmt = $pdo->query("SELECT * FROM hero_section WHERE id = 1");
$hero = $stmt->fetch();

// If no hero section exists, create default
if (!$hero) {
    $pdo->exec("INSERT INTO hero_section (id, badge_text, title, subtitle, description, primary_button_text, primary_button_link, secondary_button_text, secondary_button_link) VALUES (1, 'March 11-14, 2025', 'CSA XCON 2025', 'Pioneering Cyber Resilience in the Himalayas', 'Join 1000+ cybersecurity professionals', 'Discover More', '#about-xcon', 'View Highlights', '#highlights')");
    $hero = $pdo->query("SELECT * FROM hero_section WHERE id = 1")->fetch();
}

// Fetch hero stats
$statsStmt = $pdo->query("SELECT * FROM hero_stats ORDER BY position ASC");
$stats = $statsStmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hero Section - CSA XCON CMS</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/admin.css">
    <link rel="stylesheet" href="assets/css/editor.css">
</head>
<body>
    <!-- Sidebar -->
    <?php include 'includes/sidebar.php'; ?>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Bar -->
        <?php include 'includes/topbar.php'; ?>

        <!-- Content -->
        <div class="content-wrapper">
            <?php if (isset($success)): ?>
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    <?php echo $success; ?>
                </div>
            <?php endif; ?>

            <?php if (isset($error)): ?>
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-circle"></i>
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>

            <!-- Page Header -->
            <div class="page-header">
                <div>
                    <h1 class="page-title">
                        <i class="fas fa-star"></i>
                        Hero Section
                    </h1>
                    <p class="page-description">Edit the main banner section of your website</p>
                </div>
                <div class="page-actions">
                    <a href="../index.html" target="_blank" class="btn btn-secondary">
                        <i class="fas fa-eye"></i>
                        Preview
                    </a>
                    <button type="submit" form="heroForm" class="btn btn-primary">
                        <i class="fas fa-save"></i>
                        Save Changes
                    </button>
                </div>
            </div>

            <!-- Editor Grid -->
            <div class="editor-grid">
                <!-- Main Form -->
                <div class="editor-main">
                    <form id="heroForm" method="POST" action="">
                        <!-- Badge Text -->
                        <div class="form-card">
                            <div class="form-card-header">
                                <h3><i class="fas fa-tag"></i> Badge Text</h3>
                                <p>Small text displayed above the main title</p>
                            </div>
                            <div class="form-group">
                                <label for="badge_text">Badge Text</label>
                                <input type="text" id="badge_text" name="badge_text" 
                                       value="<?php echo htmlspecialchars($hero['badge_text']); ?>" 
                                       placeholder="e.g., March 11-14, 2025">
                                <small>Keep it short and informative (e.g., event date)</small>
                            </div>
                        </div>

                        <!-- Main Title -->
                        <div class="form-card">
                            <div class="form-card-header">
                                <h3><i class="fas fa-heading"></i> Main Title</h3>
                                <p>The primary headline of your hero section</p>
                            </div>
                            <div class="form-group">
                                <label for="title">Title *</label>
                                <input type="text" id="title" name="title" 
                                       value="<?php echo htmlspecialchars($hero['title']); ?>" 
                                       placeholder="e.g., CSA XCON 2025" required>
                                <small>This is the most prominent text on your homepage</small>
                            </div>
                        </div>

                        <!-- Subtitle -->
                        <div class="form-card">
                            <div class="form-card-header">
                                <h3><i class="fas fa-text-height"></i> Subtitle</h3>
                                <p>Supporting headline below the main title</p>
                            </div>
                            <div class="form-group">
                                <label for="subtitle">Subtitle</label>
                                <input type="text" id="subtitle" name="subtitle" 
                                       value="<?php echo htmlspecialchars($hero['subtitle']); ?>" 
                                       placeholder="e.g., Pioneering Cyber Resilience in the Himalayas">
                                <small>A compelling tagline or secondary message</small>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="form-card">
                            <div class="form-card-header">
                                <h3><i class="fas fa-align-left"></i> Description</h3>
                                <p>Detailed description or call-to-action message</p>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea id="description" name="description" rows="4" 
                                          placeholder="e.g., Join 1000+ cybersecurity professionals..."><?php echo htmlspecialchars($hero['description']); ?></textarea>
                                <small>Brief overview of your event or offering</small>
                            </div>
                        </div>

                        <!-- Primary Button -->
                        <div class="form-card">
                            <div class="form-card-header">
                                <h3><i class="fas fa-mouse-pointer"></i> Primary Button</h3>
                                <p>Main call-to-action button</p>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="primary_button_text">Button Text</label>
                                    <input type="text" id="primary_button_text" name="primary_button_text" 
                                           value="<?php echo htmlspecialchars($hero['primary_button_text']); ?>" 
                                           placeholder="e.g., Discover More">
                                </div>
                                <div class="form-group">
                                    <label for="primary_button_link">Button Link</label>
                                    <input type="text" id="primary_button_link" name="primary_button_link" 
                                           value="<?php echo htmlspecialchars($hero['primary_button_link']); ?>" 
                                           placeholder="e.g., #about-xcon">
                                </div>
                            </div>
                        </div>

                        <!-- Secondary Button -->
                        <div class="form-card">
                            <div class="form-card-header">
                                <h3><i class="fas fa-hand-pointer"></i> Secondary Button</h3>
                                <p>Alternative call-to-action button</p>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="secondary_button_text">Button Text</label>
                                    <input type="text" id="secondary_button_text" name="secondary_button_text" 
                                           value="<?php echo htmlspecialchars($hero['secondary_button_text']); ?>" 
                                           placeholder="e.g., View Highlights">
                                </div>
                                <div class="form-group">
                                    <label for="secondary_button_link">Button Link</label>
                                    <input type="text" id="secondary_button_link" name="secondary_button_link" 
                                           value="<?php echo htmlspecialchars($hero['secondary_button_link']); ?>" 
                                           placeholder="e.g., #highlights">
                                </div>
                            </div>
                        </div>
                    </form>

                    <!-- Hero Stats Section -->
                    <div class="form-card">
                        <div class="form-card-header">
                            <h3><i class="fas fa-chart-bar"></i> Hero Statistics</h3>
                            <p>Numerical highlights displayed in the hero section</p>
                            <button type="button" class="btn btn-sm btn-primary" onclick="addStat()">
                                <i class="fas fa-plus"></i> Add Stat
                            </button>
                        </div>
                        <div id="statsList" class="stats-list">
                            <?php foreach ($stats as $stat): ?>
                                <div class="stat-item sortable-item" data-id="<?php echo $stat['id']; ?>">
                                    <div class="stat-drag-handle">
                                        <i class="fas fa-grip-vertical"></i>
                                    </div>
                                    <div class="stat-content">
                                        <input type="text" class="stat-number" value="<?php echo htmlspecialchars($stat['stat_number']); ?>" placeholder="1000+">
                                        <input type="text" class="stat-label" value="<?php echo htmlspecialchars($stat['stat_label']); ?>" placeholder="Attendees">
                                    </div>
                                    <div class="stat-actions">
                                        <button type="button" class="btn-icon" onclick="saveStat(<?php echo $stat['id']; ?>)">
                                            <i class="fas fa-save"></i>
                                        </button>
                                        <button type="button" class="btn-icon btn-danger" onclick="deleteStat(<?php echo $stat['id']; ?>)">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Preview -->
                <div class="editor-sidebar">
                    <div class="preview-card sticky">
                        <div class="preview-header">
                            <h3><i class="fas fa-eye"></i> Live Preview</h3>
                            <button type="button" class="btn-icon" onclick="refreshPreview()">
                                <i class="fas fa-sync-alt"></i>
                            </button>
                        </div>
                        <div class="preview-content">
                            <div class="hero-preview">
                                <div class="preview-badge" id="preview-badge"><?php echo htmlspecialchars($hero['badge_text']); ?></div>
                                <h1 class="preview-title" id="preview-title"><?php echo htmlspecialchars($hero['title']); ?></h1>
                                <p class="preview-subtitle" id="preview-subtitle"><?php echo htmlspecialchars($hero['subtitle']); ?></p>
                                <p class="preview-description" id="preview-description"><?php echo htmlspecialchars($hero['description']); ?></p>
                                <div class="preview-buttons">
                                    <button class="preview-btn-primary" id="preview-btn-primary">
                                        <?php echo htmlspecialchars($hero['primary_button_text']); ?>
                                    </button>
                                    <button class="preview-btn-secondary" id="preview-btn-secondary">
                                        <?php echo htmlspecialchars($hero['secondary_button_text']); ?>
                                    </button>
                                </div>
                                <div class="preview-stats" id="preview-stats">
                                    <?php foreach ($stats as $stat): ?>
                                        <div class="preview-stat">
                                            <div class="preview-stat-number"><?php echo htmlspecialchars($stat['stat_number']); ?></div>
                                            <div class="preview-stat-label"><?php echo htmlspecialchars($stat['stat_label']); ?></div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                        <div class="preview-footer">
                            <small><i class="fas fa-info-circle"></i> Changes update in real-time</small>
                        </div>
                    </div>

                    <!-- Tips Card -->
                    <div class="tips-card">
                        <h3><i class="fas fa-lightbulb"></i> Tips</h3>
                        <ul>
                            <li>Keep your title concise and impactful</li>
                            <li>Use action-oriented button text</li>
                            <li>Stats should be impressive but accurate</li>
                            <li>Test on mobile devices for responsiveness</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/admin.js"></script>
    <script src="assets/js/hero-editor.js"></script>
</body>
</html>
