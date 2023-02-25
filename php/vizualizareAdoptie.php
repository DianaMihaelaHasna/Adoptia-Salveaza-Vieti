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

$id_adoptie = $_GET['id_adoptie'];

$check_adoptie = $conn->prepare("select * from adoptii where id_adoptie=?");
$check_adoptie->execute(array($id_adoptie));

$infoAdoptie = $check_adoptie->fetch();


$data_adoptie = $infoAdoptie['data_adoptie'];




$id_animal = $infoAdoptie['id_animal'];

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




$id_utilizator = $infoAdoptie['id_utilizator'];

$select_utilizator = $conn->prepare("select * from utilizatori where id_utilizator=?");
$select_utilizator->execute(array($id_utilizator));
$utilizator = $select_utilizator->fetch();

$nume_u = $utilizator['nume'];
$prenume_u = $utilizator['prenume'];
$email_u = $utilizator['email'];
$telefon_u = $utilizator['telefon'];


?>



    <title>Vizualizare Adoptie</title>
    <link rel="stylesheet" type="text/css" href="../css/admin.css">
    <script type="text/javascript" src="../javascript/adminJS.js" > </script>
<body background="../imagini/adoptaa.jpg"></body>
    <div class="content">
        <div class="container1">
            <div class="container4">
                <div id="formular">
                    <h1 align="center" class="a">Adoptie <?php echo $animal['nume']; ?>: </h1>

                    <p>Data adoptiei: <?php echo $data_adoptie; ?> </p>

                    <p>Informatii despre persoana care a adoptat animalul:
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




            </div>
        </div>

    </div>


<?php

include("../include/footer.php");

