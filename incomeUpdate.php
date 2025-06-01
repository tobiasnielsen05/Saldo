<?php
/** @var PDO $db */
require "settings/init.php";

if(!empty($_POST["inId"]) && !empty($_POST["data"])) {
    $data = $_POST["data"];
    $income = $db->sql("UPDATE income SET inName = :inName, inDate = :inDate, inAmount = :inAmount WHERE inId = :inId", [":inName" =>$data["inName"], ":inDate" => $data["inDate"], ":inAmount" => $data["inAmount"], ":inId" => $_POST["inId"]]);

    header("Location: incomeUpdate.php?success=1&inId=".$_POST["inId"]);
    exit;
}

if(empty($_GET["inId"])) {
    header("Location: incomeList.php");
}
$inId = $_GET["inId"];

$income = $db->sql("SELECT * FROM income WHERE inId = :inId", [":inId" => $inId]);
$income = $income[0];

?>

<!DOCTYPE html>
<html lang="da">
<head>
    <meta charset="utf-8">

    <title>Ret din indkomst / Saldo</title>

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
        echo "<h4 class='mt-3 text-center'>Indkomsten er opdateret</h4>";
        echo "<h4 class='text-center mt-3 mb-5'><a class='btn btn-knapfarve text-secondary fw-bold' href='incomeList.php'>Gå tilbage</a></h4>";
    }
    ?>
    <form action="incomeUpdate.php" method="post">
        <div class="row g-3 justify-content-center">
            <div class="col-10 col-md-7">
                <label for="inAmount" class="form-label text-secondary fw-bold">Beløb:</label>
                <input type="number" step="0.01" class="form-control" id="inAmount" name="data[inAmount]" placeholder="Skriv prisen på indkomsten her" value="<?php echo $income->inAmount ?>">
            </div>
            <div class="col-10 col-md-7">
                <label for="inName" class="form-label text-secondary fw-bold">Indkomst:</label>
                <input type="text" class="form-control" id="inName" name="data[inName]" placeholder="F.eks. løn, SU eller andet" value="<?php echo $income->inName ?>">
            </div>
            <div class="col-10 col-md-7">
                <label for="inDate" class="form-label text-secondary fw-bold">Vælg Dato:</label>
                <input type="date" class="form-control" id="inDate" name="data[inDate]" placeholder="Vælg Dato" value="<?php echo $income->inDate ?>">
            </div>
        </div>
        <div class="col-12 text-center mt-5">
            <button type="submit" class="btn btn-knapfarve text-secondary fw-bold">Opdater</button>
        </div>
        <div class="col-12 text-center mt-5 mb-4">
            <a class="btn btn-knapfarve text-secondary fw-bold p-2" href="incomeList.php">Gå tilbage</a>
        </div>
        <input type="hidden" name="inId" value="<?php echo $income->inId ?>">
    </form>
</div>

<script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
