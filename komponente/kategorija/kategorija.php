<?php
$db = new DB();
$user = unserialize($_SESSION['user']);

$kategorija = $db->select('kategorije', 'id = '.$id);
while ($k = mysql_fetch_array($kategorija))
	$parametri=parametri($k['parametri']);

$vsebine = $db->select('vsebine', 'kategorija = '.$id);
while ($v = mysql_fetch_array($vsebine)) { ?>
<div class="post">
	<?php 
	if($parametri["pnaslov"]==1) { ?>
        <h2 style="display:inline">
        	<a href="index.php?jedro=vsebina&id=<?php echo $v['id']; ?>&pid=<?php echo $pid; ?>">
				<?php echo $v['naziv']; ?>
            </a>
        </h2>
    <?php } ?>
    <?php if ($user->vrsta > 0) { ?>
        <a href="index.php?jedro=vsebina&naloga=uredi&id=<?php echo $v['id']; ?>&pid=<?php echo $pid ?>">
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
	<div class="entry"><p><?php echo substr(strip_tags($v['vsebina']),0,210)."..."; ?></p></div>
</div>
<div class="delilec">&nbsp;</div>
<?php } ?>