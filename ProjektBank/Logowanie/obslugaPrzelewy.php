<?php

session_start();

if (!isset($_POST['kwota'])) {
    header('Location: przelewy.php');
    exit();
}

/*... Gdy uzytkownik odświeży kartę to przeniesie go do strony głównej ...*/
if (isset($_SESSION['odswiezanie'])) {
    unset($_SESSION['odswiezanie']);
    header('Location: index.php');
    exit();
} else {
    $_SESSION['odswiezanie'] = 1;


    $kwota = $_POST['kwota'];
    $komentarz = $_POST['komentarz'];

    //Łączenie z Bazą Danych
    require_once "connect2.php";

    $polaczenie = new mysqli($host, $db_user, $db_password, $db_name);


    /*... Update niejawny bazy o kwotę którą podano w $kwota ...*/
    if ($kwota > 0) {

        /*...Zapytanie uaktualniające dane nadawcy saldo_konta w tabeli klienci...*/
        $sqlUpdate = "UPDATE klienci SET saldo_konta=" . ($_SESSION['saldo_konta'] . "-" . $kwota) . " WHERE klienci.id = " . $_SESSION['id'];
        /*Odpalenie zapytania do bazy*/
        $polaczenie->query($sqlUpdate);



        $sqlSaldoOdbiorcy = "Select ss.saldo_konta FROM (SELECT saldo_konta from klienci where login = '" . $_POST['klient'] . "') as ss";
        $rez = $polaczenie->query($sqlSaldoOdbiorcy);
        if ($rez->num_rows > 0) {
            /*...Wypisanie wszystkiego z bazy danych - które podmienia zmienną sesyjną saldo_konta ...*/
            while ($row = $rez->fetch_assoc()) {
                $_SESSION['saldo_odbiorcy'] = (float) $row['saldo_konta'];
                echo "</br>";
            }
        }

        /*...Zapytanie uaktualniające dane odbiorcy saldo_konta w tabeli klienci...*/
        $sqlUpdat = "UPDATE klienci SET saldo_konta=" . ($_SESSION['saldo_odbiorcy'] . "+" . $kwota) . " WHERE klienci.login = '" . $_POST['klient'] . "'";
        /*Odpalenie zapytania do bazy*/
        $polaczenie->query($sqlUpdat);




        /*...Pobranie nowego salda z bazy do zmiennej sesyjnej...*/
        $sqlNoweSaldo = "select saldo_konta from klienci where id=" . $_SESSION['id'];

        $rezult = $polaczenie->query($sqlNoweSaldo);
        if ($rezult->num_rows > 0) {
            /*...Wypisanie wszystkiego z bazy danych - które podmienia zmienną sesyjną saldo_konta ...*/
            while ($row = $rezult->fetch_assoc()) {
                $_SESSION['saldo_konta'] = (float) $row['saldo_konta'];
                echo "</br>";
            }
        }
        /*... KONIEC - Pobranie nowego salda z bazy do zmiennej sesyjnej */
    }

    /*Wpisanie do tabeli historia_tranzakcji danych: " id (null -bo autoIncrement), login_odbiorca, login_wysylajacy, kwota, opis_komentarz ...  */

    $sqlWpisHistoria = "INSERT INTO historia_tranzakcji VALUES ('NULL', '" . $_POST['klient'] . "','" . $_SESSION['login'] . "', $kwota, '" . $komentarz . "')";

    /*...Odpalenie zapytania do tabeli historia_tranzakcji...*/
    $polaczenie->query($sqlWpisHistoria);

    /*...Zwolnienie pamięci z zmiennych - przydaje się przy zmiennych sesyjnych saldo_konta...*/
    unset($row);
    unset($rezult);
    unset($rezultat);
    unset($sql);
    unset($sqlNoweSaldo);
    unset($sqlUpdate);
    unset($kwota);
    $polaczenie->close();
}
?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FiKu - Bank z pomysłem</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div id="container">
        <b style="text-align: center; margin-left:auto; margin-right: auto; font-size: 30px;">Przelew został wysłany pomyślnie!
            </br></br>
            <?php
            echo '<a href="przelewy.php">Nadaj kolejny przelew>></a>';
            echo '</br></br><a href="index.php">Wróć do strony głównej>></a>';
            ?>
            </br>
        </b>
    </div>
</body>

</html>