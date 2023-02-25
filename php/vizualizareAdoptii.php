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

if(isset($_SESSION['id_administrator'])) {
    $check_adoptii = $conn->prepare("select * from adoptii");
    $check_adoptii->execute();


    echo "<div class=content>";
    while ($adoptie = $check_adoptii->fetch()) {
        $id_animal = $adoptie['id_animal'];
        $data_adoptie = $adoptie['data_adoptie'];

        $check_animale = $conn->prepare("select * from animale where id_animal=?");

        $check_animale->execute(array($id_animal));

        $animal = $check_animale->fetch();

        echo "<div class='gallery'>
                    <a href='vizualizareAdoptie.php?id_adoptie=" . $adoptie["id_adoptie"] . "'>
                    <div class='desc'> " . $animal["nume"] . " </div><br>
                        <img src='" . $animal["imagine_ref"] . "' style='width=100%;'><br>
                    <div class='desc'> " . $data_adoptie . " </div></div></a>";

    }
    echo "</div>";
}

if(isset($_SESSION['id_utilizator'])){
    $check_adoptii = $conn->prepare("select * from adoptii where id_utilizator=?");
    $check_adoptii->execute(array($_SESSION['id_utilizator']));


    echo "<div class=content>";
    while ($adoptie = $check_adoptii->fetch()) {
        $id_animal = $adoptie['id_animal'];
        $data_adoptie = $adoptie['data_adoptie'];

        $check_animale = $conn->prepare("select * from animale where id_animal=?");

        $check_animale->execute(array($id_animal));

        $animal = $check_animale->fetch();

        echo "<div class='gallery'>
                    <a href='vizualizareAdoptie.php?id_adoptie=" . $adoptie["id_adoptie"] . "'>
                    <div class='desc'> " . $animal["nume"] . " </div><br>
                        <img src='" . $animal["imagine_ref"] . "' style='width=100%;'><br>
                    <div class='desc'> " . $data_adoptie . " </div></div></a>";

    }
    echo "</div>";
}




include("../include/footer.php");

?>

