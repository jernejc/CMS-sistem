<?php if ($prikazi==1) { ?>
	<h2><?php echo $naziv ?></h2>
<?php } ?>
<?php 
$zahtevek=$_SERVER['QUERY_STRING'];
if(empty($_SESSION['logged_in'])) { 
?>
<div class="prijava">
	<form method="post" action="index.php?jedro=prijava&naloga=prijava&pid=<?php echo $pid ?>" name="prijava" >
		<span class="oznaka">Uporabniško ime:</span><br />
		<input type="text" name="uporabnisko_ime" maxlength="35" class="textfield"/><br />
		<span class="oznaka">Geslo:</span><br />
		<input type="password" name="geslo" maxlength="35" class="textfield" />
		<br /><div style="height:5px"></div>
		<input type="hidden" value="<?php echo $zahtevek ?>" name="zahtevek" /> 
		<input type="submit" value="Prijava!" name="form-submit" class="gumb" style="float:left"/>
	</form>
</div>
<?php } // Konča se if za prijavni obrazec 
else {
$user = unserialize($_SESSION['user']);
?>
Pozdravljeni <?php echo $user->naziv; ?>!
<form method="post" action="index.php?jedro=prijava&naloga=odjava&pid=<?php echo $pid ?>">
	<input type="hidden" value="<?php echo $zahtevek ?>" name="zahtevek" /> 
	<input type="submit" value="Odjava" class="gumb" />
</form>
<?php } ?>