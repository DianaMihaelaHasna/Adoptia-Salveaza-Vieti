<!DOCTYPE html>
<?php
session_start();

if(!isset($_SESSION['id_utilizator'])){
    header("location: ../index.php");
}

include("../include/inHeaderUser.php");



?>
<title>Home</title>
<link rel="stylesheet" type="text/css" href="../css/admin.css">
<body background="../imagini/fundal.jpg" style="background-attachment: fixed;" >

<div class="content">




    <div class="gallery2" >
        <a href="editProfile.php">
            <img src="../imagini/editprofile2.png"  alt="Editeaza profilul"  >
        </a>
        <div class="desc">EDITEAZA PROFILUL</div>
    </div>


    <div class="gallery2">
        <a href="formDetAnimal.php">
            <img src="../imagini/look2.png"   alt="VizualizareAnimale" width="600" height="400">
        </a>
        <div class="desc">VIZUALIZARE ANIMALE </div>

    </div>


    <div class="gallery2">
        <a href="addAnunt.php">
            <img src="../imagini/adaugaanuturi.png" alt="Adauga anunt" >
        </a>
        <div class="desc">ADAUGA ANUNT </div>

    </div>


    <div class="gallery2">
        <a href="vizualizareAnunturiProprii.php">
            <img src="../imagini/trash.png"  alt="Sterge anunt" >
        </a>
        <div class="desc">STERGE ANUNT</div>
    </div>

    <div class="gallery2">
        <a href="vizualizareAnunturi.php">
            <img src="../imagini/vizanunturi.png"  alt="VizualizareAnunturi" >
        </a>
        <div class="desc">VIZUALIZEAZA  ANUNTURI </div>

    </div>





    <div class="gallery2">
        <a href="adaugaSemnalare.php">
            <img src="../imagini/semnaleaza.png"  alt="AdaugareSemnalare" width="600" height="400">
        </a>
        <div class="desc">ADAUGARE SESIZARE </div>

    </div>

    <div class="gallery2">
        <a href="vizualizareSemnalari.php">
            <img src="../imagini/removecat.png"  alt="VizualizareSemnalari" width="600" height="400">
        </a>
        <div class="desc">VIZUALIZARE SESIZARE </div>

    </div>

    <div class="gallery2">
        <a href="vizualizareSemnalariProprii.php">
            <img src="../imagini/trashcat.png" alt="Sterge semnalare" >
        </a>
        <div class="desc">STERGERE SESIZARE</div>
    </div>

    <div class="gallery2">
        <a href="vizualizareAdoptii.php">
            <img src="../imagini/ad.png" alt="Vizualizare adoptii" width="600" height="400">
        </a>
        <div class="desc">VIZUALIZARE ADOPTII</div>

    </div>



</div>


<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<?php
include("../include/footer.php");
?>