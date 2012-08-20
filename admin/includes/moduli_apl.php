<?php
if ($_GET['task'])
	$task=preveri($_GET['task'],1,20,1);

if($task=="posodobi") {
	
	if ($_POST['odstrani']) {
		if(is_array($_POST['izbrisi'])) {
			foreach ($_POST['izbrisi'] as $v)
			{
				$v=preveri($v,1,2,0);
				$sql = mysql_query("DELETE FROM moduli_pozicije WHERE id = '$v'");
			}
			$napaka="Pozicija(e) so bile uspešno izbrisane!";
		}
		else
			$napaka="Prosimo oznacite vsaj eno pozicijo!";
	}
	
	if($_POST['dodaj']) {
		
		$naziv=preveri($_POST['naziv'],1,20,1);
		
		$data = array(
				"naziv" => "'$naziv'",
			);
			
		$db->insert($data, 'moduli_pozicije');	
		
		$napaka="Pozicija je bila uspešno vnešena";
	}
}
?>
<form method="post" action="index.php?stran=moduli_apl&task=posodobi">
<div id="moznosti">
	<div id="naziv_sekcije">
    	<img src="<?php echo $domena ?>admin/resources/images/ikone/pozicije.png" width="70" align="left" />
        <p class="naziv">Urejanje pozicij za prikazovanje modulov</p>
       	S pomočjo spodnjega obrazca lahko dodate novo HTML podstran, istočasno pa jo lahko tudi povežete v enega izmed predhodno ustvarjenih menijev.
    </div>
    <div id="ikone_zg">
    	 <div class="ikona_zg">
        	<a href="index.php?stran=moduli" title="Nazaj na urejanje podstrani">
                <img src="<?php echo $domena ?>admin/resources/images/nazaj.png" width="32" />
            </a>
        </div>
        <div class="ikona_zg">
            <input type="submit" class="odstrani" value=" " title="Odstrani izbrane pozicije" name="odstrani" />
        </div>
        <div class="ikona_zg">
        	<input type="submit" class="dodaj" value=" " title="Dodaj novo pozicijo" name="dodaj" />
        </div>
    </div>
</div>
<div style="clear:both"></div>
<div style="width:49%; float:left">
    <table cellpadding="0" cellspacing="0" width="99%" border="0">
        <tr class="glava_ta">
            <th align="left" colspan="2">Dodaj pozicijo</th>
        </tr>
        <tr class="vrsta">
            <td width="40%">Naziv pozicije:</td>
            <td><input type="text" name="naziv" /></td>
        </tr>
    </table>
</div>
<div style="float:left; width:49%">
    <table cellpadding="0" cellspacing="0" width="99%" border="0">
        <tr class="glava_ta">
            <th align="center" colspan="2">Obstoječe pozicije</th>
        </tr>
    <?php
    $result = $db->select('moduli_pozicije', 'id > 0');
    $i=1;
    while ($v = mysql_fetch_array($result)) { ?>
    <tr class="vrsta">
        <td width="70%"><?php echo $v['naziv'] ?></td>
        <td><input type="checkbox" name="izbrisi[]" value="<?php echo $v['id'] ?>" /></td>
    </tr>
    <?php } ?>
    </table>
</div>
<div style="clear:both"></div>
</form>