<?php
session_start();
if (!isset($_SESSION['Nom_utilisateur'])) {
    header('Location: connexion.html');
    exit();
}
$nom_utilisateur = $_SESSION['Nom_utilisateur'];

require 'connect.php'; 

$stmt = $conn->query("SELECT Nom_utilisateur, paie, conges FROM employés");
$employes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Tableau de bord</title>
    <link rel="stylesheet" href="style_dashboard.css">
</head>
<?php
$noms = [];
$paies = [];
$conges = [];

foreach ($employes as $employe) {
    $noms[] = $employe['Nom_utilisateur'];
    $paies[] = $employe['paie'];
    $conges[] = $employe['conges'];
}
?>
<body>
<header>
    <div class="logo">
        <a href="connexion.html"><img src="logo.png" alt="Logo"></a>
    </div>
    <nav>
        <ul>
            <li><a href="connexion.html">Accueil</a></li>
        </ul>
    </nav>
</header>
<main>
    <div class="dashboard-container">
        <h2 class="dashboard-title">Bienvenue, <?php echo htmlspecialchars($nom_utilisateur); ?> !</h2>

        <div class="chart-container">
            <h3 class="chart-title">Graphique des Salaires</h3>
            <canvas id="paieChart"></canvas>
        </div>

        <div class="chart-container">
            <h3 class="chart-title">Graphique des Congés</h3>
            <canvas id="congesChart"></canvas>
        </div>

        <a class="link" href="gestion_admin.php">Gestion des employés</a>
    </div>
</main>

<footer>
    <p>Projet SIRH / Héloïse - Simon - Léna - Ilhan</p>
</footer>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const noms = <?php echo json_encode($noms); ?>;
const paies = <?php echo json_encode($paies); ?>;
const conges = <?php echo json_encode($conges); ?>;
const ctxPaie = document.getElementById('paieChart').getContext('2d');
new Chart(ctxPaie, {
    type: 'bar',
    data: {
        labels: noms,
        datasets: [{
            label: 'Salaire (€)',
            data: paies,
            backgroundColor: 'rgba(106, 90, 205, 0.7)',
            borderColor: 'rgba(106, 90, 205, 1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: { beginAtZero: true }
        }
    }
});
const ctxConges = document.getElementById('congesChart').getContext('2d');
new Chart(ctxConges, {
    type: 'bar',
    data: {
        labels: noms,
        datasets: [{
            label: 'Congés (jours)',
            data: conges,
            backgroundColor: 'rgba(60, 179, 113, 0.7)',
            borderColor: 'rgba(60, 179, 113, 1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: { beginAtZero: true }
        }
    }
});
</script>
</body>
</html>
