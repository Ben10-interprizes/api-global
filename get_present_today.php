<?php
require_once "./database.php";

$today = date('Y-m-d'); // Récupère la date du jour

$sql = "SELECT e.nom, e.prenom, e.identifiant, e.numero, e.email, p.heure_arrivee
        FROM employers e
        JOIN presence p ON e.identifiant = p.identifiant
        WHERE p.date_presence = :today";
$stmt = $db->prepare($sql);
$stmt->execute(['today' => $today]);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode([
    "success" => true,
    "data" => $rows
]);
?>
