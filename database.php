// class pour la connection a la bdd
<php?
class Database {
    private $host = "localhost";
    private $dbName = "mot_mystere";
    private $username = "root";
    private $password = "";
    public $conn;

    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbName, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch(PDOException $exception) {
            echo "Erreur de connexion à la base de données: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>

// réutilisation de la connection dans les fichiers php 
<php?
require_once '../Database.php';
//N'oubliez pas de remplacer path/to/Database.php par le chemin réel vers ton fichier de classe.

$database = new Database();
$db = $database->getConnection();
?>
// Utilisez $db pour vos requêtes SQL


//Avantages
Réutilisabilité : Tu n'as besoin de définir tes paramètres de connexion qu'une seule fois.

Maintenance : Si tu dois changer tes paramètres de base de données, tu n'auras qu'un seul endroit à modifier.

Séparation des préoccupations : Ta classe de base de données s'occupe uniquement
 de la connexion à la base de données,
 tandis que le reste de ton code s'occupe de la logique métier.