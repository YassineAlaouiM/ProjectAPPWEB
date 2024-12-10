<?php
require 'config.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("DELETE FROM rdv WHERE id = :id");
$stmt->execute(['id' => $id]);

header('Location: index.php');
exit;
?>
