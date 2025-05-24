<?php
require_once "./database.php";

$numero = $_GET['identifiant'];

$select_ = "SELECT * FROM employers WHERE identifiant = '$numero' ";
$pre_ = $db->prepare($select_);
$pre_->execute();

if ($pre_->rowCount() > 0) {
    echo "true";
} else  echo "false";
