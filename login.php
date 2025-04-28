<?php
require 'connect.php';
session_start();

$name = $_POST['name'];
$password = $_POST['password'];

$sql = "SELECT * FROM `employés` WHERE Nom_utilisateur = ? AND motdepasse = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$name, $password]);

$user = $stmt->fetch();

if ($user) {
    $_SESSION['Nom_utilisateur'] = $user['Nom_utilisateur']; // Correction de la casse aussi
    header('Location: dashboard.php');
    exit();
} else {
    echo "Échec de connexion : utilisateur ou mot de passe incorrect.";
}
?>
