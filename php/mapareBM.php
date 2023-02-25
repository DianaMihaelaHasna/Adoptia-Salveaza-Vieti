<!DOCTYPE html>
<?php
session_start();
global $conn;
if(!isset($_SESSION['id_administrator'])){
    header("location: ../index.php");
}
include("../include/inHeaderAdmin.php");
?>




<title >Asociere boala medicament</title>
<link rel="stylesheet" type="text/css" href="../css/admin.css">
<script type="text/javascript" src="../javascript/adminJS.js" > </script>
<body background="../imagini/med.jpg" >
<div class="content">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="container1">
            <div class="container4">
                <div id="formular">
                    <h1 align="center" class="a" style="color: #0b0c10;">Asociere medicament-afectiune</h1>
<br>
<br>

                    <?php

                    $boli = $conn->prepare("select * from boli");
                    $boli->execute();
                    echo "<p>Denumirea afectiunii:";


                    while($boala = $boli->fetch()){
                        echo "<br><input type='radio' name='id_boala' value='" . $boala['id_boala'] . "'/>" . $boala['nume_boala'] ;
                    }
                    echo "</p>";

                    $medicamente = $conn->prepare("select * from medicamente");
                    $medicamente->execute();
                    echo "<p>Denumire medicament:";


                    while($medicament = $medicamente->fetch()){
                        echo "<br><input type='radio' name='id_medicament' value='" . $medicament['id_medicament'] . "'/>" . $medicament['denumire'] ;
                    }
                    echo "</p>";

                    ?>


                    <hr>

                    <button class="submit" type="submit" name="submit" style="width: 100px">Asociaza</button>

                    <button class="reset" type="reset" style="width: 100px">Reset</button>

                </div>

            </div>
        </div>
    </form>
</div>

<?php
if(isset($_POST['submit'])){
    $id_boala = $_POST['id_boala'];
    $id_medicament = $_POST['id_medicament'];

    $check_mapare = $conn->prepare("select * from mapare_boala_medicament where id_boala=? and id_medicament=?");
    $check_mapare->execute(array($id_boala,$id_medicament));


    $rows = $check_mapare->rowCount();

    if($rows != 0){
        die("<script>alert('Atentie, maparea dintre aceste doua exista deja in baza de date!')</script>");

    }
    else{
        $id_max = $conn->prepare("select * from mapare_boala_medicament");

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
        $insert_mapare = $conn->prepare("insert into mapare_boala_medicament values(?,?,?)");
        $res = $insert_mapare->execute(array($id_mapare,$id_boala,$id_medicament));


        if(!$res){
            die("<script>alert('Ne pare rau, nu s-a putut realiza maparea dintre boala si medicament, va rugam sa reveniti mai tarziu!')</script>");
        }
        echo "<script>alert('Maparea dintre boala si medicament a fost realizata cu succes!')</script>";
    }
}

include("../include/footer.php");