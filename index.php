<?php
/**
 * @var db $db
 */

require "settings/init.php";
?>
<!DOCTYPE html>
<html lang="da">
<head>
    <meta charset="utf-8">
    <title>Forside / Saldo</title>
    <meta name="robots" content="All">
    <meta name="author" content="Udgiver">
    <meta name="copyright" content="Information om copyright">
    <link href="css/styles.css" rel="stylesheet" type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body class="bg-primary">

<!-- Navbar -->
<nav class="navbar">
    <div class="container d-flex justify-content-center">
        <a class="navbar d-flex justify-content-center" href="index.php">
            <img class="w-75 img-fluid" src="images/saldologo150x150.webp" alt="Saldo Logo">
        </a>
    </div>
</nav>

<?php
// Beregn indkomst og udgifter
$incomeTotal = $db->sql("SELECT SUM(inAmount) AS total FROM income")[0]->total ?? 0;
$expenseTotal = $db->sql("SELECT SUM(exAmount) AS total FROM expenses")[0]->total ?? 0;
$available = $incomeTotal - $expenseTotal;

// Farve og tekst baseret på beløb
if ($available > 1000) {
    $cardClass = "bg-success";
    $statusText = "💰 God økonomi";
    $statusIcon = "💰";
} else if ($available >= 500) {
    $cardClass = "bg-warning";
    $statusText = "⚠️ Vær opmærksom";
    $statusIcon = "⚠️";
} else if($available > 0) {
    $cardClass = "bg-danger";
    $statusText = "🚨 Overforbrug!";
    $statusIcon = "🚨";
} else if($available == 0) {
    $cardClass = "bg-dark opacity-75";
    $statusText = "";
    $statusIcon = "";
}
?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-9 col-md-3">
            <!-- Til rådighed-boks -->
            <div class="card text-white <?php echo $cardClass; ?> mb-4 mx-auto">
                <div class="card-header fw-bold">Til rådighed: <?php echo $statusText; ?></div>
                <div class="card-body text-center">
                    <h4 class="card-title fw-semibold"><?php echo number_format($available, 2, ',', '.'); ?> kr</h4>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-9 col-md-3">
            <!-- Indkomst og Udgifter-boks -->
            <div class="card bg-light mb-3 mx-auto">
                <div class="card-header text-secondary fw-bold">Detaljer:</div>
                <div class="card-body">
                    <p class="card-text text-secondary"><strong>Indkomst:</strong> <?php echo number_format($incomeTotal, 2, ',', '.'); ?> kr</p>
                    <p class="card-text text-secondary"><strong>Udgifter:</strong> -<?php echo number_format($expenseTotal, 2, ',', '.'); ?> kr</p>
                </div>
            </div>
        </div>
        <div class="col-12 mt-4 text-center">
            <a class="btn btn-knapfarve text-secondary fw-bold p-2" href="budgetOverview.php">Gå til oversigt</a>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
