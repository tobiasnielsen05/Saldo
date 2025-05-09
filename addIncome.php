<?php
/**
 * @var db $db
 */

require "settings/init.php";

if(!empty($_POST["data"])) {
    $data = $_POST["data"];

    $sql = "INSERT INTO income (inAmount, inName) VALUES(:inAmount, :inName)";
    $bind = [":inAmount" => $data["inAmount"], ":inName" => $data["inName"]];

    $db->sql($sql, $bind, false);

    echo "Indkomsten er nu tilføjet";
    exit;

}

?>
<!DOCTYPE html>
<html lang="da">
<head>
    <meta charset="utf-8">

    <title>Tilføj Indkomst / Saldo</title>

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
        <a class="navbar-brand" href="#">
            <img src="" alt="Saldo Logo">
        </a>
    </div>
</nav>

<!-- Herunder kan du finde formularen til at tilføje ens indkomst. -->
<div class="container mt-3">
    <form action="addIncome.php" method="post">
        <div class="row g-3">
            <div class="col-12 col-md-4">
                <label for="inAmount" class="form-label">Indkomst</label>
                <input type="number" step="0.01" class="form-control" id="inAmount" name="data[inAmount]" placeholder="Indkomst" value="">
            </div>
            <div class="col-12 col-md-4">
                <label for="inName" class="form-label">Indkomst navn</label>
                <input type="text" class="form-control" id="inName" name="data[inName]" placeholder="F.eks. løn, SU eller andet" value="">
            </div>
            <div class="col-12 col-md-4">
                <label for="inDate" class="form-label">Vælg Dato</label>
                <input type="date" class="form-control" id="inDate" name="data[inDate]" placeholder="Vælg Dato" value="">
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Tilføj Indkomst</button>
            </div>
        </div>
    </form>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
