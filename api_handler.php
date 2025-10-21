<?php
include 'db.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

if(isset($_POST['message']) && isset($_POST['temp_response'])){
    $user_input = $_POST['message'];
    $ai_response = $_POST['temp_response'];

    // Save safely to DB
    $stmt = $conn->prepare("INSERT INTO chat_history (user_input, ai_response) VALUES (?, ?)");
    $stmt->bind_param("ss", $user_input, $ai_response);
    $stmt->execute();
    $stmt->close();

    echo "Saved!";
}
?>
