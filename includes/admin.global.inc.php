<?php
require_once '../config.php';
require_once '../classes/Uporabniki.class.php';
require_once '../classes/Upoorodja.class.php';
require_once '../classes/DB.class.php';
require_once '../classes/Validacija.php';

//povežemo se z bazo
$db = new DB();
$db->connect();

//ustvarimo objekt za uporabnike
$userTools = new UserTools();

//ustvarimo "session"
session_start();

//osvežimo "session" in pripravimo podatke
if(isset($_SESSION['logged_in'])) {
	$user = unserialize($_SESSION['user']);
	//$_SESSION['user'] = serialize($userTools->get($user->id));
	//print_r($user);
}
?>
