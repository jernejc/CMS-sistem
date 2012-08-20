<script>
	$(function(){
		// jQuery UI Dialog    
		$('#potrditev').dialog({
			autoOpen: false,
			height: 175,
			modal: true,
			resizable: false,
			buttons: {
				"Izbriši izbrane": function() {
					$('#izbris_f').append('<input type="hidden" name="izbrisi_p" value=" " />');
					document.izbris_f.submit();
				},
				"Prekliči": function() {
					$(this).dialog("close");
				}
			}
		});

		$('form#izbris_f').submit(function(e){
			if(e.originalEvent.explicitOriginalTarget.name == "izbrisi_g") { 
				$('#potrditev').dialog('open');
				return false;
			}
		});
	});
</script>
<div id="potrditev" title="Ste prepričani?">
    <p style="font-size:10px">
        <span class="ui-icon ui-icon-alert" style="float:left; margin:6px 7px 20px 0;"></span>Vsi označeni moduli bodo izbrisani, <b>brez možnosti povrnitve!</b>
    </p>
</div>
<?php
if ($_GET['task'])
	$task=preveri($_GET['task'],1,20,1);

switch ($task) {
	case "izbrisi" :
		if ($_POST['izbrisi_p']) { ?>
						
			<?php
            if(is_array($_POST['izbris'])) {
				foreach ($_POST['izbris'] as $v) {
					$v=preveri($v,1,2,0);
					$sql = mysql_query("DELETE FROM moduli WHERE id = '$v'");
				} 
				 
				$napaka="Modul(i) so bili uspešno izbrisani!";
			}
			else
				$napaka="Prosimo označite vsaj en modul!";
		}
		
		if ($_POST['zaporedje']) {
			
			$zaporedje=array();
			$i=0;
			
			foreach ($_POST['red'] as $red) {
				$zaporedje[$_POST['id'][$i]]=$red;
				$i++;	
			}
			
			foreach ($zaporedje as $id => $r) {
				$id=preveri($id,1,2,0);
				$r=preveri($r,1,2,0);
				$sql = mysql_query("UPDATE moduli SET red='$r' WHERE id = '$id'");
			}
			
			$napaka="Zaporedje je bilo posodobljeno";
		}	
	break;
	
	case "dodaj" :
		if($_POST) {
			$naziv=preveri($_POST['naziv'],1,50,1);
			$prikazi_n=$_POST['prikazi_n'];	
			$objavljen=$_POST['objavljeno'];
			$tip=$_POST['tip'];
			$pozicija=$_POST['pozicija'];
			
			if (is_array($_POST['postavka']))
				$postavka=implode(",",$_POST['postavka']);
			else 
				$postavka="on";
			
			switch ($tip) {
				case "1" :
					$vsebina=$_POST['vsebina'];
					break;
				
				case "2" :
					$menij=$_POST['menij'];
					break;
					
				case "3" :
					$aplikacija=$_POST['aplikacija'];
					break;	
			}
			
			$data = array(
				"naziv" => "'$naziv'",
				"prikazi_n" => "'$prikazi_n'",
				"objavjlen" => "'$objavljen'",
				"tip"=>"'$tip'",
				"vsebina"=>"'$vsebina'",
				"strani"=>"'$postavka'",
				"pozicija"=>"'$pozicija'",
				"menij"=>"'$menij'",
				"aplikacija"=>"'$aplikacija'",
			);
			
			$db->insert($data, 'moduli');
			
			$napaka="Modul je bil uspešno vnešen";
		}
		else
			$napaka="Manjkajo podatki za modul!";
	break;
	
	case "posodobi" :
		if ($_POST) {
			$id=$_GET['id'];
			$naziv=preveri($_POST['naziv'],1,50,1);
			$prikazi_n=$_POST['prikazi_n'];	
			$objavljen=$_POST['objavljeno'];
			$tip=$_POST['tip'];
			$pozicija=$_POST['pozicija'];
			
			if (is_array($_POST['postavka']))
				$postavka=implode(",",$_POST['postavka']);
			else
				$postavka="on";
			
			switch ($tip) {
				case "1" :
					$vsebina=$_POST['vsebina'];
					break;
				
				case "2" :
					$menij=$_POST['menij'];
					break;
					
				case "3" :
					$aplikacija=$_POST['aplikacija'];
					break;	
			}
			
			$data = array(
				"naziv" => "'$naziv'",
				"prikazi_n" => "'$prikazi_n'",
				"objavjlen" => "'$objavljen'",
				"tip"=>"'$tip'",
				"vsebina"=>"'$vsebina'",
				"strani"=>"'$postavka'",
				"pozicija"=>"'$pozicija'",
				"menij"=>"'$menij'",
				"aplikacija"=>"'$aplikacija'",
			);
			
			$db->update($data, 'moduli', 'id = '.$id);
			
			$napaka="Modul je bil uspešno posodobljen";
		}
		else
			$napaka="Manjkajo vrednosti za posodobitev!";
	break;
}
?>
<form method="post" action="index.php?stran=moduli&task=izbrisi" name="izbris_f" id="izbris_f">
<div id="moznosti">
	<div id="naziv_sekcije" style="width:64%">
    	<img src="<?php echo $domena ?>admin/resources/images/ikone/moduli.png" width="70" align="left" />
        <p class="naziv">Urejanje modulov</p>
        V tej sekciji lahko urejate HTML podstrani. Vsaki podstrani lahko dolocite tudi kategorijo katero dodate na desni.
    </div>
    <div id="ikone_zg">
    	 <div class="ikona_zg" >
            <a href="index.php?stran=moduli_apl" title="Urejanje pozicij"><img src="<?php echo $domena ?>admin/resources/images/moduli_apl.png" width="35" border="0" />
            </a>
        </div>
        <div class="ikona_zg">
        	<input type="submit" class="zaporedje" value=" " name="zaporedje" title="Posodobi zaporedje modulov" />
        </div>
        <div class="ikona_zg">
            <input type="submit" class="odstrani" value=" " name="izbrisi_g" id="izbrisi_g" title="Odstrani izbrane moduli"  />
        </div>
        <div class="ikona_zg">
            <a href="index.php?stran=moduli_upr&mapa=upravljanje&task=nova" title="Nov modul"><img src="<?php echo $domena ?>admin/resources/images/dodaj.png" width="30" border="0" /></a>
        </div>
    </div>
    <div style="clear:both"></div>
</div>
<div style="clear:both"></div>
<table border="0" cellpadding="0" cellspacing="0" width="99%" class="sortable">
<tr class="glava_ta">
    <th width="5%">#</th>
	<th width="25%">Naziv</th>
    <th width="7%">Zapo.</th>
    <th width="7%">Stanje</th>
    <th width="8%">Pozicija</th>
    <th width="13%">Tip</th>
    <th width="13%">Datum</th>
    <th width="7%">Uredi</th>
    <th width="7%">ID</th>
</tr>
<?php 
$sql = "SELECT * FROM moduli WHERE id > 0 ORDER by red";
$result = mysql_query($sql);
$i=1;
while ($v = mysql_fetch_array($result)) { ?>
<tr class="vrsta<?php if ($i%2==0) echo"2"; ?>">
	<td align="center"><input type="checkbox" name="izbris[]" value="<?php echo $v['id']; ?>" /></td>
    <td>
		<a href="index.php?stran=moduli_upr&mapa=upravljanje&task=posodobi&id=<?php echo $v['id']; ?>" title="Uredi!" >
			<?php echo $v['naziv']; ?>
        </a>
    </td>
    <td align="center">
        <input name="red[]" size="2" value="<?php echo $v['red']; ?>" style="text-align: center;" type="text">
        <input type="hidden" name="id[]" value="<?php echo $v['id']; ?>" />
    </td>
    <td align="center"><img src="<?php echo $domena ?>admin/resources/images/<?php 
		if ($v['objavjlen']==1) 
			echo "published.png"; 
		else 
			echo "unpublished.png"; 
	?>" width="12" />
    </td>
    <td align="center"><?php echo $v['pozicija']; ?></td>
    <td align="center">
	<?php 
		switch ($v['tip']) {
			case "1" :
				echo "HTML vsebina";
				break;
			
			case "2" :
				echo "Menij";
				break;
			
			case "3" :
				echo "PHP aplikacija";
				break;
		}
	?>
    </td>
    <td align="center"><?php echo datum($v['datum']); ?></td>
    <td align="center">
        <a href="index.php?stran=moduli_upr&mapa=upravljanje&task=posodobi&id=<?php echo $v['id']; ?>" title="Uredi!" >
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
