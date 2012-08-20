<?php
if ($_GET['task'])
	$task=preveri($_GET['task'],1,20,1);

switch ($task) {
	case "izbrisi" :
		if ($_POST) {
			foreach ($_POST as $v)
			{
				foreach ($v as $meniji) {
					$meniji=preveri($meniji,1,2,0);
					$sql = mysql_query("DELETE FROM meniji WHERE id = '$meniji'");
				}
			}
			$napaka="Meniji so bili uspešno izbrisani!";
		}
		else
			$napaka="Prosimo oznacite vsaj en menij!";	
	break;
	
	case "dodaj" :
		if($_POST) {
			$naziv=preveri($_POST['naziv'],1,50,1);
			$tip=preveri($_POST['tip'],1,50,0);	
			
			$data = array(
				"naziv" => "'$naziv'",
				"tip" => "'$tip'",
			);
			
			$db->insert($data, 'meniji');
			
			$napaka="Menij je bila uspešno vnešen";
		}
		else
			$napaka="Manjkajo podatki za menij!";
	break;
	
	case "posodobi" :
		if ($_POST) {
			$id=$_GET['id'];
			$naziv=preveri($_POST['naziv'],1,50,1);
			$tip=preveri($_POST['tip'],1,50,0);	
			
			$data = array(
				"naziv" => "'$naziv'",
				"tip" => "'$tip'",
			);
			
			$db->update($data, 'meniji', 'id = '.$id);
			
			$napaka="Menij je bil uspešno posodobljen";
		}
		else
			$napaka="Manjkajo vrednosti za posodobitev!";
	break;
}
?>
<form method="post" action="index.php?stran=meniji&task=izbrisi">
<div id="moznosti">
	<div id="naziv_sekcije">
   	  <img src="<?php echo $domena ?>admin/resources/images/ikone/meniji.png" width="70" align="left" />
        <p class="naziv">Urejanje menijev</p>
        V tej sekciji lahko urejate HTML podstrani. Vsaki podstrani lahko dolocite tudi menijevo katero dodate na desni.
    </div>
    <div id="ikone_zg">
        <div class="ikona_zg">
            <input type="submit" class="odstrani" value=" " title="Odstrani izbrane meniji" />
        </div>
        <div class="ikona_zg">
            <a href="index.php?stran=meniji_upr&mapa=upravljanje&task=nova" title="Nov menij"><img src="<?php echo $domena ?>admin/resources/images/dodaj.png" width="30" border="0" /></a>
        </div>
    </div>
    <div style="clear:both"></div>
</div>
<div style="clear:both"></div>
<table border="0" cellpadding="0" cellspacing="0" width="99%" class="sortable">
<tr class="glava_ta">
    <th width="5%">#</th>
	<th width="30%">Naziv</th>
    <th width="7%">Postavke</th>
    <th width="7%">Št. postavk</th>
    <th width="11%">Datum</th>
    <th width="7%">Uredi</th>
    <th width="7%">ID</th>
</tr>
<?php 
$result = $db->select('meniji', 'id > 0');
$i=1;
while ($v = mysql_fetch_array($result)) { ?>
<tr class="vrsta<?php if ($i%2==0) echo"2"; ?>">
	<td align="center"><input type="checkbox" name="izbris[]" value="<?php echo $v['id']; ?>" /></td>
    <td>
		<a href="index.php?stran=meniji_postavke&meni=<?php echo $v['id']; ?>">
			<?php echo $v['naziv']; ?>
        </a>
    </td>
    <td align="center">
        <a href="index.php?stran=meniji_postavke&meni=<?php echo $v['id']; ?>">
            <img src="<?php echo $domena ?>admin/resources/images/ikone/postavke_small.png" width="20" border="0" />
        </a>
    </td>
    <td align="center">
		<?php 
            $stevilo = $db->select('meniji_postavke', 'meni_id = '.$v['id']);
            echo mysql_num_rows($stevilo);
        ?>
    </td>
    <td align="center"><?php echo datum($v['datum']); ?></td>
    <td align="center">
        <a href="index.php?stran=meniji_upr&mapa=upravljanje&task=posodobi&id=<?php echo $v['id']; ?>" title="Uredi!" >
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
