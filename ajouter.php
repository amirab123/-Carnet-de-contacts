<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un contact</title>
        <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
          <?php if (!empty($erreurs)) : ?>
            <div class="erreur">
                <ul>
                    <?php foreach ($erreurs as $erreur) : ?>
                        <li><?= htmlspecialchars($erreur) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
    <h1>Ajouter un nouveau contact</h1>
    <form action="traitement_ajout.php" method="post" >
       <label for="nom">Nom :</label>
    <input type="text" name="nom" id="nom" required minlength="2" maxlength="100">

    <label for="prenom">Prénom :</label>
    <input type="text" name="prenom" id="prenom" required minlength="2" maxlength="100">

    <label for="email">Email :</label>
    <input type="email" name="email" id="email" required>

    <label for="telephone">Téléphone :</label>
    <input type="text" name="telephone" id="telephone" pattern="[0-9]{8,15}" title="Entrez un numéro valide" required>

        <button type="submit">Enregistrer</button>
    </form>

    <br>
    <a href="index.php">⬅️ Retour à la liste</a>
    </div>



</body>
</html>
