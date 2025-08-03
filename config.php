<?php

$host = "localhost";
$user = "root";
$motdepasse = "";
$database = "users_db";

$conn = new mysqli($host, $user, $motdepasse, $database);

if ($conn->connect_error){
    die("Echec de la connexion: ". $conn->connect_error);
}

?>