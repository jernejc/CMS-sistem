<?php

require_once 'DB.class.php';

class User {

	public $id;
	public $uporabnisko_ime;
	public $geslo;
	public $email;
	public $vrsta;
	public $naziv;
	
	/**
	* @author Jernej Čop
	* @name user_construct
	* @description Posodobimo podatke o uporabniku v trenutni "session".
	* @param $data Sveži podatki o uporabniku.
	*/
	
	function __construct($data) {
		$this->id = (isset($data['id'])) ? $data['id'] : "Ni kul";
		$this->uporabnisko_ime = (isset($data['uporabnisko_ime'])) ? $data['uporabnisko_ime'] : "Ni kul";
		$this->geslo = (isset($data['geslo'])) ? $data['geslo'] : "Ni kul";
		$this->email = (isset($data['email'])) ? $data['email'] : "Ni kul";
		$this->vrsta = (isset($data['vrsta'])) ? $data['vrsta'] : "Ni kul";
		$this->naziv = (isset($data['naziv'])) ? $data['naziv'] : "Ni kul";
	}
	
	/**
	* @author Jernej Čop
	* @name save
	* @description Funkcija shrani uporabnika v bazo, ali pa posodobi podatke o obstoječem uporabniku.
	* @param $isNewUser Ali gre za novega uporabnika ali pa uporabnik že obstaja
	*/

	public function save($isNewUser = false) {
		$db = new DB();

		if(!$isNewUser) {
			$data = array(
				"email" => "'$this->email'",
				"uporabnisko_ime" => "'$this->uporabnisko_ime'",
				"geslo" => "'$this->geslo'",
			);

			$db->update($data, 'uporabniki', 'id = '.$this->id);
		}else {
			$data = array(
				"email" => "'$this->email'",
				"uporabnisko_ime" => "'$this->uporabnisko_ime'",
				"geslo" => "'$this->geslo'",								
			);

			$this->id = $db->insert($data, 'uporabniki');
		}
		return true;
	}

}

?>
