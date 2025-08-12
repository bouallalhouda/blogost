<?php
// DB connection
require_once 'includes/db.php';

// Get post ID from URL
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Fetch post
$stmt = $pdo->prepare("SELECT * FROM posts WHERE id = ?");
$stmt->execute([$id]);
$post = $stmt->fetch();

// If post not found
if (!$post) {
    echo "Article introuvable.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($post['title']) ?> - Blog</title>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@700&display=swap" rel="stylesheet">
    <style>
        body {
            background: #f5f5f5;
            font-family: 'Space Grotesk', Arial, sans-serif;
            color: #222;
            margin: 0;
        }
        .main-container {
            background: #fff;
            border-radius: 24px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.18);
            margin: 32px auto;
            max-width: 900px;
            padding-bottom: 40px;
            overflow: hidden;
        }
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 32px 48px 0 48px;
            font-size: 15px;
            font-weight: 500;
        }
        nav a {
            text-decoration: none;
            color: #222;
            margin-left: 20px;
        }
        nav a:hover {
            color: #888;
        }
        .logo {
            font-weight: bold;
            font-size: 1.2em;
            letter-spacing: 2px;
            color: gray;
        }
        .hero {
            text-align: center;
            padding: 40px 20px 20px;
        }
        .hero-title {
            font-size: 3rem;
            font-weight: 700;
            color: #222;
            letter-spacing: 2px;
            text-transform: uppercase;
        }
        .post-image {
            width: 100%;
            max-height: 400px;
            object-fit: cover;
            display: block;
        }
        .post-content {
            padding: 20px 40px;
            font-size: 1.1rem;
            line-height: 1.8;
            color: #333;
        }
        .footer {
            padding: 20px;
            text-align: center;
            background-color: #111;
            color: white;
            margin-top: 40px;
        }
        .footer p {
            margin: 10px 0;
            font-weight: 600;
            letter-spacing: 1px;
        }
        @media (max-width: 768px) {
            .hero-title { font-size: 2rem; }
            .post-content { padding: 15px 20px; font-size: 1rem; }
        }
    </style>
</head>
<body>
    <div class="main-container">
        <nav>
            <div class="logo">YOUR LEARNING SPACE</div>
            <div>
                <a href="index.php">ACCUEIL</a>
            </div>
        </nav>

        <section class="hero">
            <div class="hero-title"><?= htmlspecialchars($post['title']) ?></div>
        </section>

        <?php if (!empty($post['image'])): ?>
            <img src="<?= htmlspecialchars($post['image']) ?>" alt="Image de l'article" class="post-image">
        <?php endif; ?>

        <div class="post-content">
            <?= nl2br(htmlspecialchars($post['content'])) ?>
        </div>

        <footer class="footer">
            <p>&copy; 2024 Your Blog CMS - All rights reserved.</p>
        </footer>
    </div>
</body>
</html>
