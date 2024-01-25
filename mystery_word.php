<?php
// Connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=mot_mystere', 'root', '');

// Requête pour obtenir le mot mystère
$stmt = $pdo->query("SELECT world FROM mystery_world LIMIT 1");
$mysteryWord = $stmt->fetch(PDO::FETCH_ASSOC)['world'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mystery World</title>
    <link rel="stylesheet" href="../css/mystery_word.css">

</head>

<body>
    <div class="mystery-container">
        <p>Le mot mystère est : <?php echo htmlspecialchars($mysteryWord); ?></p>
   <br>
    <a href="../../index.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">retour acceuil </a>
</div>
</body>

</html>