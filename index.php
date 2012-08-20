<?php 
/*if (!file_exists( 'config.php' )) {
	header("Location: http://".$domena."/namestitev/index.php" );
	exit();
}*/

// Vključimo konfiguracijo in ostale potrebne datoteke za obratovanje sistema
require_once "includes/global.inc.php";  

// Če je stran ugasnjena ( $ugasni = 1 ), aplikacije ne zaženemo in vključimo prednastavljeno stran namenjeno tem
if ($ugasni==1){
	include ( $abs_pot."/includes/ugasnjeno.php");
	exit();
}

// Če gre za uvodno stran, je spremenljivka jedro prazna in pridobimo privzeto nastavljeno postavko v meniju
if (!$_GET['jedro']) {
	$sql = "SELECT id,tip,vkz FROM meniji_postavke WHERE objavjlen='1' ORDER BY id LIMIT 0,1";
	$postavka = mysql_query($sql);
	while ($v=mysql_fetch_assoc($postavka)) {
		$tip=$v['tip'];
		$id=$v['vkz'];
		$pid=$v['id'];
	}
	switch ($tip) {
		case "1" :
			$jedro="vsebina";
			break;
			
		case "2" :
			$jedro="kategorija";
			break;
			
		case "3" :
			$jedro="komponenta";
			break;
	}	
}

// Spremenljivke jedro, id in pid so nastavljene in pridobimo podatke glede na njihovo vrednost 
else {
	$zahteva=$_SERVER['QUERY_STRING'];
	parse_str($zahteva, $vrednosti);
	
	$jedro=preveri($vrednosti['jedro'],1,15,1);
	$id=preveri($vrednosti['id'],1,3,0);
	$pid=preveri($vrednosti['pid'],0,2,0);
}

// Vključimo privzeto ali nastavljeno grafično predlogo
if (!empty($predloga))
	include ( $abs_pot."/resources/tpl/".$predloga."/index.php");	
else
	include ( $abs_pot."/resources/tpl/privzeta/index.php");	
?>