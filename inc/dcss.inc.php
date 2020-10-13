<?php
echo ("\n".'			body {'."\n");
// echo ('background-image:url(\'img/'.$backgroundad.'.png\');');
echo ('			background-repeat:no-repeat;
			background-color: #'.$pagecolor.';
			}
			#center {'."\n");
// echo ('background-image:url(\'img/'.$page.'.png\');');
echo ('			background-repeat:no-repeat;
			background-color: #'.$pagecolor.';
			background-position: right top;
			}'."\n");

global $agentMobile;

if ($agentMobile == NULL) {

	echo ('			#rowContainer {
			position: absolute;
			top: 6.5%;
			left: 50%;
			}'."\n");
}

echo ('			.onshow {
			width: 105px;'."\n");

if ($agentMobile != NULL) {

	echo ('margin-left: 180px;'."\n");
	
}
echo ('			}'."\n");
?>