<?php
session_start();
global $conn;

if(isset($_SESSION["id_administrator"])){
    include("../include/inHeaderAdmin.php");
    $session_id = $_SESSION['id_administrator'];
}else{
    if(isset($_SESSION["id_utilizator"])){
        include("../include/inHeaderUser.php");
        $session_id = $_SESSION['id_utilizator'];
    }
    else{
        header("location: ../index.php");
    }
}
?>


<title>Home</title>
<link rel="stylesheet" type="text/css" href="../css/admin.css">
<script type="text/javascript" src="../javascript/adminJS.js" > </script>
<body background="../imagini/see.jpg"></body>
<div class="content">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="container1">
            <div class="container2">
                <div id="formular">
                    <h1 align="center" class="a">Adauga sesizare</h1>
                    <br>
                    <br>

                    <label for="tip_semnalare" class = "text4"><b>Tipul semnalarii:</b></label>


                    <br>
                    <input type="radio" value="abuz" name="tip_semnalare" >
                    <input type="button" value="Abuz" name="abuz" class="btn3">

                    <input type="radio" value="abandon" name="tip_semnalare">
                    <input type="button" value="Abandon" name="abandon" class="btn3">

                    <br>
                    <br>

                    <label for="descriere " class = "text4"><b>Descriere:</b></label>
                    <br>
                    <textarea placeholder="Introdu descrierea semnalarii" name="descriere" >

                    </textarea>

                    <br>
                    <br>

                    <label for="locatie" class = "text4"><b>Locatie:</b></label>
                    <br>
                    <input type="text" placeholder="Introdu locatia semnalarii" name="locatie" >



                    <br>
                    <br>


                    <label for="tip_animal" class = "text4"><b>Tipul animalului:</b></label>
                    <br>
                    <input type="radio" value="caine" name="tip_animal" >
                    <input type="button" value="Caine"  class="btn3">

                    <input type="radio" value="pisica" name="tip_animal">
                    <input type="button" value="Pisica"  class="btn3">


                </div>

                <hr>

                <button class="submit" type="submit" name="submit"style="width: 100px">Sesizare</button>

                <button class="reset" type="reset" style="width: 100px">Reset</button>



            </div>
        </div>
    </form>
</div>


<?php
if(isset($_POST['submit'])) {

    $tip_semnalare = $_POST['tip_semnalare'];

    $descriere = $_POST['descriere'];

    $tip_animal = $_POST['tip_animal'];

    $locatie = $_POST['locatie'];

    $id_max = $conn->prepare("select * from semnalari");

    $id_max->execute();

    $maxim_id = -1;


    while ($result2 = $id_max->fetch()) {
        if ((int)$result2["id_semnalare"] > $maxim_id) {
            $maxim_id = (int)$result2["id_semnalare"];
        }
    }

    if ($maxim_id == -1) {

        $semnalare_id = "1";

    } else {
        $semnalare_id = $maxim_id + 1;
        $semnalare_id = (string)$semnalare_id;

    }



    $insert_semnalare = $conn->prepare("insert into semnalari values(?,?,?,?,?,?)");


    $res = $insert_semnalare->execute(array($semnalare_id, $session_id, $tip_semnalare, $locatie, $descriere, $tip_animal));

    if (!$res) {
        die("<script>alert('Nu s-a putut adauga semnalarea, va rugam sa reveniti mai tarziu!')</script>");
    }

    echo "<script>alert('Semnalarea a fost adaugata! Va multumim! ')</script>";

}



?>


    <br><br><br><br><br><br>

<?php
include("../include/footer.php");
?>