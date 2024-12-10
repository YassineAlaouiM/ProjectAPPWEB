<?php
require 'config.php';

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM medecins WHERE id = :id");
$stmt->execute(['id' => $id]);
$medecin = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$medecin) {
    die('Médecin non trouvé.');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $specialite = $_POST['specialite'];

    $stmt = $pdo->prepare("
        UPDATE medecins 
        SET nom = :nom, specialite = :specialite 
        WHERE id = :id
    ");
    $stmt->execute([
        'id' => $id,
        'nom' => $nom,
        'specialite' => $specialite,
    ]);

    header('Location: list_m.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un médecin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body>
<div class="container mt-4">
    <h1 class="text-center mb-4">Modifier un médecin</h1>
    <form method="POST" class="p-4 border rounded">
        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" name="nom" class="form-control" value="<?= htmlspecialchars($medecin['nom']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="specialite" class="form-label">Spécialité</label>
            <input type="text" name="specialite" class="form-control" value="<?= htmlspecialchars($medecin['specialite']) ?>" required>
        </div>
        <button type="submit" class="btn btn-success rounded-pill fw-semibold">Modifier</button>
        <a href="list_p.php" class="btn btn-light rounded-pill fw-semibold">Retour</a>
    </form>
</div>
</body>
</html>
