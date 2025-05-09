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

<body>

<!-- Navbar -->
<nav class="navbar bg-body-tertiary">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="" alt="Saldo Logo">
        </a>
    </div>
</nav>

<!-- Indkomst-sektion -->
<div class="container mt-4">
    <div class="row g-2">
        <div class="col-12 d-flex justify-content-center">
            <h1>Indkomst:</h1>
        </div>

        <?php
        // Hent den samlede indkomst fra databasen
        $result = $db->sql("SELECT SUM(inAmount) AS total FROM income");
        $inAmount = (!empty($result) && isset($result[0]->total)) ? $result[0]->total : 0;

        // Formatter beløbet
        $income = number_format($inAmount, 0, ',', '.');
        ?>

        <div class="col-12 d-flex justify-content-center">
            <div class="bg-dark-subtle p-4 rounded">
                <p class="fs-2 fw-bold mb-0 text-success"><?php echo $income; ?>,- DKK</p>
            </div>
        </div>

        <div class="col-12 col-md-6 mt-3 mt-md-4 d-flex justify-content-md-end justify-content-center">
            <a class="btn btn-primary" href="addIncome.php" role="button">Tilføj Indkomst</a>
        </div>
        <div class="col-12 col-md-6 mt-md-4 d-flex justify-content-md-start justify-content-center">
            <a class="btn btn-primary" href="#" role="button">Ret Indkomst</a>
        </div>
    </div>
</div>

<!-- Udgifter-sektion -->
<div class="container">
    <div class="row">
        <div class="col-12 mt-5 d-flex justify-content-center">
            <h1>Udgifter:</h1>
        </div>
        <div class="col-12 mt-0 d-flex justify-content-center">
            <p>Herunder kan du tilføje dine udgifter</p>
        </div>

        <div class="col-12 col-md-6 d-flex flex-column align-items-md-end align-items-center mb-4 mb-md-5">
            <h3>Husleje</h3>
            <img src="billeder/husleje.png" alt="Husleje billede" class="img-fluid rounded shadow">
        </div>

        <div class="col-12 col-md-6 d-flex flex-column align-items-md-start align-items-center mb-4 mb-md-5">
            <h3>Mobilabonnoment</h3>
            <img src="billeder/internet.png" alt="Internet billede" class="img-fluid rounded shadow">
        </div>

        <div class="col-12 col-md-6 d-flex flex-column align-items-md-end align-items-center mb-4 mb-md-5">
            <h3>Streaming</h3>
            <img src="billeder/mobil.png" alt="Mobil billede" class="img-fluid rounded shadow">
        </div>

        <div class="col-12 col-md-6 d-flex flex-column align-items-md-start align-items-center mb-4 mb-md-5">
            <h3>Dagligvarer</h3>
            <img src="billeder/diverse.png" alt="Diverse billede" class="img-fluid rounded shadow">
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
