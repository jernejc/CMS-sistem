<?php if ($prikazi==1) { ?>
	<h2><?php echo $naziv ?></h2>
<?php } ?>
<?php
$sql = "SELECT * FROM meniji_postavke WHERE objavjlen='1' AND meni_id='{$meni_id}' ORDER by red";
$menij = mysql_query($sql);
echo "<ul>";
	while ($v = mysql_fetch_array($menij)) { ?>
		<li <?php if($v['id']==$pid) echo 'class="active"'; ?>>
			<a href="<?php echo $v['povezava'] ?>&pid=<?php echo $v['id'] ?>">
				<?php echo $v['naziv']; ?>
			</a>
		</li>
	<?php 
	} 
echo "</ul>";
?>
<div style="height:25px">&nbsp;</div>