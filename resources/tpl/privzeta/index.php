<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php $prikaz->glava($pid); ?>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    
    <link href="resources/tpl/privzeta/css/css.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="resources/css/frontend.css" rel="stylesheet" type="text/css" />

    <!-- RokBox -->
    <script type="text/javascript" src="resources/js/rokbox/mootools-release-1.11.js"></script>
    <script type="text/javascript" src="resources/js/rokbox/rokbox.js"></script>
    <link href="resources/js/rokbox/themes/light/rokbox-style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="resources/js/rokbox/themes/light/rokbox-config.js"></script>

</head>
<body>
<div id="wrapper">
	<div id="header">
		<div id="logo">
			<h1><a href="http://www.cms-sistem.com">CMS Sistem</a></h1>
			<p>webdesign made simple</p>
		</div>
	</div>
	<div id="menu">
		<?php $prikaz->modul("zgoraj", $pid); ?>
	</div>
	<div id="page">
		<div id="content">
        	<?php $prikaz->modul("banner", $pid); ?>
			<?php $prikaz->jedro($jedro, $id, $pid); ?>
		<div style="clear: both;">&nbsp;</div>
		</div>
        <?php // if($_GET['naloga']!="uredi") { ?>
		<div id="sidebar">
			<ul>
				<?php $prikaz->modul("desno", $pid); ?>
			</ul>
		</div>
        <?php //} ?>
		<div style="clear: both;">&nbsp;</div>
	</div>
</div>
<div id="footer-content">
	<div class="column1">
		<h2>Pogoji uporabe, dolžnosti in pravice</h2>
		<p>
            <a rel="license" href="http://creativecommons.org/licenses/by-sa/2.5/si/">
                <img alt="Creative Commons License" style="border-width:0; margin:5px;" src="http://i.creativecommons.org/l/by-sa/2.5/si/88x31.png" align="left" />
            </a>
            Za namen te diplome sem lasten CMS sistem izdal pod Creative Commons licenco in je na voljo kot brezplačen prenos na spletni stran: <a href="http://www.cms-sistem.com">www.cms-sistem.com</a>. 
        </p>
        <p>
            <span xmlns:dc="http://purl.org/dc/elements/1.1/" href="http://purl.org/dc/dcmitype/InteractiveResource" property="dc:title" rel="dc:type">CMS Sistem</span> is licensed under a 
            <a rel="license" href="http://creativecommons.org/licenses/by-sa/2.5/si/">
                Creative Commons Attribution-Share Alike 2.5 Slovenia License
            </a>.
        </p>
	</div>
	<div class="column2">
        <img src="prenosi/slike/facebook.png" border="0" style="margin:3px 7px" />
        <img src="prenosi/slike/twitter.png" border="0" style="margin:3px 7px" />
        <img src="prenosi/slike/linkedin.png" border="0" style="margin:3px 7px" />
        <img src="prenosi/slike/buzz.png" border="0" style="margin:3px 7px" />
        <img src="prenosi/slike/blogger.png" border="0" style="margin:3px 7px" />
        <img src="prenosi/slike/orkut.png" border="0" style="margin:3px 7px" />
	</div>
</div>
<div id="footer">
	<p> &copy; 2010 CMS Sistem - Ustvaril <a href="http://www.cms-sistem.com">cms-sistem.com</a>.</p>
</div>
</body>
</html>
