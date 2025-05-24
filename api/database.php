<?php
header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set("Africa/Porto-Novo");

try {
    $host = "dpg-d0jt5hje5dus73b97v10-a.oregon-postgres.render.com";
    $db   = "db_agent_ventes";
    $user = "db_agent_ventes_user";
    $pass = "ZSPMn6b02IEfWpESffxCYJpUUTan7pES";
    $port = "5432";

    $db = new PDO(
        "pgsql:host=$host;port=$port;dbname=$db",
        $user,
        $pass,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
} catch (Exception $e) {
    die('Error :' . $e->getMessage());
}
