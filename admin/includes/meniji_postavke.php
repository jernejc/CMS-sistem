<?php
if ($_GET['task'])
	$task=preveri($_GET['task'],1,20,0);
	
if ($_GET['meni'])
	$meni=preveri($_GET['meni'],1,20,0);

switch ($task) {
	case "izbrisi" :
		if ($_POST['izbrisi_p']) {
			
			if(is_array($_POST['izbris'])) {
				foreach ($_POST['izbris'] as $v) {
					$v=preveri($v,1,2,0);
					$sql = mysql_query("DELETE FROM meniji_postavke WHERE id = '$v'");
				}
	
				$napaka="Postavka(e) so bile uspešno izbrisane!";
			}
			else
				$napaka="Prosimo označite vsaj eno postavko!";
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
				$sql = mysql_query("UPDATE meniji_postavke SET red='$r' WHERE id = '$id'");
			}
			
			$napaka="Zaporedje je bilo posodobljeno";
		}	
	break;
	
	case "dodaj" :
		if($_POST) {
			$naziv=preveri($_POST['naziv'],1,50,1);
			$alias=preveri($_POST['alias'],1,50,0);
			$objavjlen=preveri($_POST['objavljeno'],0,5,0);
			$tip=preveri($_POST['tip'],0,5,1);
			$vkz=preveri($_POST['vkz'],0,5,1);
			$parent=$_POST['stars'];
			$meta_key=$_POST['meta_key'];
			$meta_desc=$_POST['meta_desc'];
			$title=$_POST['title'];
			
			switch($tip) {
				case "1" :
					$povezava="index.php?jedro=vsebina&id=".$vkz;
					break;
				case "2" :
					$povezava="index.php?jedro=kategorija&id=".$vkz;
					break;
				case "3" :
					$komponenta=$db->select("komponente", "id =".$vkz);
					while ($k=mysql_fetch_assoc($komponenta))
						$povezava="index.php?jedro=".$k['alias']."&naloga=".$k['povezava'];
					break;
				case "4" :
					$povezava=preveri($_POST['vkz'],1,200,0);
					break;
			}				
		
			$data = array(
				"naziv" => "'$naziv'",
				"alias" => "'$alias'",
				"objavjlen" => "'$objavjlen'",
				"tip" => "'$tip'",
				"vkz" => "'$vkz'",
				"povezava" => "'$povezava'",
				"parent" => "'$parent'",
				"meni_id" => "'$meni'",					
				"meta_key" => "'$meta_key'",
				"meta_desc" => "'$meta_desc'",
				"title" => "'$title'",	
			);
			
			$db->insert($data, 'meniji_postavke');
			
			$napaka="Postavka je bila uspešno vnešena";
		}
		else
			$napaka="Manjkajo podatki za postavko!";
	break;
	
	case "posodobi" :
		if ($_POST) {
			$id=$_GET['id'];
			$naziv=preveri($_POST['naziv'],1,50,1);
			$alias=preveri($_POST['alias'],1,50,0);
			$objavjlen=preveri($_POST['objavljeno'],0,5,0);
			$tip=preveri($_POST['tip'],0,5,1);
			$vkz=preveri($_POST['vkz'],0,5,1);
			$parent=$_POST['stars'];
			$meta_key=$_POST['meta_key'];
			$meta_desc=$_POST['meta_desc'];
			$title=$_POST['title'];
			
			switch($tip) {
				case "1" :
					$povezava="index.php?jedro=vsebina&id=".$vkz;
					break;
				case "2" :
					$povezava="index.php?jedro=kategorija&id=".$vkz;
					break;
				case "3" :
					$komponenta=$db->select("komponente", "id =".$vkz);
					while ($k=mysql_fetch_assoc($komponenta))
						$povezava="index.php?jedro=".$k['alias']."&naloga=".$k['povezava'];
					break;
				case "4" :
					$povezava=preveri($_POST['vkz'],1,200,0);
					break;
			}				
		
			$data = array(
				"naziv" => "'$naziv'",
				"alias" => "'$alias'",
				"objavjlen" => "'$objavjlen'",
				"tip" => "'$tip'",
				"vkz" => "'$vkz'",
				"povezava" => "'$povezava'",
				"parent" => "'$parent'",
				"meni_id" => "'$meni'",
				"meta_key" => "'$meta_key'",
				"meta_desc" => "'$meta_desc'",
				"title" => "'$title'",	
	
			);
			
			$db->update($data, 'meniji_postavke', 'id = '.$id);
			
			$napaka="Postavka je bila uspešno posodobljena";
		}
		else
			$napaka="Manjkajo vrednosti za posodobitev!";
	break;
}
?>
<form method="post" action="index.php?stran=meniji_postavke&task=izbrisi&meni=<?php echo $meni ?>">
<div id="moznosti">
	<div id="naziv_sekcije" style="width:64%">
    	<img src="<?php echo $domena ?>admin/resources/images/ikone/postavke.png" width="70" align="left" />
        <p class="naziv">
        Urejanje postavk v meniju: <span style="color:red">
			<?php 
                $ime = $db->select('meniji', 'id = '.$meni);
                while ($m = mysql_fetch_assoc($ime))
                    echo $m['naziv'];
            ?>
        </span>
        </p>
        V tej sekciji lahko urejate HTML podstrani. Vsaki podstrani lahko dolocite tudi kategorijo katero dodate na desni.
    </div>
    <div id="ikone_zg">
        <div class="ikona_zg">
        	<a href="index.php?stran=meniji" title="Nazaj na urejanje menijev">
                <img src="<?php echo $domena ?>admin/resources/images/nazaj.png" width="32" />
            </a>
        </div>
        <div class="ikona_zg">
        	<input type="submit" class="zaporedje" value=" " name="zaporedje" title="Posodobi zaporedje postavk" />
        </div>
        <div class="ikona_zg">
            <input type="submit" class="odstrani" value=" " title="Odstrani izbrane postavke" name="izbrisi_p" />
        </div>
        <div class="ikona_zg">
            <a href="index.php?stran=meniji_postavke_upr&mapa=upravljanje&task=nova&meni=<?php echo $meni ?>" title="Nova postavka"><img src="<?php echo $domena ?>admin/resources/images/dodaj.png" width="30" border="0" /></a>
        </div>
    </div>
    <div style="clear:both"></div>
</div>
<div style="clear:both"></div>
<table border="0" cellpadding="0" cellspacing="0" width="99%" class="sortable">
<tr class="glava_ta">
    <th width="5%">#</th>
	<th width="24%">Naziv</th>
    <th width="7%">Zapo.</th>
    <th width="5%">Stanje</th>
    <th width="11%">Tip</th>
    <th width="11%">Datum</th>
    <th width="5%">Uredi</th>
    <th width="5%">ID</th>
</tr>
<?php 
$sql = "SELECT * FROM meniji_postavke WHERE meni_id='{$meni}' ORDER by red";
$result = mysql_query($sql);
$i=1;
while ($v = mysql_fetch_array($result)) { ?>
<tr class="vrsta<?php if ($i%2==0) echo"2"; ?>">
	<td align="center"><input type="checkbox" name="izbris[]" value="<?php echo $v['id']; ?>" /></td>
    <td>
		<a href="index.php?stran=meniji_postavke_upr&mapa=upravljanje&task=posodobi&id=<?php echo $v['id']; ?>&meni=<?php echo $meni ?>" title="Uredi!" >
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
    <td align="center">
		<?php
        $tip=$v['tip'];
        switch ($tip) {
            case "1" :
                echo "HTML vsebina";
                break;
            case "2" :
                echo "Kategorija vsebin";
                break;
            case "3":
                echo "Komponenta";
                break;		
			case "4":
                echo "Zunanja povezava";
                break;
						
        }
        ?>
    </td>
    <td align="center"><?php echo datum($v['datum']); ?></td>
    <td align="center">
        <a href="index.php?stran=meniji_postavke_upr&mapa=upravljanje&task=posodobi&id=<?php echo $v['id']; ?>&meni=<?php echo $meni ?>" title="Uredi!" >
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
