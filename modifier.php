<?php
require_once('connexion.php');

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM contacts WHERE id = ?");
$stmt->execute([$id]);
$contact = $stmt->fetch();

if (!$contact) {
    echo "Contact introuvable.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un contact</title>
        <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
    <h1>Modifier le contact</h1>
    <form action="traitement_modification.php" method="post">
        <input type="hidden" name="id" value="<?= $contact['id'] ?>">

        <label>Nom :</label><br>
        <input type="text" name="nom" value="<?= htmlspecialchars($contact['nom']) ?>" required><br><br>

        <label>Prénom :</label><br>
        <input type="text" name="prenom" value="<?= htmlspecialchars($contact['prenom']) ?>" required><br><br>

        <label>Email :</label><br>
        <input type="email" name="email" value="<?= htmlspecialchars($contact['email']) ?>"><br><br>

        <label>Téléphone :</label><br>
        <input type="text" name="telephone" value="<?= htmlspecialchars($contact['telephone']) ?>"><br><br>

        <button type="submit">Mettre à jour</button>
    </form>
</div>
    <br>
    <a href="index.php">⬅️ Retour à la liste</a>
</body>
</html>
