$(function() {
	$("#vm").change(function() {
		if ($(this).val() == "disable") {
			$("#vmpasswd").prop("disabled", true);
		}
		if ($(this).val() == "enable") {
			$("#vmpasswd").prop("disabled", false);
		}
		
	});
});