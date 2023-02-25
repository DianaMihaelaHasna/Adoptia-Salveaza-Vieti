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

$id_anunt = $_GET['id_anunt'];

$check_anunturi = $conn->prepare("select * from anunturi where id_anunt=?");
$check_anunturi->execute(array($id_anunt));

$infoAnunt = $check_anunturi->fetch();

$id_utilizator = $infoAnunt['id_utilizator'];

$check_utilizator = $conn->prepare("select * from utilizatori where id_utilizator=?");
$check_utilizator->execute(array($id_utilizator));
$infoUser = $check_utilizator->fetch();


?>


    <title>Vizualizare anunt</title>


    <script type="text/javascript" src="../javascript/adminJS.js" > </script>
    <link rel="stylesheet" type="text/css" href="../css/admin.css">
    <style>
        td{
            font-weight: bold;
        }
    </style>


    <div class="row content">
        <div class="col-sm-2">
        </div>
        <div class="col-sm-8">
            <form action="" method="POST" enctype="multipart/form-data">
                <table class="table table-bordered table-hover">
                    <tr align="center">
                        <td colspan="2">Descriere

                    <tr>
                        <th> <?php
                            if($infoAnunt['imagine_ref'] !== "../incarcari/no_image.jpg"){
                                echo "<img src='" . $infoAnunt['imagine_ref'] . "'style ='width:200px;height:200px''>";}
                            ?>
                        <td><?php
                            echo $infoAnunt['descriere']; ?>


                    <tr>
                        <td>Locatie
                        <td><?php echo $infoAnunt['locatie'] ; ?>

                    <tr>
                        <td>Informatii despre autorul anuntului:
                        <td>

                            <p>Nume si prenume: <?php echo $infoUser['nume'] . " " . $infoUser['prenume']; ?></p>
                            <p>Telefon: <?php echo $infoUser['telefon']; ?></p>
                            <p>E-mail: <?php echo $infoUser['email']; ?></p>


                </table>
            </form>

        </div>

    </div>




<?php
include("../include/footer.php");
?>