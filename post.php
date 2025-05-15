<?php include 'db.php'; ?>

<?php
// Validate post ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid post ID.");
}

$post_id = $_GET['id'];

// Get the post
$stmt = $pdo->prepare("SELECT posts.*, users.username FROM posts JOIN users ON posts.user_id = users.id WHERE posts.id = ?");
$stmt->execute([$post_id]);
$post = $stmt->fetch();

if (!$post) {
    die("Post not found.");
}

// Get comments
$commentsStmt = $pdo->prepare("SELECT comments.*, users.username FROM comments JOIN users ON comments.user_id = users.id WHERE comments.post_id = ? ORDER BY comments.created_at ASC");
$commentsStmt->execute([$post_id]);
$comments = $commentsStmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo htmlspecialchars($post['title']); ?></title>
    <style>
        body {
            font-family: Arial;
            margin: 20px;
            background-color: #f4f4f4;
        }
        .post, .comment, form {
            background: white;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 8px;
            box-shadow: 0 0 5px #ccc;
        }
        .comment .author {
            color: #555;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="post">
    <h1><?php echo htmlspecialchars($post['title']); ?></h1>
    <p class="author">By <?php echo htmlspecialchars($post['username']); ?> on <?php echo $post['created_at']; ?></p>
    <p><?php echo nl2br(htmlspecialchars($post['content'])); ?></p>
</div>

<h2>Comments</h2>

<?php foreach ($comments as $comment): ?>
    <div class="comment">
        <p class="author"><?php echo htmlspecialchars($comment['username']); ?> said:</p>
        <p><?php echo nl2br(htmlspecialchars($comment['content'])); ?></p>
        <p style="color:#aaa; font-size: 0.85em;"><?php echo $comment['created_at']; ?></p>
    </div>
<?php endforeach; ?>

<h3>Add a Comment</h3>
<form method="POST" action="save_comment.php">
    <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
    <label for="user_id">Your Name:</label>
    <select name="user_id" required>
        <option value="">Select User</option>
        <?php
        $users = $pdo->query("SELECT id, username FROM users");
        foreach ($users as $user) {
            echo "<option value='{$user['id']}'>" . htmlspecialchars($user['username']) . "</option>";
        }
        ?>
    </select>
    <label for="content">Comment:</label>
    <textarea name="content" rows="4" required></textarea>
    <button type="submit">Post Comment</button>
</form>

</body>
</html>
