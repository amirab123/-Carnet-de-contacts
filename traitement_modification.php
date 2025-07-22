<?php
require_once('connexion.php');

$id = $_POST['id'];
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['email'];
$telephone = $_POST['telephone'];

if (!empty($id) && !empty($nom) && !empty($prenom)) {
    $stmt = $pdo->prepare("UPDATE contacts SET nom = ?, prenom = ?, email = ?, telephone = ? WHERE id = ?");
    $stmt->execute([$nom, $prenom, $email, $telephone, $id]);
}

header('Location: index.php');
exit;
