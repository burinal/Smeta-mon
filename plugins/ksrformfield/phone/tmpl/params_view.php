<?php 
defined('_JEXEC') or die('Restricted access'); 
?>
<div class="form-step-field" data-id="<?php echo $view->field_params['id']; ?>">
	<a class="drag" href="#"></a>
	<label class="form-step-field-name"><?php echo $view->field_params['title']; ?></label>
	<div class="form-step-field-published">	
		<label class="cb-enable <?php echo $view->field_params['published'] ? 'selected' : ''; ?>" data-value="1"><span><?php echo JText::_('ksr_enable'); ?></span></label>
		<label class="cb-disable <?php echo !$view->field_params['published'] ? 'selected' : ''; ?>" data-value="0"><span><?php echo JText::_('ksr_disable'); ?></span></label>
		<input type="hidden" name="<?php echo $view->field_params['step_name']; ?>[fields][<?php echo $view->field_params['id']; ?>][published]" value="<?php echo $view->field_params['published']; ?>">
	</div>
	<div class="form-step-field-required">				
		<input type="checkbox" name="<?php echo $view->field_params['step_name']; ?>[fields][<?php echo $view->field_params['id']; ?>][required]" value="1" <?php echo $view->field_params['required'] ? 'checked' : ''; ?> />				
		<span><?php echo JText::_('ksr_forms_form_field_params_required_lbl'); ?></span>			
	</div>		
	<a href="#" class="ch"></a>
	<a href="#" class="del">&times;</a>
	<input type="hidden" name="<?php echo $view->field_params['step_name']; ?>[fields][<?php echo $view->field_params['id']; ?>][id]" value="<?php echo $view->field_params['id']; ?>">
	<input type="hidden" name="<?php echo $view->field_params['step_name']; ?>[fields][<?php echo $view->field_params['id']; ?>][step_id]" value="<?php echo $view->field_params['step_id']; ?>">
	<input type="hidden" name="<?php echo $view->field_params['step_name']; ?>[fields][<?php echo $view->field_params['id']; ?>][type]" value="<?php echo $view->field_params['type']; ?>">
	<input type="hidden" name="<?php echo $view->field_params['step_name']; ?>[fields][<?php echo $view->field_params['id']; ?>][title]" value="<?php echo $view->field_params['title']; ?>">
	<input type="hidden" name="<?php echo $view->field_params['step_name']; ?>[fields][<?php echo $view->field_params['id']; ?>][params]" value='<?php echo $view->field_params['params']; ?>'>
	<input type="hidden" name="<?php echo $view->field_params['step_name']; ?>[fields][<?php echo $view->field_params['id']; ?>][class]" value="<?php echo $view->field_params['class']; ?>">
	<input type="hidden" name="<?php echo $view->field_params['step_name']; ?>[fields][<?php echo $view->field_params['id']; ?>][requests_list]" value="<?php echo $view->field_params['requests_list']; ?>">
	<input type="hidden" name="<?php echo $view->field_params['step_name']; ?>[fields][<?php echo $view->field_params['id']; ?>][ordering]" class="form-step-field-ordering" value="<?php echo $view->field_params['ordering']; ?>">
</div>
