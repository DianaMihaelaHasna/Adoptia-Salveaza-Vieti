<!DOCTYPE html>
<?php
session_start();
global $conn;
if(!isset($_SESSION['id_administrator'])){
    header("location: ../index.php");
}
include("../include/inHeaderAdmin.php");


echo "<link rel='stylesheet' type='text/css' href='../css/admin.css'>";

$id_fisa = $_GET['id_fisa'];



echo "</p>";





?>



<title>Mapare FB</title>


<script type="text/javascript" src="../javascript/adminJS.js" > </script>
<link rel="stylesheet" type="text/css" href="../css/admin.css">
<style>
    td{
        font-weight: bold;
    }
</style>


<div class="row content">
    <div class="col-sm-2">
    </div>
    <div class="col-sm-8">
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="table table-bordered table-hover">

                <tr align="center">
                <td> <?php

                    $boli = $conn->prepare("select * from boli");
                    $boli->execute();
                    echo "<form action='' method='post' enctype='multipart/form-data'>";
                    echo "<p>Afectiunile existente in baza de date sunt: 
<br>
<br>";
    while($boala = $boli->fetch()){
                        echo "<br><input type='radio'  name='id_boala' value='" . $boala['id_boala'] . "' /> " . $boala['nume_boala'] ;
                    }
                    ;?>
                    <tr align="center" >
                        <td><?php echo "<input type='submit' value='Adauga afectiune la animalul curent' name='submit' class='btn3'/> </form>";
                            if(isset($_POST['submit'])){

                                $id_boala = $_POST['id_boala'];
                                $check_mapare = $conn->prepare("select * from mapare_fisa_boala where id_fisa=? and id_boala=?");
                                $check_mapare->execute(array($id_fisa,$id_boala));
                                $rows = $check_mapare->rowCount();
                                if($rows != 0){

                                    die("<script>alert('Animalul curent are deja asociata afectiunea selectata!')</script>");
                                }

                                $id_max = $conn->prepare("select * from mapare_fisa_boala");
                                $id_max->execute();
                                $maxim_id = -1;

                                while ($result2 = $id_max->fetch()) {
                                    if ((int)$result2["id_mapare"] > $maxim_id) {
                                        $maxim_id = (int)$result2["id_mapare"];
                                    }
                                }

                                if ($maxim_id == -1) {

                                    $id_mapare = "1";

                                } else {
                                    $id_mapare = $maxim_id + 1;
                                    $id_mapare = (string)$id_mapare;
                                }

                                $insert_mapare = $conn->prepare("insert into mapare_fisa_boala values(?,?,?)");
                                $res = $insert_mapare->execute(array($id_mapare,$id_fisa,$id_boala));

                                if(!$res){
                                    die("<script>alert('Ne pare rau, nu s-a putut realiza adaugarea afectiunii pentru animalul curent, va rugam sa reveniti mai tarziu!')</script>");
                                }
                                echo "<script>alert('Adaugarea afectiunii pentru animalul curent s-a realizat cu succes!')</script>";

                            };?>


                </td>
            </table>
        </form>
    </div>
</div>

<?php include("../include/footer.php"); ?>