<?php 
if ($_GET['task'])
	$task=$_GET['task'];
else
	$napaka="Rab se task, da se ve kaj se dela an!";
	
switch ($task) {
	// Začetek obrazca za dodajanje nove uporabnike
	case "nova" :
?>
<form method="post" action="index.php?stran=uporabniki&task=dodaj" >
<div id="moznosti">
	<div id="naziv_sekcije">
    	<img src="<?php echo $domena ?>admin/resources/images/ikone/dodaj_uporabnika.png" width="70" align="left" />
        <p class="naziv">Nov uporabnik</p>
       	S pomočjo spodnjega obrazca lahko dodate novo HTML podstran, istočasno pa jo lahko tudi povežete v enega izmed predhodno ustvarjenih menijev.
    </div>
    <div id="ikone_zg">
        <div class="ikona_zg">
            <a href="index.php?stran=uporabniki" title="Prekliči">
                <img src="<?php echo $domena ?>admin/resources/images/odstrani.png" width="30" />
            </a>
        </div>
        <div class="ikona_zg">
        	<input type="submit" class="dodaj" value=" " title="Shrani" />
        </div>
    </div>
    <div style="clear:both"></div>
</div>
<div style="clear:both"></div>
<table cellpadding="0" cellspacing="0" width="99%" border="0">
	<tr class="glava_ta">
    	<th colspan="4">Osnovni podatki za uporabnika</th>
    </tr>
    <tr class="vrsta">
        <td>Ime in priimek:</td>
        <td><input type="text" name="naziv" /></td>
        <td>Objavljen?</td>
        <td>
            Ja <input type="radio" name="objavljeno" value="1" checked="checked" />
            Ne <input type="radio" name="objavljeno" value="0" />
        </td>
    </tr>
    <tr class="vrsta">
        <td>E-mail:</td>
        <td><input type="text" name="email" /></td>
        <td>Vrsta</td>
        <td>
            <select name="vrsta">
            	<option>--Izberi vrsto--</option>
                <option value="0">Registriran uporabnik</option>
                <option value="1">Stranka</option>
                <option value="2">Admin</option>						
            </select>
        </td>
    </tr>
    <tr class="glava_ta">
    	<th colspan="4">Podatki za prijavo</th>
    </tr>
    <tr class="vrsta">
        <td>Uporabniško ime:</td>
        <td><input type="text" name="uporabnisko_ime" /></td>
        <td>Geslo</td>
        <td>
            <input type="password" name="geslo" /> 
       </td>
    </tr>
    <tr class="vrsta">
        <td colspan="2">&nbsp;</td>
        <td>Ponovno vnesti geslo</td>
        <td>
            <input type="password" name="geslo2" /> 
        </td>
    </tr>
</table>
</form>
<table border="0" cellpadding="0" cellspacing="0" width="99%">
<tr class="spodaj_ta">
    <td align="left" height="30">
    </td>
</tr>
</table>
<?php 
//Konec obrazca za novega uporabnika
break;

//Začetek obrazca za posodabljanje uporabnika
case "posodobi" :

if($_GET['id'])
	$id=$_GET['id'];
else
	$napaka="Rab se ID mofo!";
	
$result = $db->select('uporabniki', 'id = '.$id.'');
while ($v=mysql_fetch_assoc($result)) {
?>
<form method="post" action="index.php?stran=uporabniki&task=posodobi&id=<?php echo $id ?>" >
<div id="moznosti">
	<div id="naziv_sekcije">
    	<img src="<?php echo $domena ?>admin/resources/images/ikone/dodaj_uporabnika.png" width="70" align="left" />
        <p class="naziv">Uredi uporabnika</p>
       	S pomočjo spodnjega obrazca lahko dodate novo HTML podstran, istočasno pa jo lahko tudi povežete v enega izmed predhodno ustvarjenih menijev.
    </div>
    <div id="ikone_zg">
        <div class="ikona_zg">
            <a href="index.php?stran=uporabniki" title="Prekliči"><img src="<?php echo $domena ?>admin/resources/images/odstrani.png" width="30" /></a>
        </div>
        <div class="ikona_zg">
        	<input type="submit" class="dodaj" value=" " title="Shrani" />
        </div>
    </div>
    <div style="clear:both"></div>
</div>
<div style="clear:both"></div>
<table cellpadding="0" cellspacing="0" width="99%" border="0">
	<tr class="glava_ta">
    	<th colspan="4">Osnovni podatki za uporabnika</th>
    </tr>
    <tr class="vrsta">
        <td>Ime in priimek:</td>
        <td><input type="text" name="naziv" value="<?php echo $v['naziv'];?>" /></td>
        <td>Objavljen?</td>
        <td>
            Ja <input type="radio" name="objavljeno" value="1" <?php if ($v['objavjlen']==1) { ?>checked="checked"<?php } ?> />
            Ne <input type="radio" name="objavljeno" value="0" <?php if ($v['objavjlen']==0) { ?>checked="checked"<?php } ?>/>
        </td>
    </tr>
    <tr class="vrsta">
        <td>E-mail:</td>
        <td><input type="text" name="email" value="<?php echo $v['email'];?>" /></td>
        <td>Vrsta</td>
        <td>
            <select name="vrsta">
            	<option>--Izberi vrsto--</option>
                <option value="0" <?php if ($v['vrsta']==0) { ?>selected="selected"<?php } ?>>Registriran uporabnik</option>
                <option value="1" <?php if ($v['vrsta']==1) { ?>selected="selected"<?php } ?>>Stranka</option>
                <option value="2" <?php if ($v['vrsta']==2) { ?>selected="selected"<?php } ?>>Admin</option>						
            </select>
        </td>
    </tr>
    <tr class="glava_ta">
    	<th colspan="4">Podatki za prijavo</th>
    </tr>
    <tr class="vrsta">
        <td>Uporabniško ime:</td>
        <td><input type="text" name="uporabnisko_ime" value="<?php echo $v['uporabnisko_ime'];?>" /></td>
        <td>Geslo</td>
        <td>
            <input type="password" name="geslo" /> 
       </td>
    </tr>
    <tr class="vrsta">
        <td colspan="2">&nbsp;</td>
        <td>Ponovno vnesti geslo</td>
        <td>
            <input type="password" name="geslo2" /> 
        </td>
    </tr>
</table>
</form>
<table border="0" cellpadding="0" cellspacing="0" width="99%">
<tr class="spodaj_ta">
    <td align="left" height="30">
    </td>
</tr>
</table>
</form>
<?php 
} // Konča se while za vrednosti iz baze
break;  // Konča se "posodobi" case za switch 
} // Konča se switch 
?>