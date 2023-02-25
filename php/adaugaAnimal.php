<!DOCTYPE html>
<?php
session_start();
global $conn;
if(!isset($_SESSION['id_administrator'])){
    header("location: ../index.php");
}
include("../include/inHeaderAdmin.php");
?>



<title>Adaugare animale</title>
<link rel="stylesheet" type="text/css" href="../css/admin.css">
<script type="text/javascript" src="../javascript/adminJS.js" > </script>
<body background="../imagini/add2.jpg" style="background-attachment: fixed" >

<div class="content" >
    <form action="" method="post" enctype="multipart/form-data">
        <div class="container1">
            <div class="container">
                <div id="formular">
                    <h1 align="center" class="a">Adauga animal</h1>
                    <br>
                    <br>

                    <label for="nume" class="text3"><b>Numele animalului:</b></label>
                    <input type="text" placeholder="Adauga numele animalului" name="nume"class="text3" />

                    <br>
                    <label for="rasa" class="text3" ><b>Rasa animalului:</b></label>
                    <input type="text" placeholder="Adauga rasa animalului" name="rasa" class="text3"/>

                    <label for="gen" class="text3"><b>Genul animalului:</b></label>
                    <br>
                    <select name="gen" >
                        <option value="M" >Masculin</option>
                        <option value="F">Feminin</option>
                    </select>

                    <br>
                    <br>

                    <label for="tip" class="text3"><b>Tipul animalului:</b></label>
                    <br>
                    <select name="tip" >
                        <option value="Caine">Caine</option>
                        <option value="Pisica">Pisica</option>
                    </select>

                    <br>
                    <br>


                    <label for="varsta" class="text3"><b>Varsta animalului:</b></label>
                    <input type="text" placeholder="Adauga varsta animalului" name="varsta" />


                    <label for="mediu_viata" class="text3"><b>Selecteaza mediul de viata:</b></label>
                    <br>
                    <input type="radio" value="Casa" name="mediu_viata" >
                    <input type="button" value="casa"  class="btn3" style="width: 70px">

                    <input type="radio" value="Bloc" name="mediu_viata">
                    <input type="button" value="bloc"  class="btn3" style="width: 70px" >

                    <input type="radio" value="Casa si bloc" name="mediu_viata">
                    <input type="button" value="casa si bloc" style="width: 120px"  class="btn3">
                    <br>
                    <br>



                    <label for="acomodabil" class="text3"><b>Animalul este acomodabil cu alte animale?:</b></label>
<br>

                    <input type="radio" value="da" name="acomodabil" >
                    <input type="button" value="da"  class="btn3" >

                    <input type="radio" value="nu" name="acomodabil">
                    <input type="button" value="nu"  class="btn3" >
                    <br>
                    <br>



                    <label for="descriere" class="text3"><b>Descriere:</b></label>
                    <br>

                    <textarea placeholder="Introdu descrierea animalului" name="descriere" >

                    </textarea>


                    <br>

                    <label for="fundal" class="text3"><b>Imaginea animalului:</b></label>
                    <input class="white_text" type="file" name="imagine">

                </div>

                <hr>

                <button class="submit" type="submit" onclick="classNames()" name="submit" style="width:100px;">Adauga</button>

                <button class="reset" type="reset"  style="width:100px;">Reset</button>



            </div>
        </div>
    </form>
</div>

<?php

global $conn;

if(isset($_POST["submit"])) {

    $nume = $_POST["nume"];
    $rasa = $_POST['rasa'];
    $gen = $_POST['gen'];
    $tip_animal = $_POST['tip'];
    $varsta = $_POST['varsta'];
    $mediu_viata = $_POST['mediu_viata'];
    $acomodabil = $_POST['acomodabil'];
    $descriere = $_POST['descriere'];
    $adoptat="nu";

    $postFundal = $_FILES['imagine'];

    $targetDir = "../incarcari/";




    $id_max = $conn->prepare("select * from animale");

    $id_max->execute();

    $maxim_id = -1;


    while ($result2 = $id_max->fetch()) {
        if ((int)$result2["id_animal"] > $maxim_id) {
            $maxim_id = (int)$result2["id_animal"];
        }
    }

    if ($maxim_id == -1) {

        $animal_id = "1";

    } else {
        $animal_id = $maxim_id + 1;
        $animal_id = (string)$animal_id;

    }

    if ($postFundal['name'] !== "") {

        $fileName = "imagine" . $animal_id;
        $targetFile = $targetDir . $postFundal['name'];

        $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        $targetFile = $targetDir . $fileName . "." . $fileType;


        if ($fileType != "jpg" && $fileType != "jpeg" && $fileType != "png" && $fileType != "gif") {
            die("Formatul imaginii nu este acceptat.");
        }

        if (move_uploaded_file($postFundal["tmp_name"], $targetFile)) {
            echo "Imaginea " . htmlspecialchars(basename($targetFile)) . " a fost incarcata.";
        } else {
            echo "Ne cerem scuze, incarcarea imaginii a dat gres. Va rugam sa reveniti mai tarziu.";
        }




    } else {
        $targetFile = "../incarcari/no_image.jpg";
    }



    $insert_animal = $conn->prepare("insert into animale values(?,?,?,?,?,?,?,?,?,?,?)");


    $res = $insert_animal->execute(array($animal_id, $nume, $tip_animal, $rasa, $gen, $varsta, $mediu_viata, $acomodabil, $descriere, $adoptat,$targetFile));

    if (!$res) {
        die("<script>alert('Nu s-a putut adauga animalul, va rugam sa reveniti mai tarziu!')</script>");
    }

    echo "<script>alert('Animalul a fost adaugat! Va multumim! ')</script>";

}



?>


<br><br><br><br><br><br>

<?php
include("../include/footer.php");
?>
</body>