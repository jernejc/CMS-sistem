<?php if ($prikazi==1) { ?>
	<h2><?php echo $naziv ?></h2>
<?php } 
$db = new DB();
$hmodul = $db->select('moduli', 'id = '.$id_m);
while ($h = mysql_fetch_assoc($hmodul)) { ?>
	<?php echo $h['vsebina'] ?>
<?php } ?>
