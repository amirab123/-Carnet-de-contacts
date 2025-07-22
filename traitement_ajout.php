<?php
session_start();
require_once('connexion.php');

$erreurs = [];

// Vérifier si la requête est bien en POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer et nettoyer les données
    $nom = trim($_POST['nom'] ?? '');
    $prenom = trim($_POST['prenom'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $telephone = trim($_POST['telephone'] ?? '');

    // Validation
    if (empty($nom) || strlen($nom) < 2 || strlen($nom) > 100) {
        $erreurs[] = "Le nom est requis (entre 2 et 100 caractères).";
    }

    if (empty($prenom) || strlen($prenom) < 2 || strlen($prenom) > 100) {
        $erreurs[] = "Le prénom est requis (entre 2 et 100 caractères).";
    }

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erreurs[] = "L'email est invalide.";
    }

    if (empty($telephone) || !preg_match('/^[0-9]{8,15}$/', $telephone)) {
        $erreurs[] = "Le téléphone doit contenir entre 8 et 15 chiffres.";
    }


    if (empty($erreurs)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO contacts (nom, prenom, email, telephone) VALUES (?, ?, ?, ?)");
            $stmt->execute([$nom, $prenom, $email, $telephone]);

            $_SESSION['success'] = "Contact ajouté avec succès.";
            header('Location: index.php');
            exit;

        } catch (PDOException $e) {
            $erreurs[] = "Erreur lors de l'insertion en base : " . $e->getMessage();
        }
    }


    $_SESSION['erreurs'] = $erreurs;
    $_SESSION['old'] = [
        'nom' => $nom,
        'prenom' => $prenom,
        'email' => $email,
        'telephone' => $telephone,
    ];
    header('Location: ajouter.php');
    exit;
} else {
 
    header('Location: ajouter.php');
    exit;
}
