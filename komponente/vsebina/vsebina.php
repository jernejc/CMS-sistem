<?php
if ($_GET['naloga'])
	$naloga=preveri($_GET['naloga'],1,15,1);

$user = unserialize($_SESSION['user']);
$db = new DB();

switch ($naloga) {

case "uredi" : 
	if ($user->vrsta > 0) {
		if($_GET['id'])
			$id=preveri($_GET['id'],0,2,1);
		else
			$napaka="Rab se ID mofo!";
			
		$result = $db->select('vsebine', 'id = '.$id.'');
		while ($v=mysql_fetch_assoc($result)) {
		
		$parametri=parametri($v['parametri']);
		?>
		<div class="post" style="margin-left:-7px">
			<form method="post" action="index.php?jedro=vsebina&id=<?php echo $id ?>&pid=<?php echo $pid ?>" >
			<div id="moznosti" style="width:595px">
				<div id="naziv_sekcije" style="width:70%">
					<img src="<?php echo $domena ?>admin/resources/images/ikone/dodaj_vsebino.png" width="70" align="left" />
					<p class="naziv">Urejanje html podstrani</p>
					S pomočjo spodnjega obrazca lahko uredite obstoječo HTML podstran.
				</div>
				<div id="ikone_zg">
					<div class="ikona_zg">
						<a href="index.php?jedro=vsebina&id=<?php echo $id ?>&pid=<?php echo $pid ?>" title="Prekliči"><img src="<?php echo $domena ?>admin/resources/images/odstrani.png" width="30" /></a>
					</div>
					<div class="ikona_zg">
						<input type="submit" class="dodaj" value=" " title="Shrani" />
					</div>
				</div>
				<div style="clear:both"></div>
			</div>
			<div style="clear:both"></div>
			<div style="float:left; width:99%">
			<table cellpadding="0" cellspacing="0" width="595" border="0">
				<tr class="glava_ta">
					<th colspan="4">Osnovni podatki vsebine</th>
				</tr>
				<tr class="vrsta">
					<td>Naslov vsebine:</td>
					<td><input type="text" name="naziv" value="<?php echo $v['naziv'] ?>" /></td>
					<td>Objavljena?</td>
					<td>
						Ja <input type="radio" name="objavljeno" value="1" <?php if ($v['objavjlen']=='1') echo "checked='checked'"; ?> />
						Ne <input type="radio" name="objavljeno" value="0" <?php if ($v['objavjlen']=='0') echo "checked='checked'"; ?>/>
					</td>
				</tr>
				<tr class="vrsta">
					<td>Alias:</td>
					<td><input type="text" name="alias" value="<?php echo $v['alias'] ?>" /></td>
					<td>Kategorija</td>
					<td>
						<select name="kategorija">
							<option>--Izberi kategorijo--</option>
							<?php 
								if ($v['kategorija']=='0') 
									echo "<option value='0' selected='selected'>Brez kategorije</option>";
								else 
									echo "<option value='0'>Brez kategorije</option>";
								
								$result = $db->select('kategorije', 'id > 0');
								while ($z=mysql_fetch_assoc($result)) { ?>
									<option value="<?php echo $z['id'] ?>" <?php if ($v['kategorija']==$z['id']) echo 'selected="selected"'; ?>>
										<?php echo $z['naziv'] ?>
									</option>						
							<?php } ?>
						</select>
					</td>
				</tr>
			</table>
			<table cellpadding="0" cellspacing="0" border="0" width="99%">
			<tr class="vrsta">
				<td>
				<?php include "tinymce.php"; ?>
				<textarea name="opis" rows="25" cols="80" style="width: 99%" >
				<?php echo $v['vsebina'] ?>
				</textarea>
				</td>
			</tr>
			</table>
			</div>
			<input type="hidden" name="p_vsebino" value="1" />
			</form>
		</div>
<?php 	
		}// Konča se while za vrednosti iz baze
	} 
	else
    	echo "Nimate dostopa do the strani";

break; // Konča se obrazec za urejanje vsebine na "frontendu"

default:
	
	if (($_POST['p_vsebino']==1)and($user->vrsta > 0)) {
			$naziv=preveri($_POST['naziv'],1,50,1);
			$alias=preveri($_POST['alias'],1,50,0);	
			$opis=$_POST['opis'];
			$kategorija=$_POST['kategorija'];
			$objavljen=$_POST['objavljeno'];
			$uporabnik=$user->uporabnisko_ime;
			
			$data = array(
				"naziv" => "'$naziv'",
				"alias" => "'$alias'",
				"vsebina" => "'$opis'",	
				"objavjlen" => "'$objavljen'",
				"uporabnik" => "'$uporabnik'",
				"kategorija" => "'$kategorija'",
			);
			
			$db->update($data, 'vsebine', 'id = '.$id);
			
			$napaka="Vsebina je bila uspešno posodobljena";
	}

	
	$vsebina = $db->select('vsebine', 'id = '.$id);
	
	while ($v = mysql_fetch_array($vsebina)) { 
	
	$parametri=parametri($v['parametri']);
	?>
	<div class="post">
		<?php 
		if($parametri["pnaslov"]==1) { ?>
			<h2 style="display:inline">
				<?php echo $v['naziv']; ?>
			</h2>
		<?php } ?>
		 <?php if ($user->vrsta > 0) { ?>
            <a href="index.php?jedro=vsebina&naloga=uredi&id=<?php echo $id ?>&pid=<?php echo $pid ?>">
                <img src="<?php echo $domena ?>komponente/vsebina/slike/uredi.png" height="18" style="padding-top:5px;" border="0" title="Uredi vsebino!"  />
            </a>
         <?php } ?>
		<p class="meta">
			<?php 
			if($parametri["pdatum"]==1) 
				echo datum($v['datum']); 
			 
			if($parametri["pavtor"]==1) {
				echo " - "; 
				echo $v['uporabnik'];
			}
			?>
		</p>
		<div class="entry"><?php echo $v['vsebina']; ?></div>
	</div>
<?php } 
break; // Konec "default switcha", prikažemo vsebino
}
?>