<?php include 'db.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Add New Post</title>
    <style>
        body {
            font-family: Arial;
            margin: 20px;
            background-color: #f4f4f4;
        }
        form {
            background: white;
            padding: 15px;
            border-radius: 8px;
            max-width: 500px;
            box-shadow: 0 0 5px #ccc;
        }
        input, select, textarea {
            width: 100%;
            margin: 10px 0;
            padding: 10px;
        }
        button {
            padding: 10px 20px;
            background: #28a745;
            border: none;
            color: white;
            cursor: pointer;
        }
    </style>
</head>
<body>

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

</body>
</html>
