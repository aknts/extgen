<?php
echo '	
<div id="main">
<br/>
<div id="aboutTitle">The infamous contact form, use this to submit your helpful comments! Please don\'t spam us!</div>
<br/>
<form method="post" action="index.php?page=about" class="pure-form pure-form-aligned">
	<div id="itemRows">
	<fieldset>

		<div class="pure-u-1 pure-control-group">
		<label>First name</label>
		<input type="text" name="first_name"/>
		</div>
		
		<div class="pure-u-1 pure-control-group">
		<label>Last name</label>
		<input type="text" name="last_name"/>
		</div>
		
		<div class="pure-u-1 pure-control-group">
		<label>Email</label>
		<input type="text" name="email"/>
		</div>
		
		<div class="pure-u-1 pure-control-group">
		<label>Reason</label>
		<select name="subject">
			<option value="Report a problem">Report a problem</option>
			<option value="Ask for a feature">Ask for a feature</option>
			<option value="Congratulations">The congratulations option</option>
			<option value="Other">Other</option>
		</select>
		</div>
		
		<div class="pure-u-1 pure-control-group">
		<label>Comments</label>
		<textarea name="comments" rows="4" cols="50"></textarea>
		</div>

		
		<br/><br/><br/>
		
		<div id="checkbox1">
		<label for="option-one" class="pure-checkbox">
        <input id="option-one" type="checkbox" value="cbox1" name="cbox1"/>
        If you are ready to send the form, please check the box!</label>
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
		
		<br/><br/><br/>
		
		<div class="pure-u-1 pure-control-group">
		<label></label>
		<input type="submit" name="ok" value="Send" class="pure-button"/>
		</div>
		
	</fieldset>

	</div>
</form>
</div>
';
?>
