<?php
if ($_GET['naloga'])
	$naloga=preveri($_GET['naloga'],1,15,1);
else
	die("Manjka naloga, da se ve kaj se dela!");
	
if ($_GET['gid'])
	$gid=preveri($_GET['gid'],0,3,1);

require_once("classes/Slike.class.php");
$image = new SimpleImage();
	
$user = unserialize($_SESSION['user']);
?>
<link type="text/css" rel="stylesheet" href="komponente/galerija/css/galerija.css" />
<?php if ($user->vrsta > 0) { ?>
<form method="post" action="index.php?jedro=galerija&naloga=galerije&pid=<?php echo $pid ?>" >
<div id="moznosti">
	<div id="naziv_sekcije">
   	  <img src="<?php echo $domena ?>resources/images/ikone/galerija.png" width="70" align="left" />
        <p class="naziv">Urejanje galerij</p>
        Preprosto dodajajte galerije in slike.
    </div>
    <div id="ikone_zg">
        <div class="ikona_zg">
            <a href="index.php?jedro=galerija&naloga=dodaj_slike&pid=<?php echo $pid ?>&gid=<?php echo $gid; ?>" title="Prenesi slike">
                <img src="<?php echo $domena ?>resources/images/ikone/upload.png" width="33" />
            </a>
       </div>
        <div class="ikona_zg">
            <input type="submit" class="odstrani" value=" " title="Odstrani izbrane galerije / slike" />
        </div>
        <div class="ikona_zg">
            <a href="index.php?jedro=galerija&naloga=dodaj_galerijo&pid=<?php echo $pid ?>" title="Nova galerija"><img src="<?php echo $domena ?>admin/resources/images/dodaj.png" width="30" border="0" /></a>
        </div>
    </div>
</div>
<div style="clear:both; height:10px;"></div>
<?php } // Konča se if izjava za admin panel  

switch ($naloga) {
	
	case "galerije" : 
	
	echo "<div id='galerija'>";
	
	$db = new DB();
	
	if (($_POST['izbrisg'])and($user->vrsta > 0)) {
		foreach ($_POST as $v)
		{
			foreach ($v as $galerije) {
				$galerije=preveri($galerije,1,2,0);
				$sql = mysql_query("DELETE FROM galerije WHERE id = '$galerije'");
			}
		}
		echo"<p>Album(i) so bili uspešno izbrisani!</p>";
	}
	
	if (($_POST['izbriss'])and($user->vrsta > 0)) {
		foreach ($_POST as $v)
		{
			foreach ($v as $slike) {
				$slike=preveri($slike,1,2,0);
				$sql = mysql_query("DELETE FROM galerije_slike WHERE id = '$slike'");
			}
		}
		echo "<p>Slike so bile uspešno izbrisane!</p>";
	}
	
	if (($_POST['dodaj_galerijo']==1)and($user->vrsta > 0)) {
		$naziv=preveri($_POST['naziv'],1,30,1);
		$opis=$_POST['opis'];
		$ime_slike=$_FILES['slika']['name'];
		$vrsta=$_FILES['slika']['type'];
		$velikost=$_FILES['slika']['size'];
		$error=$_FILES['slika']['error'];
		$zacasna=$_FILES['slika']['tmp_name'];
		
		$uporabnik=$user->uporabnisko_ime;
		
		if ($error > 0) 
			die ("Napaka pri prenosu datoteke! Vrsta napake: ".$error);
		else {
			$image->load($zacasna);
			$image->resizeToWidth(220);
			$image->save("komponente/galerija/slike/kat/".$ime_slike);
			
			$data = array(
				"naziv" => "'$naziv'",
				"opis" => "'$opis'",
				"slika" => "'$ime_slike'",
				"uporabnik" => "'$uporabnik'"
			);
			
			$db->insert($data, 'galerije');
			
			$napaka="<p id='napaka'>Nov album je bil uspešno vnešen.</p>";
		}
	}
	if (($_POST['dodaj_slike']==1)and($user->vrsta > 0)) {
		
		$galerija=preveri($_POST['galerija'],1,3,0);
		$uporabnik=$user->uporabnisko_ime;
		
		 for ($i=0; $i<5; $i++) {
			if($_FILES['slike']['name'][$i]) {
				$ime_slike=$_FILES['slike']['name'][$i];
				$vrsta=$_FILES['slike']['type'][$i];
				$velikost=$_FILES['slike']['size'][$i];
				$error=$_FILES['slike']['error'][$i];
				$zacasna=$_FILES['slike']['tmp_name'][$i];
				
				if ($error > 0) 
					die ("Napaka pri prenosu datoteke! Vrsta napake: ".$error);
				else {
					$image->load($zacasna);
					$image->resizeToWidth(800);
					$image->save("komponente/galerija/slike/".$ime_slike);
					
					$data = array(
						"galerija" => "'$galerija'",
						"tip" => "'$vrsta'",
						"vir" => "'$ime_slike'",
						"uporabnik" => "'$uporabnik'"
					);
					
					$db->insert($data, 'galerije_slike'); ?>
					
					<p id="napaka">Slika <?php echo $i+1; ?> je bila uspešno dodana.</p>
			<?php
				}
			}
		}
	}
	?>
        <h2>Albumi v galeriji</h2>
        <?php 
        $galerije=$db->select("galerije","id > 0");
        while ($g = mysql_fetch_assoc($galerije)) { ?>
            <div class="album">
                <h2 class="gtitle">
					<?php 
					echo $g['naziv'];
                    if ($user->vrsta > 0) { ?>
                        <span style="float:right">
                            <input type="checkbox" name="izbrisg[]" value="<?php echo $g['id'] ?>" />
                        </span>
                    <?php } ?>
                </h2>
                <a href="index.php?jedro=galerija&naloga=galerija&gid=<?php echo $g['id'] ?>&pid=<?php echo $pid ?>">
                    <img src="komponente/galerija/slike/kat/<?php echo $g['slika'] ?>" align="middle" width="220" />
                </a>
                 <p class="opis">
                    <?php echo $g['opis'] ?>
                </p>
            </div>
        <?php } ?>
    </div>
    </form>
	<?php 
	break; // Konča se prikaz galerij
	
	case "galerija" : 
	
	if ($_GET['gid'])
		$gid=preveri($_GET['gid'],0,3,1);
	else
		die("Rab se ID, da se ve za katero galerijo gre!");
	?>
    <div id="galerija">
        <h2>Slike v galeriji</h2>
        <div class="p_album">
			<?php 
            $db = new DB(); 
            $galerija=$db->select("galerije_slike", "galerija = ".$gid);
            while ($g = mysql_fetch_assoc($galerija)) { ?>
            	<div class="slika">
                    <a href="komponente/galerija/slike/<?php echo $g['vir'] ?>" rel="rokbox [450 271](galerija)">
                        <img src="komponente/galerija/slike/<?php echo $g['vir'] ?>" align="middle" width="130" />
                    </a>
                    <?php if ($user->vrsta > 0) { ?>
                        <span style="float:right">
                            <input type="checkbox" name="izbriss[]" value="<?php echo $g['id'] ?>" />
                        </span>
                    <?php } ?>
               </div>
            <?php } ?>
            <div style="clear:both"></div>
        </div>
    </div>
    </form>
	<?php 
	break; // Konča se prikaz galerije
	
	case "dodaj_galerijo" : 
		if ($user->vrsta > 0) {
			?>
			</form>
			<table cellpadding="0" cellspacing="5" border="0" width="99%">
				<tr class="glava_ta">
					<th colspan="2">Ustvari album</th>
				</tr>
					<form method="post" action="index.php?jedro=galerija&naloga=galerije&pid=<?php echo $pid ?>" enctype="multipart/form-data">
				 <tr class="vrsta">
					<td>Naziv albuma: </td>
					<td><input type="text" name="naziv" /></td>
				 <tr class="vrsta">
					 <td>Prikazna slika: </td>
					 <td><input type="file" name="slika" /></td>
				 </tr>
				 <tr class="vrsta">
					 <td>Opis albuma:</td>
					 <td> 
						<textarea name="opis" cols="30" rows="4"></textarea><br />
						<input type="hidden" name="dodaj_galerijo" value="1" />
					</td>
				 </tr>
				 <tr class="vrsta">
					 <td colspan="2"><input type="submit" value="Shrani" class="gumb" /></td>
				 </tr>    
					</form>
			</table>
			<?php
		}
		else
			echo "Nimate dostopa do the strani";
	break; // Konča se obrazec za novo galerijo
	
	case "dodaj_slike" : 
		if ($user->vrsta > 0) {
		?>
            </form>
            <table cellpadding="0" cellspacing="5" border="0" width="99%">
                <tr class="glava_ta">
                    <th colspan="2">Prenesi slike iz vašega računalnika!</th>
                </tr>
                <form method="post" action="index.php?jedro=galerija&naloga=galerije&pid=<?php echo $pid ?>" enctype="multipart/form-data">
                 <tr class="vrsta">
                    <td>Izberi galerijo:</td>
                    <td>
                        <select name="galerija">
                                <option>Izberi Galerijo</option>
                                <?php 
                                $db = new DB(); 
                                $galerije=$db->select("galerije", "id > 0");
                                while ($g = mysql_fetch_assoc($galerije)) { ?>
                                <option value="<?php echo $g['id'] ?>" <?php if ($gid==$g['id']) echo "selected='selected'"; ?>><?php echo $g['naziv']; ?></option>
                                <?php }	?>
                        </select>
                    </td>
                 </tr>
                 <tr class="vrsta">
                    <td><span class="oznaka">Slika 1:</span></td>
                    <td><input type="file" name="slike[]" class="textfield" /></td>
                 </tr>
                 <tr class="vrsta">
                    <td><span class="oznaka">Slika 2:</span></td>
                    <td><input type="file" name="slike[]" class="textfield" /></td>
                 </tr>                         
                 <tr class="vrsta">
                    <td><span class="oznaka">Slika 3:</span></td>
                    <td><input type="file" name="slike[]" class="textfield" /></td>
                 </tr>
                 <tr class="vrsta">
                    <td><span class="oznaka">Slika 4:</span></td>
                    <td><input type="file" name="slike[]" class="textfield" /></td>
                 </tr>
                 <tr class="vrsta">
                    <td><span class="oznaka">Slika 5:</span></td>
                    <td><input type="file" name="slike[]" class="textfield" /></td>
                 </tr>
                 <tr class="vrsta">
                    <td colspan="2">
                        <input type="hidden" name="dodaj_slike" value="1" />
                        <input type="submit" value="Shrani" class="gumb" />
                    </td>
                 </tr>       
                 </form>
            </table>
		<?php
		}
		else
			echo "Nimate dostopa do the strani";
	break; // Konča se obrazec za novo galerijo	
}
	?>