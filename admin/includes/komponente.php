<?php
if(!isset($_SESSION['logged_in'])) { 
	echo "Niste prijavljeni";
}

if ($_GET['task'])
	$task=preveri($_GET['task'],1,20,1);

switch ($task) {
	case "izbrisi" :
		if ($_POST) {
			foreach ($_POST as $v)
			{
				foreach ($v as $komponente) {
					$komponente=preveri($komponente,1,2,0);
					$sql = mysql_query("DELETE FROM komponente WHERE id = '$komponente'");
				}
			}
			$napaka="Komponente so bile uspešno izbrisane!";
		}
		else
			$napaka="Prosimo oznacite vsaj eno vsebino!";	
	break;
	
	case "dodaj" :
		if($_POST) {
			$naziv=preveri($_POST['naziv'],1,50,1);
			$alias=preveri($_POST['alias'],1,50,0);
			$povezava=preveri($_POST['povezava'],1,50,0);	
			$objavljen=$_POST['objavljeno'];
			
			$data = array(
				"naziv" => "'$naziv'",
				"alias" => "'$alias'",
				"povezava" => "'$povezava'",	
				"objavljen" => "'$objavljen'",
			);
			
			$db->insert($data, 'komponente');
			
			$napaka="Komponenta je bila uspešno vnešena";
		}
		else
			$napaka="Manjkajo podatki za komponento!";
	break;
	
	case "posodobi" :
		if ($_POST) {
			$id=$_GET['id'];
			$naziv=preveri($_POST['naziv'],1,50,1);
			$alias=preveri($_POST['alias'],1,50,0);
			$povezava=preveri($_POST['povezava'],1,50,0);	
			$objavljen=$_POST['objavljeno'];
			
			$data = array(
				"naziv" => "'$naziv'",
				"alias" => "'$alias'",
				"povezava" => "'$povezava'",	
				"objavljen" => "'$objavljen'",
			);
			
			
			$db->update($data, 'komponente', 'id = '.$id);
			
			$napaka="Komponenta je bila uspešno posodobljena";
		}
		else
			$napaka="Manjkajo vrednosti za posodobitev!";
	break;
}
?>
<form method="post" action="index.php?stran=komponente&task=izbrisi">
<div id="moznosti">
	<div id="naziv_sekcije">
    	<img src="<?php echo $domena ?>admin/resources/images/ikone/komponente.png" width="70" align="left" />
        <p class="naziv">Urejanje komponent</p>
        V tej sekciji lahko urejate HTML podstrani. Vsaki podstrani lahko dolocite tudi kategorijo katero dodate na desni.
    </div>
    <div id="ikone_zg">
        <div class="ikona_zg">
            <input type="submit" class="odstrani" value=" " />
        </div>
        <div class="ikona_zg">
            <a href="index.php?stran=komponente_upr&mapa=upravljanje&task=nova"><img src="<?php echo $domena ?>admin/resources/images/dodaj.png" width="30" border="0" /></a>
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
    <th width="10%">Datum</th>
    <th width="7%">Uredi</th>
    <th width="5%">ID</th>
</tr>
<?php 
$result = $db->select('komponente', 'id > 0');
$i=1;
while ($v = mysql_fetch_array($result)) { ?>
<tr class="vrsta<?php if ($i%2==0) echo"2"; ?>">
	<td align="center"><input type="checkbox" name="izbris[]" value="<?php echo $v['id']; ?>" /></td>
    <td>
        <a href="index.php?stran=komponente_upr&mapa=upravljanje&task=posodobi&id=<?php echo $v['id']; ?>" title="Uredi!" >
            <?php echo $v['naziv']; ?>
        </a>
    </td>
    <td align="center"><img src="<?php echo $domena ?>admin/resources/images/<?php 
		if ($v['objavljen']==1) 
			echo "published.png"; 
		else 
			echo "unpublished.png"; 
	?>" width="12" />
    </td>
    <td align="center"><?php echo datum($v['datum']); ?></td>
    <td align="center">
        <a href="index.php?stran=komponente_upr&mapa=upravljanje&task=posodobi&id=<?php echo $v['id']; ?>" title="Uredi!" >
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