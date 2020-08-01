<?php
/**
 * @copyright   Copyright (C) 2013. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::_('behavior.tooltip');
?>
<form class="form" method="post">
	<div class="heading">
		<h3><?php echo $this->title; ?></h3>
		<div class="save-close" style="width:auto;">
			<input type="button" class="close" onclick="parent.closePopupWindow();">
		</div>
	</div>
	<div class="edit">
		<div class="leftcol">
			<div class="set">
				<div class="row">
					<label class="inputname"><?php echo JText::_('KSR_REQUESTS_FORM_TITLE_LBL'); ?></label>
					<label class="inputname width240px"><?php echo !empty($this->request->form_title) ? $this->request->form_title : JText::_('KSR_REQUESTS_NO_FORM'); ?></label>
				</div>
				<div class="row">
					<label class="inputname"><?php echo JText::_('KSR_REQUESTS_FORM_URL_LBL'); ?></label>
					<label class="inputname width240px"><a target="_blank" href="<?php echo $this->request->url; ?>"><?php echo $this->request->url; ?></a></label>
				</div>					
			</div>					
			<div class="set">
				<h3 class="headname"><?php echo JText::_('KSR_REQUESTS_FORM_FORMFIELDS_LBL'); ?></h3>
				<?php echo $this->form->getInput('fields'); ?>
			</div>
		</div>
		<div class="rightcol">
			<div class="rightcol-wra">
				<div class="set">
					<h3 class="headname"><?php echo JText::_('KSR_REQUESTS_REQUEST_UTM_TITLE'); ?></h3>
					<?php if (!empty($this->request->utm)): ?>
						<?php foreach ($this->request->utm as $key => $utm): ?>
							<div class="row">
								<label class="inputname"><?php echo JText::_('KSR_REQUESTS_REQUEST_' . $key); ?>:</label>
								<label class="inputname"><?php echo !empty($utm) ? $utm : JText::_('KSR_REQUESTS_REQUEST_UTM_EMPTY'); ?></label>
							</div>
						<?php endforeach; ?>
					<?php endif; ?>
					<?php if (!empty($this->request->referer)): ?>
						<div class="row">
							<label class="inputname"><?php echo JText::_('KSR_REQUESTS_REQUEST_REFERER'); ?>:</label>
							<label class="inputname"><a target="_blank" href="<?php echo $this->request->referer; ?>"><?php echo $this->request->referer; ?></a></label>
						</div>		
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
	<input type="hidden" name="task" value="save_form_item">
	<?php echo $this->form->getInput('id'); ?>
</form>