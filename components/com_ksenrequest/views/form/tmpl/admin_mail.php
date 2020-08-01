<?php 
/**
 * @copyright   Copyright (C) 2013. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
 
defined('_JEXEC') or die;
?>
<h1 style="font-size:30px;margin:10px 0px 30px;"><?php echo JText::sprintf('KSR_REQUEST_ADMIN_MAIL_TITLE', $this->request_id); ?></h1>
<table class="cellpadding">
	<tr>
		<td colspan="2">
			<h3 style="font-size:20px;margin:0px 0px 20px;text-decoration:underline;"><?php echo JText::_('KSR_REQUEST_ADMIN_MAIL_INFO_LABEL'); ?></h3>
		</td>
	</tr>	
	<tr>
		<td style="padding-right:30px;"><?php echo JText::_('KSR_REQUEST_ADMIN_MAIL_FORM_LABEL'); ?>: </td>
		<td><?php echo $this->form->title; ?></td>
	</tr>	
	<tr>
		<td style="padding-right:30px;"><?php echo JText::_('KSR_REQUEST_ADMIN_MAIL_URL'); ?>: </td>
		<td><?php echo $this->url; ?></td>
	</tr>
	<tr>
		<td colspan="2">
			<h3 style="font-size:20px;margin:30px 0px 20px;text-decoration:underline;"><?php echo JText::_('KSR_REQUEST_ADMIN_MAIL_CONTACTS_LABEL'); ?></h3>
		</td>
	</tr>	
	<?php foreach ($this->fields as $field): ?>
		<tr>
			<td style="padding-right:30px;"><?php echo $field->title; ?>: </td>
			<td><?php echo $field->value; ?></td>
		</tr>
	<?php endforeach; ?>
</table>