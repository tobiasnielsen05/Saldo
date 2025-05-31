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

<!-- Indkomst-sektion -->
<div class="container mt-4">
    <div class="row g-2 justify-content-center">

        <?php
        // Hent den samlede indkomst fra databasen
        $result = $db->sql("SELECT SUM(inAmount) AS total FROM income");
        $inAmount = (!empty($result) && isset($result[0]->total)) ? $result[0]->total : 0;

        // Formatter beløbet
        $income = number_format($inAmount, 0, ',', '.');
        ?>

        <div class="col-9 col-md-3">
            <!-- Indkomst og Udgifter-boks -->
            <div class="card bg-light mb-2 mx-auto">
                <div class="card-header fw-bold text-secondary">Indkomst:</div>
                <div class="card-body">
                    <p class="fs-3 fw-bold mb-0 text-center text-success"><?php echo $income; ?>,- DKK</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-12 col-md-6 mt-3 mt-md-3 d-flex justify-content-md-end justify-content-center">
            <a class="btn btn-knapfarve text-secondary fw-bold" href="addIncome.php" role="button">Tilføj Indkomst</a>
        </div>
        <div class="col-12 col-md-6 mt-3 mt-md-3 d-flex justify-content-md-start justify-content-center">
            <a class="btn btn-knapfarve text-secondary fw-bold" href="incomeList.php" role="button">Ret Indkomst</a>
        </div>
    </div>
</div>

<!-- Udgifter-sektion -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 mt-5 d-flex justify-content-center">
            <h1 class="text-secondary fw-bold">Udgifter:</h1>
        </div>
        <div class="col-12 mt-0 d-flex justify-content-center">
            <p class="text-secondary">Herunder kan du tilføje dine udgifter</p>
        </div>

        <div class="col-6 d-flex justify-content-md-end justify-content-center mb-4 mb-md-4">
            <a href="addRentExpense.php">
                <div class="position-relative text-center">
                    <img src="images/husleje150x150.png" alt="Husleje billede" class="img-fluid rounded shadow">
                    <!-- Mørk overlay -->
                    <div class="position-absolute top-0 start-0 w-100 h-100 bg-secondary bg-opacity-25 rounded"></div>
                    <!-- Tekst foran billedet -->
                    <h3 class="position-absolute top-50 start-50 translate-middle text-white fw-bold m-0">Husleje</h3>
                </div>
            </a>
        </div>

        <div class="col-6 d-flex justify-content-md-start justify-content-center mb-4 mb-md-4">
            <a href="addStreamingExpense.php">
                <div class="position-relative text-center">
                    <img src="images/streaming150x150.webp" alt="Streaming billede" class="img-fluid rounded shadow">
                    <!-- Mørk overlay -->
                    <div class="position-absolute top-0 start-0 w-100 h-100 bg-secondary bg-opacity-25 rounded"></div>
                    <!-- Tekst foran billedet -->
                    <h3 class="position-absolute top-50 start-50 translate-middle text-white fw-bold m-0">Streaming</h3>
                </div>
            </a>
        </div>

        <div class="col-6 d-flex justify-content-md-end justify-content-center mb-4 mb-md-5">
            <a href="addMobileExpense.php">
                <div class="position-relative text-center">
                    <img src="images/mobile150x150.webp" alt="Mobil billede" class="img-fluid rounded shadow">
                    <!-- Mørk overlay -->
                    <div class="position-absolute top-0 start-0 w-100 h-100 bg-secondary bg-opacity-25 rounded"></div>
                    <!-- Tekst foran billedet -->
                    <h3 class="position-absolute top-50 start-50 translate-middle text-white fw-bold m-0">Mobil</h3>
                </div>
            </a>
        </div>

        <div class="col-6 d-flex justify-content-md-start justify-content-center mb-4 mb-md-5">
            <a href="addDiverseExpense.php">
                <div class="position-relative text-center">
                    <img src="images/diverse150x150.webp" alt="Diverse billede" class="img-fluid rounded shadow">
                    <!-- Mørk overlay -->
                    <div class="position-absolute top-0 start-0 w-100 h-100 bg-secondary bg-opacity-25 rounded"></div>
                    <!-- Tekst foran billedet -->
                    <h3 class="position-absolute top-50 start-50 translate-middle text-white fw-bold m-0">Diverse</h3>
                </div>
            </a>
        </div>

        <div class="col-12 text-center mb-4">
            <a class="btn btn-knapfarve text-secondary fw-bold p-2" href="expenseList.php">Vis alle udgifter</a>
        </div>

        <div class="col-12 text-center mt-5 mb-4">
            <a class="btn btn-knapfarve text-secondary fw-bold p-2" href="index.php">Vis til rådighed</a>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>