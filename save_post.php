<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user_id = $_POST['user_id'];
    $title = $_POST['title'];
    $content = $_POST['content'];

    if (!empty($user_id) && !empty($title) && !empty($content)) {
        $stmt = $pdo->prepare("INSERT INTO posts (user_id, title, content) VALUES (?, ?, ?)");
        $stmt->execute([$user_id, $title, $content]);

        header("Location: index.php");
        exit();
    } else {
        echo "All fields are required.";
    }
}
?>
