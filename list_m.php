<?php
require 'config.php';

$patients = $pdo->query("SELECT * FROM patients")->fetchAll(PDO::FETCH_ASSOC);
$medecins = $pdo->query("SELECT * FROM medecins")->fetchAll(PDO::FETCH_ASSOC);
$rendezvous = $pdo->query("
    SELECT rdv.id, patients.nom AS patient_nom, patients.prenom AS patient_prenom, 
           medecins.nom AS medecin_nom, medecins.specialite, rdv.date_consultation 
    FROM rdv 
    JOIN patients ON rdv.id_patient = patients.id 
    JOIN medecins ON rdv.id_medecin = medecins.id
")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des medecins</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container mt-4">

<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="me-3 fw-bold text-black ">Liste des Médecins</h1>
    <a href="./ajouter_medecin.php" class="btn btn-success rounded-pill fw-semibold">Ajouter un médecin</a>
</div>
<div class="table-responsive">
    <table class="table table-bordered table-hover table-striped table-sm">
        <thead>
            <tr>
                <th class="text-center text-black  py-2">ID</th>
                <th class="text-center text-black  py-2">Nom</th>
                <th class="text-center text-black  py-2">Spécialité</th>
                <th class="text-center text-black  py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($medecins as $medecin) : ?>
                <tr>
                    <td class="text-center py-2"><?= htmlspecialchars($medecin['id']) ?></td>
                    <td class="text-center py-2"><?= htmlspecialchars($medecin['nom']) ?></td>
                    <td class="text-center py-2"><?= htmlspecialchars($medecin['specialite']) ?></td>
                    <td class="text-center py-2">
                        <a href="modifier_medecin.php?id=<?= $medecin['id'] ?>" class="btn btn btn-light rounded-pill fw-semibold">Modifier</a>
                        <a href="supprimer_medecin.php?id=<?= $medecin['id'] ?>"
                        class="btn btn-light rounded-pill text-danger fw-semibold" onclick="return confirm('Êtes-vous sûr ?');">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<div class="d-flex justify-content-center mb-3">
    <a href="./index.php" class="btn btn-light fw-semibold text-success x-2">Liste des rendez-vous</a>
    <a href="./list_p.php" class="btn btn-light fw-semibold text-success mx-2">Liste des patients</a>
</div>

</div>
</body>
</html>
