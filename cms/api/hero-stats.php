<?php
require_once '../config.php';
require_once '../auth.php';

// Set content type to JSON
header('Content-Type: application/json');

// Check if user is logged in
if (!isLoggedIn()) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

// Get input data
$input = json_decode(file_get_contents('php://input'), true);

if (!$input) {
    echo json_encode(['success' => false, 'message' => 'Invalid input']);
    exit;
}

$action = $input['action'] ?? '';

try {
    if ($action === 'create') {
        $stmt = $pdo->prepare("INSERT INTO hero_stats (stat_number, stat_label, position) VALUES (?, ?, 0)");
        $stmt->execute([$input['stat_number'], $input['stat_label']]);
        
        echo json_encode([
            'success' => true, 
            'id' => $pdo->lastInsertId(),
            'message' => 'Stat created successfully'
        ]);
        
        // Log
        logActivity('create', 'hero_stats', $pdo->lastInsertId(), 'Created hero stat');

    } elseif ($action === 'update') {
        $stmt = $pdo->prepare("UPDATE hero_stats SET stat_number = ?, stat_label = ? WHERE id = ?");
        $stmt->execute([$input['stat_number'], $input['stat_label'], $input['id']]);
        
        echo json_encode([
            'success' => true, 
            'message' => 'Stat updated successfully'
        ]);

    } elseif ($action === 'delete') {
        $stmt = $pdo->prepare("DELETE FROM hero_stats WHERE id = ?");
        $stmt->execute([$input['id']]);
        
        echo json_encode([
            'success' => true, 
            'message' => 'Stat deleted successfully'
        ]);
        
        // Log
        logActivity('delete', 'hero_stats', $input['id'], 'Deleted hero stat');

    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid action']);
    }

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}

function logActivity($action, $table, $id, $desc) {
    global $pdo;
    try {
        $stmt = $pdo->prepare("INSERT INTO activity_log (user_id, action, table_name, record_id, description) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$_SESSION['user_id'], $action, $table, $id, $desc]);
    } catch (Exception $e) {
        // Ignore log errors
    }
}
?>
