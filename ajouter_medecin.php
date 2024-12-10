<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $specialite = $_POST['specialite'];

    $stmt = $pdo->prepare("
        INSERT INTO medecins (nom, specialite) 
        VALUES (:nom, :specialite)
    ");
    $stmt->execute([
        'nom' => $nom,
        'specialite' => $specialite,
    ]);

    header('Location: list_m.php');
    exit;
}
?>
<!--ALTER TABLE medecins AUTO_INCREMENT = 1;-->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un médecin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4 ">
    <h1 class="text-center fw-semibold mb-4 text-black ">Ajouter un médecin</h1>
    <form method="POST" class="p-4 border rounded">
        <div class="mb-3">
            <label for="nom" class="form-label fw-bold text-black ">Nom :</label>
            <input type="text" name="nom" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="specialite" class="form-label fw-bold text-black ">Spécialité :</label>
            <input type="text" name="specialite" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success rounded-pill fw-semibold">Ajouter</button>
        <a href="list_m.php" class="btn btn-light rounded-pill fw-semibold">Retour</a>
    </form>
</div>
</body>
</html>
