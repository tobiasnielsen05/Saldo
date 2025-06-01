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

    header("Location: incomeList.php");
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
<div class="container mt-4">
    <form action="addIncome.php" method="post">
        <div class="row g-3 justify-content-center">
            <div class="col-10 col-md-7">
                <label for="inAmount" class="form-label text-secondary fw-bold">Indkomst:</label>
                <input type="number" step="0.01" class="form-control" id="inAmount" name="data[inAmount]" placeholder="Indkomst" value="">
            </div>
            <div class="col-10 col-md-7 mt-3">
                <label for="inName" class="form-label text-secondary fw-bold">Navn:</label>
                <input type="text" class="form-control" id="inName" name="data[inName]" placeholder="F.eks. løn, SU eller andet" value="">
            </div>
            <div class="col-12 d-flex justify-content-center mt-4">
                <button type="submit" class="btn btn-knapfarve text-secondary fw-bold">Tilføj Indkomst</button>
            </div>
            <div class="col-12 d-flex justify-content-center mt-4 mb-5 text-center fixed-bottom">
                <a class="btn btn-knapfarve text-secondary fw-bold p-2" href="budgetOverview.php">Gå tilbage</a>
            </div>
        </div>
    </form>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
