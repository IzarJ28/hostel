<?php
require('../admin/inc/db_config.php');
require('../admin/inc/essentials.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'];
    $room_id = $_POST['room_id'];
    $signature = $_POST['signature'];
    $signature_file = $_FILES['signature-file']['name'];
    
    // Save the uploaded signature file (optional, you might want to store it in a specific directory)
    $target_dir = "uploads/signatures/";
    $target_file = $target_dir . basename($signature_file);
    
    if (move_uploaded_file($_FILES['signature-file']['tmp_name'], $target_file)) {
        // Prepare the SQL statement
        $stmt = $conn->prepare("INSERT INTO agreements (user_id, room_id, signature, signature_file) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiss", $user_id, $room_id, $signature, $signature_file);
        
        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Database error: ' . $stmt->error]);
        }
        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'File upload error']);
    }
}
?>
