<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $date_naissance= $_POST['date_naissance'];
    $telephone = $_POST['telephone'];

    $stmt = $pdo->prepare("
        INSERT INTO patients (nom, prenom, date_naissance, telephone) 
        VALUES (:nom, :prenom, :date_naissance, :telephone)
    ");
    $stmt->execute([
        'nom' => $nom,
        'prenom' => $prenom,
        'date_naissance' => $date_naissance,
        'telephone' => $telephone
    ]);
    header('Location: list_p.php');
    exit;
}
?>
<!--ALTER TABLE patients AUTO_INCREMENT = 1;-->
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un patient</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<div class="container mt-4">
    <h1 class="text-center fw-semibold mb-4 text-black ">Ajouter un patient</h1>
    <form method="POST" class="p-4 border rounded">
        <div class="mb-3">
            <label for="nom" class="form-label fw-bold text-black ">Nom :</label>
            <input type="text" name="nom" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="prenom" class="form-label fw-bold text-black ">Prénom :</label>
            <input type="text" name="prenom" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="date_naissance" class="form-label fw-bold text-black ">Date de naissance :</label>
            <input type="date" name="date_naissance" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="telephone" class="form-label fw-bold text-black ">Téléphone :</label>
            <input type="text" name="telephone" class="form-control" placeholder="+212 1 23 45 67 89" pattern="^\+212\s?[5-7]\d{1}(\s?\d{2}){4}$" required >
        </div>

        <button type="submit" class="btn btn-success rounded-pill fw-semibold">Ajouter</button>
        <a href="list_p.php" class="btn btn-light rounded-pill fw-semibold">Retour</a>
    </form>
</div>
</body>
</html>
