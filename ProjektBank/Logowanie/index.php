<?php

session_start();

if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany'] == true)) {
 header('Location: zalogowany.php');
  exit();
}


unset($_SESSION['zalogowany']);
?>



<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FiKu Bank - Logowanie do systemu</title>
    <!--
    <link rel="stylesheet" type="text/css" href="../mojestyle.css">
-->
    <link rel="stylesheet" type="text/css" href="style.php">
</head>

<body>

    <div class="szerokosc">

        <nav>
            <div id="logo">
                <a href="../index.html"><img src="../FikuBank.jpg" /></a>
            </div>
            <div id="logo2">
                <a href="../index.html" style="float: right;padding-right: 50px;">Powrót do strony głównej</a>
                <a href="#" style="float: right;padding-right: 50px;">Kontakt</a>
            </div>
            <div style="clear: both;"></div>
        </nav>


        <div class="lewy">
            <div id="goraLewy">FiKu BANK </br>zadbamy!</div>

            <div class="przerwa"></div>

            <div id="srodekLewy" style="font-size: 30px; font-weight: 700; letter-spacing: 1px;">
                <img src="../polecanieWskazanie.jpg" />
                </br></br>
                Zapraszamy
            </div>

            <div class="przerwa"></div>
            <div id="dolLewy">
                <img src="../tloLudzie.jpg" />

            </div>
        </div>
        <div class="centrum">

            <div id="container">
                <i><b>Logowanie</b></i>
                </br>

                <form action="zaloguj.php" method="post">

                    <input name="login" type="text" placeholder="login" onfocus="this.placeholder=''" onblur="this.placeholder='login'">

                    <input name="haslo" type="password" placeholder="hasło" onfocus="this.placeholder=''" onblur="this.placeholder='hasło'">

                    <input type="submit" style="margin-bottom: 10px;" value="Zaloguj się">

                </form>
                <?php
                if (isset($_SESSION['blad'])) echo $_SESSION['blad'];
                unset($_SESSION['blad']);
                ?></br>

                <a href="rejestracja.php">Załóż konto>></a>

            </div>


            <div id="srodekDolny">
                <h5>Uwaga! Może zadzwonić do Ciebie przestępca</h5>

                Przestępcy dzwonią do naszych klientów i podszywają się pod pracowników banku. Bądź czujny, to próba wyłudzenia poufnych danych przez rozmowę telefoniczną.
                <a href="#">więcej>></a>
            </div>

        </div>


        <div class="prawy"></div>
    </div>
    

</body>

</html>