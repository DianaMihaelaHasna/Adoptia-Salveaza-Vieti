<?php

session_start();

global $conn;

if(!isset($_SESSION['id_administrator'])) {
    if(!isset($_SESSION['id_utilizator']))
        header("location: ../index.php");
    include("../include/inHeaderUser.php");
    $session_id = $_SESSION["id_utilizator"];
    $author = "user";
}
else{
    include("../include/inHeaderAdmin.php");
    $session_id = $_SESSION["id_administrator"];
    $author = "admin";
}
?>

<title>Home</title>
<link rel="stylesheet" type="text/css" href="../css/admin.css">
<script type="text/javascript" src="../javascript/adminJS.js" > </script>
<body background="../imagini/some.jpg"> </body>
<div class="content">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="container1">
            <div class="container">
                <div id="formular">
                    <h1 align="center" class="a">Adauga anunt</h1>
                    <br>
                    <br>

                    <label for="titlu" class="text4"><b>Titlu:</b></label>
                    <input type="text" placeholder="Introdu titlul anuntului" name="titlu" class="text3" />

                    <label for="titlu" class="text4"><b>Descriere:</b></label>
                    <br>
                    <br>
                    <textarea placeholder="Introdu descrierea anuntului" name="descriere"  class="text3" >

                    </textarea>

                    <br>
                    <br>
                    <label for="fundal" class="text4"><b>Imagine fundal:</b></label>
                    <input class="white_text" type="file" name="fundal" >

                    <label for="tip_anunt"class="text4"><b>Tipul anuntului:</b></label>
                    <br>
                    <input type="radio" value="cautare_animal_pierdut" name="tip_anunt" class="text3"  >
                    <input type="button" value="Pierdut" name="cautare_animal_pierdut" class="btn" >

                    <input type="radio" value="cautare_animal_nou" name="tip_anunt" class="text3" >
                    <input type="button" value="Gasit" name="cautare_animal_nou" class="btn" >

                    <br>
                    <label for="locatie" class="text4"><b>Locatie:</b></label>
                    <input type="text" placeholder="Introdu locatia" name="locatie"class="text3"  >

                </div>



                <button class="submit" type="submit" onclick="classNames()" name="submit"  >Adauga</button>

                <button class="reset" type="reset"  >Reset</button>



            </div>
        </div>
    </form>
</div>



<?php
if(isset($_POST['submit'])) {

    $title = $_POST['titlu'];

    $postFundal = $_FILES['fundal'];

    $descriere = $_POST['descriere'];

    $tip_anunt = $_POST['tip_anunt'];

    $locatie = $_POST['locatie'];

    $id_max = $conn->prepare("select * from anunturi");

    $id_max->execute();

    $maxim_id = -1;

    $targetDir = "../incarcari/";

    while ($result2 = $id_max->fetch()) {
        if ((int)$result2["id_anunt"] > $maxim_id) {
            $maxim_id = (int)$result2["id_anunt"];
        }
    }

    if ($maxim_id == -1) {

        $anunt_id = "1";

    } else {
        $anunt_id = $maxim_id + 1;
        $anunt_id = (string)$anunt_id;

    }

    if ($postFundal['name'] !== "") {

        $fileName = "fundal" . $anunt_id;
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

    $insert_course = $conn->prepare("insert into anunturi values(?,?,?,?,?,?,?)");


    $res = $insert_course->execute(array($anunt_id, $session_id, $title, $descriere, $targetFile, $tip_anunt, $locatie));

    if (!$res) {
        die("<script>alert('Nu s-a putut adauga anuntul, va rugam sa reveniti mai tarziu!')</script>");
    }

    echo "<script>alert('Anuntul a fost adaugat! Va multumim! ')</script>";

}



?>


<br><br><br><br><br><br>

<?php
include("../include/footer.php");
?>