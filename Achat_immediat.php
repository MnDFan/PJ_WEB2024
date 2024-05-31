<?php
session_start();
$host = '127.0.0.1';
$db = 'agora';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Vérifier si l'utilisateur existe
    $stmt = $pdo->prepare('SELECT * FROM acheteur WHERE `e-mail` = ?');
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user) {
        // Vérifier le mot de passe
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['ID_acheteur'];
        } else {
            echo 'Mot de passe incorrect.';
            exit;
        }
    } else {
        // Créer un nouveau compte
        $stmt = $pdo->prepare('INSERT INTO acheteur (`nom`, `prenom`, `e-mail`, `password`) VALUES (?, ?, ?, ?)');
        $stmt->execute([$_POST['nom'], $_POST['prenom'], $email, password_hash($password, PASSWORD_DEFAULT)]);
        $_SESSION['user_id'] = $pdo->lastInsertId();
    }

    // Sauvegarder les informations de livraison et paiement
    $stmt = $pdo->prepare('INSERT INTO livraison (`ID_acheteur`, `nom`, `prenom`, `adresse1`, `adresse2`, `ville`, `code_postal`, `pays`, `telephone`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)');
    $stmt->execute([$_SESSION['user_id'], $_POST['nom'], $_POST['prenom'], $_POST['adresse1'], $_POST['adresse2'], $_POST['ville'], $_POST['code_postal'], $_POST['pays'], $_POST['telephone']]);

    $stmt = $pdo->prepare('INSERT INTO paiement (`ID_acheteur`, `type_carte`, `numero_carte`, `nom_carte`, `expiration_carte`, `securite_carte`) VALUES (?, ?, ?, ?, ?, ?)');
    $stmt->execute([$_SESSION['user_id'], $_POST['type_carte'], $_POST['numero_carte'], $_POST['nom_carte'], $_POST['expiration_carte'], $_POST['securite_carte']]);

    echo 'Commande passée avec succès!';
}
?>

