var rowNum = 0;
function addRow(frm) {
	if(rowNum == 10) {
		alert('Maximum number of extensions ranges reached.');
		return false;
	}
	rowNum ++;
	
	var row = '<div id="rowNum'+rowNum+'">\
			<input class="range" type="hidden" name="first_ext[]" value="'+frm.first_ext.value+'" readonly>\
			<input class="range" type="hidden" name="last_ext[]" value="'+frm.last_ext.value+'" readonly>\
			<input class="range" type="hidden" name="type[]" value="'+frm.type.value+'" readonly>\
			<input class="range" type="hidden" name="secpasswd[]" value="'+frm.secpasswd.value+'" readonly>\
			<input class="range" type="hidden" name="callwaiting[]" value="'+frm.callwaiting.value+'" readonly>\
			<input class="range" type="hidden" name="vm[]" value="'+frm.vm.value+'" readonly>\
			<input class="range" type="hidden" name="secvm[]" value="'+frm.secvm.value+'" readonly>\
			<input class="range" type="hidden" name="cgroup[]" value="'+frm.cgroup.value+'" readonly>\
			<input class="range" type="hidden" name="pgroup[]" value="'+frm.pgroup.value+'" readonly>\
			<input class="range" type="hidden" name="rincoming[]" value="'+frm.rincoming.value+'" readonly>\
			<input class="range" type="hidden" name="routgoing[]" value="'+frm.routgoing.value+'" readonly>\
			<input class="range onshow" type="text" value="'+frm.first_ext.value+' - '+frm.last_ext.value+', '+frm.type.value+'" readonly>\
			<input type="button" value="Remove" onclick="removeRow('+rowNum+');" class="pure-button range">\
			</div>';
	jQuery('#rowContainer').append(row);
	frm.first_ext.value = '';
	frm.last_ext.value = '';
	frm.type.value = 'SIP';
	frm.secpasswd.value = 'secure';
	frm.callwaiting.value = 'ENABLED';
	frm.vm.value = 'enable';
	$("#vmpasswd").prop("disabled", false);
	frm.secvm.value = 'secure';
	frm.cgroup.value = '';
	frm.pgroup.value = '';
	frm.rincoming.value = 'On\ Demand';
	frm.routgoing.value = 'On\ Demand';
}

function removeRow(rnum) {
	jQuery('#rowNum'+rnum).remove();
	rowNum --;
}