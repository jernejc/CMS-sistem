<?php require_once '../includes/admin.global.inc.php';  ?>
<?php 
if(isset($_POST['form-submit'])) { 

	$uporabnisko_ime=preveri($_POST['uporabnisko_ime'],1,30,1);
	$geslo=preveri($_POST['geslo'],1,50,1);
	
	$userTools = new UserTools();  
	
	if($userTools->login($uporabnisko_ime, $geslo)){
		header("Location: index.php?stran=uvodna");
	}
	else
		header("Location: prijava.php?napaka=Napačno uporabniško ime in geslo!");
		exit;
}
if(!isset($_SESSION['logged_in'])) { 
	header("Location: prijava.php");
}
if((isset($_SESSION['logged_in']))and($user->vrsta <= 1)) {
	header("Location: prijava.php?napaka=Nimate dostopa do the strani!");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="robots" content="noindex" />
    <title>CMS Sistem  - Administrator<?php //echo $title ?></title>
    <link rel="stylesheet" type="text/css" href="resources/css/css3.css" />
    <link rel="stylesheet" type="text/css" href="resources/css/navigacija.css" />
    <script language="javascript" type="text/javascript" src="resources/js/sorttable.js"></script>
    <script language="javascript" type="text/javascript" src="resources/js/jquery-1.4.2.js"></script>
    <script language="javascript" type="text/javascript" src="resources/js/jquerystuff.js"></script>
   
    <!-- jQuery ui -->
    <link rel="stylesheet" href="resources/js/themes/smoothness/jquery.ui.all.css">
	<script src="resources/js/ui/jquery.ui.core.js"></script>
    <script src="resources/js/ui/jquery.ui.widget.js"></script>
    <script src="resources/js/ui/jquery.ui.mouse.js"></script>
    <script src="resources/js/ui/jquery.ui.button.js"></script>
    <script src="resources/js/ui/jquery.ui.draggable.js"></script>
    <script src="resources/js/ui/jquery.ui.position.js"></script>
    <script src="resources/js/ui/jquery.ui.dialog.js"></script>
    <script src="resources/js/ui/jquery.ui.resizable.js"></script>
</head>

<body>
<div id="okvir">
    <div id="glava">
        <div id="navigacija">
            <ul id="nav">
                <div id="logo">
                </div>
                <div style="padding-top:12px">
                <li><a href="index.php?stran=uvodna">Domov</a></li>
                <li>
                    <a href="#">Stuff</a>
                  <ul>
                        <li><a href="index.php?stran=meniji">Meniji</a></li>
                        <li><a href="index.php?stran=strani">HTML Strani</a></li>
                        <li><a href="index.php?stran=komponente">Komponente</a></li>
                        <li><a href="index.php?stran=moduli">Moduli</a></li>
                        <li><a href="index.php?stran=uporabniki">Uporabniki</a></li>
                        <li><a href="#">Konfiguracija</a></li>
                    </ul>
                </li>
                <li class="current"><a href="includes/odjava.php">Odjava</a></li>
                </div>
            </ul>
        </div>
    </div>
    <div style="clear:both"></div>
	<div id="napaka">

    </div>
    <div id="vsebina">
		<?php 
			$mapa="includes/".preveri($_GET['mapa'],1,20,0);
			
        	if ($_GET["stran"]) {
				$stran=preveri($_GET["stran"],1,20,0);
			
			if (!$mapa)
				$mapa="includes";
				
				if (file_exists($abs_pot."/admin/".$mapa."/".$stran.".php"))
					include($abs_pot."/admin/".$mapa."/".$stran.".php");
				else
					die("Stran, ki si jo želite ogledati, ne obstaja. Izberite drugo stran iz menija.");
			}
			else {
				include("includes/uvodna.php");
			}
		?>    
    </div>
        <?php 
	if ($_GET['napaka'])
		$napaka=preveri($_GET['napaka'],1,50,0);	
	if ($napaka != "") { ?>
		<script type="text/javascript">
			hscroll('<?php echo $napaka;?>');
		</script>
    <?php } ?>
    <div id="noga">
    
    </div>
</div>
</body>
</html>
