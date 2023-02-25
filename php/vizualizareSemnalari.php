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


$check_semnalari = $conn->prepare("select * from semnalari");
$check_semnalari->execute();


echo "<div class=content>";
while($semnalare = $check_semnalari->fetch())
{
    echo "<div class='gallery'>
                <a href='vizualizareSemnalare.php?id_semnalare=" . $semnalare["id_semnalare"] . "'>
                <div class='desc'> " . $semnalare["tip_semnalare"] . " </div><br>
                    <p> " . $semnalare["locatie"] . "</p></div></a>";

}
echo "</div>";


?>

<title>Vizualizare sesizari</title>
<body background="../imagini/fundal%20sesizari.jpg"></body>


<?php
include("../include/footer.php");

?>


