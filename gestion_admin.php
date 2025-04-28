<?php
session_start();
if (!isset($_SESSION['Nom_utilisateur']) || $_SESSION['Nom_utilisateur'] != 'admin') {
    header('Location: connexion.html');
    exit();
}
require 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id'], $_POST['paie'], $_POST['conges'])) {
        $id = intval($_POST['id']);
        $paie = floatval($_POST['paie']);
        $conges = intval($_POST['conges']);

        $sql = "UPDATE `employés` SET paie = ?, conges = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        if ($stmt->execute([$paie, $conges, $id])) {
            echo "<p style='color: green;'>Mise à jour réussie ✅</p>";
        } else {
            echo "<p style='color: red;'>Erreur lors de la mise à jour ❌</p>";
        }
    }
}

$stmt = $conn->query("SELECT id, Nom_utilisateur, paie, conges FROM employés");
$employes = $stmt->fetchAll();
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier Employés</title>
    <link rel="stylesheet" href="style_form.css">
</head>
<body>
<h2>Modifier Paie et Congés des Employés</h2>

<form  method="POST">
    <label for="id">Sélectionner un employé :</label>
    <select name="id" required>
        <?php foreach ($employes as $employe): ?>
            <option value="<?= $employe['id'] ?>">
                <?= htmlspecialchars($employe['Nom_utilisateur']) ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <label for="paie">Nouveau salaire (€) :</label>
    <input type="number" name="paie" step="100" required><br><br>

    <label for="conges">Nouveau nombre de jours de congés :</label>
    <input type="number" name="conges" required><br><br>

    <button type="submit">Mettre à jour</button>
    <a href="dashboard.php" class="back-link">Retour au tableau de bord</a>
</form>

</body>
</html>
