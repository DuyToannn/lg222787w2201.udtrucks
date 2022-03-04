$(document).ready(function() {
	issetInput();
});
function issetInput(){
			$('.isSKU').keypress(function(event){
				if((event.keyCode >= 97 && event.keyCode <= 122) || 
					(event.keyCode >= 65 && event.keyCode <= 90) || 
					(event.keyCode >= 48 && event.keyCode <= 57) ||  
					event.keyCode == 45){
				}else event.preventDefault();
			});
			$('.isPhone').keypress(function(event){
				if($('.isPhone').val().length > 10) event.preventDefault();
				if(isNaN(String.fromCharCode(event.which)) || event.which == 32) event.preventDefault();
			});
			$('.isNumber').keypress(function(event){
				if(isNaN(String.fromCharCode(event.which)) || event.which == 32) event.preventDefault();
			});
			$('.isNumber').change(function(){
				var min = parseInt($(this).attr('min'));
				if ($(this).val() == "" || $(this).val() < min) $(this).val(min);
			});
			$('.isAccount').keypress(function(event){
				if((event.keyCode >= 48 && event.keyCode <= 122) || event.keyCode == 46){
					if((event.keyCode > 57 && event.keyCode < 65) || (event.keyCode > 90 && event.keyCode < 97)) event.preventDefault();
				}else event.preventDefault();
			});
			$('.isPwd').keypress(function(event){
				if(event.which == 32) event.preventDefault();
			});
			$('.isEmail').keypress(function(event){
				if(event.which == 32) event.preventDefault();
			});
			$('.isPrice').keyup(function() {
				var value = parseInt($(this).val());
				if (value > 0){
					value = parseInt($(this).val().replace(/\+/g, ' ').replace(/\,/g, ''));
					$(this).val(value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
				}
			});
			$('.isPrice').change(function() {
				var value = parseInt($(this).val());
				if (value > 0){
					value = parseInt($(this).val().replace(/\+/g, ' ').replace(/\,/g, ''));
					$(this).val(value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
				}
			});
}