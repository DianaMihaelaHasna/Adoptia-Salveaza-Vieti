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
                    <h1 align="center" class="a">Sterge semnalare</h1>
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

    $id_semnalare = $_GET['id_semnalare'];


    if(isset($_SESSION['id_utilizator'])){
        $verify_user = $conn->prepare("select * from utilizatori where id_utilizator=? and parola=?");
        $verify_user->execute(array($_SESSION['id_utilizator'],$parola));
        $rows = $verify_user->rowCount();
        $approve = 0;
        if($rows == 1){
            $approve = 1;
        }
        else{
            die("<script>alert('Ne pare rau, dar parola introdusa este gresita!')</script>");
        }
    }

    if(isset($_SESSION['id_administrator'])){
        $verify_user = $conn->prepare("select * from administratori where id_administrator=? and parola=?");
        $verify_user->execute(array($_SESSION['id_administrator'],$parola));
        $rows = $verify_user->rowCount();
        $approve = 0;
        if($rows == 1){
            $approve = 1;
        }
        else{
            die("<script>alert('Ne pare rau, dar parola introdusa este gresita!')</script>");
        }
    }



    $verify_semnalare = $conn->prepare("delete from semnalari where id_semnalare=?");

    $res = $verify_semnalare->execute(array($id_semnalare));

    if(!$res){
        die("Ne pare rau, nu s-a putut efectua stergerea semnalarii! Va rugam sa reveniti mai tarziu! ");
    }



    echo "<script>alert('Semnalarea a fost stearsa !')</script>";






}
?>