<?php
/**
 * @copyright   Copyright (C) 2013. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::_('behavior.keepalive');
?>
<form class="form clearfix" method="POST">
	<div class="heading">
		<h3>
			<?php echo $this->title; ?>
		</h3>
		<div class="save-close">
			<input type="submit" value="<?php echo JText::_('KS_SAVE'); ?>" class="btn btn-save">
			<input type="button" class="close" onclick="parent.closePopupWindow();">
		</div>
	</div>
	<div class="edit">
		<div class="leftcol">
			<div class="set">
				<div class="row">
					<?php echo $this->form->getLabel('title'); ?>
					<?php echo $this->form->getInput('title'); ?>
					<span class="linka" rel="setttings">
						<a><?php echo JText::_('ksr_forms_form_settings_title')?></a>
					</span>					
				</div>
				<div class="row">
					<?php echo $this->form->getLabel('published'); ?>
					<div class="checkb">
						<?php echo $this->form->getInput('published'); ?>
					</div>
				</div>				
				<div class="row setttings" style="display: none">
					<?php echo $this->form->getLabel('alias'); ?>
					<?php echo $this->form->getInput('alias'); ?>
				</div>				
				<div class="row setttings" style="display: none">
					<?php echo $this->form->getLabel('layout'); ?>
					<?php echo $this->form->getInput('layout'); ?>
				</div>	
				<div class="row setttings" style="display: none">
					<?php echo $this->form->getLabel('thanks_modal'); ?>
					<div class="checkb">
						<?php echo $this->form->getInput('thanks_modal'); ?>
					</div>
				</div>					
				<div class="row setttings" style="display: none">
					<?php echo $this->form->getLabel('source'); ?>
					<?php echo $this->form->getInput('source'); ?>
				</div>			
				<div class="row setttings" style="display: none">
					<?php echo $this->form->getLabel('tags'); ?>
					<?php echo $this->form->getInput('tags'); ?>
				</div>				
			</div>		
			<div class="set">
				<?php echo $this->form->getInput('steps'); ?>
			</div>
			<div class="set">
				<h3 class="headname"><?php echo JText::_('ksr_forms_form_messages_title')?></h3>
				<div class="row row-hidden-content">
					<h4 class="headname">
						<?php echo $this->form->getLabel('thanks_message'); ?>
						<a href="#" class="sh"></a>
					</h4>
					<div class="hidden-content">
						<?php echo $this->form->getInput('thanks_message'); ?>
					</div>	
				</div>
				<div class="row row-hidden-content">
					<h4 class="headname">
						<?php echo $this->form->getLabel('thanks_mail'); ?>
						<a href="#" class="sh"></a>
					</h4>
					<div class="hidden-content">
						<?php echo $this->form->getInput('thanks_mail'); ?>
					</div>	
				</div>				
			</div>
			<div class="set">
				<h3 class="headname"><?php echo JText::_('ksr_forms_form_texts_title')?></h3>
				<div class="row row-hidden-content">
					<h4 class="headname">
						<?php echo $this->form->getLabel('text_before'); ?>
						<a href="#" class="sh"></a>
					</h4>
					<div class="hidden-content">
						<?php echo $this->form->getInput('text_before'); ?>
					</div>	
				</div>
				<div class="row row-hidden-content">
					<h4 class="headname">
						<?php echo $this->form->getLabel('text_after'); ?>
						<a href="#" class="sh"></a>
					</h4>
					<div class="hidden-content">
						<?php echo $this->form->getInput('text_after'); ?>
					</div>	
				</div>				
			</div>			
		</div>
		<div class="rightcol">
			<div class="rightcol-wra">
				<?php echo $this->form->getInput('files'); ?>
			</div>
		</div>
		<input type="hidden" name="task" value="save_form_item">
		<input type="hidden" name="close" value="1">
		<?php echo $this->form->getInput('id'); ?>
		<?php echo $this->form->getInput('type'); ?>
	</div>
</form>