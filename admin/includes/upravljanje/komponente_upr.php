<?php 
if ($_GET['task'])
	$task=$_GET['task'];
else
	$napaka="Rab se task, da se ve kaj se dela an!";
	
switch ($task) {
	// Začetek obrazca za dodajanje nove vsebine
	case "nova" :
?>
<form method="post" action="index.php?stran=komponente&task=dodaj" >
<div id="moznosti">
	<div id="naziv_sekcije">
    	<img src="<?php echo $domena ?>admin/resources/images/ikone/dodaj_vsebino.png" width="70" align="left" />
        <p class="naziv">Nova html podstran</p>
       	S pomočjo spodnjega obrazca lahko dodate novo HTML podstran, istočasno pa jo lahko tudi povežete v enega izmed predhodno ustvarjenih menijev.
    </div>
    <div id="ikone_zg">
        <div class="ikona_zg">
            <a href="index.php?stran=komponente" title="Prekliči"><img src="<?php echo $domena ?>admin/resources/images/odkomponente.png" width="30" /></a>
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
    	<th colspan="4">Osnovni podatki komponente</th>
    </tr>
    <tr class="vrsta">
        <td>Naziv komponente:</td>
        <td><input type="text" name="naziv" /></td>
        <td>Objavljena?</td>
        <td>
            Ja <input type="radio" name="objavljeno" value="1" checked="checked" />
            Ne <input type="radio" name="objavljeno" value="0" />
        </td>
    </tr>
    <tr class="vrsta">
        <td>Alias:</td>
        <td><input type="text" name="alias" /></td>
        <td>Povezava</td>
        <td><input type="text" name="povezava" /></td>
    </tr>
</table>
<table cellpadding="0" cellspacing="0" border="0" width="99%">
    <tr class="glava_ta">
        <th colspan="2">Parametri</th>
    </tr>    
    <tr class="vrsta">
        <td><input type="checkbox" /> Prikaži naslov</td>
        <td><input type="checkbox" /> Prikaži naslov</td>
    </tr>
    <tr class="vrsta">
        <td><input type="checkbox" /> Prikaži naslov</td>
        <td><input type="checkbox" /> Prikaži naslov</td>
    </tr>
    <tr class="vrsta">
        <td><input type="checkbox" /> Prikaži naslov</td>
        <td><input type="checkbox" /> Prikaži naslov</td>
    </tr>
    <tr class="vrsta">
        <td><input type="checkbox" /> Prikaži naslov</td>
        <td><input type="checkbox" /> Prikaži naslov</td>
    </tr>
</table>
</div>
<div style="float:left; width:30%">
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
	
$result = $db->select('komponente', 'id = '.$id.'');
while ($v=mysql_fetch_assoc($result)) {
?>
<form method="post" action="index.php?stran=komponente&task=posodobi&id=<?php echo $id ?>" >
<div id="moznosti">
	<div id="naziv_sekcije">
    	<img src="<?php echo $domena ?>admin/resources/images/ikone/dodaj_vsebino.png" width="70" align="left" />
        <p class="naziv">Urejanje komponente</p>
       	S pomočjo spodnjega obrazca lahko uredite obstoječo HTML podstran, istočasno pa jo lahko tudi povežete v enega izmed predhodno ustvarjenih menijev.
    </div>
    <div id="ikone_zg">
        <div class="ikona_zg">
            <a href="index.php?stran=komponente" title="Prekliči"><img src="<?php echo $domena ?>admin/resources/images/odstrani.png" width="30" /></a>
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
    	<th colspan="4">Osnovni podatki komponente</th>
    </tr>
    <tr class="vrsta">
        <td>Naslov komponente:</td>
        <td><input type="text" name="naziv" value="<?php echo $v['naziv'] ?>" /></td>
        <td>Objavljena?</td>
        <td>
            Ja <input type="radio" name="objavljeno" value="1" <?php if ($v['objavljen']=='1') echo "checked='checked'"; ?> />
            Ne <input type="radio" name="objavljeno" value="0" <?php if ($v['objavljen']=='0') echo "checked='checked'"; ?>/>
        </td>
    </tr>
    <tr class="vrsta">
        <td>Alias:</td>
        <td><input type="text" name="alias" value="<?php echo $v['alias'] ?>" /></td>
        <td>Povezava</td>
       <td><input type="text" name="povezava" value="<?php echo $v['povezava'] ?>" /></td>
    </tr>
</table>
<table cellpadding="0" cellspacing="0" border="0" width="99%">
    <tr class="glava_ta">
        <th colspan="2">Parametri</th>
    </tr>    
    <tr class="vrsta">
        <td><input type="checkbox" /> Prikaži naslov</td>
        <td><input type="checkbox" /> Prikaži naslov</td>
    </tr>
    <tr class="vrsta">
        <td><input type="checkbox" /> Prikaži naslov</td>
        <td><input type="checkbox" /> Prikaži naslov</td>
    </tr>
    <tr class="vrsta">
        <td><input type="checkbox" /> Prikaži naslov</td>
        <td><input type="checkbox" /> Prikaži naslov</td>
    </tr>
    <tr class="vrsta">
        <td><input type="checkbox" /> Prikaži naslov</td>
        <td><input type="checkbox" /> Prikaži naslov</td>
    </tr>
</table>

</div>
<div style="float:left; width:30%">
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