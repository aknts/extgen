<?php
echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
		
switch ($page) {

	case "elastix":
		
		$pageDescription = "Create extensions for Elastix's batch extensions module";
		$pageQuote .= " - Extensions tool for Elastix";
		

	break;
	
	case "freepbx":
	
		$pageDescription = "Create extensions for Freepbx's bulk extensions module";
		$pageQuote .= " - Extensions tool for Freepbx";

	break;
	
	case "asterisk":
	
		$pageDescription = "Create extensions for Asterisk standalone installations";
		$pageQuote .= " - Extensions tool for Asterisk";

	break;
	
	case "about":
	
		$pageDescription = "Something about us and a way to contact us";
		$pageQuote .= " - Please contact us";

	break;
	
	case "home":
	
		$pageDescription = "Your toolbox for an easy and fast PBX installation";
	
	break;
	
	case NULL:
	
		$pageDescription = "Your toolbox for an easy and fast PBX installation";
	
	break;

	}
	

echo '	<meta name="description" content="'.$pageDescription.'" />
		<meta name="keywords" content="'.$metatags.'" />'."\n";
		
		if ($devMode == "disabled") {
		
			echo '<base href="http://localhost/extgen" />'."\n";
			
		}
		
echo '	<title>'.$pageTitle.''.$pageQuote.'</title>'."\n".'

		<link rel="stylesheet" type="text/css" href="css/pure-min.css" />
		<link rel="stylesheet" type="text/css" href="css/pure-min-responsive-min.css" />
		<link rel="stylesheet" type="text/css" href="css/template.css" />
		<style type="text/css">';
		switch ($page) {
		
		case "elastix":
		
			$pagecolor = $colorElastix;
		
		break;
		case "freepbx":
		
			$pagecolor = $colorFreepbx;
		
		break;
		case "asterisk":
		
			$pagecolor = $colorAsterisk;
		
		break;
		case "home":
		
			$pagecolor = $colorHome;
		
		break;
		case "index":
		
			$pagecolor = $colorIndex;
		
		break;
		case "about":
		
			$pagecolor = $colorAbout;
		
		break;
		case "":
		
			$pagecolor = $colorDefault;
			
		break;
		}
		require ('inc/dcss.inc.php');
echo '  		</style>
		<script type="text/javascript" src="js/jquery-1.11.0.js"></script>
		<script type="text/javascript" src="js/ranges.inc.js"></script>
		<script type="text/javascript" src="js/hide.js"></script>
		<script type="text/javascript" src="js/disable.js"></script>
		<script type="text/javascript" src="js/yui-min.js"></script>
		<script type="text/javascript" src="js/yui-menu-extgen.js"></script>
		';


echo'
	</head>
<body>
<noscript><div id="noscript">Something is wrong :( <br />If you can see this, Javascript is disabled! <br />Please reload!</div></noscript>
<div id="wrapper">
<div id="center">
';
?>
