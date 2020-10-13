<?php

function generatePassword ($length, $option)
  {

    // start with a blank password
    $password = "";

    // define possible characters - any character in this string can be
    // picked for use in the password, so if you want to put vowels back in
    // or add special characters such as exclamation marks, this is where
    // you should do it

    if ($option == 'VM'){

    $possible = "012346789";

    }elseif ($option == 'EXT'){

    $possible = "012346789bcdfghjkmnpqrtvwxyzBCDFGHJKLMNPQRTVWXYZ";

    }
    // we refer to the length of $possible a few times, so let's grab it now
    $maxlength = strlen($possible);

    // check for length overflow and truncate if necessary
    if ($length > $maxlength) {
      $length = $maxlength;
    }

    // set up a counter for how many characters are in the password so far
    $i = 0;

    // add random characters to $password until $length is reached
    while ($i < $length) {

      // pick a random character from the possible ones
      $char = substr($possible, mt_rand(0, $maxlength-1), 1);

      // have we already used this character in $password?
      if (!strstr($password, $char)) {
        // no, so it's OK to add it onto the end of whatever we've already got...
        $password .= $char;
        // ... and increase the counter by one
        $i++;
      }

    }

    // done!
    return $password;

  }

function errorScreen ($message)

	{
	global $page;
	require('inc/config.inc.php');
	include ('inc/head.inc.php');
	include ('inc/menu.inc.php');
	
	
		echo (
			'<div id="errorContainer">
				<div class="errorMessage">
					<h2 id="errorHead">Something is wrong :(</h2><br />
					<span id="mainMessage">'.$message.'</span><br /><br /><br />
					<span>Please try again!</span>
				</div>
			</div>'
			 );

	include ('inc/footer.inc.php');
	
	exit;
	
	}

function errorLog ($errorid, $errormsg, $user_agent, $user_ip, $user_ip_proxy) 

	{
		include ('inc/db.inc.php');
		
		global $verbosity;
		
		if ($verbosity >= 1) {
		
			$con=mysqli_connect($dbhost,$dbuser,$dbpass,$db);

			$errorid = mysqli_real_escape_string($con, $errorid);
			$errormsg = mysqli_real_escape_string($con, $errormsg);
			$user_agent = mysqli_real_escape_string($con, $user_agent);
			$user_ip = mysqli_real_escape_string($con, $user_ip);
			$user_ip_proxy = mysqli_real_escape_string($con, $user_ip_proxy);
			
			$stmt = $con->prepare('INSERT INTO errors (errorid, errormsg, user_agent, ip, user_ip_proxy) VALUES (?, ?, ?, ?, ?)');
			$stmt->bind_param('sssss', $errorid, $errormsg, $user_agent, $user_ip, $user_ip_proxy);
			$stmt->execute();
			
			//mysqli_query($con,"INSERT INTO errors (errorid, errormsg, user_agent, ip, user_ip_proxy) VALUES ('".$errorid."', '".$errormsg."', '".$user_agent."', '".$user_ip."', '".$user_ip_proxy."')");

			//$insertid = mysqli_insert_id($con);	
			
			mysqli_close($con);
		}
	}


	
function logData ($first_ext, $last_ext, $type, $secpasswd, $callwaiting, $vm, $secvm, $cgroup, $pgroup, $rincoming, $routgoing, $user_agent, $user_ip, $user_ip_proxy, $page, $table)

	{
		include ('inc/db.inc.php');
		
		$con=mysqli_connect($dbhost,$dbuser,$dbpass,$db);
		
		$first_ext = mysqli_real_escape_string($con, $first_ext);
		$last_ext = mysqli_real_escape_string($con, $last_ext);
		$type = mysqli_real_escape_string($con, $type);
		$secpasswd = mysqli_real_escape_string($con, $secpasswd);
		$callwaiting = mysqli_real_escape_string($con, $callwaiting);
		$vm = mysqli_real_escape_string($con, $vm);
		$secvm = mysqli_real_escape_string($con, $secvm);
		$cgroup = mysqli_real_escape_string($con, $cgroup);
		$pgroup = mysqli_real_escape_string($con, $pgroup);
		$rincoming = mysqli_real_escape_string($con, $rincoming);
		$routgoing = mysqli_real_escape_string($con, $routgoing);
		$user_agent = mysqli_real_escape_string($con, $user_agent);
		$user_ip = mysqli_real_escape_string($con, $user_ip);
		$user_ip_proxy = mysqli_real_escape_string($con, $user_ip_proxy);
		$page = mysqli_real_escape_string($con, $page);
		$table = mysqli_real_escape_string($con, $table);
		
		$stmt = $con->prepare('INSERT INTO '.$table.' (first_ext, last_ext, type, secpasswd, callwaiting, vm, secvm, cgroup, pgroup, rincoming, routgoing, user_agent, user_ip, user_ip_proxy, page) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
		$stmt->bind_param('sssssssssssssss', $first_ext, $last_ext, $type, $secpasswd, $callwaiting, $vm, $secvm, $cgroup, $pgroup, $rincoming, $routgoing, $user_agent, $user_ip, $user_ip_proxy, $page);
		$stmt->execute();
		
		//mysqli_query($con,"INSERT INTO ".$table." (first_ext, last_ext, type, secpasswd, callwaiting, vm, secvm, cgroup, pgroup, rincoming, routgoing, user_agent, user_ip, user_ip_proxy, page) VALUES ('".$first_ext."', '".$last_ext."', '".$type."', '".$secpasswd."', '".$callwaiting."', '".$vm."', '".$secvm."', '".$cgroup."', '".$pgroup."', '".$rincoming."', '".$routgoing."', '".$user_agent."', '".$user_ip."', '".$user_ip_proxy."', '".$page."')");
		
		$insertid = mysqli_insert_id($con);	
		
		mysqli_close($con);
	
		return array($insertid);

	}

function logExtra ($range_id, $extension, $type, $secret, $tableExtra)

	{
		include ('inc/db.inc.php');
		
		$con=mysqli_connect($dbhost,$dbuser,$dbpass,$db);
		
		$range_id = mysqli_real_escape_string($con, $range_id);
		$extension = mysqli_real_escape_string($con, $extension);
		$type = mysqli_real_escape_string($con, $type);
		$secret = mysqli_real_escape_string($con, $secret);
		$tableExtra = mysqli_real_escape_string($con, $tableExtra);
		
		$stmt = $con->prepare('INSERT INTO '.$tableExtra.' (range_id, extension, type, secret) VALUES (?, ?, ?, ?)');
		$stmt->bind_param('ssss', $range_id, $extension, $type, $secret);
		$stmt->execute();

		//mysqli_query($con,"INSERT INTO ".$tableExtra." (range_id, extension, type, secret) VALUES ('".$range_id."', '".$extension."', '".$type."', '".$secret."')");

		mysqli_close($con);	
	}
	
function sendEmail ($maildata) 	{
	
	global $contactEmail;
	global $secondaryEmail;
	global $page;	
	
	$from = $maildata['email'];
	$first_name = $maildata['first_name'];
	$last_name = $maildata['last_name'];
	$subject = $maildata['subject'];
	$comments = $maildata['comments'];
	
	$cbox1 = $maildata['cbox1'];
	$cbox2 = $maildata['cbox2'];
	$cbox3 = $maildata['cbox3'];
	
	if (!preg_match("/\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/", $from)) {

		$message = 'Not a valid email!';
		errorLog('eng010', $message, $user_agent, $user_ip, $user_ip_proxy);
		errorScreen($message);
		
	}
	
	if (($first_name == NULL) || ($last_name == NULL) || ($subject == NULL) || ($comments == NULL)) {

		$message = 'One of the fields is empty!';
		errorLog('eng011', $message, $user_agent, $user_ip, $user_ip_proxy);
		errorScreen($message);
		
	}
	
	$emailContent = "Firstname :".$first_name."\n"."Lastname :".$last_name."\n"."Email :".$from."\n"."Subject :".$subject."\n"."Comments:".$comments;
	$emailHeaders  = 'MIME-Version: 1.0' . "\n" . 'Content-type: text/plain; charset=UTF-8' . "\n" . 'From: '.$first_name.' '.$last_name.' <' . $from . ">\n";
	
	if (($cbox1 == 'cbox1') && ($cbox2 == NULL) && ($cbox3 == NULL)) {
	
		mail($contactEmail,$subject,$emailContent,$emailHeaders);
		mail($secondaryEmail,$subject,$emailContent,$emailHeaders);
	
	}
	
	
        require('inc/config.inc.php');
        include ('inc/head.inc.php');
        include ('inc/menu.inc.php');


                echo (
                        '<div id="errorContainer">
                                <div class="errorMessage">
                                        <h2 id="errorHead">Thank you :)</h2><br />
                                        <span id="mainMessage">Your feedback is valuable.</span><br /><br /><br />
                                        <span>If your message is related to a bug that you noticed,<br /> we will try and fix it as soon as possible!</span>
                                </div>
                        </div>'
                         );

        include ('inc/footer.inc.php');

        exit;


	}
	
function handleError($errno, $errstr, $errfile, $errline)
{
    if (!(error_reporting() & $errno)) {
        // This error code is not included in error_reporting
        return;
    }

    switch ($errno) {
    case E_USER_ERROR:
        $message = 'A fatal error occured, please reload the page. [E]!';
		errorLog('eng012', $message, $user_agent, $user_ip, $user_ip_proxy);
		errorScreen($message);
        break;

    case E_USER_WARNING:
        $message = 'A serious error occured, please reload the page. [W]!';
		errorLog('eng013', $message, $user_agent, $user_ip, $user_ip_proxy);
		errorScreen($message);
        break;

    case E_USER_NOTICE:
        $message = 'A fatal error occured, please reload the page. [N]!';
		errorLog('eng014', $message, $user_agent, $user_ip, $user_ip_proxy);
		errorScreen($message);
        break;

/*    default:
        $message = 'A fatal error occured, please reload the page. [U]!';
		errorLog('eng015', $message, $user_agent, $user_ip, $user_ip_proxy);
		errorScreen($message);
        break;*/
    }

    /* Don't execute PHP internal error handler */
    return true;
}

function filterVars ($checkArray) {

	$varsAllowed = array(	'page', 'tool', 
							'first_ext', 'last_ext', 'type', 'secpasswd', 'callwaiting', 'vm', 'secvm', 'cgroup', 'pgroup', 'rincoming', 'routgoing', 
							'email', 'first_name', 'last_name', 'subject', 'comments', 
							'cbox1', 'cbox2', 'cbox3', 'secq', 'ok', 'pd');
	
	foreach ($checkArray as $key => $value) {

		if (!in_array($key, $varsAllowed)) {

			$message = 'A fatal error occured, please reload the page. [A]!';
			errorLog('eng016', $message, $user_agent, $user_ip, $user_ip_proxy);
			errorScreen($message);
			break;
			
		}

	}
	
}	
	
?>