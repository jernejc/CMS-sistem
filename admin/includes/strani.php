<?php
if ($_GET['task'])
	$task=preveri($_GET['task'],1,20,1);

switch ($task) {
	case "izbrisi" :
		if ($_POST) {
			foreach ($_POST as $v)
			{
				foreach ($v as $vsebine) {
					$vsebine=preveri($vsebine,1,2,0);
					$sql = mysql_query("DELETE FROM vsebine WHERE id = '$vsebine'");
				}
			}
			$napaka="Vsebine so bile uspe&#353;no izbrisane!";
		}
		else
			$napaka="Prosimo oznacite vsaj eno vsebino!";	
	break;
	
	case "dodaj" :
		if($_POST) {
			$naziv=preveri($_POST['naziv'],1,50,1);
			$alias=preveri($_POST['alias'],1,50,0);	
			$opis=$_POST['opis'];
			$kategorija=$_POST['kategorija'];
			$objavljen=$_POST['objavljeno'];
			$uporabnik=$user->uporabnisko_ime;
			
			$parametri.="pnaslov=".$_POST['pnaslov']." ";
			$parametri.="pdatum=".$_POST['pdatum']." ";
			$parametri.="pavtor=".$_POST['pavtor']." ";
			
			$data = array(
				"naziv" => "'$naziv'",
				"alias" => "'$alias'",
				"vsebina" => "'$opis'",	
				"objavjlen" => "'$objavljen'",
				"uporabnik" => "'$uporabnik'",
				"kategorija" => "'$kategorija'",
				"parametri" => "'$parametri'"
			);
			
			$db->insert($data, 'vsebine');
			
			$napaka="Vsebina je bila uspe&#353;no vne&#353;ena";
		}
		else
			$napaka="Manjkajo podatki za vsebino!";
	break;
	
	case "posodobi" :
		if ($_POST) {
			$id=$_GET['id'];
			$naziv=preveri($_POST['naziv'],1,50,1);
			$alias=preveri($_POST['alias'],1,50,0);	
			$opis=$_POST['opis'];
			$kategorija=$_POST['kategorija'];
			$objavljen=$_POST['objavljeno'];
			$uporabnik=$user->uporabnisko_ime;
			
			$parametri.="pnaslov=".$_POST['pnaslov']." ";
			$parametri.="pdatum=".$_POST['pdatum']." ";
			$parametri.="pavtor=".$_POST['pavtor']." ";
			
			$data = array(
				"naziv" => "'$naziv'",
				"alias" => "'$alias'",
				"vsebina" => "'$opis'",	
				"objavjlen" => "'$objavljen'",
				"uporabnik" => "'$uporabnik'",
				"kategorija" => "'$kategorija'",
				"parametri" => "'$parametri'"
			);
			
			$db->update($data, 'vsebine', 'id = '.$id);
			
			$napaka="Vsebina je bila uspe&#353;no posodobljena";
		}
		else
			$napaka="Manjkajo vrednosti za posodobitev!";
	break;
}
?>
<form method="post" action="index.php?stran=strani&task=izbrisi">
<div id="moznosti">
	<div id="naziv_sekcije">
    	<img src="<?php echo $domena ?>admin/resources/images/ikone/strani.png" width="70" align="left" />
        <p class="naziv">Urejanje strani</p>
        V tej sekciji lahko urejate HTML podstrani. Vsaki podstrani lahko dolocite tudi kategorijo katero dodate na desni.
    </div>
    <div id="ikone_zg">
        <div class="ikona_zg">
        	<a href="index.php?stran=kategorije">
                <img src="<?php echo $domena ?>admin/resources/images/kategorije.png" width="30" />
            </a>
        </div>
        <div class="ikona_zg">
            <input type="submit" class="odstrani" value=" " />
        </div>
        <div class="ikona_zg">
            <a href="index.php?stran=vsebine_upr&mapa=upravljanje&task=nova"><img src="<?php echo $domena ?>admin/resources/images/dodaj.png" width="30" border="0" /></a>
        </div>
    </div>
    <div style="clear:both"></div>
</div>
<div style="clear:both"></div>
<table border="0" cellpadding="0" cellspacing="0" width="99%" class="sortable">
<tr class="glava_ta">
    <th width="5%">#</th>
	<th width="25%">Naziv</th>
    <th width="7%">Stanje</th>
    <th width="11%">Datum</th>
    <th width="13%">Kategorija</th>
    <th width="7%">Uporabnik</th>
    <th width="7%">Uredi</th>
    <th width="5%">ID</th>
</tr>
<?php 
$result = $db->select('vsebine', 'id > 0');
$i=1;
while ($v = mysql_fetch_array($result)) { ?>
<tr class="vrsta<?php if ($i%2==0) echo"2"; ?>">
	<td align="center"><input type="checkbox" name="izbris[]" value="<?php echo $v['id']; ?>" /></td>
    <td>
        <a href="index.php?stran=vsebine_upr&mapa=upravljanje&task=posodobi&id=<?php echo $v['id']; ?>" title="Uredi!" >
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
    <td align="center"><?php echo datum($v['datum']); ?></td>
    <td align="center">
		<?php 
		$kategorija=$v['kategorija'];
		if ($kategorija>0) {
			$result2 = $db->select('kategorije', 'id = '.$kategorija);
			while ($z = mysql_fetch_array($result2)) {
				echo $z['naziv'];
			}
		}
		else
			echo "Brez kategorije";
		?>
    </td>
    <td align="center"><?php echo $v['uporabnik']; ?></td>
    <td align="center">
        <a href="index.php?stran=vsebine_upr&mapa=upravljanje&task=posodobi&id=<?php echo $v['id']; ?>" title="Uredi!" >
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
    	<div class="form_sp">
            <form>
                <select>
                    <option>--Izberi kategorijo--</option>
                 </select>
            </form>
        </div>
    </td>
    <td align="right" width="40%">     
        <div class="stevilo">3</div>
        <div class="stevilo">2</div>
        <div class="stevilo">1</div>
    </td>
</tr>
</table>