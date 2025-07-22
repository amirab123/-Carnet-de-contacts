<?php
require_once('connexion.php');

// Préparation des données
$stmt = $pdo->query("SELECT * FROM contacts ORDER BY nom ASC");
$contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);

// En-têtes pour forcer le téléchargement
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=contacts.csv');


$output = fopen('php://output', 'w');

fputcsv($output, ['ID', 'Nom', 'Prénom', 'Email', 'Téléphone']);

foreach ($contacts as $contact) {
    fputcsv($output, [
        $contact['id'],
        $contact['nom'],
        $contact['prenom'],
        $contact['email'],
        $contact['telephone']
    ]);
}

// Fermeture
fclose($output);
exit;
