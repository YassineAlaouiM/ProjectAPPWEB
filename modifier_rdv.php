<?php
require 'config.php';

$id = $_GET['id'];

$stmt = $pdo->prepare("
    SELECT * FROM rdv 
    WHERE id = :id
");
$stmt->execute(['id' => $id]);
$rdv = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$rdv) {
    die('Rendez-vous non trouvé.');
}

$patients = $pdo->query("SELECT id, nom, prenom FROM patients")->fetchAll(PDO::FETCH_ASSOC);
$medecins = $pdo->query("SELECT id, nom, specialite FROM medecins")->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_patient = $_POST['id_patient'];
    $id_medecin = $_POST['id_medecin'];
    $date_consultation = $_POST['date_consultation'];

    $stmt = $pdo->prepare("
        UPDATE rdv 
        SET id_patient = :id_patient, id_medecin = :id_medecin, date_consultation = :date_consultation
        WHERE id = :id
    ");
    $stmt->execute([
        'id' => $id,
        'id_patient' => $id_patient,
        'id_medecin' => $id_medecin,
        'date_consultation' => $date_consultation,
    ]);

    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un rendez-vous</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body>
<div class="container mt-4">
    <h1 class="text-center mb-4">Modifier un rendez-vous</h1>
    <form method="POST" class="p-4 border rounded">
        <div class="mb-3">
            <label for="id_patient" class="form-label">Patient</label>
            <select name="id_patient" class="form-select" required>
                <?php foreach ($patients as $patient): ?>
                    <option value="<?= $patient['id'] ?>" <?= $patient['id'] == $rdv['id_patient'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($patient['prenom'] . ' ' . $patient['nom']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="id_medecin" class="form-label">Médecin</label>
            <select name="id_medecin" class="form-select" required>
                <?php foreach ($medecins as $medecin): ?>
                    <option value="<?= $medecin['id'] ?>" <?= $medecin['id'] == $rdv['id_medecin'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($medecin['nom'] . ' (' . $medecin['specialite'] . ')') ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="date_consultation" class="form-label">Date et heure</label>
            <input type="datetime-local" name="date_consultation" class="form-control" 
                   value="<?= date('Y-m-d\TH:i', strtotime($rdv['date_consultation'])) ?>" required>
        </div>
        <button type="submit" class="btn btn-success rounded-pill fw-semibold">Modifier</button>
        <a href="list_p.php" class="btn btn-light rounded-pill fw-semibold">Retour</a>
    </form>
</div>
</body>
</html>
