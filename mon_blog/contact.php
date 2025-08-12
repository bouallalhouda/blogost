<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Contact</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
  <header>
    <h1>Contact us !!</h1>
  </header>

  <main style="max-width: 600px; margin: auto; padding: 20px;">
    <form action="https://formspree.io/f/mqalnyal" method="POST">
      <label for="name">Name :</label><br>
      <input type="text" id="name" name="name" required><br><br>

      <label for="email">Email :</label><br>
      <input type="email" id="email" name="email" required><br><br>

      <label for="message">Message :</label><br>
      <textarea id="message" name="message" rows="5" required></textarea><br><br>

      <button type="submit">Envoyer</button>
    </form>
  </main>

  <footer>
    &copy; <?php echo date("Y"); ?> Blog 
  </footer>
</body>
</html>
