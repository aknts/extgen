<?php
function extenEngine ($data, $server, $page)

{

// Get some user data
	$user_agent = $server['HTTP_USER_AGENT'];
	$user_ip = $server['REMOTE_ADDR'];
	$user_ip_proxy = $server['HTTP_X_FORWARDED_FOR'];
	

// Get some global data
	global $pageTitle;
	
// Get if the form was submitted by a mobile device	
	global $agentMobile;
	
//	Check for display names
/*if ($names != NULL){

	$names_array = explode("\n", $names);
	$count_names = count($names_array);

		if ($count_names != $swarm) {

			errorScreen("The number of the display names and the swarm are not the same, please check again!");
			
		}

}*/

// Get how many ranges we have
// First we count how many variables we have in the post array
$rows = count($data, COUNT_RECURSIVE); 
//$rows = ($rows-8)/7;
//$rows = ($rows-12)/11;
// We check if we don't have anything
if ($rows > 0) {

	// Inside the post array there are two types of variables
	// The first ones are arrays of each field that contains the data for all ranges that the user has submitted
	// The second are single variables that contain the security data and the submit of the form
	// We filter the data leaving out the single variables because these variables can be accessed like a common POST variable
	// We filter the needed data with the following line
	switch ($page) {
	
	case "elastix":
	
		$rows = ($rows-14)/11;
	
	break;
	
	case "freepbx":
	
		$rows = ($rows-14)/11;
		
	break;
	
	case "asterisk":
	
		$rows = ($rows-14)/11;
		
	break;
	
	}
	// The rows variable has a value that contains all the keys in each array and the individual variables
	// We subtrack the number of the repeating fields that he have in our form plus each individual variable
	// and we divide this number with the number of the repeating fields
	// This will give us the actual number of the submited rows of extensions and with this number we can now
	// retrive the data from the arrays with the proper order for each range.
}

// Check if the form is submited by a human
// First, we check if the $rows is an integer, if yes the form is submited by a human, if not it's just a bot.
	if (($rows != NULL) && (!preg_match('/^\d+$/',$rows))) {
	
		$message = "Please follow the instructions next of the checkboxes!";
		errorLog('eng001', $message, $user_agent, $user_ip, $user_ip_proxy);
		errorScreen($message);
		
	} 
	
// Second, we check if the range match the answer of the security question
	$secq = $data[secq];
	
	if ($secq != $rows) {
	
		$message = 'You have answered wrong at the security question!';
		errorLog('eng002', $message, $user_agent, $user_ip, $user_ip_proxy);
		errorScreen($message);
	
	}
// Third, we check if the ranges are more than 10, we don't want to execute the scipt for too long so we keep it under control.
// This check happens also in the javascript script when someone tries to pass the 10 ranges limit.
if ($rows > 10) {

	$message = 'Too many ranges!';
	errorLog('eng003', $message, $user_agent, $user_ip, $user_ip_proxy);
	errorScreen($message);
	
	}


//	Enter the if state to start making the file if rows variables isn't null.
if ($rows != NULL ) {

	$FileName = '['.$pageTitle.']-'.$page.'-' . date("dmyHi");
	
	if ($page == 'asterisk') {
	
		if ($agentMobile != NULL) {
		
		$FileName .= '.TXT';
		
		} else {
		
		$FileName .= '.txt';
		
		}
	
	} else {
	
		if ($agentMobile != NULL) {
		
		$FileName .= '.CSV';
		
		} else {
		
		$FileName .= '.csv';
		
		}
		
	}
	
	$Content = "";

//	Head row of the CSV
	switch ($page) {
		
		case "elastix":
		
			$Content = '"Display Name","User Extension","Direct DID","Outbound CID","Call Waiting","Secret","Voicemail Status","Voicemail Password","VM Email Address","VM Pager Email Address","VM Options","VM Email Attachment","VM Play CID","VM Play Envelope","VM Delete Vmail","Context","Tech","Callgroup","Pickupgroup","Disallow","Allow","Deny","Permit","Record Incoming","Record Outgoing"'."\n";
		
		break;
		
		case "freepbx":
		
			$Content = 'action,extension,name,cid_masquerade,sipname,outboundcid,ringtimer,callwaiting,call_screen,pinless,password,noanswer_dest,noanswer_cid,busy_dest,busy_cid,chanunavail_dest,chanunavail_cid,emergency_cid,tech,hardware,devinfo_channel,devinfo_secret,devinfo_notransfer,devinfo_dtmfmode,devinfo_canreinvite,devinfo_context,devinfo_immediate,devinfo_signalling,devinfo_echocancel,devinfo_echocancelwhenbrdiged,devinfo_echotraining,devinfo_busydetect,devinfo_busycount,devinfo_callprogress,devinfo_host,devinfo_type,devinfo_nat,devinfo_port,devinfo_qualify,devinfo_callgroup,devinfo_pickupgroup,devinfo_disallow,devinfo_allow,devinfo_dial,devinfo_accountcode,devinfo_mailbox,devinfo_deny,devinfo_permit,devicetype,deviceid,deviceuser,description,dictenabled,dictformat,dictemail,langcode,record_in,record_out,vm,vmpwd,email,pager,attach,saycid,envelope,delete,options,vmcontext,vmx_state,vmx_unavail_enabled,vmx_busy_enabled,vmx_play_instructions,vmx_option_0_sytem_default,vmx_option_0_number,vmx_option_1_system_default,vmx_option_1_number,vmx_option_2_number,account,ddial,pre_ring,strategy,grptime,grplist,annmsg_id,ringing,grppre,dring,needsconf,remotealert_id,toolate_id,postdest,faxenabled,faxemail'."\n";
			
		break;
		
		case "asterisk":
		
			$Content = '';
			
		break;
	
	}
// The loop variable	
$i=0;
$vmpasswdarray = array();
while ($rows > $i) {
	
// Get range data
	$first_ext = $data['first_ext'][$i];
	$last_ext = $data['last_ext'][$i];
	$type = $data['type'][$i];
	$secpasswd = $data['secpasswd'][$i];
	$callwaiting = $data['callwaiting'][$i];
	$vm = $data['vm'][$i];
	$secvm = $data['secvm'][$i];
	$cgroup = $data['cgroup'][$i];
	$pgroup = $data['pgroup'][$i];
	$rincoming = $data['rincoming'][$i];
	$routgoing = $data['routgoing'][$i];

// We check the range. We want a maximum 5 digit number, extensions for a pbx are lot smaller but we keep it safe with a 5 digit maximum.
// If they want a six digit extensions, just make some accounts on a voip provider.

// Ok, we first make an array with the user inputs.
$uservars = array("$first_ext", "$last_ext", "$cgroup", "$pgroup");

// Then we cycle the array with a foreach loop.
foreach ($uservars as $key => $value) {

$length = mb_strlen($value);

// First we check if the vars are empty.
if ((($key == 0) || ($key == 1)) && (($value == NULL) || ($value == ''))) {

	$message = 'Empty values!';
	errorLog('eng004', $message, $user_agent, $user_ip, $user_ip_proxy);
	errorScreen($message);
	
	}

// Second, if they are over five digits.	
if ($length > 5 ){
	
	$message = 'Too many digits!';
	errorLog('eng005', $message, $user_agent, $user_ip, $user_ip_proxy);
	errorScreen($message);
	
	}
	
// Third, if they are intergers.
if((($value != NULL) || ($value != '')) && (!preg_match('/^\d+$/',$value))) {
	
	$message = 'The value that you inserted is not a integer!';
	errorLog('eng006', $message, $user_agent, $user_ip, $user_ip_proxy);
	errorScreen($message);
		
	} 
}
	

// Finally we check the range, if bigger than 500 extensions fail. We don't want to run our script forever.
	$range = $last_ext-$first_ext;
	
	if ($range > 100) {
	
		$message = 'Too many extensions!';
		errorLog('eng007', $message, $user_agent, $user_ip, $user_ip_proxy);
		errorScreen($message);
		
	}
	
// Ok, after checking the user based variables, we check also those that are from the drop downs menus. You never know.
// The varsforcheck is an array with the variables that we need to check.
// The allowedvalues are all the values that can have this variables.
// We use a foreach loop to cycle through each variable crosschecking from the array of the allowed values.

$varsforcheck = array("$type", "$secpasswd", "$callwaiting", "$vm", "$secvm", "$rincoming", "$routgoing");
$allowedvalues = array('SIP', 'IAX2', 'secure', 'simple', 'ENABLED','DISABLED', 'enable', 'disable', 'Always', 'On Demand', 'Never');

foreach ($varsforcheck as $value){
	
	if (!(in_array($value, $allowedvalues))) {

		$message = 'Hey, this is not a valid value!';
		errorLog('eng008', $message, $user_agent, $user_ip, $user_ip_proxy);
		errorScreen($message);

	}
}
// Log data
include('inc/config.inc.php');
		if ($verbosity >= 2) {
		
			$logInfo = logData($first_ext, $last_ext, $type, $secpasswd, $callwaiting, $vm, $secvm, $cgroup, $pgroup, $rincoming, $routgoing, $user_agent, $user_ip, $user_ip_proxy, $page, "ranges");
			
			}
		
if (($type == 'SIP') && ($page == 'asterisk')){

	$Content .= 'Please add the following lines to your sip.conf!'."\n";
	
	}elseif (($type == 'IAX2') && ($page == 'asterisk')){
	
	$Content .= 'Please add the following lines to your iax.conf!'."\n";
	
	}
		
// We check if the first extension is smaller from the last for obvious reasons and while this happens we make each time an extension.
// After our values have past all tests, we generate the password if the user chose to have a secure secret or a secure vmpassword.
// By the way here is the actual starting point of the generated file. We start making extensions and echo the rest of the variables because they have the same value.

	while ($first_ext <= $last_ext) {

// For the time being, we simple give the display name the number of the extension.
	$displayname = $first_ext;

// A simple if statement to generate or not a secret for our extension.
	if ($secpasswd == 'secure') {

	        $secret=generatePassword(30,'EXT');

	} elseif ($secpasswd == 'simple') {

        	$secret=$first_ext.''.$page;

	}

// An if statement to generate a secure voicemaill pin if the user has enabled voicemails.
	if (($vm == 'enable') && ($secvm == 'secure')) {

			$vmpasswd=generatePassword(5,'VM');

       	} elseif (($vm == 'enable') && ($secvm == 'simple')) {

           	$vmpasswd=$first_ext;

		} elseif ($vm == 'disable') {
		
			$vmpasswd='';
		
		}
		
/*	Add also display names
	if ($names == NULL) {

		$displayname = $first_ext;

	} elseif ($names != NULL) {

		$displayname = trim($names_array[$i]);

			if ($displayname == NULL){

				$displayname = $first_ext;

			}

	}*/


// Log data
	
//	$logInfo = logData($first_ext, $last_ext, $type, $secpasswd, $callwaiting, $vm, $secvm, $cgroup, $pgroup, $rincoming, $routgoing, $user_agent, $user_ip, $user_ip_proxy, "elastix");
//	logExtra($logInfo[0], $logInfo[1], $first_ext, $tech, $secret, "extensions");
	

// Fill data in the CSV
	switch ($page) {
	
	case "elastix":
	
		$Content .= '"'.$displayname.'","'.$first_ext.'","","","'.$callwaiting.'","'.$secret.'","'.$vm.'","'.$vmpasswd.'","","","","no","no","no","no","from-internal","'.$type.'","'.$cgroup.'","'.$pgroup.'","","","0.0.0.0/0.0.0.0","0.0.0.0/0.0.0.0","'.$rincoming.'","'.$routgoing.'"'."\n";
		
	break;
	
	case "freepbx": 
	
	if ($rincoming == 'On Demand') {
	
			$rincoming = 'Adhoc';
			
		}
		
	if ($routgoing == 'On Demand') {
		
			$routgoing = 'Adhoc';
			
		}
	
		switch ($type){
		
		case "SIP":
		
			$fpbxvars = array("transfer" => "", "dtmf" => "rfc2833", "canreinvite" => "no", "nat" => "yes", "port" => "5060");
			
		break;
		
		case "IAX2":
		
			$fpbxvars = array("transfer" => "iax2", "dtmf" => "", "canreinvite" => "", "nat" => "", "port" => "4569");
			
		break;
		
		}
	
		$Content .= 'add,'.$first_ext.','.$displayname.','.$first_ext.',,,0,'.strtolower($callwaiting).',0,disabled,,,,,,,,,'.strtolower($type).',,,'.$secret.','.$fpbxvars['transfer'].','.$fpbxvars['dtmf'].','.$fpbxvars['canreinvite'].',from-internal,,,,,,,,,dynamic,friend,'.$fpbxvars['nat'].','.$fpbxvars['port'].',yes,,'.$pgroup.',,,'.$type.'/'.$first_ext.',,'.$first_ext.'@device,0.0.0.0/0.0.0.0,0.0.0.0/0.0.0.0,fixed,,'.$first_ext.','.$first_ext.',disabled,ogg,,,'.$rincoming.','.$routgoing.','.$vm.','.$vmpasswd.',,,attach=no,saycid=no,envelope=no,delete=no,,default,,,,checked,checked,,,,,,,,,,,,,,,,,,,,'."\n";

	break;
	
	case "asterisk":
	
	if ($type == 'SIP') {
	
		$Content .= '['.$first_ext.']'."\n".'deny=0.0.0.0/0.0.0.0'."\n".'secret='.$secret.''."\n".'dtmfmode=rfc2833'."\n".'canreinvite=no'."\n".'context=from-internal'."\n".'host=dynamic'."\n".'type=friend'."\n".'nat=yes'."\n".'port=5060'."\n".'qualify=yes'."\n".'callgroup='.$cgroup.''."\n".'pickupgroup='.$pgroup.''."\n".'dial=SIP/'.$first_ext.''."\n".'mailbox='.$first_ext.'@device'."\n".'permit=0.0.0.0/0.0.0.0'."\n".'callerid='.$first_ext.''."\n".'callcounter=yes'."\n".'faxdetect=no'."\n";
		$Content .= "\n";
		
	} elseif ($type == 'IAX2') {
	
		$Content .= '['.$first_ext.']'."\n".'deny=0.0.0.0/0.0.0.0'."\n".'secret='.$secret.''."\n".'transfer=no'."\n".'context=from-internal'."\n".'host=dynamic'."\n".'type=friend'."\n".'port=4569'."\n".'qualify=yes'."\n".'dial=IAX2/'.$first_ext.''."\n".'mailbox='.$first_ext.'@device'."\n".'permit=0.0.0.0/0.0.0.0'."\n".'callerid='.$first_ext.''."\n".'setvar=REALCALLERIDNUM='.$first_ext.''."\n".'';
		$Content .= "\n";
	}
	
	$vmpasswdarray[$first_ext] = $vmpasswd;
	break;
	
	}
	
//Log data		

		if ($verbosity >= 3) {
			
			logExtra($logInfo[0], $first_ext, $type, $secret, "extensions");
		
		}
	
	$first_ext ++;
	
	}
	
	
	
	$i ++;
	
}

	if ($page == 'asterisk' ) {
	
		$Content .= "\n";
		$Content .= 'Please put the following in the voicemail.conf to enable the voicemail for each extension!'."\n";
		
		foreach ($vmpasswdarray as $key => $value) {
		
			if ($value != NULL) {
			
				$Content .= $key.' => '.$value.','.$key.',,,attach=no|saycid=no|envelope=no|delete=no'."\n";
				
			}
		
		}
		
		$Content .= "\n";
	}

	header("Content-Description: File Transfer");
	header("Content-Type: application/octet-stream");
	header("Content-Disposition: attachment; filename=\"" . basename($FileName) . "\"");
	header("Content-Transfer-Encoding: binary");
	header("Content-Length: " . filesize($Content));
	print $Content;
	exit;


}
}
?>