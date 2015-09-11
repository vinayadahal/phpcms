<?php
require '../config/credentials.php';
//$host = "localhost";
//
//$root = "root";
//$root_password = "";
//$db = "cms";

try {
    $dbh = new PDO("mysql:host=$host", $root, $root_password);

    $dbh->exec("DROP DATABASE `$db`;");
} catch (PDOException $e) {
    die("DB ERROR: " . $e->getMessage());
}
