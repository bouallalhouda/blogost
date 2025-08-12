<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog posts - Explore Our articles </title>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@700&display=swap" rel="stylesheet">


    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #f5f5f5;
            min-height: 100vh;
            font-family: 'Space Grotesk', Arial, sans-serif;
            color: #222;
        }

        .main-container {
            background: #fff;
            border-radius: 24px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.18);
            margin: 32px auto;
            max-width: 1200px;
            min-height: 90vh;
            position: relative;
            overflow: hidden;
            padding: 0 0 40px 0;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 32px 48px 0 48px;
            font-size: 15px;
            font-weight: 500;
        }

        nav ul {
            display: flex;
            gap: 32px;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        nav a {
            color: #222;
            text-decoration: none;
            letter-spacing: 1px;
            transition: color 0.2s;
        }

        nav a:hover {
            color: #888;
        }

        .logo {
            font-weight: bold;
            font-size: 1.2em;
            letter-spacing: 2px;
            color:gray;
        }

        .hi {
            position: relative;
            text-align: center;
            margin-top: 60px;
            z-index: 2;
        }

        .hi-title {
            font-size: 4.2rem;
            font-family: 'Space Grotesk', Arial, sans-serif;
            font-weight: 700;
            color: #222;
            letter-spacing: 2px;
            line-height: 1.05;
            text-transform: uppercase;
            position: relative;
            display: inline-block;
            text-shadow: 6px 8px 0 #000, 12px 16px 0 #bbb;
            background: white;
            padding: 0 18px;
            border-radius: 10px;
        }

        .hi-desc {
            margin: 24px auto 0 auto;
            max-width: 600px;
            color: #222;
            font-size: 1.05rem;
            letter-spacing: 0.5px;
            font-weight: 400;
        }

        .posts-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 30px;
            padding: 40px 20px;
            margin-top: 40px;
        }

        .post-card {
            background: white;
            border-radius: 15px;
            width: 350px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 2px solid #111;
        }

        .post-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.2);
        }

        .post-card h2 {
            font-size: 1.5rem;
            color: #222;
            margin: 20px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .post-card p {
            color: #555;
            margin: 0 20px 20px 20px;
            font-size: 1rem;
            line-height: 1.6;
        }

        .post-card a {
            display: block;
            margin: 0 20px 20px 20px;
            color: #111;
            font-weight: 600;
            text-decoration: none;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 10px 20px;
            background: #f4f4f4;
            border-radius: 8px;
            text-align: center;
            transition: background-color 0.3s;
        }

        .post-card a:hover {
            background: #111;
            color: white;
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

        /* SVG Illustrations */
        .svg-planet {
            position: absolute;
            top: 60px;
            right: 60px;
            width: 180px;
            z-index: 1;
        }

        .svg-alien {
            position: absolute;
            left: 0;
            bottom: 120px;
            width: 90px;
            z-index: 1;
        }

        .svg-ufo {
            position: absolute;
            left: 120px;
            bottom: 60px;
            width: 120px;
            z-index: 1;
        }

        .svg-astronaut {
            position: absolute;
            right: 40px;
            bottom: 40px;
            width: 210px;
            z-index: 1;
        }

        .svg-telescope {
            position: absolute;
            left: 50%;
            bottom: 30px;
            width: 80px;
            transform: translateX(-50%);
            z-index: 1;
        }

        .svg-bg-planet {
            position: absolute;
            left: -80px;
            top: 0;
            width: 220px;
            z-index: 0;
            opacity: 0.7;
        }


        
        @media (max-width: 900px) {
            .main-container { max-width: 99vw; }
            .svg-planet { right: 10px; width: 120px; }
            .svg-astronaut { right: 0; width: 120px; }
            .svg-ufo { left: 10px; width: 80px; }
            .svg-alien { width: 60px; }
            .svg-bg-planet { width: 120px; }
            .hero-title { font-size: 2.5rem; }
            .post-card { width: 90%; max-width: 400px; }
        }

        @media (max-width: 600px) {
            .hero-title { font-size: 2rem; }
            nav { padding: 18px 10px 0 10px; font-size: 13px; }
            .posts-container { flex-direction: column; align-items: center; }
            .post-card { width: 95%; }
        }
    </style>


</head>
<body>
    <div class="main-container">
        <nav>
            <div class="logo">YOUR LEARNING SPACE</div>
            <ul class="nav-links">
                <li><a href="index.php">ACCUEIL</a></li>
                <li><a href="about.php">À PROPOS</a></li>
                <li><a href="contact.php">CONTACT</a></li>
            </ul>
        </nav>

        <!-- animations(SVG  -->
        <svg class="svg-bg-planet" viewBox="0 0 200 200">
            <ellipse cx="100" cy="100" rx="100" ry="100" fill="#111" />
            <circle cx="60" cy="80" r="30" fill="#fff" opacity="0.13" />
        </svg>
        <svg class="svg-planet" viewBox="0 0 180 100">
            <ellipse cx="90" cy="50" rx="80" ry="40" fill="#111" />
            <ellipse cx="130" cy="30" rx="30" ry="12" fill="#fff" opacity="0.13" />
            <ellipse cx="140" cy="30" rx="40" ry="8" fill="none" stroke="#fff" stroke-width="3" opacity="0.7" />
            <ellipse cx="140" cy="30" rx="50" ry="12" fill="none" stroke="#fff" stroke-width="2" opacity="0.3" />
        </svg>
        <svg class="svg-bg-planet" viewBox="0 0 200 200">
    <ellipse cx="100" cy="100" rx="100" ry="100" fill="#111" />
    <circle cx="60" cy="80" r="30" fill="#fff" opacity="0.13" />
</svg>

<svg class="svg-planet" viewBox="0 0 180 100">
    <ellipse cx="90" cy="50" rx="80" ry="40" fill="#111" />
    <ellipse cx="130" cy="30" rx="30" ry="12" fill="#fff" opacity="0.13" />
    <ellipse cx="140" cy="30" rx="40" ry="8" fill="none" stroke="#fff" stroke-width="3" opacity="0.7" />
    <ellipse cx="140" cy="30" rx="50" ry="12" fill="none" stroke="#fff" stroke-width="2" opacity="0.3" />
</svg>

        <!-- Hi Sect-->
        <section class="hi">
            <div class="hi-title">WELCOME IN YOUR<br />Space</div>
            <div class="hi-desc">
                A playground to learn about different things or technologies "HTML, CSS, JS, and PHP" through a realworld blog projec.
            </div>
        </section>

<div class="posts-container">
    <?php
    require_once 'includes/db.php';
    $stmt = $pdo->query("SELECT * FROM posts ORDER BY created_at DESC");
    while ($post = $stmt->fetch()):
    ?>
        <div class="post-card">
            <?php if (!empty($post['image'])): ?>
                <img src="<?= htmlspecialchars($post['image']) ?>" alt="image article" style="width:100%; height:180px; object-fit:cover;">
            <?php endif; ?>
            <h2><?= htmlspecialchars($post['title']) ?></h2>
            <p>
  <?php
    $excerpt = strip_tags($post['content']); // remoove htmml
    $excerpt = mb_strimwidth($excerpt, 0, 150, "..."); // lmt 150 
    echo htmlspecialchars($excerpt);
    ?>
           </p>
           <a href="post.php?id=<?= $post['id'] ?>">Lire plus</a>

        </div>
    <?php endwhile; ?>
</div>


        <!-- Footer  -->
        <footer class="footer">
            <p>&copy; 2025  madee with love.</p>
        </footer>
    </div>
</body>
</html>