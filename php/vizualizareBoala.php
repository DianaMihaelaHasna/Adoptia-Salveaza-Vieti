
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

$id_boala = $_GET['id_boala'];

$check_infoBoala = $conn->prepare("select * from boli where id_boala=?");
$check_infoBoala->execute(array($id_boala));
$infoBoala = $check_infoBoala->fetch();


echo "<center><h2>" . $infoBoala['nume_boala'] .  "</h2></center><br><br>";



$check_medicamente = $conn->prepare("select * from mapare_boala_medicament where id_boala=?");
$check_medicamente->execute(array($id_boala));
$rows = $check_medicamente->rowCount();



?>


<title>Vizualizare tratament afectiune</title>


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
                    <td><?php
                        if($rows != 0) {

                            echo "<p>Durata de tratament: " . $infoBoala['durata'] . "</p>";

                            echo "<p>Medicamente utilizate in tratament:";
                            echo "<ol>";
                            while ($medicament = $check_medicamente->fetch()) {
                                $id_medicament = $medicament['id_medicament'];
                                $check_infoMedicament = $conn->prepare("select * from medicamente where id_medicament=?");
                                $check_infoMedicament->execute(array($id_medicament));

                                $infoMedicament = $check_infoMedicament->fetch();

                                echo "<li>" . $infoMedicament['denumire'] . " : " . $infoMedicament['ratie'] . "</li>";
                            }
                        }
                        else{
                            echo "<p>Aceasta boala este fara tratament sau nu are medicamente asociate in acest moment</p>";
                        }?>


            </table>
        </form>

    </div>

</div>



<?php
include("../include/footer.php");
?>
