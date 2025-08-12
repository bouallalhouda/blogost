<?php
// admin/edit.php
session_start();
require_once __DIR__ . '/../includes/db.php';
if (!isset($_SESSION['admin'])) { header('Location: login.php'); exit; }

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$stmt = $pdo->prepare("SELECT * FROM posts WHERE id = ?");
$stmt->execute([$id]);
$post = $stmt->fetch();
if (!$post) { echo "Article introuvable."; exit; }

$errors = [];
$title = $post['title'];
$content = $post['content'];
$currentImage = $post['image'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $content = trim($_POST['content'] ?? '');

    if ($title === '') $errors[] = 'Title required';
    if ($content === '') $errors[] = 'Content required';

    // image replace
    $imagePath = $currentImage;
    if (!empty($_FILES['image']['name'])) {
        $img = $_FILES['image'];
        $allowed = ['image/jpeg','image/png','image/gif','image/webp'];
        if ($img['error'] !== 0) {
            $errors[] = 'Image upload error';
        } elseif (!in_array(mime_content_type($img['tmp_name']), $allowed)) {
            $errors[] = 'Invalid image type';
        } else {
            $ext = pathinfo($img['name'], PATHINFO_EXTENSION);
            $name = uniqid('img_') . '.' . $ext;
            $destDir = __DIR__ . '/../images/uploads/';
            if (!is_dir($destDir)) mkdir($destDir, 0755, true);
            $dest = $destDir . $name;
            if (move_uploaded_file($img['tmp_name'], $dest)) {
                $imagePath = 'images/uploads/' . $name;
                // optionally delete old image file:
                if ($currentImage && file_exists(__DIR__ . '/../' . $currentImage)) {
                    @unlink(__DIR__ . '/../' . $currentImage);
                }
            } else {
                $errors[] = 'Failed to move uploaded file';
            }
        }
    }

    if (empty($errors)) {
        $stmt = $pdo->prepare("UPDATE posts SET title = ?, content = ?, image = ? WHERE id = ?");
        $stmt->execute([$title, $content, $imagePath, $id]);
        header('Location: dashboard.php');
        exit;
    }
}
?>
<!doctype html>
<html lang="fr">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Edit Post</title>
<style>
  body{font-family:Arial;background:#f5f7fb;margin:0;padding:24px}
  .card{max-width:800px;margin:0 auto;background:#fff;padding:18px;border-radius:12px;box-shadow:0 8px 30px rgba(0,0,0,.06)}
  input,textarea{width:100%;padding:10px;border:1px solid #ddd;border-radius:8px;margin-bottom:10px}
  label{font-weight:600;margin-bottom:6px;display:block}
  .actions{display:flex;gap:8px;justify-content:flex-end}
  button{padding:10px 12px;border-radius:8px;border:0;background:#111;color:#fff}
  img.preview{max-width:240px;border-radius:8px;margin-bottom:10px}
  .error{color:#c0392b;margin-bottom:8px}
</style>
</head>
<body>
<div class="card">
  <h2>Modifier l'article</h2>

  <?php if ($errors): foreach ($errors as $err): ?>
    <div class="error"><?= htmlspecialchars($err) ?></div>
  <?php endforeach; endif; ?>

  <form method="post" enctype="multipart/form-data">
    <label>Titre</label>
    <input type="text" name="title" value="<?= htmlspecialchars($title) ?>" required>

    <label>Image actuelle</label>
    <?php if ($currentImage): ?>
      <img class="preview" src="../<?= htmlspecialchars($currentImage) ?>" alt="">
    <?php else: ?>
      <div style="color:#999">No image</div>
    <?php endif; ?>

    <label>Remplacer l'image (laisser vide pour garder)</label>
    <input type="file" name="image" accept="image/*">

    <label>Contenu</label>
    <textarea name="content" rows="10" required><?= htmlspecialchars($content) ?></textarea>

    <div class="actions">
      <a href="dashboard.php" style="padding:10px 12px;border-radius:8px;text-decoration:none;background:#ddd;color:#111">Cancel</a>
      <button type="submit">Enregistrer</button>
    </div>
  </form>
</div>
</body>
</html>
