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

    echo "Streamingtjenesten er nu tilføjet. <a href='addStreamingExpense.php'>Tilføj en anden streamingtjeneste</a> Eller <a href='index.php'>Gå tilbage</a>";
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
        <a class="navbar-brand" href="index.php">
            <img src="" alt="Saldo Logo">
        </a>
    </div>
</nav>

<!-- Herunder kan du finde formularen til at tilføje ens indkomst. -->
<div class="container mt-3">
    <div class="row">
        <form method="post" action="addStreamingExpense.php">
            <div class="col-12 col-md-4">
                <!-- Dropdown med faste platforme -->
                <label for="expense_type">Vælg streamingtjeneste:</label>
                <select name="data[exName]" id="exName" class="form-select" onchange="fillFixedPrice()">
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


            <div class="col-12 col-md-4">
                <!-- Beløb -->
                <label for="exAmount" class="mt-2">Beløb (kr):</label>
                <input type="text" name="data[exAmount]" id="exAmount" class="form-control">
            </div>


            <div class="col-12 col-md-4">
                <label for="exDate" class="form-label">Vælg Dato</label>
                <input type="date" class="form-control" id="exDate" name="data[exDate]" placeholder="Vælg Dato" value="">
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary mt-3">Tilføj udgift</button>
            </div>

        </form>
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
