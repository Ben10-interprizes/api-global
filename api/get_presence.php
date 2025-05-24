<?php
require_once "./database.php";

$id_employers = $_GET['id'];

$select_ = "SELECT * FROM employers WHERE identifiant = '$id_employers' ";
$pre_ = $db->prepare($select_);
$pre_->execute();

if ($pre_->rowCount() > 0) {

    $select = "SELECT * FROM presence WHERE identifiant = '$id_employers' ";
    $pre = $db->prepare($select);
    $pre->execute();

    $data = $pre->fetch(PDO::FETCH_ASSOC);

    if ($data['today'] != '0') {
        echo json_encode([
            "presence" => true
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
