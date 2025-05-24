<?php
require_once "./database.php";

// On suppose que la colonne "today" dans la table "presence" indique la présence du jour (1=présent)
$sql = "SELECT e.nom, e.prenom, e.identifiant, e.numero, e.email
        FROM employers e
        JOIN presence p ON e.identifiant = p.identifiant
        WHERE p.today != '0'";

$stmt = $db->prepare($sql);
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode([
    "success" => true,
    "data" => $rows
]);
?>
