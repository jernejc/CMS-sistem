<?php
if ($_GET['task'])
	$task=preveri($_GET['task'],1,20,1);

switch ($task) {
	case "izbrisi" :
		if ($_POST) {
			foreach ($_POST as $v)
			{
				foreach ($v as $kategorije) {
					$kategorije=preveri($kategorije,1,2,0);
					$sql = mysql_query("DELETE FROM kategorije WHERE id = '$kategorije'");
				}
			}
			$napaka="Kategorije so bile uspešno izbrisane!";
		}
		else
			$napaka="Prosimo oznacite vsaj eno kategorijo!";	
	break;
	
	case "dodaj" :
		if($_POST) {
			$naziv=preveri($_POST['naziv'],1,50,1);
			$alias=preveri($_POST['alias'],1,50,0);	
			$opis=$_POST['opis'];
			$slika=$_POST['slika'];
			$objavjlen=$_POST['objavljeno'];
			
			$parametri.="pnaslov=".$_POST['pnaslov']." ";
			$parametri.="pdatum=".$_POST['pdatum']." ";
			$parametri.="pavtor=".$_POST['pavtor']." ";
			
			$data = array(
				"naziv" => "'$naziv'",
				"alias" => "'$alias'",
				"opis" => "'$opis'",	
				"objavjlen" => "'$objavjlen'",
				"parametri" => "'$parametri'"
			);
			
			$db->insert($data, 'kategorije');
			
			$napaka="Kategorija je bila uspešno vnešena";
		}
		else
			$napaka="Manjkajo podatki za kategorijo!";
	break;
	
	case "posodobi" :
		if ($_POST) {
			$id=$_GET['id'];
			$naziv=preveri($_POST['naziv'],1,50,1);
			$alias=preveri($_POST['alias'],1,50,0);	
			$opis=$_POST['opis'];
			$slika=$_POST['slika'];
			$objavjlen=$_POST['objavljeno'];
			
			$parametri.="pnaslov=".$_POST['pnaslov']." ";
			$parametri.="pdatum=".$_POST['pdatum']." ";
			$parametri.="pavtor=".$_POST['pavtor']." ";
			
			$data = array(
				"naziv" => "'$naziv'",
				"alias" => "'$alias'",
				"opis" => "'$opis'",	
				"objavjlen" => "'$objavjlen'",
				"parametri" => "'$parametri'"
			);
			
			$db->update($data, 'kategorije', 'id = '.$id);
			
			$napaka="Kategorija je bila uspešno posodobljena";
		}
		else
			$napaka="Manjkajo vrednosti za posodobitev!";
	break;
}
?>
<form method="post" action="index.php?stran=kategorije&task=izbrisi">
<div id="moznosti">
	<div id="naziv_sekcije">
    	<img src="<?php echo $domena ?>admin/resources/images/ikone/kategorije2.png" width="70" align="left" />
        <p class="naziv">Urejanje kategorij</p>
        V tej sekciji lahko urejate HTML podstrani. Vsaki podstrani lahko dolocite tudi kategorijo katero dodate na desni.
    </div>
    <div id="ikone_zg">
        <div class="ikona_zg">
        	<a href="index.php?stran=strani" title="Nazaj na urejanje podstrani">
                <img src="<?php echo $domena ?>admin/resources/images/nazaj.png" width="32" />
            </a>
        </div>
        <div class="ikona_zg">
            <input type="submit" class="odstrani" value=" " title="Odstrani izbrane kategorije" />
        </div>
        <div class="ikona_zg">
            <a href="index.php?stran=kategorije_upr&mapa=upravljanje&task=nova" title="Nova kategorija"><img src="<?php echo $domena ?>admin/resources/images/dodaj.png" width="30" border="0" /></a>
        </div>
    </div>
    <div style="clear:both"></div>
</div>
<div style="clear:both"></div>
<table border="0" cellpadding="0" cellspacing="0" width="99%" class="sortable">
<tr class="glava_ta">
    <th width="5%">#</th>
	<th width="20%">Naziv</th>
    <th width="7%">Stanje</th>
    <th>Opis</th>
    <th>Datum</th>
    <th width="7%">Uredi</th>
    <th>ID</th>
</tr>
<?php 
$result = $db->select('kategorije', 'id > 0');
$i=1;
while ($v = mysql_fetch_array($result)) { ?>
<tr class="vrsta<?php if ($i%2==0) echo"2"; ?>">
	<td align="center"><input type="checkbox" name="izbris[]" value="<?php echo $v['id']; ?>" /></td>
    <td>
		<a href="index.php?stran=kategorije_upr&mapa=upravljanje&task=posodobi&id=<?php echo $v['id']; ?>" title="Uredi!" >
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
    <td align="center"><?php echo strip_tags($v['opis']); ?></td>
    <td align="center"><?php echo datum($v['datum']); ?></td>
    <td align="center">
        <a href="index.php?stran=kategorije_upr&mapa=upravljanje&task=posodobi&id=<?php echo $v['id']; ?>" title="Uredi!" >
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
