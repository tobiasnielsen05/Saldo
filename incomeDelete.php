<?php
/** @var PDO $db */
require "settings/init.php";
$inId = $_GET["inId"];

if(empty($inId)) {
    header("Location: incomeList.php");
    exit;
}

$sql = "DELETE FROM income WHERE inId = :inId";
$db->sql($sql, [":inId" => $inId]);
?>

<!DOCTYPE html>
<html lang="da">
<head>
    <meta charset="utf-8">
    <title>Fjern indkomst / Saldo</title>
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

<!-- Indhold i midten -->
<div class="container text-center mt-3">
    <div class="row justify-content-center">
        <div class="col-10 col-md-5 bg-white rounded p-4 shadow">
            <h3 class="text-success fw-bold mb-3">✅ Indkomsten er nu slettet</h3>
            <a href="incomeList.php" class="btn btn-knapfarve fw-bold mt-3">Tilbage til oversigten</a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
