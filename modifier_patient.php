<?php
require 'config.php';

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM patients WHERE id = :id");
$stmt->execute(['id' => $id]);
$patient = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$patient) {
    die('Patient non trouvé.');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $date_naissance= $_POST['date_naissance'];
    $telephone = $_POST['telephone'];

    $stmt = $pdo->prepare("
        UPDATE patients 
        SET nom = :nom, prenom = :prenom, date_naissance = :date_naissance, telephone = :telephone
        WHERE id = :id
    ");
    $stmt->execute([
        'id' => $id,
        'nom' => $nom,
        'prenom' => $prenom,
        'date_naissance' => $date_naissance,
        'telephone' => $telephone
    ]);

    header('Location: list_p.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un patient</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container mt-4">
    <h1 class="text-center mb-4">Modifier un patient</h1>
    <form method="POST" class="p-4 border rounded">
        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" name="nom" class="form-control" value="<?= htmlspecialchars($patient['nom']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="prenom" class="form-label">Prénom</label>
            <input type="text" name="prenom" class="form-control" value="<?= htmlspecialchars($patient['prenom']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="date_naissance" class="form-label">Date de naissance</label>
            <input type="date" name="date_naissance" class="form-control" value="<?= htmlspecialchars($patient['date_naissance']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="telephone" class="form-label">Téléphone</label>
            <input type="text" name="telephone" class="form-control" pattern="^\+212\s?[5-7]\d{1}(\s?\d{2}){4}$" value="<?= htmlspecialchars($patient['telephone']) ?>" required>
        </div>
        <button type="submit" class="btn btn-success rounded-pill fw-semibold">Modifier</button>
        <a href="list_p.php" class="btn btn-light rounded-pill fw-semibold">Retour</a>
    </form>
</div>
</body>
</html>
