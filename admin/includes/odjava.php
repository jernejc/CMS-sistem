<?php 
require_once '../../classes/Uporabniki.class.php';
require_once '../../classes/Upoorodja.class.php';
require_once '../../classes/DB.class.php';
require_once '../../classes/Validacija.php';

session_start();

$userTools = new UserTools();
$userTools->logout();

header("Location: ../prijava.php?napaka=Uspešno ste se odjavili");
?>
