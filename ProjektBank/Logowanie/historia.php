<?php

session_start();

if (!isset($_SESSION['zalogowany'])) {

    header('Location: index.php');
    exit();
}

if (!isset($_SESSION['komunikat'])) {
    $_SESSION['komunikat'] = 1;
    echo "<script language='javascript' type='text/javascript'>alert('Witamy w naszym banku. Kliknij by przejść dalej.'); </script>";
}

if (isset($_SESSION['odswiezanie'])) {
    unset($_SESSION['odswiezanie']);
}

?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Twoje konto bankowe </title>



    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="../AdminLTE/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../AdminLTE/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="przelewystyle.php">
</head>

<body>

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand-md navbar-light navbar-white" style="margin-left: 0px; text-align: center;">
        <div class="container" style="margin-left: 0px;">
            <a href="zalogowany.php" class="navbar-brand">
                <img src="../FikuBank.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">FiKuBank</span>
            </a>

            <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="zalogowany.php" class="nav-link">Twoje konto</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">Historia płatności</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Główna Lista rozwijana</a>
                        <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                            <li><a href="przelewy.php" class="dropdown-item">Przelej pieniądze </a></li>
                            <li><a href="#" class="dropdown-item">Wyloguj się</a></li>

                            <li class="dropdown-divider"></li>

                            <!-- Level two dropdown-->
                            <li class="dropdown-submenu dropdown-hover">
                                <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Lista w liście</a>
                                <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                                    <li>
                                        <a tabindex="-1" href="#" class="dropdown-item">level 2</a>
                                    </li>

                                    <!-- Level three dropdown-->
                                    <li class="dropdown-submenu">
                                        <a id="dropdownSubMenu3" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">level 2</a>
                                        <ul aria-labelledby="dropdownSubMenu3" class="dropdown-menu border-0 shadow">
                                            <li><a href="#" class="dropdown-item">3rd level</a></li>
                                            <li><a href="#" class="dropdown-item">3rd level</a></li>
                                        </ul>
                                    </li>
                                    <!-- End Level three -->

                                    <li><a href="#" class="dropdown-item">level 2</a></li>
                                    <li><a href="#" class="dropdown-item">level 2</a></li>
                                </ul>
                            </li>
                            <!-- End Level two -->
                        </ul>
                    </li>
                </ul>
            </div>

        </div>
    </nav>
    <!-- /.navbar -->



    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="margin-left:0px; min-height: auto;">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark"> FiKu Konto Przekorzystne </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Historia płatności</a></li>
                            <li class="breadcrumb-item"><a href="przelewy.php">Przelewy</a></li>
                            <li class="breadcrumb-item active"><a href="logout.php">Wyloguj</a></li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <form name="form" action="obslugaHistorii.php" method="post">
                                        <select name="liczba_historii" size="1">
                                            <option value="0"></option>
                                            <option value="2">2</option>
                                            <option value="5">5</option>
                                            <option value="10">10</option>
                                            <option value="20">20</option>
                                            <option value="50">50</option>
                                        </select>
                                        <?php
                                        /*...Pomocne przy pierwszym odpaleniu by nie było błędów...*/
                                        if (!isset($_SESSION['liczbaHistorii'])) {
                                            $_SESSION['liczbaHistorii'] = 0;
                                        }
                                        ?>
                                        <input type="submit"  <?php if ($_SESSION['liczbaHistorii'] == 0) {
                                                                                                echo ' style="margin-bottom: 10px; font-size: 14px;" value="Zmień wyświetlanie (domyślnie 0)">';
                                                                                            } else {
                                                                                                echo 'style="margin-bottom: 10px;" value="Zmień wyświetlanie">';
                                                                                            }
                                                                                            ?> </form> </h5> <p class="card-text">
                                        <!-- /*...Może coś jeszcze tu będzie ...*/ -->
                                        </p>
                            </div>
                        </div>
                    </div>


                    <!-- /.col-md-6 -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title m-0">Historia ostatnich tranzakcji:</h5>

                                <?php
                                //Łączenie z Bazą Danych
                                require_once "connect2.php";

                                $polaczenie = new mysqli($host, $db_user, $db_password, $db_name);



                                /*...Odpalenie zapytania do tabeli historia_tranzakcji...*/

                                $hist = "select * from historia_tranzakcji where (login_odbiorca='" . $_SESSION['login'] . "' or login_wysylajacy='" . $_SESSION['login'] . "') order by id desc limit " . $_SESSION['liczbaHistorii'];
                                $r = $polaczenie->query($hist);

                                /*...Wypisanie wszystkiego z bazy danych historii  ...*/
                                while ($row = $r->fetch_assoc()) {

                                    echo "</br></br>Przelew wysłano do:  <b>" . $row["login_odbiorca"] . "</b>  na kwotę:  <b>" . $row["kwota"] . " zł</b>  Opis : <b>" . $row["opis_komentarz"] . "</b></br>";
                                }

                                /*...Koniec operacji na tabeli histria_tranzakcji...*/

                                ?>

                            </div>

                        </div>


                    </div>
                    <!-- /.col-md-6 -->

                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->





    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
        <div class="p-3">
            <h5>Title</h5>
            <p>Sidebar content</p>
        </div>
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="float-right d-none d-sm-inline">
            <?php
            echo $_SESSION['login'] . '![<a href="logout.php">wyloguj</a>] </p>';
            ?>
        </div>
        <!-- Default to the left -->
        <strong>Filip Kuczewski &copy; 2020 z pomocą: <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    </footer>


    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="../AdminLTE/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../AdminLTE/dist/js/adminlte.min.js"></script>
</body>

</html>