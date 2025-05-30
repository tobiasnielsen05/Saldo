<?php
/**
 * @var db $db
 */

require "settings/init.php";

// Hent alle udgifter + navn på typen (JOIN)
$expenses = $db->sql("SELECT * FROM expenses LEFT JOIN expense_types ON exName = extName ORDER BY exDate DESC");
?>
<!DOCTYPE html>
<html lang="da">
<head>
    <meta charset="utf-8">
    <title>Udgift Liste / Saldo</title>
    <meta name="robots" content="All">
    <meta name="author" content="Udgiver">
    <meta name="copyright" content="Information om copyright">
    <link href="css/styles.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body class="bg-primary">

<!-- Navbar -->
<nav class="navbar">
    <div class="container d-flex justify-content-center">
        <a class="navbar" href="index.php">
            <img class="w-75 img-fluid" src="images/saldologo150x150.webp" alt="Saldo Logo">
        </a>
    </div>
</nav>

<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <h3 class="text-secondary fw-bold mb-3">Dine udgifter:</h3>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover w-auto">
                    <thead class="table-secondary">
                    <tr>
                        <th class="text-nowrap">Udgift</th>
                        <th class="text-nowrap">Beløb (kr)</th>
                        <th class="text-nowrap">Dato</th>
                        <th>Ret</th>
                        <th>Slet</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($expenses as $expense) {
                        ?>
                        <tr>
                            <td><?php echo $expense->extName ?? 'Ukendt'; ?></td>
                            <td class="text-nowrap"><?php echo number_format($expense->exAmount, 2, ',', '.'); ?>,-</td>
                            <td class="text-nowrap"><?php echo date("d-m-Y", strtotime($expense->exDate)); ?></td>
                            <td class="text-center">
                                <a href="expenseEdit.php?exId=<?php echo $expense->exId; ?>" class="text-warning fs-3">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                            </td>
                            <td class="text-center fs-3">
                                <a href="expenseDelete.php?exId=<?php echo $expense->exId; ?>" class="text-danger">
                                    <i class="bi bi-trash-fill"></i>
                                </a>
                            </td>
                        </tr>
                        <?php
                    } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-12 text-center mt-5">
            <a class="btn btn-knapfarve text-secondary fw-bold p-2" href="index.php">Gå tilbage</a>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
