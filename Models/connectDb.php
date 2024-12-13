<?php 

try {
    $host = "localhost";
    $dbname = "social_media";
    $user = "root";
    $password = "";

    $pdo = new PDO("mysql:host=$host; dbname=$dbname", $user, $password);
} catch (Exception $e) {
    die('Erreur : ' . $e -> getMessage());
}