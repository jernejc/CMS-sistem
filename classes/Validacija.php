<?php 
/**
* @author Jernej Čop
* @name preveri
* @description Preverimo ( empty / dolžina ) in počistimo / uredimo vrednost, da so primerne za vnos v bazo
* @param $value Vrednost, ki se bo počistila / preverila
* @param $a Ali je številka (0) ali besedilo (1)
* @param $b Maximalno število znakov
* @param $c Ali je polje obvezno (1)
*/

function preveri($value,$a,$b,$c) {
	
	if ($c==1) {
		if (empty($value)) {
			die ("Vrednost je prazna");		  
		}
	}
	
	$value = trim($value);
	$value = addslashes($value);
	$value = strip_tags($value);
	
	if ($a==0) {
		if (!is_numeric($value)) {
			die ("Prosimo vnesite zgolj števila!");			   
		}
	}
	if (strlen($value) > $b) {
		die ("Vrednost je predolga!");
	}
	
	return $value;
}

/**
* @author Jernej Čop
* @name get_user_browser
* @description Pridobimo naziv brskalnika, ki ga uporablja trenutni uporabnik
*/

function get_user_browser()
{
    $u_agent = $_SERVER['HTTP_USER_AGENT'];
    $ub = '';
    if(preg_match('/MSIE/i',$u_agent))
    {
        $ub = "ie";
    }
    elseif(preg_match('/Firefox/i',$u_agent))
    {
        $ub = "firefox";
    }
    elseif(preg_match('/Safari/i',$u_agent))
    {
        $ub = "safari";
    }
    elseif(preg_match('/Chrome/i',$u_agent))
    {
        $ub = "chrome";
    }
    elseif(preg_match('/Flock/i',$u_agent))
    {
        $ub = "flock";
    }
    elseif(preg_match('/Opera/i',$u_agent))
    {
        $ub = "opera";
    }
   
    return $ub;
}

/**
* @author Jernej Čop
* @name parametri
* @description Funkcija sestavi tabelo ( array ) parametrov pridobljenih s točno določeno strukturo iz baze.
* @param $v Parametri pridobljeni iz baze
*/ 

function parametri ($v) {
	$y=explode(" ",$v);
	$i=0;
	$o=array();
	while($y[$i]!='') {
		$z=explode("=",$y[$i]);
		$o[$z[0]]=$z[1];
		$i++;	
	}
	return $o;
}

/**
* @author Jernej Čop
* @name datum
* @description Datumu iz MYSQL baze spremenimo obliko, ki je lažje berljiva.
* @param $datum Datum pridobljen iz baze ( TIMESTAMP )
*/

function datum ($datum) {
	return date("d M G:i",strtotime($datum));
}
?>