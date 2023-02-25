<?php

session_start();


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

echo "<link rel='stylesheet' type='text/css' href='../css/admin.css'>";

global $conn;


if(isset($_SESSION['id_administrator'])){

    $check_animale = $conn->prepare("select * from animale where adoptat='nu'");
    $check_animale->execute();


    echo "<div class=content>";
    while($animal = $check_animale->fetch())
    {

        echo "<div class='gallery'>
                        <a href='vizualizareAnimal.php?id_animal=" . $animal["id_animal"] . "'>
                        <div class='desc'> " . $animal["nume"] . " </div><br>
                            <img src='" . $animal["imagine_ref"] . "' style='width=100%;'><br>
                        <div class='desc'> " . $animal["rasa"] . " </div></div></a>";

    }
    echo "</div>";
}

if(isset($_SESSION['id_utilizator'])){
    $tip_animal = $_GET['tip_animal'];
    $gen_animal = $_GET['gen_animal'];
    $acomodabil = $_GET['acomodabil'];
    $mediu_viata = $_GET['mediu_viata'];

    if($acomodabil === "da"){

        $check_animale = $conn->prepare("select * from animale where tip_animal=? and gen=? and mediu_viata=? and acomodabil=? and adoptat='nu'");

        $check_animale->execute(array($tip_animal,$gen_animal,$mediu_viata,$acomodabil));

    }
    if($acomodabil === "nu"){

        $check_animale = $conn->prepare("select * from animale where tip_animal=? and gen=? and mediu_viata=? and adoptat='nu'");

        $check_animale->execute(array($tip_animal,$gen_animal,$mediu_viata));

    }
    echo "<div class=content>";
    while($animal = $check_animale->fetch())
    {

        echo "<div class='gallery'>
                        <a href='vizualizareAnimal.php?id_animal=" . $animal["id_animal"] . "'>
                        <div class='desc'> " . $animal["nume"] . " </div><br>
                            <img src='" . $animal["imagine_ref"] . "' style='width=100%;'><br>
                        <div class='desc'> " . $animal["rasa"] . " </div></div></a>";

    }
    echo "</div>";

}




include("../include/footer.php");

?>