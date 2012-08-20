<?php

require_once 'Uporabniki.class.php';
require_once 'DB.class.php';

class UserTools {

	/**
	* @author Jernej Čop
	* @name login
	* @description Funkcija nas "prijavi v sistem", preveri uporabniško ime in geslo in, če se ujemata ustvari "session" z podatki o uporabniku, ki se je prijavil.
	* @param $uporabnisko_ime Uporabniško ime
	* @param $geslo Geslo
	*/
	
	public function login($uporabnisko_ime, $geslo)
	{
		$hashedPassword = md5($geslo);
		$sql = mysql_query("SELECT * FROM uporabniki WHERE uporabnisko_ime = '$uporabnisko_ime' AND geslo = '$hashedPassword'");
		
		if(mysql_num_rows($sql) == 1)
		{
			$_SESSION["user"] = serialize(new User(mysql_fetch_assoc($sql)));
			$_SESSION["login_time"] = time();
			$_SESSION["logged_in"] = 1;
			return true;
		}
		else
			return false;
	}
	
	/**
	* @author Jernej Čop
	* @name logout
	* @description Funkcija nas odjavi iz sistema.
	*/
	
	public function logout() {
		unset($_SESSION['user']);
		unset($_SESSION['login_time']);
		unset($_SESSION['logged_in']);
		session_destroy();
	}
	
	/**
	* @author Jernej Čop
	* @name checkUsernameExists
	* @description Preveri ali že obstaja uporabnik s tem uporabniškim imenom.
	* @param $uporabnisko_ime Uporabniško ime
	*/
	
	public function checkUsernameExists($uporabnisko_ime) {
		$result = mysql_query("SELECT id FROM uporabniki WHERE uporabnisko_ime='$uporabnisko_ime'");
    	if(mysql_num_rows($result) == 0)
    	{
			return false;
	   	}else{
	   		return true;
		}
	}
	
	/**
	* @author Jernej Čop
	* @name get
	* @description Pridobimo podatke o uporabniku, glede na njegov ID.
	* @param $id ID uporabnika
	*/

	public function get($id)
	{
		$db = new DB();
		$result = $db->select('uporabniki', "id = $id");

		return new User($result);
	}

}

?>
