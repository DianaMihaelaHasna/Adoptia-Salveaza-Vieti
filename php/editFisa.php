<!DOCTYPE html>
<?php
session_start();
global $conn;
if(!isset($_SESSION['id_administrator'])){
    header("location: ../index.php");
}
include("../include/inHeaderAdmin.php");


echo "<link rel='stylesheet' type='text/css' href='../css/admin.css'>";

$id_animal = $_GET['id_animal'];
$id_fisa = $_GET['id_fisa'];

?>

<!--

adauga boala pentru animal

sterge boala pentru animal

-->



<title>Vizualizare Adoptie</title>
<link rel="stylesheet" type="text/css" href="../css/admin.css">
<script type="text/javascript" src="../javascript/adminJS.js" > </script>
<div class="row content">
    <div class="col-sm-2">
    </div>
    <div class="col-sm-8">
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="table table-bordered table-hover" style="position: center">
                <tr align="center">
                    <td>
                        <?php echo "<a href='mapareFB.php?id_fisa=" . $id_fisa . "'><input type='button' value='Adauga boala' class='btn3'></a>"; ?>
                        <tr align="center">
                    <td>           <?php

                      echo "<a href='stergeMapareFB.php?id_fisa=" . $id_fisa . "'><input type='button' value='Sterge boala' class='btn3'></a>";?>


            </table>
        </form>

    </div>

</div>

<?php

include("../include/footer.php");?>