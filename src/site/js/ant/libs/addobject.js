// JavaScript Document
$(document).ready(function() {
	showNextLevel('im_a_region_id', '4c3eb33182810');
	showNextLevel('im_area_id', '4c3eb839f144e');
});
function showNextLevel(id, value) {
	//var JSArray = new Array();
	// <?php echo BuildJSNextLevelArray($BuildResult, $dictionaries);?>
	var selectBox = document.getElementById(id);
	for ( var i = 0; i < JSArray[value].length; i++) {
		if (i != 0) {
			selectBox[i] = new Option(JSArray[value][i]['name'],
					JSArray[value][i]['id']);
		}
	}
	return;
}
function showLimitLenghtInput(id, lenght) {
	var InputVal = $("#" + id).val();
	var span = lenght - InputVal.length + 1;
	$("#span_" + id).text(span);
}