<?php

session_start();

if (isset($_POST['email'])) {

    //Udana walidacja? Załóżmy, że tak!
    $wszystko_ok = true;

    //Sprawdź poprawnść imienia
    $imie = $_POST['imie'];

    if ((strlen($imie) < 3) || (strlen($imie) > 20)) {
        $wszystko_ok = false;
        $_SESSION['e_imie'] = "Imię musi posiadać od 3 do 20 znaków!";
    }

    //Sprawdź poprawnść nazwiska
    $nazwisko = $_POST['nazwisko'];

    if ((strlen($nazwisko) < 2) || (strlen($nazwisko) > 38)) {
        $wszystko_ok = false;
        $_SESSION['e_nazwisko'] = "Nazwisko musi posiadać od 2 do 38 znaków!";
    }

    //Sprawdź poprawnść nickname'a
    $nick = $_POST['nick'];

    //Sprawdzenie długości nick'a
    if (strlen($nick) < 3 || (strlen($nick) > 20)) {
        $wszystko_ok = false;
        $_SESSION['e_nick'] = "Nick musi posiadać od 3 d 20 znaków!";
    }

    //Sprawdzenie czy znaki są alfanumeryczne
    if (ctype_alnum($nick) == false) {
        $wszystko_ok = false;
        $_SESSION['e_nick'] = "Nick może składac się tylko z liter i cyfr (bez polskich znaków)";
    }

    //Sprawdź poprawność adresu e-mail
    $email = $_POST['email'];
    $emailB = filter_var($email, FILTER_SANITIZE_EMAIL);
    if ((filter_var($emailB, FILTER_VALIDATE_EMAIL) == false) || ($emailB != $email)) {
        $wszystko_ok = false;
        $_SESSION['e_email'] = "Podaj poprawny adres e-mail!";
    }

    //Sprawdź poprawność hasła (hasło od 8 do 20 znaków)
    $haslo1 = $_POST['haslo1'];
    $haslo2 = $_POST['haslo2'];

    if ((strlen($haslo1) < 8) || (strlen($haslo1) > 20)) {
        $wszystko_ok = false;
        $_SESSION['e_haslo'] = "Hasło musi posiadać od 8 do 20 znaków!";
    }

    if ($haslo1 != $haslo2) {
        $wszystko_ok = false;
        $_SESSION['e_haslo'] = "Podane hasa nie są identyczne.";
    }

    $haslo_hash = password_hash($haslo1, PASSWORD_DEFAULT);

    if (!isset($_POST['regulamin'])) {
        $wszystko_ok = false;
        $_SESSION['e_regulamin'] = "Potwierdź akceptację regulaminu.";
    }

    //Bot or not? Oto jest pytanie!
    /*...Klucz tajny recaptchy na localhoscie
    $sekret = "6LcOyecUAAAAABMNlLLvYw2dMTbW7BkQShDi3ZrY";
    ...*/
    $sekret = "6LfAu6MZAAAAAI23JEFgO1VVYSZL0BCCzdFI4KeL";
    $sprawdz = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $sekret . '&response=' . $_POST['g-recaptcha-response']);

    $odpowiedz = json_decode($sprawdz);

    if ($odpowiedz->success == false) {
        $wszystko_ok = false;
        $_SESSION['e_bot'] = "Potwierdź, że nie jesteś botem!";
    }
    //Zapamiętaj wprowadzone dane

    $_SESSION['fr_imie'] = $imie;
    $_SESSION['fr_nazwisko'] = $nazwisko;
    $_SESSION['fr_nick'] = $nick;
    $_SESSION['fr_email'] = $email;
    $_SESSION['fr_haslo1'] = $haslo1;
    $_SESSION['fr_haslo2'] = $haslo2;
    if (isset($_POST['regulamin'])) $_SESSION['fr_regulamin'] = true;



    //Łączenie z Bazą Danych
    require_once "connect2.php";
    mysqli_report(MYSQLI_REPORT_STRICT);
    try {

        $polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
        if ($polaczenie->connect_errno != 0) {
            throw new Exception(mysqli_connect_errno());
        } else {

            //Czy email już istnieje?
            $rezultat = $polaczenie->query("Select id from klienci where email='$email'");

            if (!$rezultat) throw new Exception($polaczenie->error);

            $ile_takich_maili = $rezultat->num_rows;

            if ($ile_takich_maili > 0) {
                $wszystko_ok = false;
                $_SESSION['e_email'] = "Istnieje już konto przypisane do adresu e-mail!";
            }

            //Czy nick już istnieje?
            $rezultat = $polaczenie->query("Select id from klienci where login='$nick'");

            if (!$rezultat) throw new Exception($polaczenie->error);

            $ile_takich_nickow = $rezultat->num_rows;

            if ($ile_takich_nickow > 0) {
                $wszystko_ok = false;
                $_SESSION['e_nick'] = "Istnieje już gracz o takim nicku! Wybierz inny.";
            }


            if ($wszystko_ok == true) {

                //Hurra, wszystkie testy zaliczone, dodajemy gracza do bazy
                if ($polaczenie->query("Insert into klienci values (NULL,'$imie','$nazwisko','$email','$nick','$haslo_hash',1000,0)")) {
                    $_SESSION['udanarejestracja'] = true;
                    header('Location: witamy.php');
                } else {
                    throw new Exception($polaczenie->error);
                }
            }


            $polaczenie->close();
        }
    } catch (Exception $e) {
        echo '<span style="color:red;">Błąd serwera, przepraszamy za niedogodności i prosimy o rejestrację w innym terminie.</span>';
        echo '</br>Informacja deweloperska: ' . $e;
    }
}

?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FiKuBank - załóż konto</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link rel="stylesheet" href="style.php">

    <style>
        .error {
            color: red;
            margin-top: 10px;
            margin-bottom: 10px;
            font-size: small;
        }
    </style>

</head>

<body>
    <div class="szerokosc">

        <div id="container" style="margin-top: 0px;">
            <i><b>FiKuBank - Rejestracja konta</b></i>
            </br>
            </br>
            <form method="post">


                Imię:</br> <input type="text" value="<?php
                                                        if (isset($_SESSION['fr_imie'])) {
                                                            echo $_SESSION['fr_imie'];
                                                            unset($_SESSION['fr_imie']);
                                                        }
                                                        ?>" name="imie"/></br>
                
                <?php
                if (isset($_SESSION['e_imie'])) {
                    echo '<div class="error">' . $_SESSION['e_imie'] . '</div>';
                    unset($_SESSION['e_imie']);
                }
                ?>



                Nazwisko:</br> <input type="text" value="<?php
                                                        if (isset($_SESSION['fr_nazwisko'])) {
                                                            echo $_SESSION['fr_nazwisko'];
                                                            unset($_SESSION['fr_nazwisko']);
                                                        }
                                                        ?>" name="nazwisko"/></br>
                <?php
                if (isset($_SESSION['e_nazwisko'])) {
                    echo '<div class="error">' . $_SESSION['e_nazwisko'] . '</div>';
                    unset($_SESSION['e_nazwisko']);
                }
                ?>


                Nick: </br><input type="text" value="<?php
                                                        if (isset($_SESSION['fr_nick'])) {
                                                            echo $_SESSION['fr_nick'];
                                                            unset($_SESSION['fr_nick']);
                                                        }
                                                        ?>" name="nick" /></br>

                <?php
                if (isset($_SESSION['e_nick'])) {
                    echo '<div class="error">' . $_SESSION['e_nick'] . '</div>';
                    unset($_SESSION['e_nick']);
                }
                ?>

                E-mail: </br><input type="text" value="<?php
                                                        if (isset($_SESSION['fr_email'])) {
                                                            echo $_SESSION['fr_email'];
                                                            unset($_SESSION['fr_email']);
                                                        }
                                                        ?>" name="email" /></br>

                <?php
                if (isset($_SESSION['e_email'])) {
                    echo '<div class="error">' . $_SESSION['e_email'] . '</div>';
                    unset($_SESSION['e_email']);
                }
                ?>
                Twoje hasło: </br><input type="password" value="<?php
                                                                if (isset($_SESSION['fr_haslo1'])) {
                                                                    echo $_SESSION['fr_haslo1'];
                                                                    unset($_SESSION['fr_haslo1']);
                                                                }
                                                                ?>" name="haslo1" /></br>

                <?php
                if (isset($_SESSION['e_haslo'])) {
                    echo '<div class="error">' . $_SESSION['e_haslo'] . '</div>';
                    unset($_SESSION['e_haslo']);
                }
                ?>

                Powtórz hasło: </br><input type="password" value="<?php
                                                                    if (isset($_SESSION['fr_haslo2'])) {
                                                                        echo $_SESSION['fr_haslo2'];
                                                                        unset($_SESSION['fr_haslo2']);
                                                                    }
                                                                    ?>" name="haslo2" /></br>


                <label>
                    <input type="checkbox" name="regulamin" <?php
                                                            if (isset($_SESSION['fr_regulamin'])) {
                                                                echo "checked";
                                                                unset($_SESSION['fr_regulamin']);
                                                            }
                                                            ?> />Akceptuję regulamin
                </label>
                </br>
                <?php
                if (isset($_SESSION['e_regulamin'])) {
                    echo '<div class="error">' . $_SESSION['e_regulamin'] . '</div>';
                    unset($_SESSION['e_regulamin']);
                }
                ?>
                <div class="text-xs-center">
                  <!--Recaptcha na localhoscie  
                  <div class="g-recaptcha" data-sitekey="6LcOyecUAAAAAEvu9cpst9Vo5DUK2sEu7ty5TDtI"></div> 
                  -->
                    <div class="g-recaptcha" data-sitekey="6LfAu6MZAAAAAOpTtKbocVXpd86GuUE5khCgtnWt"></div>
                </div>
                </br>
                <?php
                if (isset($_SESSION['e_bot'])) {
                    echo '<div class="error">' . $_SESSION['e_bot'] . '</div>';
                    unset($_SESSION['e_bot']);
                }
                ?>
                <input type="submit" value="Zarejestruj się" />

            </form>
            <a href="index.php">Logowanie>></a>
        </div>
    </div>

</body>

</html>