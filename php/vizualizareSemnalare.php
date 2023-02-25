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

$id_semnalare = $_GET['id_semnalare'];

$check_semnalari = $conn->prepare("select * from semnalari where id_semnalare=?");
$check_semnalari->execute(array($id_semnalare));

$infoSemnalari = $check_semnalari->fetch();

$id_utilizator = $infoSemnalari['id_utilizator'];
$check_utilizatori = $conn->prepare("select * from utilizatori where id_utilizator=?");
$check_utilizatori->execute(array($id_utilizator));

$infoUser = $check_utilizatori->fetch();

?>



<title>Vizualizare sesizare</title>
<link rel="stylesheet" type="text/css" href="../css/admin.css">
<script type="text/javascript" src="../javascript/adminJS.js" > </script>
<body background="../imagini/fundal%20sesizari.jpg"></body>
<div class="content">
    <div class="container1">
        <div class="container4">
            <div id="formular">
                <h1 align="center" class="a">Sesizare : </h1>

                <p><?php echo "<center><h2>" . $infoSemnalari['tip_semnalare'] . "</h2></center><br><br>"; ?> </p>

                <p>Descriere: </p>
                <ul>
                    <li>
                         <?php echo "<p>" . $infoSemnalari['descriere'] . "</p>";?>
                    </li>
                    <li>
                        <?php echo "<p>Locatie: " . $infoSemnalari['locatie'] . "</p>"; ?>
                    </li>
                    <li>
                         <?php echo "<p>Tipul animalului: " . $infoSemnalari['tip_animal'] . "</p>";?>
                    </li>
                </ul>

                <p>Informatii despre autorul semnalarii:</p>
                <ul>
                    <li>
                        <?php echo "<ul>
        <li>Nume si prenume: " . $infoUser['nume'] . " " . $infoUser['prenume'] . "</li>
        <li>Telefon: " . $infoUser['telefon'] . "</li>
        <li>E-mail: " . $infoUser['email'] . "</li> </ul> " ;
?>
                    </li>


                </ul>
                </p>

            </div>

            <hr>




        </div>
    </div>

</div>





<?php
include("../include/footer.php");
?>
