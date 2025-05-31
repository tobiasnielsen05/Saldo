<?php
/**
 * @var db $db
 */

require "settings/init.php";

if(!empty($_POST["data"])) {
    $data = $_POST["data"];

    $sql = "INSERT INTO expenses (exAmount, exName, exDate) VALUES(:exAmount, :exName, :exDate)";
    $bind = [":exAmount" => $data["exAmount"], ":exName" => $data["exName"], ":exDate" => $data["exDate"]];

    $db->sql($sql, $bind, false);

    echo "Mobilabonnementet er nu tilføjet. <a href='addMobileExpense.php'>Tilføj et andet mobilabonnement</a> Eller <a href='budgetOverview.php'>Gå tilbage til forsiden</a> ";
    exit;

}

?>
<!DOCTYPE html>
<html lang="da">
<head>
    <meta charset="utf-8">

    <title>Tilføj mobilabonnement / Saldo</title>

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

<!-- Herunder kan du finde formularen til at tilføje ens indkomst. -->
<div class="container mt-3">
    <form action="addMobileExpense.php" method="post">
        <div class="row g-3 justify-content-center">
            <div class="col-10 col-md-7">
                <label for="exAmount" class="form-label text-secondary fw-bold">Beløb:</label>
                <input type="number" step="0.01" class="form-control" id="exAmount" name="data[exAmount]" placeholder="Skriv prisen på abonnementet her" value="">
            </div>
            <div class="col-10 col-md-7">
                <label for="exName" class="form-label text-secondary fw-bold mt-md-3">Abonnement:</label>
                <input type="text" class="form-control" id="exName" name="data[exName]" placeholder="F.eks. Telia eller mobilabonnement" value="">
            </div>
            <div class="col-10 col-md-7 mb-3">
                <label for="exDate" class="form-label text-secondary fw-bold mt-md-3">Vælg Dato:</label>
                <input type="date" class="form-control" id="exDate" name="data[exDate]" placeholder="Vælg Dato" value="">
            </div>
            <div class="col-12 d-flex justify-content-center">
                <button type="submit" class="btn btn-knapfarve text-secondary fw-bold">Tilføj abonnement</button>
            </div>
        </div>
    </form>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
