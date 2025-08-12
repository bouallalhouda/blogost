<?php

// Admin/dashboard.php
session_start();
require_once __DIR__ . '/../includes/db.php';
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

$search = trim($_GET['search'] ?? '');
$params = [];
$sql = "SELECT * FROM posts";
if ($search !== '') {
    $sql .= " WHERE title LIKE :s OR content LIKE :s";
    $params[':s'] = '%' . $search . '%';
}
$sql .= " ORDER BY created_at DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$posts = $stmt->fetchAll();

?>
<!doctype html>
<html lang="fr">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Admin Dashboard</title>
<style>
    :root{--bg:#f5f7fb;--card:#fff;--accent:#111;--muted:#666}
    body{font-family:system-ui,Arial;background:var(--bg);margin:0;padding:24px}
    .wrap{max-width:1100px;margin:0 auto}
    header{display:flex;justify-content:space-between;align-items:center;gap:12px}
    h1{margin:0;font-size:20px}
    .controls{display:flex;gap:8px;align-items:center}
    input[type=text]{padding:8px 10px;border-radius:8px;border:1px solid #ddd}
    a.btn{display:inline-block;padding:8px 12px;border-radius:8px;text-decoration:none;background:#111;color:#fff}
    a.danger{background:#e74c3c}
    table{width:100%;border-collapse:collapse;margin-top:18px;background:var(--card);border-radius:10px;overflow:hidden;box-shadow:0 6px 20px rgba(0,0,0,.06)}
    th,td{padding:12px 14px;text-align:left;border-bottom:1px solid #f0f2f5}
    th{background:#fafbfd;color:var(--muted);font-weight:600}
    td img{max-width:120px;height:60px;object-fit:cover;border-radius:6px}
    .actions a{margin-right:8px;text-decoration:none;padding:6px 8px;border-radius:6px;font-size:.9rem}
    .actions .edit{background:#2ecc71;color:#fff}
    .actions .del{background:#e74c3c;color:#fff}
    @media (max-width:800px){
        table,thead,tbody,tr,th,td{display:block}
        th{display:none}
        td{padding:10px;border-bottom:1px solid #eee}
        td[data-label]{font-size:.95rem}
    }
</style>
</head>
<body>
<div class="wrap">
  <header>
    <div>
      <h1>Admin Dashboard</h1>
      <div style="color:var(--muted);font-size:.95rem">Connecté en tant que <strong><?= htmlspecialchars($_SESSION['admin']) ?></strong></div>
    </div>

    <div class="controls">
      <form method="get" style="display:flex">
        <input type="text" name="search" placeholder="Chercher titre ou catégorie" value="<?= htmlspecialchars($search) ?>">
        <button type="submit" style="padding:8px 10px;border-radius:8px;border:1px solid #ddd;background:#fff;cursor:pointer">Search</button>
      </form>
      <a href="create.php" class="btn">+ Nouveau</a>
      <a href="logout.php" class="btn danger">Se déconnecter</a>
    </div>
  </header>

  <table>
    <thead>
      <tr>
        <th>Titre</th>
        <th>Image</th>
        <th>Category</th>
        <th>Date</th>
        <th style="width:190px">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php if (empty($posts)): ?>
        <tr><td colspan="5" style="padding:20px;text-align:center;color:#666">Aucun article trouve.</td></tr>
      <?php endif; ?>
      <?php foreach ($posts as $p): ?>
        <tr>
          <td data-label="Titre"><?= htmlspecialchars($p['title']) ?></td>
          <td data-label="Image">
            <?php if (!empty($p['image'])): ?>
              <img src="<?= htmlspecialchars($p['image']) ?>" alt="">
            <?php else: ?>
              <span style="color:#999">No image</span>
            <?php endif; ?>
          </td>
          <td data-label="Category"><?= htmlspecialchars($p['category'] ?? '') ?></td>
          <td data-label="Date"><?= $p['created_at'] ?></td>
          <td class="actions" data-label="Actions">
            <a class="edit" href="edit.php?id=<?= $p['id'] ?>">Edit</a>
            <a class="del" href="delete.php?id=<?= $p['id'] ?>" onclick="return confirm('Supprimer cet article ?')">Delete</a>
            <a style="background:#3498db;color:#fff;padding:6px 8px;border-radius:6px;text-decoration:none" href="../post.php?id=<?= $p['id'] ?>" target="_blank">View</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
</body>
</html>
