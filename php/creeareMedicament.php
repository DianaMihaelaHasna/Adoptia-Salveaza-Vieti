<!DOCTYPE html>
<?php
session_start();
global $conn;
if(!isset($_SESSION['id_administrator'])){
    header("location: ../index.php");
}
include("../include/inHeaderAdmin.php");
?>



<title>Home</title>
<link rel="stylesheet" type="text/css" href="../css/admin.css">
<script type="text/javascript" src="../javascript/adminJS.js" > </script>
<body background="../imagini/look.png" >
<div class="content">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="container1">
            <div class="container">
                <div id="formular">
                    <h1 align="center" class="a">Adauga medicament</h1>
<br>
<br>
                    <label for="nume"><b>Denumire medicament:</b></label>
                    <input type="text" placeholder="Adauga denumirea medicamentului" name="nume" />

                    <br>
                    <label for="durata"><b>Dozaj medicament:</b></label>
                    <input type="text" placeholder="Adauga dozajul medicamentului" name="ratie" />

                    <hr>

                    <button class="submit" type="submit" name="submit" style="width: 100px">Adauga</button>

                    <button class="reset" type="reset" style="width: 100px">Reset</button>

                </div>

            </div>
        </div>
    </form>
</div>


<?php

global $conn;

if(isset($_POST["submit"])) {
    $nume = $_POST["nume"];
    $ratie = $_POST['ratie'];


    $id_max = $conn->prepare("select * from medicamente");

    $id_max->execute();

    $maxim_id = -1;


    while ($result2 = $id_max->fetch()) {
        if ((int)$result2["id_medicament"] > $maxim_id) {
            $maxim_id = (int)$result2["id_medicament"];
        }
    }

    if ($maxim_id == -1) {

        $medicament_id = "1";

    } else {
        $medicament_id = $maxim_id + 1;
        $medicament_id = (string)$medicament_id;

    }


    $insert_medicament = $conn->prepare("insert into medicamente values(?,?,?)");


    $res = $insert_medicament->execute(array($medicament_id, $nume, $ratie));

    if (!$res) {
        die("<script>alert('Nu s-a putut adauga medicamentul, va rugam sa reveniti mai tarziu!')</script>");
    }

    echo "<script>alert('Medicamentul a fost adaugat! Va multumim! ')</script>";

}


include("../include/footer.php");

