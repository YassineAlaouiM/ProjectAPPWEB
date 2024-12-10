<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_patient = $_POST['id_patient'];
    $id_medecin = $_POST['id_medecin'];
    $date_consultation = $_POST['date_consultation'];

    $stmt = $pdo->prepare("
        INSERT INTO rdv (id_patient, id_medecin, date_consultation) 
        VALUES (:id_patient, :id_medecin, :date_consultation)
    ");
    $stmt->execute([
        'id_patient' => $id_patient,
        'id_medecin' => $id_medecin,
        'date_consultation' => $date_consultation
    ]);

    header('Location: index.php');
    exit;
}

$patients = $pdo->query("SELECT id, nom, prenom FROM patients")->fetchAll(PDO::FETCH_ASSOC);
$medecins = $pdo->query("SELECT id, nom, specialite FROM medecins")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un rendez-vous</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-4">
        <h1 class="text-center mb-4 text-black fw-semibold ">Ajouter un rendez-vous</h1>
        <form method="POST">
            <div class="mb-3">
                <label for="id_patient" class="form-label fw-bold text-black ">Patient :</label>
                <select name="id_patient" id="id_patient" class="form-select" required>
                    <?php foreach ($patients as $patient): ?>
                        <option value="<?= $patient['id'] ?>"><?= htmlspecialchars($patient['prenom'] . ' ' . $patient['nom']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="id_medecin" class="form-label fw-bold text-black ">Médecin :</label>
                <select name="id_medecin" id="id_medecin" class="form-select" required>
                    <?php foreach ($medecins as $medecin): ?>
                        <option value="<?= $medecin['id'] ?>"><?= htmlspecialchars($medecin['nom'] . ' (' . $medecin['specialite'] . ')') ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="date_consultation" class="form-label fw-bold text-black ">Date et heure :</label>
                <input type="datetime-local" name="date_consultation" id="date_consultation" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-success rounded-pill fw-semibold">Ajouter</button>
            <a href="index.php" class="btn btn-light rounded-pill fw-semibold">Retour</a>
        </form>
    </div>
</body>
</html>
