<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Blog Posts</title>
    <style>
        body {
            font-family: Arial;
            margin: 20px;
            background-color: #f4f4f4;
        }
        .post {
            background: white;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 8px;
            box-shadow: 0 0 5px #ccc;
        }
        .author {
            color: #888;
            font-size: 0.9em;
        }
    </style>
</head>
<body>

<h1>All Blog Posts</h1>

<?php
$stmt = $pdo->query("SELECT posts.title, posts.content, users.username, posts.created_at 
                     FROM posts 
                     JOIN users ON posts.user_id = users.id 
                     ORDER BY posts.created_at DESC");

while ($row = $stmt->fetch()) {
    echo "<div class='post'>";
    echo "<h2>" . htmlspecialchars($row['title']) . "</h2>";
    echo "<p class='author'>By " . htmlspecialchars($row['username']) . " on " . $row['created_at'] . "</p>";
    echo "<p>" . nl2br(htmlspecialchars($row['content'])) . "</p>";
    echo "</div>";
}
?>

</body>
</html>