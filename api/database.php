<?php

header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set("Africa/Porto-Novo");

try {
    $user = 'root';
    $pass = "";
    $db = new PDO('mysql:host=localhost;dbname=tolaro_base;charset=utf8mb4', $user, $pass);
} catch (Exception $e) {
    die('Error :' . $e->getMessage());
}
