<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html lang="en">

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">


	<!-- Website CSS style -->
	<link href="css/bootstrap.min.css" rel="stylesheet">

	<!-- Website Font style -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
	<link rel="stylesheet" href="../css/register.css">
	<!-- Google Fonts -->
	<link href='https://fonts.googleapis.com/css?family=Passion+One' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>

	<title>Register</title>
</head>

<body>
	<div class="container">
		<div class="row main">
			<div class="main-login main-center">
				<h5>Sign up once and watch any of our free demos.</h5>
				<form class="" method="post" action="#">

					<div class="form-group">
						<label for="name" class="cols-sm-2 control-label">Your First Name</label>
						<div class="cols-sm-10">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
								<input type="text" class="form-control" name="name" id="name" placeholder="Enter your First Name" />
							</div>
						</div>
					</div>

					<div class="form-group">
						<label for="name" class="cols-sm-2 control-label">Your Last Name</label>
						<div class="cols-sm-10">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
								<input type="text" class="form-control" name="name" id="name" placeholder="Enter your Last Name" />
							</div>
						</div>
					</div>

					<div class="form-group">
						<label for="email" class="cols-sm-2 control-label">Your Email</label>
						<div class="cols-sm-10">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
								<input type="email" class="form-control" name="email" id="email" placeholder="Enter your Email" />
							</div>
						</div>
					</div>

					<div class="form-group">
						<label for="password" class="cols-sm-2 control-label">Password</label>
						<div class="cols-sm-10">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
								<input type="password" class="form-control" name="password" id="password" placeholder="Enter your Password" />
							</div>
						</div>
					</div>
					<div class="form-group">
						<a href="./login.php" class="text-info">Login here</a><br>
						<input type="submit" name="submit" class="btn btn-info btn-md" value="submit">
					</div>

				</form>
			</div>
		</div>
		<?php
		// Vérifier si le formulaire a été soumis en utilisant la méthode POST
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			// Récupérer les données envoyées par le formulaire
			$first_name = $_POST['first_name'];
			$last_name = $_POST['last_name'];
			$email = $_POST['email'];
			$password = $_POST['password'];

			// Vérifier la complexité du mot de passe
			// utilisation de regex (expression réguliere pour que le mdp soit formater )
			if (!preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/", $password)) {
				// Si le mot de passe ne respecte pas la politique de complexité, afficher un message d'erreur
				echo "<p style='color: red;'>Le mot de passe doit contenir au moins 8 caractères, dont des majuscules, des minuscules, et des chiffres.</p>";

				exit; // Arrêter l'exécution du script
			}
			// Connexion à la base de données
			// Utilisation de PDO (PHP Data Objects) pour se connecter à la base de données.
			// 'mysql:host=localhost;dbname=mot_mystere' spécifie le type de base de données (MySQL), l'hôte (localhost) et le nom de la base de données (mot_mystere).
			// 'root' et '' sont respectivement le nom d'utilisateur et le mot de passe pour se connecter à la base de données.
			$pdo = new PDO('mysql:host=localhost;dbname=mot_mystere', 'root', '');

			// Récupérer les données envoyées par le formulaire
			// $_POST est un tableau qui contient les données soumises via le formulaire.
			$email = $_POST['email'];
			$password = $_POST['password'];

			// Hacher le mot de passe
			// La fonction password_hash est utilisée pour hacher le mot de passe de manière sécurisée.
			// PASSWORD_DEFAULT est un algorithme de hachage qui peut être modifié par PHP à l'avenir pour une meilleure sécurité.
			$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

			// Préparer et exécuter la requête SQL pour insérer l'utilisateur dans la base de données
			// La requête est préparée avec des placeholders '?' pour éviter les injections SQL.
			$stmt = $pdo->prepare("INSERT INTO User (email, password) VALUES (?, ?)");
			$stmt->execute([$email, $hashedPassword]);

			// Afficher un message après l'inscription
			// Ceci est un simple feedback pour l'utilisateur indiquant que l'inscription a été réussie.
			echo "<p>Inscription réussie !</p>";
		}
		?>

	</div>
	<br>
	<a href="../../index.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">retour acceuil </a>

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="js/bootstrap.min.js"></script>
</body>

</html>