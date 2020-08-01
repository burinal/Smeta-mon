<?php 
defined('_JEXEC') or die('Restricted access'); 
?>
<textarea name="fields[<?php echo $view->field_params->id; ?>]" id="ksr-form-field-<?php echo $view->field_params->id; ?>" 
	class="form-control <?php echo !empty($view->field_params->class) ? $view->field_params->class : ''; ?>" 
	<?php echo $view->field_params->params['placeholder'] ? 'placeholder="'.$view->field_params->title.'"' : ''; ?> 
	<?php echo $view->field_params->required ? 'required' : ''; ?> 
></textarea>
