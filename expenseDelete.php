<?php
/** @var PDO $db */
require "settings/init.php";
$exId = $_GET["exId"];

if(empty($_GET["exId"])) {
    header("Location: expenseList.php");
}

if(!empty($_GET["exId"])) {

    $sql = "DELETE FROM expenses WHERE exId = '$exId'";

    $db->sql($sql);

    echo "<h3>Udgiften er nu slettet</h3><a class='btn btn-knapfarve' href='expenseList.php'>Tilbage</a> ";
    exit;
}
?>

<?php
/**
 * @var db $db
 */

require "settings/init.php";