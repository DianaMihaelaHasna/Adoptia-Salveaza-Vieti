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
<body background="../imagini/boala.png" >
<div class="content">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="container1">
            <div class="container">
                <div id="formular">
                    <h1 align="center" class="a">Adauga boala</h1>
                    <br>
                    <br>

                    <label for="nume"><b>Denumirea bolii:</b></label>
                    <input type="text" placeholder="Adauga numele bolii" name="nume" />

                    <br>
                    <label for="durata"><b>Perioada de tratament:</b></label>
                    <input type="text" placeholder="Adauga durata bolii" name="durata" />

                    <hr>

                    <button class="submit" type="submit" onclick="classNames()" name="submit" style="width: 100px">Adauga</button>

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
    $durata = $_POST['durata'];


    $id_max = $conn->prepare("select * from boli");

    $id_max->execute();

    $maxim_id = -1;


    while ($result2 = $id_max->fetch()) {
        if ((int)$result2["id_boala"] > $maxim_id) {
            $maxim_id = (int)$result2["id_boala"];
        }
    }

    if ($maxim_id == -1) {

        $boala_id = "1";

    } else {
        $boala_id = $maxim_id + 1;
        $boala_id = (string)$boala_id;

    }


    $insert_boala = $conn->prepare("insert into boli values(?,?,?)");


    $res = $insert_boala->execute(array($boala_id, $nume, $durata));

    if (!$res) {
        die("<script>alert('Nu s-a putut adauga boala, va rugam sa reveniti mai tarziu!')</script>");
    }

    echo "<script>alert('Boala a fost adaugata! Va multumim! ')</script>";

}


include("../include/footer.php");

