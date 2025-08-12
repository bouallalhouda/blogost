<?php
session_start();
require_once '../includes/db.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

// Search filter
$search = isset($_GET['search']) ? "%".$_GET['search']."%" : "%%";
$stmt = $pdo->prepare("SELECT * FROM posts WHERE title LIKE ? ORDER BY created_at DESC");
$stmt->execute([$search]);
$posts = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <style>
        body { font-family: Arial; padding: 20px; background: #f5f5f5; }
        a { text-decoration: none; padding: 6px 10px; background: #222; color: white; border-radius: 4px; margin: 0 4px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid #ccc; }
        th, td { padding: 10px; text-align: left; }
        form { display: inline; }
        .top-bar { display: flex; justify-content: space-between; align-items: center; }
        input[type=text] { padding: 6px; }
    </style>
</head>
<body>
    <div class="top-bar">
        <h1>Admin Dashboard</h1>
        <div>
            <form method="GET" style="display:inline;">
                <input type="text" name="search" placeholder="Search title">
                <button type="submit">Search</button>
            </form>
            <a href="create.php">+ New Post</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>

    <table>
        <tr>
            <th>Title</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($posts as $post): ?>
        <tr>
            <td><?= htmlspecialchars($post['title']) ?></td>
            <td><?= $post['created_at'] ?></td>
            <td>
                <a href="edit.php?id=<?= $post['id'] ?>">Edit</a>
                <a href="delete.php?id=<?= $post['id'] ?>" onclick="return confirm('Delete this post?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
