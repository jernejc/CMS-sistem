<script type="text/javascript" src="resources/js/validacija_moduli.js"></script>
<?php 
if ($_GET['task'])
	$task=$_GET['task'];
else
	$napaka="Rab se task, da se ve kaj se dela an!";
	
switch ($task) {
	// Začetek obrazca za dodajanje nove vsebine
	case "nova" :
?>
<form method="post" action="index.php?stran=moduli&task=dodaj" name="obrazec" onsubmit="return validate_form ( );" >
<div id="moznosti">
	<div id="naziv_sekcije">
    	<img src="<?php echo $domena ?>admin/resources/images/ikone/dodaj_moduli.png" width="70" align="left" />
        <p class="naziv">Nov modul</p>
       	S pomočjo spodnjega obrazca lahko dodate novo HTML podstran, istočasno pa jo lahko tudi povežete v enega izmed predhodno ustvarjenih menijev.
    </div>
    <div id="ikone_zg">
        <div class="ikona_zg">
            <a href="index.php?stran=moduli" title="Prekliči"><img src="<?php echo $domena ?>admin/resources/images/odstrani.png" width="30" /></a>
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
    	<th colspan="4">Osnovni podatki modula</th>
    </tr>
    <tr class="vrsta">
        <td>Naziv modula:</td>
        <td><input type="text" name="naziv" /></td>
        <td>Objavljena?</td>
        <td>
            Ja <input type="radio" name="objavljeno" value="1" checked="checked" />
            Ne <input type="radio" name="objavljeno" value="0" />
        </td>
    </tr>
    <tr class="vrsta">
        <td>Tip modula</td>
        <td>
            <select name="tip" onchange="menjava()" id="tip">
            	<option value="0">--Izberi tip--</option>
                <option value="1">HTML vsebina</option>
                <option value="2">Menij</option>
                <option value="3">PHP aplikacija</option>
            </select>
        </td>
        <td>Prikaži naslov?:</td>
        <td>            
        	Ja <input type="radio" name="prikazi_n" value="1" checked="checked" />
            Ne <input type="radio" name="prikazi_n" value="0" />
        </td>
    </tr>
    <tr><td height="10"></td></tr>
</table>
<div id="nimodula">
	<p></p>
</div>
<div id="vsebine" style="display:none">
<table border="0" cellpadding="0" cellspacing="0" width="99%">
    <tr class="glava_ta">
      <th colspan="5">Prosim vnesite <span style="color:red">HTML vsebino</span> za vaš modul</th>
    </tr>
    <tr class="vrsta">
        <td height="370">
        <?php include "tinymce.php"; ?>
        <textarea name="vsebina" rows="70" cols="70" style="width: 70%; height:340px" >
    
        </textarea>
        </td>
    </tr>
    </table>
</div>
<div id="meniji" style="display:none">
    <table border="0" cellpadding="0" cellspacing="0"  width="99%">
        <tr class="glava_ta">
            <th colspan="5">Prosim izberite <span style="color:red">menij</span>, katerega želite povezati v meni</th>
        </tr>
        <?php
		$meniji = $db->select('meniji', 'id > 0');
		$i=1;
		while ($m = mysql_fetch_assoc($meniji)) {	?>
        <tr class="vrsta">
            <td width="5%" align="center">
                <input type="radio" name="menij" value="<?php echo $m['id'] ?>">
            </td>
            <td width="40%">
                <?php echo $m['naziv'] ?>
            </td>
             <td width="20%" align="center">
                <?php echo $m['datum'] ?>
            </td>
            <td width="10%" align="center">
                <img src="<?php echo $domena; ?>admin/resources/images/uredi.png" width="15" border="0" />
            </td>
            <td width="10%" align="center">
                <?php echo $m['id'] ?>
            </td>
        </tr>
        <?php $i++; } ?>
    </table>
</div>
<div id="aplikacije" style="display:none">
    <table border="0" cellpadding="0" cellspacing="0"  width="99%">
        <tr class="glava_ta">
            <th colspan="5">Prosim izberite <span style="color:red">aplikacijo</span>, katero želite povezati v meni</th>
        </tr>
        <?php
		$aplikacije = $db->select('moduli_apl', 'id > 0');
		$i=1;
		while ($a = mysql_fetch_assoc($aplikacije)) {	?>
        <tr class="vrsta">
            <td width="5%" align="center">
                <input type="radio" name="aplikacija" value="<?php echo $a['id'] ?>">
            </td>
            <td width="40%">
                <?php echo $a['naziv'] ?>
            </td>
             <td width="20%" align="center">
                <?php echo $a['datum'] ?>
            </td>
            <td width="10%" align="center">
                <img src="<?php echo $domena; ?>admin/resources/images/uredi.png" width="15" border="0" />
            </td>
            <td width="10%" align="center">
                <?php echo $a['id'] ?>
            </td>
        </tr>
        <?php $i++; } ?>
    </table>
</div>
</div>
<div style="float:left; width:30%">
<table cellpadding="0" cellspacing="0" width="99%" border="0">
    <tr class="glava_ta">
        <th colspan="2">Podstrani</th>
    </tr>
    <tr class="vrsta">
        <td colspan="2">
            <select name="postavka[]" multiple="multiple" style="width:250px; height:100px;" id="postavke">
                <?php
                $postavke = $db->select('meniji_postavke', 'id >0 ');
                while ($p=mysql_fetch_assoc($postavke)) { ?>
                    <option value="<?php echo $p['id'] ?>">
						<?php echo $p['naziv'] ?>
                    </option>
                <?php } ?>
            </select>
       </td>
    </tr>
    <tr class="vrsta">
        <td colspan="2">
            * Izberete lahko <b>več kot eno</b> podstran za prikazovanje, s pomočjo tipke "Control".
        </td>
    </tr>
    <tr class="vrsta">
        <td colspan="2">
            <input type="button" value="Izberi vse" onclick="izberiVse('postavke');" id="izberi" />
            <input type="button" value="Odstrani vse" onclick="odstraniVse('postavke');" id="odstrani" />
        </td>
    </tr>
    <tr class="vrsta">
        <td colspan="2">
            <input type="checkbox" name="vsi" onclick="senci();" /> Prikaži modul na vseh podstraneh
        </td>
    </tr>
	<tr><td height="20">&nbsp;</td>
    <tr class="glava_ta">
        <th colspan="2">Izbero pozicijo</th>
    </tr>
    <tr class="vrsta">
        <td colspan="2">
            <select name="pozicija" multiple="multiple" style="width:250px; height:75px;" >
               <?php
                $result = $db->select('moduli_pozicije', 'id >0 ');
                while ($z=mysql_fetch_assoc($result)) { ?>
                    <option value="<?php echo $z['naziv'] ?>">
						<?php echo $z['naziv'] ?>
                    </option>
                <?php } ?>
            </select>
        </td>
    </tr>
   <tr class="vrsta">
        <td colspan="2">
            * Izberete lahko <b>samo eno</b> pozicijo za posamezni modul!".
        </td>
    </tr>
</table>
</form>
</div>
<div style="clear:both"></div>
<?php 
//Konec obrazca za nov modul
break;

//Začetek obrazca za posodabljanje modula
case "posodobi" :

if($_GET['id'])
	$id=$_GET['id'];
else
	$napaka="Rab se ID mofo!";
	
$result = $db->select('moduli', 'id = '.$id.'');
while ($v=mysql_fetch_assoc($result)) {

$strani=explode(",",$v['strani']); // Zgradimo array za podstrani
?>
<script language="javascript">
	window.onload=uredi;
</script>
<form method="post" action="index.php?stran=moduli&task=posodobi&id=<?php echo $id ?>" name="obrazec" onsubmit="return validate_form ( );" >
<div id="moznosti">
	<div id="naziv_sekcije">
    	<img src="<?php echo $domena ?>admin/resources/images/ikone/dodaj_moduli.png" width="70" align="left" />
        <p class="naziv">Nov modul</p>
       	S pomočjo spodnjega obrazca lahko dodate novo HTML podstran, istočasno pa jo lahko tudi povežete v enega izmed predhodno ustvarjenih menijev.
    </div>
    <div id="ikone_zg">
        <div class="ikona_zg">
            <a href="index.php?stran=moduli" title="Prekliči"><img src="<?php echo $domena ?>admin/resources/images/odstrani.png" width="30" /></a>
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
    	<th colspan="4">Osnovni podatki modula</th>
    </tr>
    <tr class="vrsta">
        <td>Naziv modula:</td>
        <td><input type="text" name="naziv" value="<?php echo $v['naziv'] ?>" /></td>
        <td>Objavljen?</td>
        <td>
            Ja <input type="radio" name="objavljeno" value="1" <?php if ($v['objavjlen']=='1') echo "checked='checked'"; ?> />
            Ne <input type="radio" name="objavljeno" value="0" <?php if ($v['objavjlen']=='0') echo "checked='checked'"; ?> />
        </td>
    </tr>
    <tr class="vrsta">
        <td>Tip modula</td>
        <td>
             <select name="tip" onchange="menjava()" id="tip">
            	<option>--Izberi tip--</option>
                <option value="1" <?php if($v['tip']==1) echo "selected='selected'"; ?>>HTML vsebina</option>
                <option value="2" <?php if($v['tip']==2) echo "selected='selected'"; ?>>Menij</option>
                <option value="3" <?php if($v['tip']==3) echo "selected='selected'"; ?>>PHP aplikacija</option>
            </select>
        </td>
        <td>Prikaži naslov?:</td>
        <td>            
        	Ja <input type="radio" name="prikazi_n" value="1" <?php if ($v['prikazi_n']=='1') echo "checked='checked'"; ?> />
            Ne <input type="radio" name="prikazi_n" value="0" <?php if ($v['prikazi_n']=='0') echo "checked='checked'"; ?> />
        </td>

    </tr>
</table>
<div id="nimodula">
	<p></p>
</div>
<div id="vsebine" style="display:none">
<table border="0" cellpadding="0" cellspacing="0" width="99%">
    <tr class="glava_ta">
      <th colspan="5">Prosim vnesite <span style="color:red">HTML vsebino</span> za vaš modul</th>
    </tr>
    <tr class="vrsta">
        <td height="370">
        <?php include "tinymce.php"; ?>
        <textarea name="vsebina" rows="70" cols="70" style="width: 70%; height:340px" >
    		<?php echo $v['vsebina'] ?>
        </textarea>
        </td>
    </tr>
    </table>
</div>
<div id="meniji" style="display:none">
    <table border="0" cellpadding="0" cellspacing="0"  width="99%">
        <tr class="glava_ta">
            <th colspan="5">Prosim izberite <span style="color:red">menij</span>, katerega želite povezati v meni</th>
        </tr>
        <?php
		$meniji = $db->select('meniji', 'id > 0');
		$i=1;
		while ($m = mysql_fetch_assoc($meniji)) {	?>
        <tr class="vrsta">
            <td width="5%" align="center">
                <input type="radio" name="menij" value="<?php echo $m['id'] ?>" <?php if ($v['menij']==$m['id']) echo "checked='checked'" ?>>
            </td>
            <td width="40%">
                <?php echo $m['naziv'] ?>
            </td>
             <td width="20%" align="center">
                <?php echo $m['datum'] ?>
            </td>
            <td width="10%" align="center">
                <img src="<?php echo $domena; ?>admin/resources/images/uredi.png" width="15" border="0" />
            </td>
            <td width="10%" align="center">
                <?php echo $m['id'] ?>
            </td>
        </tr>
        <?php $i++; } ?>
    </table>
</div>
<div id="aplikacije" style="display:none">
    <table border="0" cellpadding="0" cellspacing="0"  width="99%">
        <tr class="glava_ta">
            <th colspan="5">Prosim izberite <span style="color:red">aplikacijo</span>, katero želite povezati v meni</th>
        </tr>
        <?php
		$aplikacije = $db->select('moduli_apl', 'id > 0');
		$i=1;
		while ($a = mysql_fetch_assoc($aplikacije)) {	?>
        <tr class="vrsta">
            <td width="5%" align="center">
                <input type="radio" name="aplikacija" value="<?php echo $a['id'] ?>" 
				<?php if ($v['aplikacija']==$a['id']) echo "checked='checked'" ?>>
            </td>
            <td width="40%">
                <?php echo $a['naziv'] ?>
            </td>
             <td width="20%" align="center">
                <?php echo $a['datum'] ?>
            </td>
            <td width="10%" align="center">
                <img src="<?php echo $domena; ?>admin/resources/images/uredi.png" width="15" border="0" />
            </td>
            <td width="10%" align="center">
                <?php echo $a['id'] ?>
            </td>
        </tr>
        <?php $i++; } ?>
    </table>
</div>
</div>
<div style="float:left; width:30%">
<table cellpadding="0" cellspacing="0" width="99%" border="0">
    <tr class="glava_ta">
        <th colspan="2">Podstrani</th>
    </tr>
    <tr class="vrsta">
        <td colspan="2">
            <select name="postavka[]" multiple="multiple" style="width:250px; height:100px;" id="postavke">
                <?php
                $postavke = $db->select('meniji_postavke', 'id >0 ');
                while ($p=mysql_fetch_assoc($postavke)) { ?>
                    <option value="<?php echo $p['id'] ?>" <?php if (in_array($p['id'],$strani)) echo "selected='selected'";?>>
						<?php echo $p['naziv'] ?>
                    </option>
                <?php } ?>
            </select>
       </td>
    </tr>
    <tr class="vrsta">
        <td colspan="2">
            * Izberete lahko <b>več kot eno</b> podstran za prikazovanje, s pomočjo tipke "Control".
        </td>
    </tr>
    <tr class="vrsta">
        <td colspan="2">
            <input type="button" value="Izberi vse" onclick="izberiVse('postavke');" id="izberi" />
            <input type="button" value="Odstrani vse" onclick="odstraniVse('postavke');" id="odstrani" />
        </td>
    </tr>
    <tr class="vrsta">
        <td colspan="2">
            <input type="checkbox" name="vsi" onclick="senci();" <?php if($v['strani']=="on") echo 'checked="checked"' ?> /> Prikaži modul na vseh podstraneh
        </td>
    </tr>
	<tr><td height="20">&nbsp;</td>
    <tr class="glava_ta">
        <th colspan="2">Izbero pozicijo</th>
    </tr>
    <tr class="vrsta">
        <td colspan="2">
            <select name="pozicija" multiple="multiple" style="width:250px; height:75px;" >
               <?php
                $result = $db->select('moduli_pozicije', 'id >0 ');
                while ($z=mysql_fetch_assoc($result)) { ?>
                    <option value="<?php echo $z['naziv'] ?>" <?php if ($v['pozicija']==$z['naziv']) echo "selected='selected'"; ?>>
						<?php echo $z['naziv'] ?>
                    </option>
                <?php } ?>
            </select>
        </td>
    </tr>
   <tr class="vrsta">
        <td colspan="2">
            * Izberete lahko <b>samo eno</b> pozicijo za posamezni modul!".
        </td>
    </tr>
</table>
</div>
</form>
<div style="clear:both"></div>
<?php 
} // Konča se while za vrednosti iz baze
break;  // Konča se "posodobi" case za switch 
} // Konča se switch 
?>