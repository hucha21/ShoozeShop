<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bazapodataka";
$message = "Neispravan unos podataka.";
// Create connection
global $konekcija;
$konekcija = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($konekcija->connect_error) {
    die("Connection failed: " . $konekcija->connect_error);
} 
?>