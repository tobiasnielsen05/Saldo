<?php
/**
 * @var db $db
 */

require "settings/init.php";

// Hent alle udgifter + navn på typen (JOIN)
$income = $db->sql("SELECT * FROM income ORDER BY inDate DESC");
?>
<!DOCTYPE html>
<html lang="da">
<head>
    <meta charset="utf-8">
    <title>Indkomst Liste / Saldo</title>
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
        <a class="navbar d-flex justify-content-center" href="index.php">
            <img class="w-75 img-fluid" src="images/saldologo150x150.webp" alt="Saldo Logo">
        </a>
    </div>
</nav>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-auto">
            <h3 class="text-secondary fw-bold mb-3">Dine indkomster:</h3>
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
                    foreach ($income as $in) {
                        ?>
                        <tr>
                            <td><?php echo $in->inName ?? 'Ukendt'; ?></td>
                            <td class="text-nowrap"><?php echo number_format($in->inAmount, 2, ',', '.'); ?>,-</td>
                            <td class="text-nowrap"><?php echo date("d-m-Y", strtotime($in->inDate)); ?></td>
                            <td class="text-center">
                                <a href="expenseUpdate.php?exId=<?php echo $in->inId; ?>" class="text-warning fs-3">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                            </td>
                            <td class="text-center fs-3">
                                <a href="incomeDelete.php?inId=<?php echo $in->inId; ?>" class="text-danger">
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
