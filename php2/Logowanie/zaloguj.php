<?php

session_start();

if ((!isset($_POST['login'])) || (!isset($_POST['haslo']))) {
    header('Location: index.php');
    exit();
}

require_once "connect.php";

$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);

if ($polaczenie->connect_errno != 0) {
    echo "Error" . $polaczenie->connect_errno;
} else {
    $login = $_POST['login'];
    $haslo = $_POST['haslo'];

    $login = htmlentities($login, ENT_QUOTES, "UTF-8");

    //if by w razie zapytania ktore zle jest skonstruowane w zmiennej $sql
    if ($rezultat = @$polaczenie->query(
        sprintf(
            "Select * from uzytkownicy where user='%s'",
            mysqli_real_escape_string($polaczenie, $login)
        )
    )) {

        $ilu_userow = $rezultat->num_rows;
        if ($ilu_userow > 0) {

            $wiersz = ($rezultat)->fetch_assoc();

            if (password_verify($haslo, $wiersz['pass'])) {



                $_SESSION['zalogowany'] = true;


                $_SESSION['id'] = $wiersz['id'];
                $_SESSION['user'] = $wiersz['user'];
                $_SESSION['drewno'] = $wiersz['drewno'];
                $_SESSION['kamien'] = $wiersz['kamien'];
                $_SESSION['zboze'] = $wiersz['zboze'];
                $_SESSION['email'] = $wiersz['email'];
                $_SESSION['dnipremium'] = $wiersz['dnipremium'];



                unset($_SESSION['blad']);
                $rezultat->free_result();
                header('Location: gra.php');
            } else {
                $_SESSION['blad'] = '<span style="color:red">Nieprawidłowy login lub hasło</span>';
                header('Location: index.php');
            }
        } else {
            $_SESSION['blad'] = '<span style="color:red">Nieprawidłowy login lub hasło</span>';
            header('Location: index.php');
        }
    } else {
        echo "Błędna konstrukcja zapytania sql";
    }

    $polaczenie->close();
}
