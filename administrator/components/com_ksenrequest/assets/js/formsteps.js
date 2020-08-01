jQuery(document).ready(function(){
	
	var new_step_id = -2;
	var new_field_id = -4;
	
	jQuery('body').on('click', '.form-steps .popup-window .close', function(e){
		e.preventDefault();
		
		jQuery(this).closest('.popup-window').fadeOut();
	});	
	
	jQuery('.form-steps').each(function(){
		formStepsSorting(jQuery(this));
		
		jQuery(this).find('.form-step').each(function(){
			formStepsFieldsSorting(jQuery(this));
		});
	});
	
	jQuery('body').on('click', '.form-step .headname .sh', function(e){
		e.preventDefault();
		
		jQuery(this).closest('.form-step').toggleClass('active');
	});
	
	jQuery('body').on('click', '.form-step .add-step', function(e){
		e.preventDefault();
		
		var steps_el = jQuery(this).closest('.form-steps');
		var step_el = jQuery(this).closest('.form-step');
		var new_step_el = jQuery('.form-step-mask')[0].outerHTML;
		
		new_step_el = new_step_el.replace(new RegExp('form-step-mask', 'g'), 'form-step');
		new_step_el = new_step_el.replace(new RegExp('fake-input', 'g'), 'input');
		new_step_el = new_step_el.replace(new RegExp('fake-select', 'g'), 'select');
		new_step_el = new_step_el.replace(new RegExp('{id}', 'g'), new_step_id);
		
		step_el.after(new_step_el);
		steps_el.addClass('can-delete');
		formStepsReordering(steps_el);
		new_step_id--;
	});
	
	jQuery('body').on('click', '.form-step .headname .del', function(e){
		e.preventDefault();
		
		if (!confirm(Joomla.JText._('KSM_DELETE_CONFIRMATION'))) 
		{
			return;
		}
		
		var steps_el = jQuery(this).closest('.form-steps');
		
		jQuery(this).closest('.form-step').remove();
		if (steps_el.find('.form-step').length == 1)
		{
			steps_el.removeClass('can-delete');	
		}
		formStepsReordering(steps_el);
	});	
	
	jQuery('body').on('click', '.form-step .headname .ch', function(e){
		e.preventDefault();

		var step_el = jQuery(this).closest('.form-step');
		var step_id = step_el.data('id');
		
		jQuery('.popup-window').hide();
		jQuery('#form-steps-field-params').remove();
		jQuery('#form-step-settings-'+step_id).fadeToggle();	
	});		
	
	jQuery('body').on('keyup', '.form-step-title', function(e){
		var title = jQuery(this).val();
		var hide_title = jQuery(this).closest('.popup-window').find('.form-step-hide-title').is(':checked');
		var step_el = jQuery(this).closest('.form-step');
		
		if (hide_title && title != '')
		{
			step_el.addClass('title-hidden');
		}
		else
		{
			step_el.removeClass('title-hidden');
		}		

		if (title == '')
		{
			title = Joomla.JText._('KSR_FORMS_FORM_STEP_EMPTY_TITLE');
		}
		
		step_el.find('.form-step-head-title').text(title);
	});
	
	jQuery('body').on('click', '.form-step-hide-title', function(e){
		var hide_title = jQuery(this).is(':checked');
		var title = jQuery(this).closest('.popup-window').find('.form-step-title').val();
		var step_el = jQuery(this).closest('.form-step');
		
		if (hide_title && title != '')
		{
			
			step_el.addClass('title-hidden');
		}
		else
		{
			step_el.removeClass('title-hidden');
		}
	});
	
	jQuery('body').on('click', '.form-step .add-step-field', function(e){
		e.preventDefault();
		
		var step_el = jQuery(this).closest('.form-step');
		var step_id = step_el.data('id');
		var step_name = step_el.data('name');
		
		jQuery('.popup-window').hide();
		jQuery('#form-steps-field-params').remove();
		jQuery('#form-steps-field-types-list').data('step-id', step_id);
		jQuery('#form-steps-field-types-list').data('step-name', step_name);
		jQuery('#form-steps-field-types-list').fadeToggle();
	});
	
	jQuery('body').on('click', '#form-steps-field-types-list li', function(e){
		e.preventDefault();
		
		var type = jQuery(this).data('type');
		var step_id = jQuery('#form-steps-field-types-list').data('step-id');
		var step_name = jQuery('#form-steps-field-types-list').data('step-name');
		var data = {
			option: 'com_ksenrequest',
			task: 'forms.get_field_params',
			field_params: {
				id: new_field_id,
				type: type,
				step_id: step_id,			
				step_name: step_name,
				params: '{}'
			}
		};
		
		jQuery.ajax({
			url: 'index.php',
			data: data,
			type: 'post',
			dataType: 'json',
			success: function(response){
				jQuery('.popup-window').hide();
				jQuery('#form-steps-field-params').remove();
				jQuery('body').append(response.html);
				jQuery('#form-steps-field-params').show();
			}
		});
		
		new_field_id--;
	});	
	
	jQuery('body').on('click', '#form-steps-field-params .close', function(e){
		e.preventDefault();
		
		jQuery('#form-steps-field-params').remove();
	});
	
	jQuery('body').on('submit', '#form-steps-field-params form', function(e){
		e.preventDefault();
		
		var field_params = jQuery(this).formData();
		var step_el = jQuery('.form-step[data-id="'+field_params.step_id+'"]');
		var data = {
			option: 'com_ksenrequest',
			task: 'forms.get_field_view',
			field_params: field_params
		};
		
		jQuery.ajax({
			url: 'index.php',
			data: data,
			type: 'post',
			dataType: 'json',
			success: function(response){
				jQuery('#form-steps-field-params').remove();
				
				if (step_el.find('.form-step-field[data-id="'+field_params.id+'"]').length)
				{
					step_el.find('.form-step-field[data-id="'+field_params.id+'"]').replaceWith(response.html);
				}
				else
				{
					step_el.find('.form-step-fields').append(response.html);
				}
				
				formStepsFieldsReordering(step_el);
				formStepsFieldsSorting(step_el);
			}
		});
	});	
	
	jQuery('body').on('click', '.form-step-field .del', function(e){
		e.preventDefault();
		
		if (!confirm(Joomla.JText._('KSM_DELETE_CONFIRMATION'))) 
		{
			return;
		}
		
		var step_el = jQuery(this).closest('.form-step');
		
		jQuery(this).closest('.form-step-field').remove();
		formStepsFieldsReordering(step_el);
	});	
	
	jQuery('body').on('click', '.form-step-field .ch', function(e){
		e.preventDefault();

		var step_id = jQuery(this).closest('.form-step').data('id');
		var field_id = jQuery(this).closest('.form-step-field').data('id');
		var form_data = jQuery(this).closest('form').formData();
		var field_params = form_data.jform.steps[step_id].fields[field_id];
		field_params['step_name'] = jQuery(this).closest('.form-step').data('name');
		var data = {
			option: 'com_ksenrequest',
			task: 'forms.get_field_params',
			field_params: field_params
		};
		
		jQuery.ajax({
			url: 'index.php',
			data: data,
			type: 'post',
			dataType: 'json',
			success: function(response){
				jQuery('.popup-window').hide();
				jQuery('#form-steps-field-params').remove();
				jQuery('body').append(response.html);
				jQuery('#form-steps-field-params').show();
			}
		});		
	});		
	
    jQuery('body').on('click', '.form-step-field .cb-enable', function(e){
		e.preventDefault();
		
        var switch_el = jQuery(this).closest('.form-step-field-published');
		var value = jQuery(this).data('value');

        switch_el.find('.cb-disable').removeClass('selected');
        jQuery(this).addClass('selected');
		switch_el.find('input[type="hidden"]').val(value);
    });

    jQuery('body').on('click', '.form-step-field .cb-disable', function(e){
		e.preventDefault();
		
        var switch_el = jQuery(this).closest('.form-step-field-published');
		var value = jQuery(this).data('value');

        switch_el.find('.cb-enable').removeClass('selected');
        jQuery(this).addClass('selected');
		switch_el.find('input[type="hidden"]').val(value);
    });	

    jQuery('body').on('click', '.form-step-button .ch, .form-step-button .ch-inline', function(e){
		e.preventDefault();
		
		var step_el = jQuery(this).closest('.form-step');
		var step_id = step_el.data('id');
		
		jQuery('.popup-window').hide();
		jQuery('#form-steps-field-params').remove();
		jQuery('#form-step-button-settings-'+step_id).fadeToggle();	
    });	
	
	jQuery('body').on('keyup', '.form-step-button-text', function(e){
		var button_text = jQuery(this).val();
		var step_el = jQuery(this).closest('.form-step');
		
		if (button_text == '')
		{
			button_text = Joomla.JText._('KSR_FORMS_FORM_STEP_BUTTON_SEND_LBL');
		}
		
		step_el.find('.form-step-button button').text(button_text);
	});	
	
	function formStepsReordering(steps_el)
	{
		var ordering = 1;
		steps_el.find('.form-step').each(function(){
			jQuery(this).find('.form-step-ordering').val(ordering);
			ordering++;
		});
	}
	
	function formStepsFieldsReordering(step_el)
	{
		var ordering = 1;
		step_el.find('.form-step-field').each(function(){
			jQuery(this).find('.form-step-field-ordering').val(ordering);
			ordering++;
		});
	}
	
	function formStepsSorting(steps_el)
	{
		steps_el.sortable({
			items: '.form-step',
			handle: '.headname .drag',
			stop: function() {
				formStepsReordering(steps_el);
			}
		});		
	}
	
	function formStepsFieldsSorting(step_el)
	{
		step_el.find('.form-step-fields').sortable({
			items: '.form-step-field',
			handle: '.drag',
			stop: function() {
				formStepsFieldsReordering(step_el);
			}
		});		
	}	
	
});