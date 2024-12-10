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
    <title>Liste des rendez-vous</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">    
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="me-3 fw-bold text-black">Liste des Rendez-vous</h1> 
            <a href="./ajouter_rdv.php" class="btn btn-success rounded-pill fw-semibold">Ajouter un rendez-vous</a>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped table-sm">
                <thead>
                    <tr>
                        <th class="text-center text-black  py-2">Patient</th>
                        <th class="text-center text-black  py-2">Médecin</th>
                        <th class="text-center text-black py-2">Date et heure</th>
                        <th class="text-center text-black py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rendezvous as $rdv) : ?>
                        <tr>
                            <td class="text-center py-2"><?= htmlspecialchars($rdv['patient_prenom'] . ' ' . $rdv['patient_nom']) ?></td>
                            <td class="text-center py-2"><?= htmlspecialchars($rdv['medecin_nom'] . ' (' . $rdv['specialite'] . ')') ?></td>
                            <td class="text-center py-2"><?= htmlspecialchars($rdv['date_consultation']) ?></td>
                            <td class="text-center py-2">
                                <a href="modifier_rdv.php?id=<?= $rdv['id'] ?>" class="btn btn-light rounded-pill fw-semibold">Modifier</a>
                                <a href="supprimer_rdv.php?id=<?= $rdv['id'] ?>" 
                                class="btn btn-light rounded-pill text-danger fw-semibold" onclick="return confirm('Êtes-vous sûr ?');">Supprimer</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center mb-3">
            <a href="./list_p.php" class="btn btn-light fw-semibold text-success mx-2">Liste des patients</a>
            <a href="./list_m.php" class="btn btn-light fw-semibold text-success mx-2">Liste des medecins</a>
        </div>
    </div>
    </body>
</html>
