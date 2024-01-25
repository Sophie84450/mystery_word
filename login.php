<?php
    // Démarrer la session PHP
    // Les sessions sont utilisées pour stocker des informations à utiliser sur plusieurs pages.
    session_start();

    // Vérifier si le formulaire a été soumis
    // $_SERVER['REQUEST_METHOD'] contient la méthode de requête utilisée pour accéder à la page (par exemple, POST).
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Connexion à la base de données
        // Créer une nouvelle instance de PDO pour interagir avec la base de données.
        $pdo = new PDO('mysql:host=localhost;dbname=mot_mystere', 'root', '');

        // Récupérer les données envoyées par le formulaire
        // $_POST est un tableau global PHP qui contient les données de formulaire soumises via la méthode POST.
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Préparer la requête SQL pour trouver l'utilisateur
        // Préparation d'une requête SQL pour éviter les injections SQL et améliorer les performances.
        $stmt = $pdo->prepare("SELECT * FROM User WHERE email = ?");
        
        // Exécuter la requête avec le paramètre fourni (email).
        $stmt->execute([$email]);
        
        // Récupérer le premier résultat sous forme de tableau associatif.
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Vérifier si l'utilisateur existe et que le mot de passe est correct
        // password_verify est utilisé pour vérifier un mot de passe haché.
        if ($user && password_verify($password, $user['password'])) {

            // Connexion réussie, stocker l'ID utilisateur dans la session
            // $_SESSION est un tableau global utilisé pour stocker des informations de session.
            $_SESSION['user_id'] = $user['id_user'];

            // Afficher un message de réussite (ceci sera temporaire, car une redirection est effectuée juste après).
            echo "<p>Connexion réussie</p>";

            // Redirection vers mystery_world.php
            // La fonction header est utilisée pour envoyer une en-tête HTTP brut.
            // 'Location: mystery_world.php' redirige le navigateur vers la page donnée.
            header('Location: mystery_word.php');
            exit; // Arrêter l'exécution du script après la redirection.

        } else {
            // Si la connexion échoue, afficher un message d'erreur.
            echo "<p>Identifiants incorrects</p>";
        }
    }
?>

 

<!DOCTYPE html>
<html lang="en">
    <head> 
		<meta name="viewport" content="width=device-width, initial-scale=1">


		<!-- Website CSS style -->
		<link href="css/bootstrap.min.css" rel="stylesheet">

		<!-- Website Font style -->
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
		<link rel="stylesheet" href="../css/login.css">

		<title>Login</title>
	</head>

<body>
    <div id="login">
        <h3 class="text-center text-white pt-5">Login form</h3>
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" action="" method="post">
                            <h3 class="text-center text-info">Login</h3>
                            <div class="form-group">
                                <label for="email" class="text-info">Email:</label><br>
                                <input type="email" name="email" id="email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info">Password:</label><br>
                                <input type="password" name="password" id="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="submit" name="submit" class="btn btn-info btn-md" value="submit">
                            </div>
                            <div id="register-link" class="text-right">
                                <a href="./register.php" class="text-info">Register here</a>
                            </div>
                        </form>
                    </div>
                </div>
             </div>
               
        </div>
    </div>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</body>
</html>