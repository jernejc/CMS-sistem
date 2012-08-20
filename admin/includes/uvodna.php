<script src="resources/js/menu.js" type="text/javascript"></script>
<link type="text/css" rel="stylesheet" href="resources/css/meni.css" />
<div id="uvodna">
    <div id="ikone">
        <div class="ikona">
        	<a href="index.php?stran=meniji" title="Urejanje menijev">
                <img src="<?php echo $domena ?>admin/resources/images/ikone/meniji.png" width="100" border="0" />
                <p align="center">Meniji</p>
            </a>
        </div>
        <div class="ikona">
            <a href="index.php?stran=strani" title="Urejanje HTML vsebin">
                <img src="<?php echo $domena ?>admin/resources/images/ikone/strani.png" width="100" border="0" />
                <p align="center">Strani</p>
            </a>
        </div>
        <div class="ikona">
            <a href="index.php?stran=uporabniki" title="Urejanje uporabnikov">
                <img src="<?php echo $domena ?>admin/resources/images/ikone/uporabniki.png" width="100" border="0" />
                <p align="center">Uporabniki</p>
            </a>
        </div>
        <div class="ikona">
            <a href="index.php?stran=moduli" title="Urejanje modulov">
                <img src="<?php echo $domena ?>admin/resources/images/ikone/moduli.png" width="100" border="0" />
                <p align="center">Moduli</p>
            </a>
        </div>
        <div class="ikona">
        	<a href="index.php?stran=komponente" title="Urejanje komponent">
                <img src="<?php echo $domena ?>admin/resources/images/ikone/komponente.png" width="100" border="0" />
                <p align="center">Komponente</p>
            </a>
        </div>
        <div class="ikona">
            <img src="<?php echo $domena ?>admin/resources/images/ikone/konfiguracija.png" width="100" border="0" />
            <p align="center">Konfiguracija</p>
        </div>

    </div>
    <div id="najnovejse">
        <ul id="menu">
            <li>
                <a href="#">Najnovejše HTML vsebine</a>
                <ul>
                    <?php
                    $sql = "SELECT * FROM vsebine ORDER BY datum DESC LIMIT 0,5";
                    $vsebine = mysql_query($sql);
                    $i=1;
                    while ($v = mysql_fetch_assoc($vsebine)) {	?>
                       <li class="clearfix">
                           <a href="index.php?stran=vsebine_upr&mapa=upravljanje&task=posodobi&id=<?php echo $v['id'] ?>">
                                :: <?php echo $v['naziv'] ?>
                                <span class="datum"><?php echo date("d M G:i",strtotime($v['datum'])); ?></span>
                           </a>                   
                       </li>
                    <?php $i++; } ?>
                </ul>
            </li>
            <li>
                <a href="#">Najnovejše postavke v menijih</a>
                <ul>
                    <?php
                    $sql = "SELECT * FROM meniji_postavke ORDER BY datum DESC LIMIT 0,5";
                    $postavke = mysql_query($sql);
                    $i=1;
                    while ($p = mysql_fetch_assoc($postavke)) {	?>
                       <li class="clearfix">
                           <a href="index.php?stran=meniji_postavke_upr&mapa=upravljanje&task=posodobi&id=<?php echo $p['id'] ?>&meni=<?php echo $p['meni_id'] ?>">
                                :: <?php echo $p['naziv'] ?>
                                <span class="datum"><?php echo date("d M G:i",strtotime($p['datum'])); ?></span>
                           </a>                   
                       </li>
                    <?php $i++; } ?>
                </ul>
            </li>
            <li>
                <a href="#">Najnovejši moduli</a>
                <ul>
                    <?php
                    $sql = "SELECT * FROM moduli ORDER BY datum DESC LIMIT 0,5";
                    $moduli = mysql_query($sql);
                    $i=1;
                    while ($m = mysql_fetch_assoc($moduli)) {	?>
                       <li class="clearfix">
                           <a href="index.php?stran=moduli_upr&mapa=upravljanje&task=posodobi&id=<?php echo $m['id'] ?>">
                                :: <?php echo $m['naziv'] ?>
                                <span class="datum"><?php echo date("d M G:i",strtotime($m['datum'])); ?></span>
                           </a>                   
                       </li>
                    <?php $i++; } ?>
                </ul>
            </li>      
            <li>
                <a href="#">Najnovejši uporabniki</a>
                <ul>
                    <?php
                    $sql = "SELECT * FROM uporabniki ORDER BY datum DESC LIMIT 0,5";
                    $uporabniki = mysql_query($sql);
                    $i=1;
                    while ($u = mysql_fetch_assoc($uporabniki)) {	?>
                       <li class="clearfix">
                           <a href="index.php?stran=uporabniki_upr&mapa=upravljanje&task=posodobi&id=<?php echo $u['id'] ?>">
                                :: <?php echo $u['naziv'] ?>
                                <span class="datum"><?php echo date("d M G:i",strtotime($u['datum'])); ?></span>
                           </a>                   
                       </li>
                    <?php $i++; } ?>
                </ul>
            </li>
		</ul>
    </div>
    <div style="clear:both"></div>
</div>