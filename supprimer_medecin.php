<?php
require 'config.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("DELETE FROM medecins WHERE id = :id");
$stmt->execute(['id' => $id]);

header('Location: list_m.php');
exit;
?>
