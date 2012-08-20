<?php
$naloga=preveri($_GET['naloga'],1,24,1);
$userTools = new UserTools();

switch ($naloga) {
	case "prijava":
		if(isset($_POST['form-submit'])) { 
			$uporabnisko_ime=preveri($_POST['uporabnisko_ime'],1,15,1);
			$geslo=preveri($_POST['geslo'],1,15,1);
			$zahtevek=$_POST['zahtevek'];
			
			if($userTools->login($uporabnisko_ime, $geslo)) { ?>
            
				<meta http-equiv='refresh' content='1;url=index.php?<?php echo $zahtevek; ?>'>
				<b>Čez 1 sekundo se bo stran samodejno osvežila.</b><p></p>
				<h1>Uspešno ste se prijavili</h1>
                
			<?php }	else { ?>
            <script>
				alert('Napačno uporabniško ime in geslo!')
			</script>
			<meta http-equiv='refresh' content='1;url=index.php?<?php echo $zahtevek; ?>'>
			<b>Čez 1 sekundo se bo stran samodejno osvežila.</b>
			<?php }
		}
		break;
		
	case "odjava" :
		$userTools->logout();
		$zahtevek=$_POST['zahtevek']; ?>
		
		<meta http-equiv='refresh' content='1;url=index.php?<?php echo $zahtevek; ?>'>
		<b>Čez 1 sekundo se bo stran samodejno osvežila.</b><p></p>
		<h1>Uspešno ste se odjavili</h1>
		
	<?php 
	break;
}
?>