<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $post_id = $_POST['post_id'];
    $user_id = $_POST['user_id'];
    $content = $_POST['content'];

    if (!empty($post_id) && !empty($user_id) && !empty($content)) {
        $stmt = $pdo->prepare("INSERT INTO comments (post_id, user_id, content) VALUES (?, ?, ?)");
        $stmt->execute([$post_id, $user_id, $content]);

        header("Location: post.php?id=" . $post_id);
        exit();
    } else {
        echo "All fields are required.";
    }
}
?>
