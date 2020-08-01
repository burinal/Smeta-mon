<?php
defined('_JEXEC') or die;
?>
<div class="modal fade ksr-form-thanks-modal" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><?php echo JText::_('KSR_FORM_THANKS_MODAL_TITLE'); ?></h4>
			</div>
			<div class="modal-body">
				<div class="ksr-form-thanks">
					<?php echo $this->form->thanks_message; ?>
				</div>
			</div>
		</div>
	</div>
</div>