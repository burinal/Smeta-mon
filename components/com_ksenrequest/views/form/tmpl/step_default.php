<?php
defined('_JEXEC') or die;
?>
<form class="ksr-step-form form-horizontal">
	
	<?php if (!empty($this->step->title) && !$this->step->hide_title): ?>
		<h3 class="ksr-form-step-title"><?php echo $this->step->title; ?></h3>
	<?php endif; ?>
	
	<?php foreach($this->step->fields as $field): ?>
		<div class="form-group">
			<label class="col-sm-3 control-label">
				<?php echo $field->title; ?>
				<?php if ($field->required): ?>*<?php endif; ?>
			</label>
			<div class="col-sm-9"><?php echo $field->html; ?></div>
		</div>
	<?php endforeach; ?>
	
	<div class="form-group">
		<div class="col-sm-12">
			<button type="submit" class="ksr-step-btn btn btn-success" data-button-text="<?php echo $this->step->button_text; ?>" data-loading-text="<?php echo JText::_('KSR_FORM_LOADING_TEXT'); ?>"><?php echo $this->step->button_text; ?></button>
		</div>						
	</div>
	
	<input type="hidden" name="id" value="<?php echo $this->form->id; ?>">
	<input type="hidden" name="step_id" value="<?php echo $this->step->id; ?>">
	<input type="hidden" name="option" value="com_ksenrequest">
	<input type="hidden" name="task" value="form.processStep">
</form>