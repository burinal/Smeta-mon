<?php 
defined('_JEXEC') or die('Restricted access'); 
?>
<div id="form-steps-field-params" class="popup-window">
	<div class="popup-window-inner">
		<form class="form">
			<div class="heading">
				<h3><?php echo JText::_('KSR_FORMS_FORM_FIELD_PARAMS_LBL'); ?></h3>
				<div class="save-close">
					<button type="submit" class="save"><?php echo JText::_('KS_SAVE'); ?></button>
					<button class="close"></button>
				</div>
			</div>
			<div class="contents">
				<div class="contents-inner">	
					<div class="row">
						<?php echo $view->form->getLabel('title'); ?>
						<?php echo $view->form->getInput('title'); ?>
					</div>
					<div class="row">
						<?php echo $view->form->getLabel('params-placeholder'); ?>
						<div class="checkb">
							<?php echo $view->form->getInput('params-placeholder'); ?>
						</div>
					</div>		
					<div class="row">
						<?php echo $view->form->getLabel('class'); ?>
						<?php echo $view->form->getInput('class'); ?>
					</div>					
					<div class="row">
						<?php echo $view->form->getLabel('required'); ?>
						<div class="checkb">
							<?php echo $view->form->getInput('required'); ?>
						</div>
					</div>						
					<div class="row">
						<?php echo $view->form->getLabel('published'); ?>
						<div class="checkb">
							<?php echo $view->form->getInput('published'); ?>
						</div>
					</div>			
					<div class="row">
						<?php echo $view->form->getLabel('requests_list'); ?>
						<div class="checkb">
							<?php echo $view->form->getInput('requests_list'); ?>
						</div>
					</div>	
					<div class="row">
						<?php echo $view->form->getLabel('params-system-name'); ?>
						<div class="checkb">
							<?php echo $view->form->getInput('params-system-name'); ?>
						</div>
					</div>						
				</div>
			</div>
			<?php echo $view->form->getInput('type'); ?>
			<?php echo $view->form->getInput('step_id'); ?>
			<?php echo $view->form->getInput('step_name'); ?>
			<?php echo $view->form->getInput('ordering'); ?>
			<?php echo $view->form->getInput('id'); ?>
		</form>
	</div>
</div>
