<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Add New Post</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Add New Post</h1>

        <form method="POST" action="save_post.php">
            <label for="user_id">Author:</label>
            <select name="user_id" required>
                <option value="">Select User</option>
                <?php
                $stmt = $pdo->query("SELECT id, username FROM users");
                while ($row = $stmt->fetch()) {
                    echo "<option value='{$row['id']}'>" . htmlspecialchars($row['username']) . "</option>";
                }
                ?>
            </select>

            <label for="title">Title:</label>
            <input type="text" name="title" required>

            <label for="content">Content:</label>
            <textarea name="content" rows="5" required></textarea>

            <button type="submit">Add Post</button>
        </form>
    </div>
</body>
</html>
