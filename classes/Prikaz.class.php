<?php
class Prikaz {
	
	/**
	* @author Jernej Čop
	* @name jedro
	* @description V jedro spletne strani vključimo komponento, katera je bila povezana v meni.
	* @param $jedro Naziv aplikacije, za vključitev le te v jedro spletne strani
	* @param $id ID komponente, ki je povezana v menij
	* @param $pid ID izbrane postavke v meniju
	*/
	
	public function jedro ($jedro, $id, $pid){
		global $abs_pot;
		
		$id  = $id;
		$pid = $pid;
		
		if (file_exists($abs_pot."/komponente/".$jedro."/".$jedro.".php"))
			include ($abs_pot."/komponente/".$jedro."/".$jedro.".php");
		else
			die("Stran, ki si jo želite ogledati, ne obstaja. Izberite drugo stran iz menija.");
	}
	
	/**
	* @author Jernej Čop
	* @name modul
	* @description Funkcija izipše modul(e), glede na trenutno podstran in njihovo pozicijo.
	* @param $pozicija Pozicija na kateri je modul(i) objavlen.
	* @param $pid ID izbrane postavke v meniju
	*/
	
	public function modul ($pozicija, $pid){
		global $abs_pot;
		
		$sql = "SELECT * FROM moduli WHERE objavjlen='1' AND pozicija='{$pozicija}' ORDER by red";
		$moduli = mysql_query($sql);
		while ($m = mysql_fetch_assoc($moduli)) {
			
			if ($m['strani']!="on") {
				$strani=explode(",",$m['strani']);
				if (in_array($pid,$strani))
					$prikazi=1;
			}
			else {
				$strani=$m['strani'];
				if ($strani=="on")
					$prikazi=1;
			}
			
			if ($prikazi==1)
			{
				switch ($m['tip']) {
					case "1" :
						$modul="html";
						$id_m=$m['id'];
						break;
						
					case "2" :
						$modul="menij";
						$meni_id=$m['menij'];
						break;
						
					case "3" :
						$id_m=$m['id'];
						$aplikacija=$m['aplikacija'];
						$sql="SELECT * FROM moduli_apl WHERE id='{$aplikacija}'";
						$temp=mysql_query($sql);
						while ($t = mysql_fetch_assoc($temp)) {
							$modul=	$t['alias'];
						}
						break;
				}
				$naziv=$m['naziv'];
				$prikazi=$m['prikazi_n'];
				$pid=$pid;
				
				include ($abs_pot."/moduli/".$modul."/".$modul.".php");
				
			}
			$prikazi=0;
		}
	}
	
	/**
	* @author Jernej Čop
	* @name glava
	* @description Izpišemo glavo HTML dokumenta, funkcija poskrbi za dinamične naslove in opis spletne strani
	* @param $pid ID izbrane postavke v meniju
	*/
	
	public function glava ($pid){
		global $nazivs;
		
		$sql = "SELECT naziv,meta_key,meta_desc,title FROM meniji_postavke WHERE id='{$pid}'";
		$glava = mysql_query($sql);
		
		while ($g = mysql_fetch_assoc($glava)) {
			
			if (!empty($g['title']))
				$html.='<title>'.$g['title'].' - '.$nazivs.'</title>';
			else
				$html.='<title>'.$g['naziv'].' - '.$nazivs.'</title>';
			
			$html.='<meta name="description" content="'.$g['meta_desc'].'" />';
		
		}
		echo $html;
	}
}
?>