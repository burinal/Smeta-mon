<?php
defined('_JEXEC') or die;
?>
<div id="ksr-form-<?php echo $this->form->id; ?>" class="ksr-form">
	
	<h2 class="ksr-form-title"><?php echo $this->form->title; ?></h2>
	
	<div class="ksr-form-content">
	
		<?php if (!empty($this->form->text_before)): ?>
			<div class="ksr-form-text-before">
				<?php echo $this->form->text_before; ?>
			</div>
		<?php endif; ?>
		
		<div class="ksr-form-step">
			<?php $this->setLayout($this->step->layout); ?>
			<?php echo $this->loadTemplate(); ?>
		</div>
		
		<?php if (!empty($this->form->text_after)): ?>
			<div class="ksr-form-text-after">
				<?php echo $this->form->text_after; ?>
			</div>
		<?php endif; ?>	
		
	</div>
	
</div>