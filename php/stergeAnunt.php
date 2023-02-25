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
?>
    <script type="text/javascript" src="../javascript/adminJS.js" > </script>
    <link rel="stylesheet" type="text/css" href="../css/admin.css">
    <body background="../images/trash1.jpg"></body>
    <div class="content">
        <form action="" method="post" name="form1">
            <div class="container1">
                <div class="container">
                    <h1 align="center" class="a">Stergere anunt</h1>
                    <hr>


                    <label for="parola"><b>Parola:</b></label>
                    <input type="password" placeholder="Introduceti parola" name="parola" id="parola" required >


                    <hr>

                    <button class="submit" type="submit" name="submit">Sterge</button>

                    <button class="reset" type="reset">Reset</button>


                </div>
            </div>
        </form>
    </div>

<?php
include ("../include/footer.php");

if(isset($_POST['submit'])){
    global $conn;

    $parola = $_POST['parola'];

    $anunt_id = $_GET['id_anunt'];

    $verifyCourse = $conn->prepare("delete from anunturi where id_anunt=?");

    $res = $verifyCourse->execute(array($anunt_id));

    if(!$res){
        die("Ne pare rau, nu s-a putut efectua stergerea anuntului! Va rugam sa reveniti mai tarziu! ");
    }



    echo "<script>alert('Anuntul a fost sters !')</script>";






}
?>