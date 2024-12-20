<?php
$servername = "localhost";
$username = "root";  // ou l'utilisateur de votre base de données
$password = "";  // ou votre mot de passe
$dbname = "nom_de_votre_base";  // Remplacez par le nom de votre base de données

// Créer une connexion
$conn = new mysqli("localhost", "root", "", "punu");

// Vérifier la connexion
if ($conn->connect_error) {
    die("La connexion a échoué: " . $conn->connect_error);
}
?>
