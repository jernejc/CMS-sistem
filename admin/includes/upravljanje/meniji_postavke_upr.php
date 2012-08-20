<script language="javascript">
	function menjava() {
		var tipi=document.getElementById("tip")
		if (tipi.options[0].selected==true){
			document.getElementById("vsebine").style.display="none"
			document.getElementById("kategorije").style.display="none"
			document.getElementById("nitipa").style.display=""
			document.getElementById("komponente").style.display="none"
		}
		if (tipi.options[1].selected==true){
			document.getElementById("vsebine").style.display=""
			document.getElementById("kategorije").style.display="none"
			document.getElementById("nitipa").style.display="none"
			document.getElementById("komponente").style.display="none"
		}
		if (tipi.options[2].selected==true){
			document.getElementById("kategorije").style.display=""
			document.getElementById("vsebine").style.display="none"
			document.getElementById("nitipa").style.display="none"
			document.getElementById("komponente").style.display="none"
		}
		if (tipi.options[3].selected==true){
			document.getElementById("komponente").style.display=""
			document.getElementById("kategorije").style.display="none"
			document.getElementById("vsebine").style.display="none"
			document.getElementById("nitipa").style.display="none"
		}
		if (tipi.options[4].selected==true){
			document.getElementById("vsebine").style.display="none"
			document.getElementById("nitipa").style.display="none"
		}
	}
</script>
<?php 
if ($_GET['meni'])
	$meni=$_GET['meni'];
else
	$napaka="Rab se meni ID, da se ve o katerem meniju govorimo!";

if ($_GET['task'])
	$task=$_GET['task'];
else
	$napaka="Rab se task, da se ve kaj se dela an!";
	
switch ($task) {
	// Začetek obrazca za dodajanje nove vsebine
	case "nova" :
?>
<form method="post" action="index.php?stran=meniji_postavke&task=dodaj&meni=<?php echo $meni ?>" >
<div id="moznosti">
	<div id="naziv_sekcije">
    	<img src="<?php echo $domena ?>admin/resources/images/ikone/dodaj_postavke.png" width="70" align="left" />
        <p class="naziv">Nova postavka</p>
       	S pomočjo spodnjega obrazca lahko dodate novo HTML podstran, istočasno pa jo lahko tudi povežete v enega izmed predhodno ustvarjenih menijev.
    </div>
    <div id="ikone_zg">
        <div class="ikona_zg">
            <a href="index.php?stran=meniji_postavke&meni=<?php echo $meni ?>" title="Prekliči"><img src="<?php echo $domena ?>admin/resources/images/odstrani.png" width="30" /></a>
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
    	<th colspan="4">Osnovni podatki postavke</th>
    </tr>
    <tr class="vrsta">
        <td>Naziv postavke:</td>
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
        <td>Tip povezave</td>
        <td>
            <select name="tip" onchange="menjava()" id="tip">
            	<option>--Izberi tip--</option>
                <option value="1">HTML vsebina</option>
                <option value="2">Kategorijo vsebin</option>
                <option value="3">Komponenta</option>
                <option value="4">Zunanja povezava</option>
            </select>
        </td>
    </tr>
    <tr><td height="10"></td></tr>
</table>
<div id="nitipa">
	<p></p>
</div>
<div id="vsebine" style="display:none">
    <table border="0" cellpadding="0" cellspacing="0"  width="99%">
        <tr class="glava_ta">
            <th colspan="5">Prosim izberite <span style="color:red">vsebino</span>, katero želite povezati v meni</th>
        </tr>
        <?php
		$vsebine = $db->select('vsebine', 'id > 0');
		$i=1;
		while ($s = mysql_fetch_assoc($vsebine)) {	?>
        <tr class="vrsta">
            <td width="5%" align="center">
                <input type="radio" name="vkz" value="<?php echo $s['id'] ?>">
            </td>
            <td width="40%">
                <?php echo $s['naziv'] ?>
            </td>
             <td width="20%" align="center">
                <?php echo $s['datum'] ?>
            </td>
            <td width="10%" align="center">
                <img src="<?php echo $domena; ?>admin/resources/images/uredi.png" width="15" border="0" />
            </td>
            <td width="10%" align="center">
                <?php echo $s['id'] ?>
            </td>
        </tr>
        <?php $i++; } ?>
    </table>
</div>
<div id="kategorije" style="display:none">
    <table border="0" cellpadding="0" cellspacing="0"  width="99%">
        <tr class="glava_ta">
            <th colspan="5">Prosim izberite <span style="color:red">kategorijo</span>, katero želite povezati v meni</th>
        </tr>
        <?php
		$kategorije = $db->select('kategorije', 'id > 0');
		$i=1;
		while ($k = mysql_fetch_assoc($kategorije)) {	?>
        <tr class="vrsta">
            <td width="5%" align="center">
                <input type="radio" name="vkz" value="<?php echo $k['id'] ?>">
            </td>
            <td width="40%">
                <?php echo $k['naziv'] ?>
            </td>
             <td width="20%" align="center">
                <?php echo $k['datum'] ?>
            </td>
            <td width="10%" align="center">
                <img src="<?php echo $domena; ?>admin/resources/images/uredi.png" width="15" border="0" />
            </td>
            <td width="10%" align="center">
                <?php echo $k['id'] ?>
            </td>
        </tr>
        <?php $i++; } ?>
    </table>
</div>
<div id="komponente" style="display:none">
    <table border="0" cellpadding="0" cellspacing="0"  width="99%">
        <tr class="glava_ta">
            <th colspan="5">Prosim izberite <span style="color:red">komponento</span>, katero želite povezati v meni</th>
        </tr>
        <?php
		$komponente = $db->select('komponente', 'id > 0');
		$i=1;
		while ($k2 = mysql_fetch_assoc($komponente)) {	?>
        <tr class="vrsta">
            <td width="5%" align="center">
                <input type="radio" name="vkz" value="<?php echo $k2['id'] ?>">
            </td>
            <td width="40%">
                <?php echo $k2['naziv'] ?>
            </td>
             <td width="20%" align="center">
                <?php echo $k2['datum'] ?>
            </td>
            <td width="10%" align="center">
                <img src="<?php echo $domena; ?>admin/resources/images/uredi.png" width="15" border="0" />
            </td>
            <td width="10%" align="center">
                <?php echo $k2['id'] ?>
            </td>
        </tr>
        <?php $i++; } ?>
    </table>
</div>
</div>
<div style="float:left; width:30%">
    <table cellpadding="0" cellspacing="0" border="0">
        <tr class="glava_ta">
        	<th colspan="2">Izberite starševsko povezavo</th>
        </tr>
        <tr class="vrsta">
            <td colspan="2">
                <select name="stars" multiple="multiple" style="width:250px" >
                    <?php 
                    $postavke = $db->select('meniji_postavke', 'meni_id = '.$meni);
                    $i=1;
                    while ($p=mysql_fetch_assoc($postavke)) {
                    ?>
                        <option value="<?php echo $p['id'] ?>"><?php echo $p['naziv'] ?></option>
                    <?php } ?>
                </select>
            </td>
        </tr>
        <tr class="vrsta">
            <td colspan="2">
                * Izberete lahko samo <b>eno</b> povezavo!
            </td>
        </tr>
        <tr><td height="10"></td></tr>
        <tr class="glava_ta">
            <th colspan="2">Meta podatki</th>
        </tr>    
        <tr class="vrsta">
            <td colspan="2">Opis</td>
        </tr>
        <tr class="vrsta">
            <td colspan="2">
                <textarea name="meta_desc" style="width:250px; height:50px;"></textarea>
            </td>
        </tr>     
        <tr class="vrsta">
            <td colspan="2">Naslov strani</td>
        </tr>
        <tr class="vrsta">
            <td colspan="2"><input type="text" name="title" style="width:250px" /></td>
        </tr>    
    </table>
</div>
<div style="clear:both"></div>
</form>
<?php 
//Konec obrazca za nov modul
break;

//Začetek obrazca za posodabljanje modula
case "posodobi" :

if($_GET['id'])
	$id=$_GET['id'];
else
	$napaka="Rab se ID mofo!";
	
$result = $db->select('meniji_postavke', 'id = '.$id.'');
while ($v=mysql_fetch_assoc($result)) {
?>
<script language="javascript">
	window.onload=menjava;
</script>
<form method="post" action="index.php?stran=meniji_postavke&task=posodobi&id=<?php echo $id ?>&meni=<?php echo $meni ?>" >
<div id="moznosti">
	<div id="naziv_sekcije">
    	<img src="<?php echo $domena ?>admin/resources/images/ikone/dodaj_postavke.png" width="70" align="left" />
        <p class="naziv">Posodobi postavko</p>
       	S pomočjo spodnjega obrazca lahko dodate novo HTML podstran, istočasno pa jo lahko tudi povežete v enega izmed predhodno ustvarjenih menijev.
    </div>
    <div id="ikone_zg">
        <div class="ikona_zg">
            <a href="index.php?stran=meniji_postavke&meni=<?php echo $meni ?>" title="Prekliči"><img src="<?php echo $domena ?>admin/resources/images/odstrani.png" width="30" /></a>
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
    	<th colspan="4">Osnovni podatki postavke</th>
    </tr>
    <tr class="vrsta">
        <td>Naziv postavke:</td>
        <td><input type="text" name="naziv" value="<?php echo $v['naziv'] ?>" /></td>
        <td>Objavljena?</td>
        <td>
            Da <input type="radio" name="objavljeno" value="1" <?php if ($v['objavjlen']=='1') echo "checked='checked'"; ?> />
            Ne <input type="radio" name="objavljeno" value="0" <?php if ($v['objavjlen']=='0') echo "checked='checked'"; ?>/>
        </td>
    </tr>
    <tr class="vrsta">
        <td>Alias:</td>
        <td><input type="text" name="alias" value="<?php echo $v['alias'] ?>" /></td>
        <td>Tip povezave</td>
        <td>
            <select name="tip" onchange="menjava()" id="tip">
            	<option>--Izberi tip--</option>
                <option value="1" <?php if ($v['tip']=='1') echo "selected='selected'"; ?>>HTML vsebina</option>
                <option value="2" <?php if ($v['tip']=='2') echo "selected='selected'"; ?>>Kategorijo vsebin</option>
                <option value="3" <?php if ($v['tip']=='3') echo "selected='selected'"; ?>>Komponenta</option>
                <option value="4" <?php if ($v['tip']=='4') echo "selected='selected'"; ?>>Zunanja povezava</option>
            </select>
        </td>
    </tr>
    <tr><td height="10"></td></tr>
</table>
<div id="nitipa">
    <p></p>
</div>
<div id="vsebine" style="display:none">
    <table border="0" cellpadding="0" cellspacing="0"  width="99%">
        <tr class="glava_ta">
            <th colspan="5">Prosim izberite <span style="color:red">vsebino</span>, katero želite povezati v meni</th>
        </tr>
        <?php
		$vsebine = $db->select('vsebine', 'id > 0');
		$i=1;
		while ($s = mysql_fetch_assoc($vsebine)) {	?>
        <tr class="vrsta">
            <td width="5%" align="center">
                <input type="radio" name="vkz" value="<?php echo $s['id'] ?>" 
				<?php 
				if (($v['vkz']==$s['id'])and($v['tip']==1)) 
					echo "checked='checked'" ?> >
            </td>
            <td width="40%">
                <?php echo $s['naziv'] ?>
            </td>
             <td width="20%" align="center">
                <?php echo $s['datum'] ?>
            </td>
            <td width="10%" align="center">
                <img src="<?php echo $domena; ?>admin/resources/images/uredi.png" width="15" border="0" />
            </td>
            <td width="10%" align="center">
                <?php echo $s['id'] ?>
            </td>
        </tr>
        <?php $i++; } ?>
    </table>
</div>
<div id="kategorije" style="display:none">
    <table border="0" cellpadding="0" cellspacing="0"  width="99%">
        <tr class="glava_ta">
            <th colspan="5">Prosim izberite <span style="color:red">kategorijo</span>, katero želite povezati v meni</th>
        </tr>
        <?php
		$kategorije = $db->select('kategorije', 'id > 0');
		$i=1;
		while ($k = mysql_fetch_assoc($kategorije)) {	?>
        <tr class="vrsta">
            <td width="5%" align="center">
                <input type="radio" name="vkz" value="<?php echo $k['id'] ?>" 
				<?php 
				if (($v['vkz']==$k['id'])and($v['tip']==2))  
					echo "checked='checked'" ?>>
            </td>
            <td width="40%">
                <?php echo $k['naziv'] ?>
            </td>
             <td width="20%" align="center">
                <?php echo $k['datum'] ?>
            </td>
            <td width="10%" align="center">
                <img src="<?php echo $domena; ?>admin/resources/images/uredi.png" width="15" border="0" />
            </td>
            <td width="10%" align="center">
                <?php echo $k['id'] ?>
            </td>
        </tr>
        <?php $i++; } ?>
    </table>
</div>
<div id="komponente" style="display:none">
    <table border="0" cellpadding="0" cellspacing="0"  width="99%">
        <tr class="glava_ta">
            <th colspan="5">Prosim izberite <span style="color:red">komponento</span>, katero želite povezati v meni</th>
        </tr>
        <?php
		$komponente = $db->select('komponente', 'id > 0');
		$i=1;
		while ($k2 = mysql_fetch_assoc($komponente)) {	?>
        <tr class="vrsta">
            <td width="5%" align="center">
                <input type="radio" name="vkz" value="<?php echo $k2['id'] ?>" 
				<?php 
				if (($v['vkz']==$k2['id'])and($v['tip']==3)) 
					echo "checked='checked'" ?>>
            </td>
            <td width="40%">
                <?php echo $k2['naziv'] ?>
            </td>
             <td width="20%" align="center">
                <?php echo $k2['datum'] ?>
            </td>
            <td width="10%" align="center">
                <img src="<?php echo $domena; ?>admin/resources/images/uredi.png" width="15" border="0" />
            </td>
            <td width="10%" align="center">
                <?php echo $k2['id'] ?>
            </td>
        </tr>
        <?php $i++; } ?>
    </table>
</div>
</div>
<div style="float:left; width:30%">
    <table cellpadding="0" cellspacing="0" border="0">
        <tr class="glava_ta">
        	<th colspan="2">Izberite starševsko povezavo</th>
        </tr>
        <tr class="vrsta">
            <td colspan="2">
                <select name="stars" multiple="multiple" style="width:250px" >
                    <?php 
                    $postavke = $db->select('meniji_postavke', 'meni_id = '.$meni);
                    $i=1;
                    while ($p=mysql_fetch_assoc($postavke)) {
                    ?>
                        <option value="<?php echo $p['id'] ?>" <?php if ($v['parent']==$p['id']) echo "selected='selected'"; ?>><?php echo $p['naziv'] ?></option>
                    <?php } ?>
                </select>
            </td>
        </tr>
        <tr class="vrsta">
            <td colspan="2">
                * Izberete lahko samo <b>eno</b> povezavo!
            </td>
        </tr>
        <tr><td height="10"></td></tr>
        <tr class="glava_ta">
            <th colspan="2">Meta podatki</th>
        </tr>    
        <tr class="vrsta">
            <td colspan="2">Opis</td>
        </tr>
        <tr class="vrsta">
            <td colspan="2">
                <textarea name="meta_desc" style="width:250px; height:50px;"><?php echo $v['meta_desc'] ?></textarea>
            </td>
        </tr>     
        <tr class="vrsta">
            <td colspan="2">Naslov strani</td>
        </tr>
        <tr class="vrsta">
            <td colspan="2"><input type="text" name="title" style="width:250px" value="<?php echo $v['title'] ?>" /></td>
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