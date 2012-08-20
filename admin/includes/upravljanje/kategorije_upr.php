<link rel="stylesheet" type="text/css" href="../../resources/css/css3.css" />
<?php 
if ($_GET['task'])
	$task=$_GET['task'];
else
	$napaka="Rab se task, da se ve kaj se dela an!";
	
switch ($task) {
	// Začetek obrazca za dodajanje nove vsebine
	case "nova" :
?>
<form method="post" action="index.php?stran=kategorije&task=dodaj">
<div id="moznosti">
	<div id="naziv_sekcije">
    	<img src="<?php echo $domena ?>admin/resources/images/ikone/kategorija_dodaj.png" width="70" align="left" />
        <p class="naziv">Nova kategorija</p>
       	S pomočjo spodnjega obrazca lahko dodate novo HTML podstran, istočasno pa jo lahko tudi povežete v enega izmed predhodno ustvarjenih menijev.
    </div>
    <div id="ikone_zg">
        <div class="ikona_zg">
            <a href="index.php?stran=kategorije" title="Prekliči"><img src="<?php echo $domena ?>admin/resources/images/odstrani.png" width="30" /></a>
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
    	<th align="left" colspan="4">Osnovni podatki kategorije</th>
    </tr>
    <tr class="vrsta">
        <td width="20%">Naslov vsebine:</td>
        <td><input type="text" name="naziv" /></td>
        <td>Prikaži <b>naslov</b> vsebin</td>
        <td>
            Da
            <input type="radio" name="pnaslov" value="1" checked='checked' />
            Ne
            <input type="radio" name="pnaslov" value="0" />
        </td>
    </tr>
    <tr class="vrsta">
      <td>Alias:</td>
      <td><input type="text" name="alias" /></td>
      <td>Prikaži <b>datum</b> vsebin</td>
      <td> 
          Da
          <input type="radio" name="pdatum" value="1" checked='checked'/>
          Ne
          <input type="radio" name="pdatum" value="0" />
      </td>
    </tr>
    <tr class="vrsta">
        <td>Objavljena?</td>
        <td>
            Da <input type="radio" name="objavljeno" value="1" checked="checked" />
            Ne <input type="radio" name="objavljeno" value="0" />
        </td>
        <td>Prikaži <b>avtorja</b> vsebin</td>
        <td> 
            Da
            <input type="radio" name="pavtor" value="1" checked='checked' />
            Ne
            <input type="radio" name="pavtor" value="0" />
        </td>
    </tr>
</table>
<table cellpadding="0" cellspacing="0" border="0" width="99%">
<tr class="vrsta">
    <td>
    <?php include "tinymce.php"; ?>
    <textarea name="opis" rows="25" cols="80" style="width: 99%" >

	</textarea>
    </td>
</tr>
</table>
</form>
<?php 
break; // Konča se obrazec za novo kategorijo

case "posodobi" :

if($_GET['id'])
	$id=$_GET['id'];
else
	$napaka="Rab se ID mofo!";
	
$result = $db->select('kategorije', 'id = '.$id.'');
while ($v=mysql_fetch_assoc($result)) {

$parametri=parametri($v['parametri']);
?>
<form method="post" action="index.php?stran=kategorije&task=posodobi&id=<?php echo $id ?>">
<div id="moznosti">
	<div id="naziv_sekcije">
    	<img src="<?php echo $domena ?>admin/resources/images/ikone/kategorija_dodaj.png" width="70" align="left" />
        <p class="naziv">Uredi kategorijo</p>
       	S pomočjo spodnjega obrazca lahko dodate novo HTML podstran, istočasno pa jo lahko tudi povežete v enega izmed predhodno ustvarjenih menijev.
    </div>
    <div id="ikone_zg">
        <div class="ikona_zg">
            <a href="index.php?stran=kategorije" title="Prekliči"><img src="<?php echo $domena ?>admin/resources/images/odstrani.png" width="30" /></a>
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
    	<th align="left" colspan="4">Osnovni podatki kategorije</th>
    </tr>
    <tr class="vrsta">
        <td>Naslov vsebine:</td>
        <td><input type="text" name="naziv" value="<?php echo $v['naziv'] ?>" /></td>
        <td>Prikaži <b>naslov</b> vsebin</td>
        <td>
            Da
            <input type="radio" name="pnaslov" value="1" <?php if($parametri['pnaslov']==1) echo "checked='checked'"; ?> />
            Ne
            <input type="radio" name="pnaslov" value="0" <?php if($parametri['pnaslov']==0) echo "checked='checked'"; ?> />
        </td>
    </tr>
    <tr class="vrsta">
      <td>Alias:</td>
      <td><input type="text" name="alias" value="<?php echo $v['alias'] ?>" /></td>
      <td>Prikaži <b>datum</b> vsebin</td>
      <td> 
          Da
          <input type="radio" name="pdatum" value="1" <?php if($parametri['pdatum']==1) echo "checked='checked'"; ?> />
          Ne
          <input type="radio" name="pdatum" value="0" <?php if($parametri['pdatum']==0) echo "checked='checked'"; ?> />
      </td>

    </tr>
    <tr class="vrsta">
        <td>Objavljena?</td>
        <td>
            Da <input type="radio" name="objavljeno" value="1" <?php if ($v['objavjlen']=='1') echo "checked='checked'"; ?> />
            Ne <input type="radio" name="objavljeno" value="0" <?php if ($v['objavjlen']=='0') echo "checked='checked'"; ?>/>
        </td>
       <td>Prikaži <b>avtorja</b> vsebin</td>
       <td> 
            Da
            <input type="radio" name="pavtor" value="1" <?php if($parametri['pavtor']==1) echo "checked='checked'"; ?> />
            Ne
            <input type="radio" name="pavtor" value="0" <?php if($parametri['pavtor']==0) echo "checked='checked'"; ?> />
        </td>
    </tr>
</table>
<table cellpadding="0" cellspacing="0" border="0" width="99%">
<tr class="vrsta">
    <td>
    <?php include "tinymce.php"; ?>
    <textarea name="opis" rows="25" cols="80" style="width: 99%" >
	<?php echo $v['opis'] ?>
	</textarea>
    </td>
</tr>
</table>
</form>
<?php
} // Konča se while
break; // Konča se obrazec za posodobitev
} // Zapre se switch
?>
