<?php
//	Extensions and dialplan generator - 05/04/2014

//	Include library
require ('inc/general.lib.inc.php');
require ('inc/engines.lib.inc.php');
require ('inc/config.inc.php');

set_error_handler("handleError");

// We check if the page variable is a valid option from the array localpages. If it is empty we give it the home value.
$page = $_GET['page'];
$pd = $_GET['pd'];

$localpages = array('elastix', 'freepbx', 'asterisk', 'about', 'home', 'index');
$genpages = array('elastix', 'freepbx', 'asterisk');

//We check if we have a mobile device
$mobileagents = array('Android', 'android', 'iPad', 'ipad', 'iPhone', 'iphone');

foreach ($mobileagents as $value) {

	if (strpos($_SERVER['HTTP_USER_AGENT'],$value) !== false) {

		$agentMobile = $value;
			
	}

}

//Special for mobile devices
if (($page != NULL) && (in_array($page, $genpages)) && ($_POST != NULL) && ($pd == NULL)) {

if ($agentMobile != NULL) {
	//A special variables to pass data to the get form
	$pd = base64_encode(serialize($_POST));
	
	include ('inc/head.inc.php');
	include ('inc/menu.inc.php');
	include ('inc/forms.lib.inc.php');

		formElastix();

	echo'<form action="index.php?page='.$page.'" method="get" name="cpd">';
	echo '<input type="hidden" name="page" value="'.htmlentities($page).'">';
	echo '<input type="hidden" name="pd" value="'.htmlentities($pd).'">';
	echo '</form>';
										
	include ('inc/footer.inc.php');
				
	echo '<script type="text/javascript">
			document.cpd.submit();
		</script>';
	exit;
	}

	extenEngine($_POST, $_SERVER, $page);
	
}

//When a form is submitted by an android device it is translate to a get request because of a major bug on Android
if ($pd != NULL) {

		
	$pd = unserialize(base64_decode($pd));
	
	if (!is_array($pd)) {
        
        $message = 'Hey, the data that you submited is not valid!';
		errorLog('eng017', $message, $user_agent, $user_ip, $user_ip_proxy);
		errorScreen($message);
		
    }
	
	extenEngine($pd, $_SERVER, $page);
	
}

if (($page == 'about') && ($_POST != NULL)) {

	sendEmail($_POST);

	}

//	HTML Form


include ('inc/head.inc.php');


// We check if the page variable is a valid option from the array localpages. If it is empty we give it the home value.

//$localpages = array('elastix', 'freepbx', 'asterisk', 'about', 'home');

if ($page == NULL ) {

	$page = 'home';
	
	}


if (($page != NULL) && !(in_array($page, $localpages))) {

	$message = 'Hey, this is not a page!';
	errorLog('eng009', $message, $user_agent, $user_ip, $user_ip_proxy);
	errorScreen($message);

	}

// Include the menu page and the forms lib. With the switch, we feed the proper function to output the form that we want.

include ('inc/menu.inc.php');
include ('inc/forms.lib.inc.php');

switch ($page) {

	case "elastix":
		
		formElastix();

	break;
	
	case "freepbx":
	
		formFreepbx();

	break;
	
	case "asterisk":
	
		formAsterisk();

	break;
	
	case "about":
	
		include ('inc/form.about.inc.php');

	break;
	
	case "home":
	
		include ('inc/home.inc.php');
	
	break;
	
	case "index":
	
		include ('inc/home.inc.php');

	break;
	}

// Concluding with the footer.

include ('inc/footer.inc.php');
?>
