<?php

/**
* @author http://buildinternet.com/2009/12/creating-your-first-php-application-part-1/
* @name class DB
* @description Class za upravljanje z bazami
*/

class DB {
	
	protected $db_name;
	protected $db_user;
	protected $db_pass;
	protected $db_host;
	
	public function connect() {
		global $mysql_baza, $mysql_uporabnik, $mysql_geslo, $host;
		
		$this->db_name = $mysql_baza;
		$this->db_user = $mysql_uporabnik;
		$this->db_pass = $mysql_geslo;
		$this->db_host = $host;
		
		$connection = mysql_connect($this->db_host, $this->db_user, $this->db_pass);
		mysql_select_db($this->db_name);

		return true;
	}
	
	public function select($table, $where) {
		$sql = "SELECT * FROM $table WHERE $where";
		$result = mysql_query($sql);

		return $result;
	}
	
	public function update($data, $table, $where) {
		foreach ($data as $column => $value) {
			$sql = "UPDATE $table SET $column = $value WHERE $where";
			mysql_query($sql) or die(mysql_error());
		}
		return true;
	}
	
	public function delete($data, $table) {
		foreach ($data as $column => $value) {
			$sql = "DELETE FROM $table WHERE $column = $value";
			mysql_query($sql) or die(mysql_error());
		}
		return true;
	}
	
	public function insert($data, $table) {

		$columns = "";
		$values = "";

		foreach ($data as $column => $value) {
			$columns .= ($columns == "") ? "" : ", ";
			$columns .= mysql_real_escape_string($column);
			$values .= ($values == "") ? "" : ", ";
			$values .= mysql_real_escape_string($value);
		}

		$sql = "insert into $table ($columns) values ($values)";

		mysql_query($sql) or die(mysql_error());

		return mysql_insert_id();
	}
}

?>