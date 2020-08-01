jQuery(document).ready(function(){	
	jQuery('.close-sc, .wrapper-sc').click(function(){
		closeForm(0);
	});
	jQuery(window).keydown(function(event){
		if (event.keyCode == '27') {
			closeForm(0);
		}
	});
});
function closeForm(d){
		jQuery('.close-form').delay(d).fadeOut();
}
function showMessageResult(message){
	jQuery("#result-sc").html(message);
}
function openForm(){
	jQuery('.close-form').fadeIn();
	jQuery('.close-form form').trigger( 'reset' );
	jQuery("#result-sc").html("");
}
function submitEmail(){
	jQuery.ajax({
        type: "post",
		dataType: 'json',
		url: 'index.php',
        data: {
			option: 'com_ajax',
			module: 'socialcont',
			format: 'json',
			name : jQuery('#name-sc').val(), 
			email : jQuery('#email-sc').val(), 
			subject : jQuery('#subject-sc').val(), 
			text : jQuery('#text-sc').val(),
			captcha : jQuery('#captcha-sc:checked').val()
		},
		success: function(result){
			var message = result.data.message;
			switch (result.data.num){
				case 0:
					showMessageResult(message);
					closeForm(1500);
					break;
				case 1:
					showMessageResult(message);
					break;
				default:
					showMessageResult(message);
			}
		}
    });
}