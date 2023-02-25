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


$res = $query->fetch();

$first_name = $res['nume'];
$last_name = $res['prenume'];
$email = $res['email'];
$pass = $res['parola'];
$telefon = $res['telefon'];


?>



    <title>Editeaza profilul</title>


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
                        <td colspan="7" class="active"><h2>Editeaza profilul</h2>

                    <tr>
                        <th rowspan="5"><img src="../imagini/cutu4.jpg">

                        <td>Nume
                        <td><input class="form-control" type="text" name="nume" required value="<?php echo $first_name; ?>">
                    <tr>
                        <td>Prenume
                        <td><input class="form-control" type="text" name="prenume" required value="<?php echo $last_name; ?>">
                    <tr>
                        <td>Telefon
                        <td><input class="form-control" type="text" name="telefon" required value="<?php echo $telefon; ?>">
                    <tr>
                        <td>Parola
                        <td><input class="form-control" type="password" name="pass" id="mypass" required value="<?php echo $pass; ?>">
                            <input type="checkbox" onclick="show_password()"><strong>Arata parola</strong>
                    <tr>
                        <td>E-mail
                        <td><input class="form-control" type="email" name="email" required value="<?php echo $email; ?>">

                    <tr align="center">
                        <td colspan="7">
                            <input type="submit" class="btn btn-info" name="update" style="width: 250px;" value="Editeaza">


                </table>
            </form>

        </div>

    </div>



<?php

if(isset($_POST['update'])){
    $first_name = $_POST['nume'];
    $last_name = $_POST['prenume'];
    $telefon = $_POST['telefon'];
    $pass = $_POST['pass'];
    $email2 = $_POST['email'];

    $check_email1 = $conn->prepare("select * from administratori where email=?");
    $check_email2 = $conn->prepare("select * from utilizatori where email=?");

    $check_email1 ->execute(array($email2));
    $check_email2 ->execute(array($email2));

    $rows1 = $check_email1->rowCount();
    $rows2 = $check_email2->rowCount();

    if($email != $email2) {
        if ($rows1 == 1 or $rows2 == 1) {

            //va urma
            die("<script>alert('Ne pare rau, email ul este deja folosit!')</script>");
        }
    }

    if(isset($_SESSION["id_administrator"])){
        $update = $conn->prepare("UPDATE administratori SET nume=?, prenume=?,  email=?, parola=?, telefon=? WHERE id_administrator=?");
    }else{
        if(isset($_SESSION["id_utilizator"])){
            $update = $conn->prepare("UPDATE utilizatori SET nume=?, prenume=?,  email=?, parola=?, telefon=? WHERE id_utilizator=?");
        }
    }

    $res = $update->execute(array($first_name,$last_name,$email2,$pass,$telefon,$session_id));


    if($res){
        echo "<script>alert('Datele dumneavoastra au fost schimbate')</script>";
    }
    else{
        echo "<script>alert('Ne pare rau, nu s-a putut face update, va rugam sa reveniti mai tarziu!')</script>";

    }
    echo "<script>window.open('editProfile.php', '_self')</script>";

}
include("../include/footer.php");