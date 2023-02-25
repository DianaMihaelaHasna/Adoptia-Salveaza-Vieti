
<?php
session_start();
global $conn;

if(isset($_SESSION["id_administrator"])){
    include("../include/inHeaderAdmin.php");
    $session_id = $_SESSION['id_administrator'];
    $query = $conn->prepare("SELECT * FROM administratori WHERE id_administrator=?");
    $query->execute(array($session_id));
}else{
    if(isset($_SESSION["id_utilizator"])){
        include("../include/inHeaderUser.php");
        $session_id = $_SESSION['id_utilizator'];
        $query = $conn->prepare("SELECT * FROM utilizatori WHERE id_utilizator=?");
        $query->execute(array($session_id));
    }
    else{
        header("location: ../index.php");
    }
}


echo "<link rel='stylesheet' type='text/css' href='../css/admin.css'>";



$id_animal = $_GET['id_animal'];

$check_animal = $conn->prepare("select * from animale where id_animal=?");
$check_animal->execute(array($id_animal));

$infoAnimal = $check_animal->fetch();

echo "<center><h2>Fisa medicala  " . $infoAnimal['nume'] .  "</h2></center><br><br>";

$check_fisa = $conn->prepare("select * from fisa_medicala where id_animal=?");
$check_fisa->execute(array($id_animal));

$res = $check_fisa->fetch();
$fisa_id = $res['id_fisa'];

$check_boli = $conn->prepare("select * from mapare_fisa_boala where id_fisa=?");

$check_boli->execute(array($fisa_id));

$rows = $check_boli->rowCount();


?>


<title>Vizualizare fisa medicala</title>


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
    <th rowspan="3"> <?php echo "<img src='" . $infoAnimal['imagine_ref'] . "' style ='width:200px;height:200px''>"; ?>

    <td>Descriere
    <td><textarea class="form-control" type="text" name="nume" ><?php echo $infoAnimal['descriere']; ?>
                            </textarea>
<tr>
    <td>Afectiuni
    <td><?php if($rows == 0){
                                echo "<p>Animalul nu prezinta nici o afectiune sau tratament!</p>";

                            }
                            else{
                                echo "<p>Afectiunile  de care sufera " . $infoAnimal['nume'] . ":</p>";
                                echo "<ol>";
                                while($map = $check_boli->fetch()){
                                    $id_boala = $map['id_boala'];

                                    $check_infoBoala = $conn->prepare("select * from boli where id_boala=?");
                                    $check_infoBoala->execute(array($id_boala));
                                    $infoBoala = $check_infoBoala->fetch();

                                    echo "<li><a href='vizualizareBoala.php?id_boala=" . $id_boala . "'>" . $infoBoala['nume_boala'] . "</a></li>";
                                }
                                echo "</ol>";


                            } ?>

<tr align="center">
    <td colspan="7"><?php if(isset($_SESSION['id_administrator'])){
    echo "<a href='editFisa.php?id_animal=" . $id_animal . "&id_fisa=" . $fisa_id . "' ><input type='button' value='Editeaza fisa medicala' class='btn3'></a>";
};?>


        </table>
        </form>

        </div>

        </div>

<?php include("../include/footer.php"); ?>