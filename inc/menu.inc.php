<?php
if ((in_array('mod_rewrite', apache_get_modules())) && ($devMode == "disabled")) {

	$linkUrl = '';
	$linkUrlExt = 'extensions/';
	$linkFoot = '/';
	
} else {
	
	$linkUrl = 'index.php?page=';
	$linkUrlExt = 'index.php?tool=extensions&page=';
	$linkFoot = '';
	
}
echo '
<div id="menu" class="pure-menu pure-menu-open pure-menu-horizontal">
    <ul id="std-menu-items">
        <li><a href="'.$linkUrl.'home'.$linkFoot.'">Home</a></li>
        <li><a href="#">Extensions</a>
			<ul>
				<li><a href="'.$linkUrlExt.'elastix'.$linkFoot.'">For Elastix</a></li>
				<li><a href="'.$linkUrlExt.'freepbx'.$linkFoot.'">For Freepbx</a></li>
				<li><a href="'.$linkUrlExt.'asterisk'.$linkFoot.'">For Asterisk</a></li>
			</ul>
		</li>
        <li><a href="'.$linkUrl.'about'.$linkFoot.'">About</a></li>
    </ul>
</div>
';
?>