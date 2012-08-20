<?php
if ($_GET['task'])
	$task=preveri($_GET['task'],1,20,0);

switch ($task) {
	case "izbrisi" :
		if ($_POST) {
			foreach ($_POST as $v)
			{
				foreach ($v as $uporabniki) {
					$uporabniki=preveri($uporabniki,1,2,0);
					$sql = mysql_query("DELETE FROM uporabniki WHERE id = '$uporabniki'");
				}
			}
			$napaka="Uporabniki so bile uspešno izbrisani!";
		}
		else
			$napaka="Prosimo označite vsaj enega uporabnika!";	
	break;
	
	case "dodaj" :
		if($_POST) {
			$naziv=preveri($_POST['naziv'],1,50,1);
			$email=preveri($_POST['email'],1,50,1);	
			$objavljen=$_POST['objavljeno'];
			$vrsta=$_POST['vrsta'];
			$uporabnisko_ime=preveri($_POST['uporabnisko_ime'],1,50,1);
			$geslo=md5($_POST['geslo']);
			
			$data = array(
				"naziv" => "'$naziv'",
				"vrsta" => "'$vrsta'",	
				"email" => "'$email'",
				"uporabnisko_ime" => "'$uporabnisko_ime'",
				"geslo" => "'$geslo'",
				"objavjlen" => "'$objavljen'",
			);
			
			$db->insert($data, 'uporabniki');
			
			$napaka="Uporabnik je bil uspešno vnešen";
		}
		else
			$napaka="Manjkajo podatki za uporabnika!";
	break;
	
	case "posodobi" :
		if ($_POST) {
			$id=$_GET['id'];
			$naziv=preveri($_POST['naziv'],1,50,1);
			$email=preveri($_POST['email'],1,50,1);	
			$objavljen=$_POST['objavljeno'];
			$vrsta=$_POST['vrsta'];
			$uporabnisko_ime=preveri($_POST['uporabnisko_ime'],1,50,1);
			$geslo=md5($_POST['geslo']);
			
			$data = array(
				"naziv" => "'$naziv'",
				"vrsta" => "'$vrsta'",	
				"email" => "'$email'",
				"uporabnisko_ime" => "'$uporabnisko_ime'",
				"geslo" => "'$geslo'",
				"objavjlen" => "'$objavljen'",
			);
			
			$db->update($data, 'uporabniki', 'id = '.$id);
			
			$napaka="Uporabnik je bil uspešno posodobljen!";
		}
		else
			$napaka="Manjkajo vrednosti za posodobitev!";
	break;
}
?>
<form method="post" action="index.php?stran=uporabniki&task=izbrisi">
<div id="moznosti">
	<div id="naziv_sekcije">
    	<img src="<?php echo $domena ?>admin/resources/images/ikone/uporabniki.png" width="70" align="left" />
        <p class="naziv">Urejanje uporabnikov</p>
        V tej sekciji lahko urejate HTML podstrani. Vsaki podstrani lahko dolocite tudi kategorijo katero dodate na desni.
    </div>
    <div id="ikone_zg">
        <div class="ikona_zg">
            <input type="submit" class="odstrani" value=" " />
        </div>
        <div class="ikona_zg">
            <a href="index.php?stran=uporabniki_upr&mapa=upravljanje&task=nova"><img src="<?php echo $domena ?>admin/resources/images/dodaj.png" width="30" border="0" /></a>
        </div>
    </div>
    <div style="clear:both"></div>
</div>
<div style="clear:both"></div>
<table border="0" cellpadding="0" cellspacing="0" width="99%" class="sortable">
<tr class="glava_ta">
    <th width="5%">#</th>
	<th width="20%">Naziv</th>
    <th width="7%">Stranje</th>
    <th width="7%">Vrsta</th>
    <th>E-mail</th>
    <th>Uporabniško ime</th>
    <th>Datum</th>
    <th width="7%">Uredi</th>
    <th>ID</th>
</tr>
<?php 
$result = $db->select('uporabniki', 'id > 0');
$i=1;
while ($v = mysql_fetch_array($result)) { ?>
<tr class="vrsta<?php if ($i%2==0) echo"2"; ?>">
	<td align="center"><input type="checkbox" name="izbris[]" value="<?php echo $v['id']; ?>" /></td>
    <td>
        <a href="index.php?stran=uporabniki_upr&mapa=upravljanje&task=posodobi&id=<?php echo $v['id']; ?>" title="Uredi!" >
            <?php echo $v['naziv']; ?>
        </a>
    </td>
    <td align="center"><img src="<?php echo $domena ?>admin/resources/images/<?php 
		if ($v['objavjlen']==1) 
			echo "published.png"; 
		else 
			echo "unpublished.png"; 
	?>" width="12" />
    </td>
    <td align="center">
	<?php 
		switch ($v['vrsta']) {
			case "0" :
				echo "registriran uporabnik";
			break;
			case "1" :
				echo "stranka";
			break;
			case "2":
				echo "admin";
			break;
		}
	?>
    </td>
    <td align="center"><a href="mailto:<?php echo $v['email']; ?>"><?php echo $v['email']; ?></a></td>
    <td align="center"><?php echo $v['uporabnisko_ime']; ?></td>
    <td align="center"><?php echo datum($v['datum']); ?></td>
    <td align="center">
        <a href="index.php?stran=uporabniki_upr&mapa=upravljanje&task=posodobi&id=<?php echo $v['id']; ?>" title="Uredi!" >
            <img src="<?php echo $domena ?>admin/resources/images/uredi.png" width="15" border="0" />
        </a>
    </td>
    <td align="center"><?php echo $v['id']; ?></td>
</tr>
<?php $i++; } ?>
</table>
</form>
<table border="0" cellpadding="0" cellspacing="0" width="99%">
<tr class="spodaj_ta">
    <td align="left" width="60%">
    </td>
    <td align="right" width="40%">     
        <div class="stevilo">3</div>
        <div class="stevilo">2</div>
        <div class="stevilo">1</div>
    </td>
</tr>
</table>