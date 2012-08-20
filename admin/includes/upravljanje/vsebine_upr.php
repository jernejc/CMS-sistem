<?php 
if ($_GET['task'])
	$task=$_GET['task'];
else
	$napaka="Rab se task, da se ve kaj se dela an!";
	
switch ($task) {
	// Začetek obrazca za dodajanje nove vsebine
	case "nova" :
?>
<script type="text/javascript">
function validate_form ( )
{
    valid = true;
    if ( document.obrazec.naziv.value == "" )
    {
        hscroll ( "Prosim vnesite naziv!" );
        valid = false;
    }
	if ( document.obrazec.kategorija.selectedIndex < 0 )
    {
        hscroll ( "Prosim izberite kategorijo!" );
        valid = false;
    }
    return valid;
}
</script>
<form method="post" action="index.php?stran=strani&task=dodaj" name="obrazec" onsubmit="return validate_form ( );" >
<div id="moznosti">
	<div id="naziv_sekcije">
    	<img src="<?php echo $domena ?>admin/resources/images/ikone/dodaj_vsebino.png" width="70" align="left" />
        <p class="naziv">Nova html podstran</p>
       	S pomočjo spodnjega obrazca lahko dodate novo HTML podstran, istočasno pa jo lahko tudi povežete v enega izmed predhodno ustvarjenih menijev.
    </div>
    <div id="ikone_zg">
        <div class="ikona_zg">
            <a href="index.php?stran=strani" title="Prekliči"><img src="<?php echo $domena ?>admin/resources/images/odstrani.png" width="30" /></a>
        </div>
        <div class="ikona_zg">
        	<input type="submit" class="dodaj" value=" " title="Shrani" />
        </div>
    </div>
    <div style="clear:both"></div>
</div>
<div style="clear:both"></div>
<div style="float:left; width:70%">
<table cellpadding="0" cellspacing="0" width="99%" border="0">
	<tr class="glava_ta">
    	<th colspan="4">Osnovni podatki vsebine</th>
    </tr>
    <tr class="vrsta">
        <td>Naslov vsebine:</td>
        <td><input type="text" name="naziv" /></td>
        <td>Objavljena?</td>
        <td>
            Da 
              <input type="radio" name="objavljeno" value="1" checked="checked" />
            Ne <input type="radio" name="objavljeno" value="0" />
        </td>
    </tr>
    <tr class="vrsta">
        <td>Alias:</td>
        <td><input type="text" name="alias" /></td>
        <td>Kategorija</td>
        <td>
            <select name="kategorija">
            	<option>--Izberi kategorijo--</option>
                <option value="0">Brez kategorije</option>
                 <?php 
					$result = $db->select('kategorije', 'id > 0');
					while ($v=mysql_fetch_assoc($result)) { ?>
					<option value="<?php echo $v['id'] ?>"><?php echo $v['naziv'] ?></option>						
				<?php } ?>
            </select>
        </td>
    </tr>
</table>
<table cellpadding="0" cellspacing="0" border="0" width="99%">
<tr class="vrsta">
    <td>
    <?php include "tinymce.php"; ?>
    <textarea name="opis" rows="25" cols="80" style="width: 80%" >

	</textarea>
    </td>
</tr>
</table>
</div>
<div style="float:left; width:30%">
    <table cellpadding="0" cellspacing="0" border="0" width="99%">
        <tr class="glava_ta">
            <th colspan="2">Parametri</th>
        </tr>    
        <tr class="vrsta">
            <td>Prikaži naslov</td>
            <td>
            	Da
                <input type="radio" name="pnaslov" value="1" checked="checked" />
                Ne
                <input type="radio" name="pnaslov" value="0" />
            </td>
        </tr>
        <tr class="vrsta">
            <td>Prikaži datum</td>
            <td>
                Da
                <input type="radio" name="pdatum" value="1" checked="checked" />
                Ne
                <input type="radio" name="pdatum" value="0" />
			</td>
        </tr>
        <tr class="vrsta">
            <td>Prikaži avtorja</td>
            <td>                
            	Da
                <input type="radio" name="pavtor" value="1" checked="checked" />
                Ne
                <input type="radio" name="pavtor" value="0" />
            </td>
        </tr>
        <tr><td height="10"></td></tr>
    </table>
</form>
<form method="post" action="index.php?stran=meni&task=vsebina">
    <table cellpadding="0" cellspacing="0" width="99%" border="0">
        <tr class="glava_ta">
            <th colspan="2">Poveži v meni?</th>
        </tr>
        <tr class="vrsta">
            <td colspan="2">
                <select name="meni" multiple="multiple" style="width:250px" >
                    <option value="id_meni">meni1</option>
                    <option value="id_meni">meni2</option>
                    <option value="id_meni">meni3</option>
                    <option value="id_meni">meni3</option>
                </select>
            </td>
        </tr>
        <tr class="vrsta">
            <td>Naziv:</td>
            <td><input type="text" name="naziv_meni"/></td>
        </tr>
        <tr class="vrsta">
            <td>Objavljena?</td>
            <td>
                Ja <input type="radio" name="objavljeno_meni" value="1" />
                Ne <input type="radio" name="objavljeno_meni" value="0" />
            </td>
        </tr>
    </table>
</div>
<div style="clear:both"></div>
</form>
<?php 
//Konec obrazca za novo vsebino
break;

//Začetek obrazca za posodabljanje vsebine
case "posodobi" :

if($_GET['id'])
	$id=$_GET['id'];
else
	$napaka="Rab se ID mofo!";
	
$result = $db->select('vsebine', 'id = '.$id.'');
while ($v=mysql_fetch_assoc($result)) {

$parametri=parametri($v['parametri']);
?>
<form method="post" action="index.php?stran=strani&task=posodobi&id=<?php echo $id ?>" >
<div id="moznosti">
	<div id="naziv_sekcije">
    	<img src="<?php echo $domena ?>admin/resources/images/ikone/dodaj_vsebino.png" width="70" align="left" />
        <p class="naziv">Urejanje html podstran</p>
       	S pomočjo spodnjega obrazca lahko uredite obstoječo HTML podstran, istočasno pa jo lahko tudi povežete v enega izmed predhodno ustvarjenih menijev.
    </div>
    <div id="ikone_zg">
        <div class="ikona_zg">
            <a href="index.php?stran=strani" title="Prekliči"><img src="<?php echo $domena ?>admin/resources/images/odstrani.png" width="30" /></a>
        </div>
        <div class="ikona_zg">
        	<input type="submit" class="dodaj" value=" " title="Shrani" />
        </div>
    </div>
    <div style="clear:both"></div>
</div>
<div style="clear:both"></div>
<div style="float:left; width:70%">
<table cellpadding="0" cellspacing="0" width="99%" border="0">
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
    <textarea name="opis" rows="25" cols="80" style="width: 80%" >
	<?php echo $v['vsebina'] ?>
	</textarea>
    </td>
</tr>
</table>
</div>
<div style="float:left; width:30%">
    <table cellpadding="0" cellspacing="0" border="0" width="99%">
        <tr class="glava_ta">
            <th colspan="2">Parametri</th>
        </tr>    
        <tr class="vrsta">
            <td>Prikaži naslov</td>
            <td>
            	Da
                <input type="radio" name="pnaslov" value="1" <?php if($parametri['pnaslov']==1) echo "checked='checked'"; ?> />
                Ne
                <input type="radio" name="pnaslov" value="0" <?php if($parametri['pnaslov']==0) echo "checked='checked'"; ?> />
            </td>
        </tr>
        <tr class="vrsta">
            <td>Prikaži datum</td>
            <td>
                Da
                <input type="radio" name="pdatum" value="1" <?php if($parametri['pdatum']==1) echo "checked='checked'"; ?> />
                Ne
                <input type="radio" name="pdatum" value="0" <?php if($parametri['pdatum']==0) echo "checked='checked'"; ?> />
			</td>
        </tr>
        <tr class="vrsta">
            <td>Prikaži avtorja</td>
            <td>                
            	Da
                <input type="radio" name="pavtor" value="1" <?php if($parametri['pavtor']==1) echo "checked='checked'"; ?> />
                Ne
                <input type="radio" name="pavtor" value="0" <?php if($parametri['pavtor']==0) echo "checked='checked'"; ?> />
            </td>
        </tr>
        <tr><td height="10"></td></tr>    
    </table>
</form>
<form method="post" action="index.php?stran=meni&task=vsebina">
    <table cellpadding="0" cellspacing="0" width="99%" border="0">
        <tr class="glava_ta">
            <th colspan="2">Poveži v meni?</th>
        </tr>
        <tr class="vrsta">
            <td colspan="2">
                <select name="meni" multiple="multiple" style="width:250px" >
                    <option value="id_meni">meni1</option>
                    <option value="id_meni">meni2</option>
                    <option value="id_meni">meni3</option>
                    <option value="id_meni">meni3</option>
                </select>
            </td>
        </tr>
        <tr class="vrsta">
            <td>Naziv:</td>
            <td><input type="text" name="naziv_meni"/></td>
        </tr>
        <tr class="vrsta">
            <td>Objavljena?</td>
            <td>
                Ja <input type="radio" name="objavljeno_meni" value="1" />
                Ne <input type="radio" name="objavljeno_meni" value="0" />
            </td>
        </tr>
    </table>
</div>
<div style="clear:both"></div>
</form>
<?php 
} // Konča se while za vrednosti iz baze
break;  // Konča se "posodobi" case za switch 
} // Konča se switch 
?>