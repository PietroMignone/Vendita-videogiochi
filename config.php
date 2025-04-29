<?php
session_start();

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "gamenexus";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica connessione
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}
?>
