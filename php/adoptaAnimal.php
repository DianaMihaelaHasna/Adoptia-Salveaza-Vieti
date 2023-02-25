<!DOCTYPE html>
<?php
session_start();
global $conn;
if(!isset($_SESSION['id_utilizator'])){
    header("location: ../index.php");
}

include("../include/inHeaderUser.php");

$id_animal = $_GET['id_animal'];
$select_animal = $conn->prepare("select * from animale where id_animal=?");
$select_animal->execute(array($id_animal));
$animal = $select_animal->fetch();

$nume_a = $animal['nume'];
$tip_a = $animal['tip_animal'];
$rasa_a = $animal['rasa'];
$gen_a = $animal['gen'];
$varsta_a = $animal['varsta'];
$mediu_a = $animal['mediu_viata'];
$acomodabil_a = $animal['acomodabil'];

$id_utilizator = $_SESSION['id_utilizator'];
$select_utilizator = $conn->prepare("select * from utilizatori where id_utilizator=?");
$select_utilizator->execute(array($id_utilizator));
$utilizator = $select_utilizator->fetch();

$nume_u = $utilizator['nume'];
$prenume_u = $utilizator['prenume'];
$email_u = $utilizator['email'];
$telefon_u = $utilizator['telefon'];

$data_adoptie = date("d-M-Y");

?>

<title>Home</title>
<link rel="stylesheet" type="text/css" href="../css/admin.css">
<script type="text/javascript" src="../javascript/adminJS.js" > </script>
<body background="../imagini/adoptie.jpg"></body>

<div class="content">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="container1">
            <div class="container">
                <div id="formular">
                    <h1 align="center" class="a">Formular adoptie pentru <?php echo $animal['nume']; ?> </h1>

                    <p>Data adoptiei: <?php echo $data_adoptie; ?> </p>

                    <p>Informatii despre persoana care adopta animalul:
                        <ul>
                            <li>
                                Nume: <?php echo $nume_u;?>
                            </li>
                            <li>
                                Prenume: <?php echo $prenume_u;?>
                            </li>
                            <li>
                                Telefon: <?php echo $telefon_u;?>
                            </li>
                            <li>
                                Email: <?php echo $email_u;?>
                            </li>
                        </ul>
                    </p>



                    <p>Informatii despre animalul adoptat:
                        <ul>
                            <li>
                                Nume: <?php echo $nume_a;?>
                            </li>
                            <li>
                                Tipul animalului: <?php echo $tip_a;?>
                            </li>
                            <li>
                                Rasa: <?php echo $rasa_a;?>
                            </li>
                            <li>
                                Gen: <?php echo $gen_a;?>
                            </li>
                            <li>
                                Varsta: <?php echo $varsta_a;?>
                            </li>
                            <li>
                                Mediu de viata: <?php echo $mediu_a;?>
                            </li>
                            <li>
                                Acomodabil cu alte animale: <?php echo $acomodabil_a;?>
                            </li>
                        </ul>
                    </p>


                </div>

                <hr>

                <button class="submit" type="submit" name="submit">Adopta</button>

                <button class="reset" type="reset">Reset</button>



            </div>
        </div>
    </form>
</div>

<?php

if(isset($_POST['submit'])){

    $id_max = $conn->prepare("select * from adoptii");

    $id_max->execute();

    $maxim_id = -1;

    while ($result2 = $id_max->fetch()) {
        if ((int)$result2["id_adoptie"] > $maxim_id) {
            $maxim_id = (int)$result2["id_adoptie"];
        }
    }

    if ($maxim_id == -1) {

        $adoptie_id = "1";

    } else {
        $adoptie_id = $maxim_id + 1;
        $adoptie_id = (string)$adoptie_id;

    }
    $insert_adoptie = $conn->prepare("insert into adoptii values(?,?,?,?)");
    $res = $insert_adoptie->execute(array($adoptie_id,$id_utilizator,$id_animal,$data_adoptie));

    if(!$res){
        die("<script>alert('Ne pare rau, in acest moment nu se pot face adoptii, va rugam sa reveniti mai tarziu')</script>");
    }
    else{

        $update_a = $conn->prepare("update animale set adoptat='da' where id_animal=?");
        $up = $update_a->execute(array($id_animal));

        if(!$up){
            $delete_adoptie = $conn->prepare("delete from adoptii where id_adoptie=?");
            $delete_adoptie->execute(array($adoptie_id));
            die("<script>alert('Ne pare rau, in acest moment nu se pot face adoptii, va rugam sa reveniti mai tarziu')</script>");
        }
        else {
            echo "<script>alert('Felicitari, ati adoptat un animal!')</script>";
        }
    }

}