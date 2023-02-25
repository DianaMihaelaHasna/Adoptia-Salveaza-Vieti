<!DOCTYPE html>
<?php
session_start();
global $conn;
if(!isset($_SESSION['id_administrator'])){
    header("location: ../index.php");
}
include("../include/inHeaderAdmin.php");


echo "<link rel='stylesheet' type='text/css' href='../css/admin.css'>";


$id_fisa = $_GET['id_fisa'];

$check_boli = $conn->prepare("select * from mapare_fisa_boala where id_fisa=?");

$check_boli->execute(array($id_fisa));

$rows = $check_boli->rowCount();

if($rows == 0){
    echo "<p>Animalul este perfect sanatos, nu are nicio boala!</p>";
}
else{
    echo "<form action='' method='post' enctype='multipart/form-data'>";
    echo "<p>Bolile pe care le are animalul:</p>";

    while($map = $check_boli->fetch()){
        $id_boala = $map['id_boala'];

        $check_infoBoala = $conn->prepare("select * from boli where id_boala=?");
        $check_infoBoala->execute(array($id_boala));
        $infoBoala = $check_infoBoala->fetch();

        echo "<br><input type='radio' name='id_boala' value='" . $infoBoala['id_boala'] . "'/>" . $infoBoala['nume_boala'] ;
    }

    echo "<br><input type='submit' value='Sterge boala de la animalul curent' name='submit'/> </form>";

}

if(isset($_POST['submit'])){
    $id_boala = $_POST['id_boala'];

    $check_mapare = $conn->prepare("select * from mapare_fisa_boala where id_fisa=? and id_boala=?");
    $check_mapare->execute(array($id_fisa,$id_boala));

    $rows = $check_mapare->rowCount();

    if($rows == 0){
        echo "<script>alert('Ne pare rau, asocierea dintre aceasta fisa si boala nu exista in baza de date!')</script>";
    }
    else{
        $delete_mapare = $conn->prepare("delete from mapare_fisa_boala where id_fisa=? and id_boala=?");
        $res = $delete_mapare->execute(array($id_fisa,$id_boala));
        if(!$res){
            echo "<script>alert('Ne pare rau, stergerea nu s-a putut efectua, va rugam sa reveniti mai tarziu!')</script>";
        }
        else{
            echo "<script>alert('Stergerea bolii de la animalul curent s-a efectuat cu succes!')</script>";
        }
    }
}
?>

