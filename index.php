<?php include('connexion.php'); ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des contacts</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">
    <h1>📒 Carnet de contacts</h1>

    <!-- Formulaire de recherche -->
    <form method="get" action="index.php">
        <label for="recherche">Rechercher :</label>
        <input type="text" name="recherche" id="recherche" placeholder="Nom ou prénom..." value="<?= htmlspecialchars($_GET['recherche'] ?? '') ?>">
        <button type="submit">🔍 Rechercher</button>
    </form>

    <!-- Liens d'action -->
    <div style="margin-top: 20px; text-align: center;">
        <a href="ajouter.php">➕ Ajouter un contact</a> |
        <a href="export_csv.php">📄 Exporter en CSV</a>
    </div>

    <!-- Tableau des contacts -->
    <table border="1" cellpadding="10" cellspacing="0" style="margin-top: 30px; width: 100%; background-color: #fff;">
        <tr style="background-color: #e6f4ea;">
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Téléphone</th>
            <th>Actions</th>
        </tr>

        <?php
        $recherche = $_GET['recherche'] ?? '';

        if (!empty($recherche)) {
            $stmt = $pdo->prepare("SELECT * FROM contacts WHERE nom LIKE ? OR prenom LIKE ? ORDER BY nom ASC");
            $stmt->execute(["%$recherche%", "%$recherche%"]);
        } else {
            $stmt = $pdo->query("SELECT * FROM contacts ORDER BY nom ASC");
        }

        $resultats = $stmt->fetchAll();

        if (count($resultats) > 0) {
            foreach ($resultats as $contact) {
                echo "<tr>
                        <td>" . htmlspecialchars($contact['nom']) . "</td>
                        <td>" . htmlspecialchars($contact['prenom']) . "</td>
                        <td>" . htmlspecialchars($contact['email']) . "</td>
                        <td>" . htmlspecialchars($contact['telephone']) . "</td>
                        <td>
                            <a href='modifier.php?id={$contact['id']}'>✏️ Modifier</a> |
                            <a href='supprimer.php?id={$contact['id']}' onclick='return confirm(\"Supprimer ce contact ?\")'>🗑️ Supprimer</a>
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='5' style='text-align:center;'>Aucun contact trouvé.</td></tr>";
        }
        ?>
    </table>
</div>
<?php if (!empty($_SESSION['success'])): ?>
    <div class="success"><?= htmlspecialchars($_SESSION['success']) ?></div>
    <?php unset($_SESSION['success']); ?>
<?php endif; ?>

</body>
</html>
