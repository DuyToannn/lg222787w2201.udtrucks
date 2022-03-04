function FileSelected(file){
	var fieldId = RoxyUtils.GetUrlParam('ipID');
	$(window.parent.document).find('#' + fieldId).val(file.fullPath);
	window.parent.closeFM();
}
function GetSelectedValue(){
  return "";
}