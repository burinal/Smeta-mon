<?php 
defined('_JEXEC') or die('Restricted access'); 
?>
<select 
	name="fields[<?php echo $view->field_params->id; ?>]" id="ksr-form-field-<?php echo $view->field_params->id; ?>"
	class="form-control <?php echo !empty($view->field_params->class) ? $view->field_params->class : ''; ?>" 
	<?php echo $view->field_params->required ? 'required' : ''; ?> >
	
	<?php foreach($view->field_params->params['items'] as $item): ?>
		<option value="<?php echo $item['title']; ?>"><?php echo $item['title']; ?></option>
	<?php endforeach; ?>
	
</select>