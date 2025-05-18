<?php
/**
 * @var db $db
 */

require "settings/init.php";

if(!empty($_POST["data"])) {
    $data = $_POST["data"];

    $sql = "INSERT INTO expense (exAmount, exName, exDate) VALUES(:exAmount, :exName, :exDate)";
    $bind = [":inAmount" => $data["inAmount"], ":exName" => $data["exName"], ":exDate" => $data["exDate"]];

    $db->sql($sql, $bind, false);

    echo "Huslejen er nu tilføjet. <a href='index.php'>Gå tilbage til forsiden</a> ";
    exit;

}

?>
<!DOCTYPE html>
<html lang="da">
<head>
    <meta charset="utf-8">

    <title>Tilføj Husleje / Saldo</title>

    <meta name="robots" content="All">
    <meta name="author" content="Udgiver">
    <meta name="copyright" content="Information om copyright">

    <link href="css/styles.css" rel="stylesheet" type="text/css">

    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>

<!-- Her har du en navbar. Det er det, som viser logoet oppe i højre -->
<nav class="navbar bg-body-tertiary">
    <div class="container">
        <a class="navbar-brand" href="index.php">
            <img src="" alt="Saldo Logo">
        </a>
    </div>
</nav>

<!-- Herunder kan du finde formularen til at tilføje ens indkomst. -->
<div class="container mt-3">
    <form action="addRentExpense.php" method="post">
        <div class="row g-3">
            <div class="col-12 col-md-4">
                <label for="exAmount" class="form-label">Husleje Pris</label>
                <input type="number" step="0.01" class="form-control" id="exAmount" name="data[exAmount]" placeholder="Skriv din husleje her" value="">
            </div>
            <div class="col-12 col-md-4">
                <label for="exName" class="form-label">Husleje Navn</label>
                <input type="text" class="form-control" id="exName" name="data[exName]" placeholder="Husleje" value="Husleje" disabled>
            </div>
            <div class="col-12 col-md-4">
                <label for="exDate" class="form-label">Vælg Dato</label>
                <input type="date" class="form-control" id="exDate" name="data[exDate]" placeholder="Vælg Dato" value="">
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Tilføj Husleje</button>
            </div>
        </div>
    </form>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
