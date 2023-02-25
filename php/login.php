<?php
session_start();
include("../include/outHeader.php");
?>

<link rel="stylesheet" type="text/css" href="../css/admin.css">
<body background="../imagini/pisi2.jpg"></body>
<div class="content">
    <form action="" method="post">

        <div class="container1">

            <div class="container">

                <h1 align="center" class="a">Log In</h1>

                <hr>


                <label for="email"><b>Email:</b></label>
                <input type="text" placeholder="Introdu email-ul" name="email" required>

                <label for="password"><b>Parola:</b></label>
                <input type="password" placeholder="Introdu parola" name="password" required >

                <hr>

                <button class="submit" type="submit" name="submit">Login</button>

                <button class="reset" type="reset">Delete</button>


                <br>
            </div>
        </div>
    </form>
</div>
<?php

include("../include/footer.php");

if(isset($_POST["submit"]))
{
    global $conn;

    $email = $_POST["email"];
    $password = $_POST["password"];

    $check_user = $conn->prepare("select * from utilizatori where email=? AND parola=?");
    $check_admin = $conn->prepare("select * from administratori where email=? AND parola=?");

    $check_user ->execute(array($email,$password));
    $check_admin ->execute(array($email,$password));

    $rows_user = $check_user->rowCount();

    if($rows_user == 1){

        $result = $check_user->fetch();
        $_SESSION['id_utilizator'] = $result['id_utilizator'];

        $user_id = $result['id_utilizator'];
        echo "<script>window.open('mainUser.php', '_self')</script>";
    }


    $rows_admin = $check_admin->rowCount();

    if($rows_admin == 1){

        $result = $check_admin->fetch();
        $_SESSION['id_administrator'] = $result['id_administrator'];

        $admin_id = $result['id_administrator'];

        echo "<script>window.open('mainAdmin.php', '_self')</script>";
    }

    if($rows_user != 1 and $rows_admin != 1)
    {
        echo "<script>alert('Credentiale gresite');</script>";
    }


}

?>

