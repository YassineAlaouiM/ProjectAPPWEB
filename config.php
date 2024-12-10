<?php
$host = 'localhost';
$db_name = 'traumato_rdv';
$user = 'root';
$password = '';

try {
    $pdo = new PDO('mysql:host=localhost;dbname=traumato_rdv', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connexion avec succès";
} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}

?>
