jQuery(document).ready(function(){
	
    jQuery('body').on('submit', '.ksr-step-form', function(e){
        e.preventDefault();
		
        var form = jQuery(this);
		var btn = form.find('.ksr-step-btn');
		var loading_text = btn.data('loading-text');
        var formdata = new FormData(form.get(0));
		
		btn.prop('disabled', true);
		btn.text(loading_text);

        jQuery.ajax({
            url: '/index.php',
            method: 'post',
            contentType: false,
            processData: false,
            dataType: 'json',
            data: formdata,
            success: function(response){
				if (response.success)
				{
					if (response.data.type == 'step')
					{
						form.replaceWith(response.data.html);
					}
					else if (response.data.type == 'thanks')
					{
						form.closest('.ksr-form-content').html(response.data.html);
					}
				}
				else
				{
					var button_text = btn.data('button-text');
					btn.prop('disabled', false);
					btn.text(button_text);			
					alert(response.message);
				}
            }
        });
    });	
	
});