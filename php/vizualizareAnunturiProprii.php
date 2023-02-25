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

if(isset($_SESSION['id_utilizator'])){
    $check_anunturi = $conn->prepare("select * from anunturi where id_utilizator=?");
    $check_anunturi->execute(array($_SESSION['id_utilizator']));


    echo "<div class=content>";
        while($anunt = $check_anunturi->fetch())
        {
            echo "<div class='gallery'>
                <a href='stergeAnunt.php?id_anunt=" . $anunt["id_anunt"] . "'>
                <div class='desc'> " . $anunt["titlu"] . " </div><br>
                    <img src='" . $anunt["imagine_ref"] . "' style='width=100%;'><br>
                <div class='desc'> " . $anunt["locatie"] . " </div></div></a>";

        }
        echo "</div>";

}

if(isset($_SESSION['id_administrator'])){
    $check_anunturi = $conn->prepare("select * from anunturi");
    $check_anunturi->execute();

    echo "<div class=content>";
    while($anunt = $check_anunturi->fetch())
    {
        echo "<div class='gallery'>
                <a href='stergeAnunt.php?id_anunt=" . $anunt["id_anunt"] . "'>
                <div class='desc'> " . $anunt["titlu"] . " </div><br>
                    <img src='" . $anunt["imagine_ref"] . "' style='width=100%;'><br>
                <div class='desc'> " . $anunt["locatie"] . " </div></div></a>";

    }
    echo "</div>";
}

include("../include/footer.php");

?>


