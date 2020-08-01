<?php 
defined('_JEXEC') or die('Restricted access'); 
?>
<div class="field-calendar" id="ksr-form-field-<?php echo $view->field_params->id; ?>-container">
	<div class="input-group">
		<input 
			type="text" name="fields[<?php echo $view->field_params->id; ?>]" id="ksr-form-field-<?php echo $view->field_params->id; ?>"
			class="form-control <?php echo !empty($view->field_params->class) ? $view->field_params->class : ''; ?>" 
			data-alt-value=""
			<?php echo $view->field_params->params['placeholder'] ? 'placeholder="'.$view->field_params->title.'"' : ''; ?> 
			<?php echo $view->field_params->required ? 'required' : ''; ?> 
		/>
		<span class="input-group-btn">
			<button type="button" class="btn btn-secondary"
				id="ksr-form-field-<?php echo $view->field_params->id; ?>_btn"
				data-inputfield="ksr-form-field-<?php echo $view->field_params->id; ?>"
				data-button="ksr-form-field-<?php echo $view->field_params->id; ?>_btn"
				data-dayformat="<?php echo JText::_('DATE_FORMAT_CALENDAR_DATE'); ?>"
				data-firstday="<?php echo JFactory::getLanguage()->getFirstDay(); ?>"
				data-weekend="<?php echo JFactory::getLanguage()->getWeekEnd(); ?>"
				data-today-btn="1"
				data-week-numbers="1"
				data-show-time="0"
				data-show-others="1"
				data-time-24="24"
				data-only-months-nav="0"	
			>
				<?php echo JText::_('plg_ksrformfield_date_choose_lbl'); ?>
			</button>
		</span>	
	</div>
</div>
<script>
	JoomlaCalendar.init(document.getElementById('ksr-form-field-<?php echo $view->field_params->id; ?>-container'));
</script>