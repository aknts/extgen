<?php
function formElastix () {
global $agentMobile;
echo '
<div id="main">
<form method="post" action="index.php?tool=extensions&page=elastix" class="pure-form pure-form-aligned">
	<div id="itemRows">
	<fieldset>

		
		<div class="pure-u-1 pure-control-group">
		<label>First extension</label>
		<input type="text" name="first_ext"/>
		</div>
		
		<div class="pure-u-1 pure-control-group">
		<label>Last extension</label>
		<input type="text" name="last_ext"/>
		</div>
		
		<div class="pure-u-1 pure-control-group">
		<label>Type</label>
		<select name="type">
			<option value="SIP">SIP</option>
			<option value="IAX2">IAX</option>
		</select>
		</div>
		
		<div class="pure-u-1 pure-control-group">
		<label>Password</label>
		<select name="secpasswd">
			<option value="secure">Secure</option>
			<option value="simple">Simple</option>
		</select>
		</div>
		
		<div id="showadv" class="pure-u-1 pure-control-group">
		<label></label>
		<input value="Show more" class="pure-button"/>
		</div>
		
		<div id="hideadv" class="pure-u-1 pure-control-group">
		<label></label>
		<input value="Hide" class="pure-button"/>
		</div>
		
		<div id="advanced">
		
		<div class="pure-u-1 pure-control-group">
		<label>Call waiting</label>
		<select name="callwaiting">
			<option value="ENABLED">Yes</option>
			<option value="DISABLED">No</option>
		</select>
		</div>
		
		<div class="pure-u-1 pure-control-group">
		<label>Voicemail</label>
		<select id="vm" name="vm">
			<option value="enable">Yes</option>
			<option value="disable">No</option>
		</select>
		</div>
		
		<div class="pure-u-1 pure-control-group">
		<label>Voicemail Password</label>
		<select id="vmpasswd" name="secvm">
			<option value="secure">Secure</option>
			<option value="simple">Simple</option>
		</select>
		</div>
		
		<div class="pure-u-1 pure-control-group">
		<label>Callgroup</label>
		<input type="text" name="cgroup"/>
		</div>
		
		<div class="pure-u-1 pure-control-group">
		<label>Pickupgroup</label>
		<input type="text" name="pgroup"/>
		</div>
		
		<div class="pure-u-1 pure-control-group">
		<label>Record incoming</label>
		<select name="rincoming">
			<option value="On Demand">On Demand</option>
			<option value="Always">Always</option>
			<option value="Never">Never</option>
		</select>
		</div>
		
		<div class="pure-u-1 pure-control-group">
		<label>Record outgoing</label>
		<select name="routgoing">
			<option value="On Demand">On Demand</option>
			<option value="Always">Always</option>
			<option value="Never">Never</option>
		</select>
		</div>
		</div>
		
		<div class="pure-u-1 pure-control-group">
		<label></label>
		<input onclick="addRow(this.form);" type="button" value="Add range" class="pure-button"/>
		</div>
		<br/><br/><br/>
		
		<div id="checkbox1">
		<label for="option-one" class="pure-checkbox">
        <input id="option-one" type="checkbox" value="cbox1" name="cbox1"/>
        If you agree with the form, please check the box!</label>
		</div>
		
		<div id="checkbox2">
		<label for="option-two" class="pure-checkbox">
        <input id="option-two" type="checkbox" value="cbox2" name="cbox2"/>
        For security reasons, please leave this box empty!</label>
		</div>
		
		<div id="checkbox3">
		<label for="option-three" class="pure-checkbox">
        <input id="option-three" type="checkbox" value="cbox3" name="cbox3"/>
        If you can see this, please reload!</label>
		</div>
		
		<div class="pure-u-1 pure-control-group">
		<label>Input the number of ranges that you want</label>
		<input type="text" name="secq" value=""/>
		</div>
		<br/><br/><br/>
		
		<div class="pure-u-1 pure-control-group">
		<label></label>
		<input type="submit" name="ok" value="Generate" class="pure-button"/>
		</div>
		
	</fieldset>
	<div id="rowContainer"';
	
	if ($agentMobile != NULL){
	
		echo ' class="pure-u-1 pure-control-group"';
		
	}
	
	echo '>
		<label id="titleContainer">Ranges</label>
	</div>
	</div>
</form>
</div>
';
}

function formFreepbx () {
global $agentMobile;
echo '	
<div id="main">
<form method="post" action="index.php?tool=extensions&page=freepbx" class="pure-form pure-form-aligned">
	<div id="itemRows">
	<fieldset>

		
		<div class="pure-u-1 pure-control-group">
		<label>First extension</label>
		<input type="text" name="first_ext"/>
		</div>
		
		<div class="pure-u-1 pure-control-group">
		<label>Last extension</label>
		<input type="text" name="last_ext"/>
		</div>
		
		<div class="pure-u-1 pure-control-group">
		<label>Type</label>
		<select name="type">
			<option value="SIP">SIP</option>
			<option value="IAX2">IAX</option>
		</select>
		</div>
		
		<div class="pure-u-1 pure-control-group">
		<label>Password</label>
		<select name="secpasswd">
			<option value="secure">Secure</option>
			<option value="simple">Simple</option>
		</select>
		</div>
		
		<div id="showadv" class="pure-u-1 pure-control-group">
		<label></label>
		<input value="Show more" class="pure-button"/>
		</div>
		
		<div id="hideadv" class="pure-u-1 pure-control-group">
		<label></label>
		<input value="Hide" class="pure-button"/>
		</div>
		
		<div id="advanced">
		
		<div class="pure-u-1 pure-control-group">
		<label>Call waiting</label>
		<select name="callwaiting">
			<option value="ENABLED">Yes</option>
			<option value="DISABLED">No</option>
		</select>
		</div>
		
		<div class="pure-u-1 pure-control-group">
		<label>Voicemail</label>
		<select id="vm" name="vm">
			<option value="enable">Yes</option>
			<option value="disable">No</option>
		</select>
		</div>
		
		<div class="pure-u-1 pure-control-group">
		<label>Voicemail Password</label>
		<select id="vmpasswd" name="secvm">
			<option value="secure">Secure</option>
			<option value="simple">Simple</option>
		</select>
		</div>
		
		<div class="pure-u-1 pure-control-group">
		<label>Callgroup</label>
		<input type="text" name="cgroup"/>
		</div>
		
		<div class="pure-u-1 pure-control-group">
		<label>Pickupgroup</label>
		<input type="text" name="pgroup"/>
		</div>
		
		<div class="pure-u-1 pure-control-group">
		<label>Record incoming</label>
		<select name="rincoming">
			<option value="On Demand">On Demand</option>
			<option value="Always">Always</option>
			<option value="Never">Never</option>
		</select>
		</div>
		
		<div class="pure-u-1 pure-control-group">
		<label>Record outgoing</label>
		<select name="routgoing">
			<option value="On Demand">On Demand</option>
			<option value="Always">Always</option>
			<option value="Never">Never</option>
		</select>
		</div>
		</div>
		
		<div class="pure-u-1 pure-control-group">
		<label></label>
		<input onclick="addRow(this.form);" type="button" value="Add range" class="pure-button"/>
		</div>
		<br/><br/><br/>
		
		<div id="checkbox1">
		<label for="option-one" class="pure-checkbox">
        <input id="option-one" type="checkbox" value="cbox1" name="cbox1"/>
        If you agree with the form, please check the box!</label>
		</div>
		
		<div id="checkbox2">
		<label for="option-two" class="pure-checkbox">
        <input id="option-two" type="checkbox" value="cbox2" name="cbox2"/>
        For security reasons, please leave this box empty!</label>
		</div>
		
		<div id="checkbox3">
		<label for="option-three" class="pure-checkbox">
        <input id="option-three" type="checkbox" value="cbox3" name="cbox3"/>
        If you can see this, please reload!</label>
		</div>
		
		<div class="pure-u-1 pure-control-group">
		<label>Input the number of ranges that you want</label>
		<input type="text" name="secq" value=""/>
		</div>
		<br/><br/><br/>
		
		<div class="pure-u-1 pure-control-group">
		<label></label>
		<input type="submit" name="ok" value="Generate" class="pure-button"/>
		</div>
		
	</fieldset>
	<div id="rowContainer"';
	
	if ($agentMobile != NULL){
	
		echo ' class="pure-u-1 pure-control-group"';
		
	}
	
	echo '>
		<label id="titleContainer">Ranges</label>
	</div>
	</div>
</form>
</div>
';
}

function formAsterisk () {
global $agentMobile;
echo '	
<div id="main">
<form method="post" action="index.php?tool=extensions&page=asterisk" class="pure-form pure-form-aligned">
	<div id="itemRows">
	<fieldset>

		
		<div class="pure-u-1 pure-control-group">
		<label>First extension</label>
		<input type="text" name="first_ext"/>
		</div>
		
		<div class="pure-u-1 pure-control-group">
		<label>Last extension</label>
		<input type="text" name="last_ext"/>
		</div>
		
		<div class="pure-u-1 pure-control-group">
		<label>Type</label>
		<select name="type">
			<option value="SIP">SIP</option>
			<option value="IAX2">IAX</option>
		</select>
		</div>
		
		<div class="pure-u-1 pure-control-group">
		<label>Password</label>
		<select name="secpasswd">
			<option value="secure">Secure</option>
			<option value="simple">Simple</option>
		</select>
		</div>
		
		<div id="showadv" class="pure-u-1 pure-control-group">
		<label></label>
		<input value="Show more" class="pure-button"/>
		</div>
		
		<div id="hideadv" class="pure-u-1 pure-control-group">
		<label></label>
		<input value="Hide" class="pure-button"/>
		</div>
		
		<div id="advanced">
		 
		<div class="pure-u-1 pure-control-group asterisk">
		<label>Call waiting</label>
		<select name="callwaiting">
			<option value="ENABLED">Yes</option>
			<option value="DISABLED">No</option>
		</select>
		</div>
		
		
		<div class="pure-u-1 pure-control-group">
		<label>Voicemail</label>
		<select id="vm" name="vm">
			<option value="enable">Yes</option>
			<option value="disable">No</option>
		</select>
		</div>
		
		<div class="pure-u-1 pure-control-group">
		<label>Voicemail Password</label>
		<select id="vmpasswd" name="secvm">
			<option value="secure">Secure</option>
			<option value="simple">Simple</option>
		</select>
		</div>
		
		<div class="pure-u-1 pure-control-group">
		<label>Callgroup</label>
		<input type="text" name="cgroup"/>
		</div>
		
		<div class="pure-u-1 pure-control-group">
		<label>Pickupgroup</label>
		<input type="text" name="pgroup"/>
		</div>
	
		<div class="pure-u-1 pure-control-group asterisk">
		<label>Record incoming</label>
		<select name="rincoming">
			<option value="On Demand">On Demand</option>
			<option value="Always">Always</option>
			<option value="Never">Never</option>
		</select>
		</div>

		<div class="pure-u-1 pure-control-group asterisk">
		<label>Record outgoing</label>
		<select name="routgoing">
			<option value="On Demand">On Demand</option>
			<option value="Always">Always</option>
			<option value="Never">Never</option>
		</select>
		</div>
		</div>
		
		<div class="pure-u-1 pure-control-group">
		<label></label>
		<input onclick="addRow(this.form);" type="button" value="Add range" class="pure-button"/>
		</div>
		<br/><br/><br/>
		
		<div id="checkbox1">
		<label for="option-one" class="pure-checkbox">
        <input id="option-one" type="checkbox" value="cbox1" name="cbox1"/>
        If you agree with the form, please check the box!</label>
		</div>
		
		<div id="checkbox2">
		<label for="option-two" class="pure-checkbox">
        <input id="option-two" type="checkbox" value="cbox2" name="cbox2"/>
        For security reasons, please leave this box empty!</label>
		</div>
		
		<div id="checkbox3">
		<label for="option-three" class="pure-checkbox">
        <input id="option-three" type="checkbox" value="cbox3" name="cbox3"/>
        If you can see this, please reload!</label>
		</div>
		
		<div class="pure-u-1 pure-control-group">
		<label>Input the number of ranges that you want</label>
		<input type="text" name="secq" value=""/>
		</div>
		<br/><br/><br/>
		
		<div class="pure-u-1 pure-control-group">
		<label></label>
		<input type="submit" name="ok" value="Generate" class="pure-button"/>
		</div>
		
	</fieldset>
	<div id="rowContainer"';
	
	if ($agentMobile != NULL){
	
		echo ' class="pure-u-1 pure-control-group"';
		
	}
	
	echo '>
		<label id="titleContainer">Ranges</label>
	</div>
	</div>
</form>
</div>
';
}
?>