<?php
require 'config.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("DELETE FROM patients WHERE id = :id");
$stmt->execute(['id' => $id]);

header('Location: list_p.php');
exit;
?>
