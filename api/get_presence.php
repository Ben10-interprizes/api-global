<?php
require_once "./database.php";

// Récupère la date du jour
$today = date('Y-m-d');

if (isset($_GET['id'])) {
    // Cas 1 : présence d'un identifiant → vérification individuelle
    $id_employers = $_GET['id'];

    // Vérifie si l'employé existe
    $select_ = "SELECT * FROM employers WHERE identifiant = :id";
    $pre_ = $db->prepare($select_);
    $pre_->execute(['id' => $id_employers]);

    if ($pre_->rowCount() > 0) {
        // Cherche la présence pour aujourd'hui
        $select = "SELECT * FROM presence WHERE identifiant = :id AND date_presence = :today";
        $pre = $db->prepare($select);
        $pre->execute(['id' => $id_employers, 'today' => $today]);

        $data = $pre->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            echo json_encode([
                "presence" => true,
                "heure_arrivee" => $data['heure_arrivee']
            ]);
        } else {
            echo json_encode([
                "presence" => false
            ]);
        }
    } else {
        echo json_encode([
            "existance" => false
        ]);
    }
} else {
    // Cas 2 : pas d'identifiant → liste de tous les présents aujourd'hui
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
}
?>
