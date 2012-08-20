<?php if ($prikazi==1) { ?>
    <h2><?php echo $naziv ?></h2>
<?php } ?>
<div class="enovice">
    Prijavite se na e-novice preko katerih vas bomo redno obveščali o novostih<br />
    <form method="post" action="index.php?jedro=prijava&naloga=prijava&pid=<?php echo $pid ?>" >
        <span class="oznaka">Ime in priimek:</span><br />
        <input type="text" name="ime" maxlength="35" class="textfield"/>
        <br />
        <span class="oznaka">E-mail:</span><br />
        <input type="text" name="email" maxlength="35" class="textfield" />
        <br /><div style="height:5px"></div>
        <input type="submit" value="Pošlji!" name="form-submit" style="float:left" class="gumb"/>
    </form>
    <p>&nbsp;</p>
</div>
