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

$id_animal = $_GET['id_animal'];

$check_animal = $conn->prepare("select * from animale where id_animal=?");
$check_animal->execute(array($id_animal));

$infoAnimal = $check_animal->fetch();



$check_fisa = $conn->prepare("select * from fisa_medicala where id_animal=?");
$check_fisa->execute(array($id_animal));

$rows = $check_fisa->rowCount();






if(isset($_POST['submit'])){
    $id_max = $conn->prepare("select * from fisa_medicala");


    $id_max->execute();

    $maxim_id = -1;


    while ($result2 = $id_max->fetch()) {
        if ((int)$result2["id_fisa"] > $maxim_id) {
            $maxim_id = (int)$result2["id_fisa"];
        }
    }

    if ($maxim_id == -1) {

        $fisa_id = "1";

    } else {
        $fisa_id = $maxim_id + 1;
        $fisa_id = (string)$fisa_id;

    }

    $insert_fisa = $conn->prepare("insert into fisa_medicala values(?,?)");
    $res = $insert_fisa->execute(array($fisa_id,$id_animal));
    if($res){
        echo "<script>alert('Fisa medicala a fost creata')</script>";
        echo "<script>window.open('vizualizareAnimal.php?id_animal=" . $id_animal . "','_self')</script>";
    }
    else{
        echo "<script>alert('Fisa medicala nu s-a putut crea, va rugam sa reveniti mai tarziu!')</script>";
    }

}



?>


<title>Vizualizare animal</title>


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
                        <td colspan="7" class="active"><h2><?php echo $infoAnimal['nume']; ?></h2>

                    <tr>
                        <th rowspan="7"> <?php echo "<img src='" . $infoAnimal['imagine_ref'] . "' style ='width:200px;height:200px''>"; ?>

                        <td>Descriere
                        <td><textarea class="form-control" type="text" name="nume" ><?php echo $infoAnimal['descriere']; ?>
                            </textarea>
                    <tr>
                        <td>Rasa
                        <td><?php echo $infoAnimal['rasa']; ?>
                    <tr>
                        <td>Gen
                        <td><?php echo $infoAnimal['gen']; ?>
                    <tr>
                        <td>Varsta
                        <td><?php echo$infoAnimal['varsta'] ;?>
                    <tr>
                    <tr>
                        <td>Mediu de viata
                        <td><?php echo$infoAnimal['mediu_viata']; ?>

                    <tr>
                        <td>Acomodabil
                        <td><?php echo$infoAnimal['acomodabil']; ?>


                    <tr align="center">
                        <td colspan="7"><?php  if($rows == 0 and isset ($_SESSION['id_administrator'])) {
                                echo "<form action='' method='post'>";
                                echo "<button class='submit' type='submit' name='submit'>Creeaza fisa</button>";
                                echo "</form>";
                            };?>

                    <tr align="center">
                        <td colspan="7">           <?php
                            if($rows == 1) {
                            echo "<button class='btn3' ><a href='vizualizareFisa.php?id_animal=" . $id_animal . "' style='color:#0b0c10 '>Fisa medicala</a>";
                            } ?>

                    <tr align="center">
                        <td colspan="7"> <?php
                            if(isset($_SESSION['id_utilizator'])){
                                echo "<br><a class='btn3' href='adoptaAnimal.php?id_animal=" . $id_animal . "' style='color:#0b0c10 '>Adopta animalul curent.</a>";
                            }
                             ?>




                </table>
            </form>

        </div>

    </div>

<?php include("../include/footer.php"); ?>