<?php

session_start();

$_SESSION['liczbaHistorii'] = (int) $_POST['liczba_historii'];
header('Location: historia.php');
exit();
