<?php
/** @var PDO $db */
require "settings/init.php";

if(!empty($_POST["exId"]) && !empty($_POST["data"])) {
    $data = $_POST["data"];
    $expenses = $db->sql("UPDATE expenses SET exName = :exName, exDate = :exDate, exAmount = :exAmount WHERE exId = :exId", [":exName" =>$data["exName"], ":exDate" => $data["exDate"], ":exAmount" => $data["exAmount"], ":exId" => $_POST["exId"]]);

    header("Location: expenseUpdate.php?success=1&exId=".$_POST["exId"]);
    exit;
}

if(empty($_GET["exId"])) {
    header("Location: expenseList.php");
}
$exId = $_GET["exId"];

$expenses = $db->sql("SELECT * FROM expenses WHERE exId = :exId", [":exId" => $exId]);
$expenses = $expenses[0];

?>

<!DOCTYPE html>
<html lang="da">
<head>
    <meta charset="utf-8">

    <title>Ret din udgift / Saldo</title>

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

<div class="container mt-3">
    <?php
    if(!empty($_GET["success"]) && $_GET["success"] == 1) {
        echo "<h4 class='mt-3 text-center'>Udgiften er opdateret</h4>";
        echo "<h4 class='text-center mt-3 mb-5'><a class='btn btn-knapfarve text-secondary fw-bold' href='expenseList.php'>Gå tilbage</a></h4>";
    }
    ?>
    <form action="expenseUpdate.php" method="post">
        <div class="row g-3 justify-content-center">
            <div class="col-10 col-md-7">
                <label for="exAmount" class="form-label text-secondary fw-bold">Beløb:</label>
                <input type="number" step="0.01" class="form-control" id="exAmount" name="data[exAmount]" placeholder="Skriv prisen på udgiften her" value="<?php echo $expenses->exAmount ?>">
            </div>
            <div class="col-10 col-md-7">
                <label for="exName" class="form-label text-secondary fw-bold">Udgift:</label>
                <input type="text" class="form-control" id="exName" name="data[exName]" placeholder="F.eks. forsikring, internet, fagforening osv." value="<?php echo $expenses->exName ?>">
            </div>
            <div class="col-10 col-md-7">
                <label for="exDate" class="form-label text-secondary fw-bold">Vælg Dato:</label>
                <input type="date" class="form-control" id="exDate" name="data[exDate]" placeholder="Vælg Dato" value="<?php echo $expenses->exDate ?>">
            </div>
        </div>
        <div class="col-12 text-center mt-5">
            <button type="submit" class="btn btn-knapfarve text-secondary fw-bold">Opdater</button>
        </div>
        <div class="col-12 text-center mt-5 mb-4">
            <a class="btn btn-knapfarve text-secondary fw-bold p-2" href="expenseList.php">Gå tilbage</a>
        </div>
        <input type="hidden" name="exId" value="<?php echo $expenses->exId ?>">
    </form>
</div>

<script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
