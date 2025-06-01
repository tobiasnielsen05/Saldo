<?php
/**
 * @var db $db
 */

require "settings/init.php";

if(!empty($_POST["data"])) {
    $data = $_POST["data"];

    $sql = "INSERT INTO expenses (exAmount, exName) VALUES(:exAmount, :exName)";
    $bind = [":exAmount" => $data["exAmount"], ":exName" => $data["exName"]];

    $db->sql($sql, $bind, false);

    header("Location: expenseList.php");
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
<div class="container mt-3">
    <form method="post" action="addStreamingExpense.php">
    <div class="row justify-content-center">
            <!-- StreamingTjenesterne -->
            <div class="col-10 col-md-7">
                <!-- Dropdown med faste platforme -->
                <label class="text-secondary fw-bold mb-1" for="expense_type">Vælg streamingtjeneste:</label>
                <select name="data[exName]" id="exName" class="form-select text-secondary" onchange="fillFixedPrice()">
                    <option value="">Klik her for at vælge</option>
                    <?php
                    $fixedExpenses = $db->sql("SELECT * FROM expense_types");
                    foreach ($fixedExpenses as $fx) { ?>
                        <option value="<?php echo $fx->extName; ?>" data-price="<?php echo $fx->extAmount; ?>">
                            <?php echo $fx->extName . " (" . number_format($fx->extAmount, 2, ',', '.') . " kr)"; ?>
                        </option>
                        <?php
                    }
                    ?>
                </select>
            </div>

            <!-- Beløb -->
            <div class="col-10 col-md-7">
                <label for="exAmount" class="text-secondary fw-bold mb-1 mt-3">Beløb (kr):</label>
                <input type="number" name="data[exAmount]" id="exAmount" class="form-control">
            </div>
        </form>

        <!-- Tilføj knappen -->
        <div class="col-12 d-flex justify-content-center mt-3">
            <button type="submit" class="btn btn-knapfarve text-secondary fw-bold mt-3">Tilføj udgift</button>
        </div>

    <div class="col-12 text-center mt-5 mb-4">
        <a class="btn btn-knapfarve text-secondary fw-bold p-2" href="budgetOverview.php">Gå tilbage</a>
    </div>

    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function fillFixedPrice() {
        const select = document.getElementById("exName");
        const amountInput = document.getElementById("exAmount");
        const selected = select.options[select.selectedIndex];
        const price = selected.getAttribute("data-price");
        if (price) {
            amountInput.value = price;
            amountInput.readOnly = true;
        } else {
            amountInput.value = "";
            amountInput.readOnly = false;
        }
    }
</script>
</body>
</html>
