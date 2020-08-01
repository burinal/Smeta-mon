<?php 
/**
 * @copyright   Copyright (C) 2013. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
 
defined('_JEXEC') or die;
?>
<table class="cat" width="100%" cellspacing="0">	
	<thead>
		<tr>
			<th class="check"><input type="checkbox" class="check-all" /></th>
			<th class="order_number"><span class="sort_field" rel="id"><?php echo JText::_('ksr_requests_number')?></span></th>
			<th align="left" width="20%"><?php echo JText::_('ksr_requests_form_name')?></th>
			<th class="name stretch" align="left"><?php echo JText::_('ksr_requests_data')?></th>
			<th class="order_date"><?php echo JText::_('ksr_requests_date')?></th>
			<th class="del"><span></span></th>
		</tr>
	</thead>	
	<tbody>
	<?php if (count($this->items)>0):?>
		<?php foreach($this->items as $item):?>
			<?php $this->item=&$item;?>
			<?php echo $this->loadTemplate('item_form');?>
		<?php endforeach;?>
	<?php else:?>
		<?php echo $this->loadTemplate('no_items');?>
	<?php endif;?>
	</tbody>
</table>
<div class="pagi">
</div>