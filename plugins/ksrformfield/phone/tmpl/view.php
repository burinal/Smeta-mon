<?php 
defined('_JEXEC') or die('Restricted access'); 
?>
<input 
	type="text" name="fields[<?php echo $view->field_params->id; ?>]" id="ksr-form-field-<?php echo $view->field_params->id; ?>" 
	class="form-control <?php echo !empty($view->field_params->class) ? $view->field_params->class : ''; ?>" 
	<?php echo $view->field_params->params['placeholder'] ? 'placeholder="'.$view->field_params->title.'"' : ''; ?> 
	<?php echo $view->field_params->required ? 'required' : ''; ?> 
/>
<script>
	jQuery('#ksr-form-field-<?php echo $view->field_params->id; ?>').mask('+7 (999) 999-9999');
</script>