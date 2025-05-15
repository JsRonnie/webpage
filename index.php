<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>All Blog Posts</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>All Blog Posts</h1>
    <a href="add_post.php">➕ Add New Post</a>
    <hr>

    <?php
    $stmt = $pdo->query("SELECT posts.id, posts.title, posts.content, users.username, posts.created_at 
                         FROM posts JOIN users ON posts.user_id = users.id 
                         ORDER BY posts.created_at DESC");

    while ($row = $stmt->fetch()) {
        echo "<div class='post'>";
        echo "<h2>" . htmlspecialchars($row['title']) . "</h2>";
        echo "<p><strong>By:</strong> " . htmlspecialchars($row['username']) . " <em>(" . $row['created_at'] . ")</em></p>";
        echo "<p>" . nl2br(htmlspecialchars($row['content'])) . "</p>";
        echo "<a href='post.php?id={$row['id']}'>💬 View & Comment</a>";
        echo "</div>";
    }
    ?>
</div>
</body>
</html>
