<link rel="stylesheet" type="text/css" href="../../resources/css/css3.css" />
<?php 
if ($_GET['task'])
	$task=$_GET['task'];
else
	$napaka="Rab se task, da se ve kaj se dela an!";
	
switch ($task) {
	// Začetek obrazca za dodajanje novega menija
	case "nova" :
?>
<form method="post" action="index.php?stran=meniji&task=dodaj">
<div id="moznosti">
	<div id="naziv_sekcije">
   	  <img src="<?php echo $domena ?>admin/resources/images/ikone/dodaj_meni.png" width="70" align="left" />
        <p class="naziv">Nov menij</p>
       	S pomočjo spodnjega obrazca lahko dodate novo HTML podstran, istočasno pa jo lahko tudi povežete v enega izmed predhodno ustvarjenih menijev.
    </div>
    <div id="ikone_zg">
        <div class="ikona_zg">
          <a href="index.php?stran=meniji" title="Prekliči"><img src="<?php echo $domena ?>admin/resources/images/odstrani.png" width="30" /></a>
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
    	<th align="left" colspan="3">Osnovni podatki za menij</th>
    </tr>
    <tr class="vrsta">
        <td width="20%">Naslov menija:</td>
        <td ><input type="text" name="naziv" /></td>
    </tr>
    <tr class="vrsta">
      <td>Tip:</td>
      <td><input type="text" name="tip" /></td>
    </tr>
</table>
</form>
<?php 
break; // Konča se obrazec za nov menij

case "posodobi" :

if($_GET['id'])
	$id=$_GET['id'];
else
	$napaka="Rab se ID mofo!";
	
$result = $db->select('meniji', 'id = '.$id.'');
while ($v=mysql_fetch_assoc($result)) {
?>
<form method="post" action="index.php?stran=meniji&task=posodobi&id=<?php echo $id; ?>">
<div id="moznosti">
	<div id="naziv_sekcije">
   	  <img src="<?php echo $domena ?>admin/resources/images/ikone/dodaj_meni.png" width="70" align="left" />
        <p class="naziv">Uredi menij</p>
       	S pomočjo spodnjega obrazca lahko dodate novo HTML podstran, istočasno pa jo lahko tudi povežete v enega izmed predhodno ustvarjenih menijev.
    </div>
    <div id="ikone_zg">
        <div class="ikona_zg">
          <a href="index.php?stran=meniji" title="Prekliči"><img src="<?php echo $domena ?>admin/resources/images/odstrani.png" width="30" /></a>
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
    	<th align="left" colspan="3">Osnovni podatki za menij</th>
    </tr>
    <tr class="vrsta">
        <td width="20%">Naslov menija:</td>
        <td ><input type="text" name="naziv" value="<?php echo $v['naziv']; ?>" /></td>
    </tr>
    <tr class="vrsta">
      <td>Tip:</td>
      <td><input type="text" name="tip" value="<?php echo $v['tip']; ?>" /></td>
    </tr>
</table>
</form>
<?php
} // Konča se while
break; // Konča se obrazec za posodobitev
} // Zapre se switch
?>
