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
    <title>Liste des patients</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container mt-4">
    
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="me-3 fw-bold text-black ">Liste des Patients</h1>
    <a href="./ajouter_patient.php" class="btn btn-success rounded-pill fw-semibold">Ajouter un patient</a>
</div>
<div class="table-responsive">
    <table class="table table-bordered table-hover table-striped table-sm">
        <thead>
            <tr>
                <th class="text-center text-black  py-2">ID</th>
                <th class="text-center text-black  py-2">Nom</th>
                <th class="text-center text-black  py-2">Prénom</th>
                <th class="text-center text-black  py-2">date de naissance</th>
                <th class="text-center text-black  py-2">telephone</th>
                <th class="text-center text-black  py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($patients as $patient) : ?>
                <tr>
                    <td class="text-center py-2"><?= htmlspecialchars($patient['id']) ?></td>
                    <td class="text-center py-2"><?= htmlspecialchars($patient['nom']) ?></td>
                    <td class="text-center py-2"><?= htmlspecialchars($patient['prenom']) ?></td>
                    <td class="text-center py-2"><?= htmlspecialchars($patient['date_naissance']) ?></td>
                    <td class="text-center py-2"><?= htmlspecialchars($patient['telephone']) ?></td>
                    <td class="text-center py-2">   
                        <a href="modifier_patient.php?id=<?= $patient['id'] ?>" class="btn btn-light rounded-pill fw-semibold">Modifier</a>
                        <a href="supprimer_patient.php?id=<?= $patient['id'] ?>"
                        class="btn btn-light rounded-pill text-danger fw-semibold" onclick="return confirm('Êtes-vous sûr ?');">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </div>
<div class="d-flex justify-content-center mb-3">
    <a href="./index.php" class="btn btn-light fw-semibold text-success x-2">Liste des rendez-vous</a>
    <a href="./list_m.php" class="btn btn-light fw-semibold text-success mx-2">Liste des medecins</a>
</div>

</div>
</body>
</html>
