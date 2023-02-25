<!DOCTYPE html>
<?php
session_start();

global $conn;
if(!isset($_SESSION['id_utilizator'])){
    header("location: ../index.php");
}

include("../include/inHeaderUser.php");



?>


<title>Home</title>
<link rel="stylesheet" type="text/css" href="../css/admin.css">
<script type="text/javascript" src="../javascript/adminJS.js" > </script>
<body background="../imagini/fundaladoptie.jpg" style="background-size: cover" ></body>
<div class="content">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="container1">
            <div class="container5" >
                <div id="formular" >
                    <h1 align="center" class="a2">Cauta animale </h1>
                    <br>
                    <br>

                    <p><label for="tip_animal"><b>Tipul animalului cautat:</b></label>
                    <br><input type="radio" name="tip_animal" value="Caine" checked/>Caine
                        <br><input type="radio" name="tip_animal" value="Pisica"/>Pisica </p>
                    <br>

                    <p><label for="gen_animal"><b>Genul animalului:</b></label>
                    <br><input type="radio" name="gen_animal" value="F" checked/>Feminim
                        <br><input type="radio" name="gen_animal" value="M"/>Masculin </p>
                    <br>

                    <p><label for="acomodabil"><b>Detineti si alte animale?</b></label>
                        <br><input type="radio" name="acomodabil" value="da" checked/>Da
                        <br><input type="radio" name="acomodabil" value="nu"/>Nu </p>
                    <br>

                    <p><label for="mediu_viata"><b>Unde locuiti?</b></label>
                        <br><input type="radio" name="mediu_viata" value="Casa" checked/>Casa
                        <br><input type="radio" name="mediu_viata" value="Bloc"/>Bloc
                        <br><input type="radio" name="mediu_viata" value="Casa si bloc"/>Casa si bloc </p>
                    <br>




                </div>

                <hr>

                <button class="submit" type="submit" name="submit" style="width: 100px">Cautare</button>

                <button class="reset" type="reset"  style="width: 100px">Reset</button>



            </div>
        </div>
    </form>
</div>

<?php

if(isset($_POST['submit'])){
    $tip_animal = $_POST['tip_animal'];
    $gen_animal = $_POST['gen_animal'];
    $acomodabil = $_POST['acomodabil'];
    $mediu_viata = $_POST['mediu_viata'];

    echo "<script>window.open('vizualizareAnimale.php?tip_animal=" . $tip_animal . "&gen_animal=" . $gen_animal . "&acomodabil=" . $acomodabil . "&mediu_viata=" . $mediu_viata . "','_self')</script>";


}

include("../include/footer.php");