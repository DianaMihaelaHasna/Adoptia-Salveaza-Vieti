<?php
session_start();
include("../include/outHeader.php");

?>

    <link rel="stylesheet" type="text/css" href="../css/admin.css">
    <body background="../imagini/cutu-pisi.jpg"></body>
    <div class="content">
        <form name="form1" action="" method="post">
            <div class="container1">
                <div class="container">
                    <h1 align="center" class="a">Inregistrare</h1>
                    <hr>

                    <p class="user_type"><input type="radio" onclick="userType(this);" name="userTypeAuth" value="administrator" >Administrator</p>
                    <br>
                    <p class="user_type"><input type="radio" onclick="userType(this);" name="userTypeAuth" value="utilizator" checked>Utilizator</>

                    <br>
                    <br>
                    <br>

                    <label for="nume"><b>Nume:</b></label>
                    <input type="text" placeholder="Introdu numele" name="first_name"  id="first_name" required>

                    <label for="prenume"><b>Prenume:</b></label>
                    <input type="text" placeholder="Introdu prenumele" name="last_name" id="last_name" required >

                    <label for="e-mail"><b>E-mail:</b></label>
                    <input type="text" placeholder="Introdu e-mail" name="email" required>

                    <label for="telefon"><b>Telefon:</b></label>
                    <input type="text" placeholder="Introdu numarul de telefon" name="telefon" required>


                    <label for="pass"><b>Parola:</b></label>
                    <input type="password" placeholder="Introduceti parola" name="password" required>

                    <label for="pass2"><b>Reintroduceti parola:</b></label>
                    <input type="password" placeholder="Introduceti parola" name="password2" required>

                    <div id="security_passwords" hidden>
                        <label for="pass2"><b>Parola de securitate 1:</b></label>
                        <input type="password" placeholder="Introduceti parola" name="sec_pass1" id="sec_pass1">

                        <label for="pass2"><b>Parola de securitate 2:</b></label>
                        <input type="password" placeholder="Introduceti parola" name="sec_pass2" id="sec_pass2">

                        <label for="pass2"><b>Parola de securitate 3:</b></label>
                        <input type="password" placeholder="Introduceti parola" name="sec_pass3" id="sec_pass3">
                    </div>

                    <hr>

                    <button class="submit" type="submit" name="submit" onclick="return validari(document.form1.email)">Trimite</button>

                    <button class="reset" type="reset">Sterge</button>
                    <br>
                    <br>
                    <br>


                </div>
            </div>
        </form>

    </div>

    <br>
    <br>
    <br>
    <br>
    <br>
    <br>


<?php

include("../include/footer.php");

?>

    <script>

        function validari(inputText)
        {
            var mailformat = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
            var pass1 = document.form1.password.value;
            var pass2 = document.form1.password2.value;

            if(inputText.value.match(mailformat) && pass1.toString() === pass2.toString())
            {
                return true;
            }
            else
            {
                if(!inputText.value.match(mailformat))
                {
                    alert("Formatul email-ului nu este acceptat!");
                    document.form1.email.focus();
                }

                if(pass1.toString() !== pass2.toString())
                {
                    alert("Parolele nu corespund!");
                    document.form1.password.focus();
                }

                return false;
            }


        }

        function userType(radioButton){
            var x = radioButton.value;

            if(x === "administrator"){
                document.getElementById("security_passwords").removeAttribute("hidden");
                document.getElementById("sec_pass1").setAttribute("required","");
                document.getElementById("sec_pass2").setAttribute("required","");
                document.getElementById("sec_pass3").setAttribute("required","");
            }
            if(x === "utilizator"){
                document.getElementById("security_passwords").setAttribute("hidden","");
                document.getElementById("sec_pass1").removeAttribute("required");
                document.getElementById("sec_pass2").removeAttribute("required");
                document.getElementById("sec_pass3").removeAttribute("required");
            }
        }

    </script>


<?php

if(isset($_POST["submit"]))
{
    global $conn;
    $userType = $_POST["userTypeAuth"];
    $telefon = $_POST['telefon'];
    if($userType == "administrator")
    {

        $pass1 = $_POST["sec_pass1"];
        $pass2 = $_POST["sec_pass2"];
        $pass3 = $_POST["sec_pass3"];

        $verify_pass = $conn -> prepare("SELECT * FROM parole_securitate WHERE parola1=? AND parola2=? AND parola3=?");

        $params = array($pass1,$pass2,$pass3);

        $verify_pass ->execute($params);

        $result = $verify_pass ->rowCount();

        if($result === 0)
        {
            echo "<script> alert('Parolele de securitate nu sunt corecte!') </script>";

        }
        else{
            $email = $_POST["email"];

            $check_email1 = $conn->prepare("select * from administratori where email=?");
            $check_email2 = $conn->prepare("select * from utilizatori where email=?");


            $check_email1 ->execute(array($email));
            $check_email2 ->execute(array($email));

            $rows1 = $check_email1->rowCount();
            $rows2 = $check_email2->rowCount();

            if($rows1 == 1 or $rows2 == 1){

                die("<script>alert('Ne pare rau, email ul este deja folosit!')</script>");
            }


            $first_name = $_POST["first_name"];
            $last_name = $_POST["last_name"];

            $password = $_POST["password"];

            $id_max = $conn->prepare("select * from administratori");

            $id_max->execute();

            $maxim_id = -1;

            while($result2 = $id_max->fetch())
            {
                if((int)$result2["id_administrator"] > $maxim_id)
                {
                    $maxim_id = (int)$result2["id_administrator"];
                }
            }



            if($maxim_id == -1){

                $admin_id = "1";


                $insert_admin = $conn->prepare("insert into administratori values(?,?,?,?,?,?)");


                $res = $insert_admin->execute(array($admin_id,$first_name,$last_name,$email,$password,$telefon));



                if($res)
                    echo "<script>alert('Felicitari, ati fost introdus in baza de date')</script>";

                else
                    echo "<script>alert('Ne pare rau, inregistrarea a esuat, va rugam sa reveniti mai tarziu!')</script>";



            }
            else{
                $admin_id = $maxim_id + 1;
                $admin_id = (string)$admin_id;


                $insert_admin = $conn->prepare("insert into administratori values(?,?,?,?,?,?)");

                $res = $insert_admin->execute(array($admin_id,$first_name,$last_name,$email,$password,$telefon));


                if($res)
                    echo "<script>alert('Felicitari, ati fost introdus in baza de date')</script>";

                else
                    echo "<script>alert('Ne pare rau, inregistrarea a esuat, va rugam sa reveniti mai tarziu!')</script>";



            }
        }


    }

    if($userType == "utilizator"){
        $first_name = $_POST["first_name"];
        $last_name = $_POST["last_name"];
        $email = $_POST["email"];
        $password = $_POST["password"];


        $check_email1 = $conn->prepare("select * from utilizatori where email=?");
        $check_email2 = $conn->prepare("select * from administratori where email=?");

        $check_email1->execute(array($email));
        $check_email2->execute(array($email));


        $rows1 = $check_email1->rowCount();
        $rows2 = $check_email2->rowCount();


        if($rows1 == 1 or $rows2 == 1){
            die("<script>alert('Ne pare rau, email-ul este deja folosit!')</script>");
        }

        $check_id = $conn->prepare("select * from utilizatori");
        $check_id->execute();


        $maxim_id = -1;
        while($res = $check_id->fetch()){
            if((int)$res["id_utilizator"] > $maxim_id)
            {
                $maxim_id = (int)$res["id_utilizator"];
            }
        }




        if($maxim_id == -1)
        {
            $user_id = "1";

            $insert_user = $conn->prepare("insert into utilizatori values(?,?,?,?,?,?)");

            $res = $insert_user->execute(array($user_id,$first_name,$last_name,$email,$password,$telefon));


            if($res)
                echo "<script>alert('Ati fost introdus in baza de date!')</script>";
            else
                echo "<script>alert('Ne pare rau, inregistrarea a esuat, va rugam sa reveniti mai tarziu!')</script>";
        }
        else{
            $user_id = $maxim_id + 1;
            $user_id = (string)$user_id;

            $insert_user = $conn->prepare("insert into utilizatori values(?,?,?,?,?,?)");

            $res = $insert_user->execute(array($user_id,$first_name,$last_name,$email,$password,$telefon));


            if($res)
                echo "<script>alert('Ati fost introdus in baza de date!')</script>";
            else
                echo "<script>alert('Ne pare rau, inregistrarea a esuat, va rugam sa reveniti mai tarziu!')</script>";

        }

    }
}

?>