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
    $check_semnalari = $conn->prepare("select * from semnalari where id_utilizator=?");
    $check_semnalari->execute(array($_SESSION['id_utilizator']));


    echo "<div class=content>";
    while($semnalare = $check_semnalari->fetch())
    {
        echo "<div class='gallery'>
                <a href='stergeSemnalare.php?id_semnalare=" . $semnalare["id_semnalare"] . "'>
                <div class='desc'> " . $semnalare["tip_semnalare"] . " </div><br>
                <div class='desc'> " . $semnalare["locatie"] . " </div></div></a>";

    }
    echo "</div>";

}

if(isset($_SESSION['id_administrator'])){
    $check_semnalari = $conn->prepare("select * from semnalari");
    $check_semnalari->execute(array());

    echo "<div class=content>";
    while($semnalare = $check_semnalari->fetch())
    {
        echo "<div class='gallery'>
                <a href='stergeSemnalare.php?id_semnalare=" . $semnalare["id_semnalare"] . "'>
                <div class='desc'> " . $semnalare["tip_semnalare"] . " </div><br>
                <div class='desc'> " . $semnalare["locatie"] . " </div></div></a>";

    }
    echo "</div>";
}



include("../include/footer.php");

?>


