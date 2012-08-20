<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="robots" content="noindex" />
    <title>CMS Sistem - Administrator: Prosimo prijavite se!</title>
    <link rel="stylesheet" type="text/css" href="resources/css/css3.css" />
    <link rel="stylesheet" type="text/css" href="resources/css/prijava.css" />
    <script language="javascript" type="text/javascript" src="resources/js/jquery-1.4.2.js"></script>
    <script language="javascript" type="text/javascript" src="resources/js/jquerystuff.js"></script>
</head>

<body>
<div id="okvirp">
    <div id="napaka_p">
        
    </div>
    <div id="vsebina">
    	<?php 
		include("../classes/Validacija.php");	
		
		$brskalnik=get_user_browser();
		
		switch ($brskalnik) {
		
		case "ie": ?>
		
            <h1 style="color:#999">Pozor! Uporabljate "gnil" brskalnik</h1>
            
            <p>Dostop do administracije je priporočljiv samo s spodobnim spletnim brskalnikom.</p>
            <h4>Priporočamo vam:</h4>
            <a href="http://www.mozilla-europe.org/en/firefox/">
                <img src="resources/images/ikone/firefox.jpg" border="0" style="margin:5px" width="90" />
            </a>
            <a href="http://www.google.com/chrome">
                <img src="resources/images/ikone/chrome.jpg" border="0" style="margin:5px" width="87" />
            </a>
            <a href="http://www.apple.com/safari/download/">
                <img src="resources/images/ikone/safari.jpg" border="0" style="margin:5px 8px" width="80" />
            </a>
		<?php
		break;
			
		default: ?>


			<div id="prijava">
				<div id="pokvir">
					<h1 style="margin-left:0; padding-left:0;">Prosim prijavite se:</h1>
					<form method="post" action="index.php">
						<span class="oznaka">Uporabniško ime:</span><br />
						<input type="text" name="uporabnisko_ime" maxlength="35" class="textfield"/><br />
						<p>
						<span class="oznaka">Geslo:</span><br />
						<input type="password" name="geslo" maxlength="35" class="textfield" />
						<p>
						<input type="hidden" name="form-submit" value="1" />
						<input type="submit" value="Prijava!" class="btn" style="float:left"/>
					</form>
				</div>
			</div>
        <?php 
	if ($_GET['napaka'])
		$napaka=preveri($_GET['napaka'],1,50,0);	
	if ($napaka != "") { ?>
		<script type="text/javascript">
			hscroll_p('<?php echo $napaka;?>');
		</script>
    <?php } 
		break;
		} // Zaključi se switch za brskalnike
		?>
   	</div>
</div>
</body>
</html>