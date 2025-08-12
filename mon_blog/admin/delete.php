<?php
// admin/delete.php
session_start();
require_once __DIR__ . '/../includes/db.php';
if (!isset($_SESSION['admin'])) { header('Location: login.php'); exit; }

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) { header('Location: dashboard.php'); exit; }

// f imagepath to delete poost
$stmt = $pdo->prepare("SELECT image FROM posts WHERE id = ?");
$stmt->execute([$id]);
$post = $stmt->fetch();
if ($post) {
    // delete DB row
    $del = $pdo->prepare("DELETE FROM posts WHERE id = ?");
    $del->execute([$id]);

    // delete image iff exiiist
    if (!empty($post['image'])) {
        $file = __DIR__ . '/../' . $post['image'];
        if (file_exists($file)) @unlink($file);
    }
}

header('Location: dashboard.php');
exit;
