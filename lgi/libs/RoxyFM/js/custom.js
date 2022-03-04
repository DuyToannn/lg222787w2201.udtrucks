function FileSelected(file){
	var name = RoxyUtils.GetUrlParam('ipName');
	$(window.parent.document).find('input[name='+name+']').val(file.fullPath);
	window.parent.closeFM();
}
function GetSelectedValue(){
  return "";
}