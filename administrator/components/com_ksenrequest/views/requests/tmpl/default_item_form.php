<?php
/**
 * @copyright   Copyright (C) 2013. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>
<tr class="list_item">
	<td class="check"><input type="checkbox" class="check-item" /></td>	
	<td class="order_number"><?php echo $this->item->id ?></td>
	<td align="left" width="20%">
		<?php echo !empty($this->item->form_title) ? $this->item->form_title : JText::_('KSR_REQUESTS_NO_FORM'); ?>
	</td>
	<td class="name stretch">
		<a class="km-modal" rel='{"x":"90%","y":"90%"}' href="<?php echo JRoute::_('index.php?option=com_ksenrequest&view=requests&layout=request&id=' . $this->item->id . '&tmpl=component'); ?>">
			<?php foreach($this->item->fields as $field): ?>
				<b><?php echo $field->title; ?>:</b> <?php echo $field->value; ?><br>
			<?php endforeach; ?>
		</a>
	</td>
	<td class="order_date"><?php echo $this->item->created ?></td>
	<td class="del"><a href="#"></a></td>
	<input type="hidden" class="id" name="items[<?php echo $this->item->id; ?>][id]" value="<?php echo $this->item->id ?>">
</tr>