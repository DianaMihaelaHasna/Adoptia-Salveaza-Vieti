<?php
include("include/outHeader.php");
?>


<head>
    <title>Adoptia Salveaza Vieti </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="css/admin.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@1,100&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <meta content="text/html; charset=iso-8859-2" http-equiv="Content-Type">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">



    <style>
        * {box-sizing: border-box;}
        body {font-family: Verdana, sans-serif;}


        .active {
            background-color: #717171;
        }



    </style>



</head>



<body>

<div class="content">


    <div class="slideshow-container">

        <div class="mySlides fade">
            <img class="slideshow" src="imagini/look.jpg" >

            <div class="text">LOOKING FOR A NEW FRIEND?</div>
            <button class="btn"><a href="/Adoptia-Salveaza-Vieti/php/signup.php">Join now!</a></button>
            <div class="text2">Have you ever considered  adopting a pet? NO?!
                <br>Well now it's time!</div>
        </div>

        <div class="mySlides fade">
            <img class="slideshow" src="imagini/look.jpg">
            <div class="text">TIRED OF BEEING ALONE?</div>
            <button class="btn"><a href="/Adoptia-Salveaza-Vieti/php/signup.php">Join now!</a></button>
            <div class="text2">Fill the empty space from your life with the love of a pet.
                <br>Let us find you a forever friend!</div>
        </div>

        <div class="mySlides fade">
            <img class="slideshow" src="imagini/look.jpg" >
            <div class="text">Color your life!</div>
            <button class="btn"><a href="/Adoptia-Salveaza-Vieti/php/signup.php">Join now!</a></button>
            <div class="text2">You need them and they need you!
                <br>There is no " perfect time " for adopting , there is now!</div>
        </div>













    </div>
    <br>

    <div style="text-align:center">
        <span class="dot"></span>
        <span class="dot"></span>
        <sFpan class="dot"></sFpan>
        <span class="dot"></span>
        <span class="dot"></span>

    </div>


    <br>
    <br>
    <br>
    <br>

    <table class="centered">
        <tr>
            <th class="scris">WHY CHOOSE US</th>
        </tr>
        <tr>
            <td><img src="imagini/paw.png" height=50 width=50></img></td>

        </tr>
        <tr class="scris2">
            <td>We don't just find you a  simple animal, </td>

        </tr>
        <tr class="scris2">
            <td>we find you a friend and a lifelong comrade.</td>

        </tr>
    </table>

    <br>
    <br>
    <br>
    <br>


    <div class="gallery">

        <img src="imagini/control.jpg" alt="Cinque Terre" width="300" height="200">
        </a>
        <div class="desc">High quality medical care.
        </div>
    </div>

    <div class="gallery">
        <img src="imagini/adopt.jpg" alt="Cinque Terre" width="300" height="200">
        </a>
        <div class="desc">Finding you a friend,not just a pet.</div>
    </div>

    <div class="gallery">
        <img src="imagini/lost.jpg" alt="Cinque Terre" width="300" height="200">
        </a>
        <div class="desc"> Lost your furry friend?
            <br>Search here!</div>
    </div>

    <div class="gallery">
        <img src="imagini/grooming.jpg" alt="Cinque Terre">
        </a>
        <div class="desc">We take care of their fur,as well as their health</div>
    </div>





    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <table class="sectiune">


        <tr class="rand1">
            <th colspan="2" class="titlu">ADOPTIA SALVEAZA VIETI</th>
        </tr>
        <tr>
            <td class="coloana_stanga">
                <p class="indent">Bored of beeing alone? To much peace in the house,and you need a little buddy to make everything more colorful?
                <p class="indent">Or do you have a furry friend and you are looking after a home for him?
            </td>
            <td class="coloana_dreapta">
                <p class="indent">Well you came in the right place!</p>
                <p class="indent">Even if you want to :</p>
                <ul>
                    <li>adopt</li>
                    <li>give for adoption </li>
                    <li>your're looking after your missing friend </li>
                    <li> or you have  found a pet and you are trying to find it's owner</li>
                </ul>
                <p class="indent">"Adoptia salveaza vieti" is the right website for you!</p>

            </td>
        </tr>
    </table>



</div>


<?php
include("include/footer.php");
?>

<script>
    var slideIndex = 0;
    showSlides();

    function showSlides() {
        var i;
        var slides = document.getElementsByClassName("mySlides");
        var dots = document.getElementsByClassName("dot");
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        slideIndex++;
        if (slideIndex > slides.length) {slideIndex = 1}
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex-1].style.display = "block";
        dots[slideIndex-1].className += " active";
        setTimeout(showSlides, 4000); // Change image every 2 seconds
    }
</script>



</body>
