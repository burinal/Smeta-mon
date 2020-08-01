<? defined( '_JEXEC' ) or die; ?>
<table class="cat" width="100%" cellspacing="0">	
	<thead>
		<tr>
			<th class="handler"><span></span></th>
			<th class="check"><input type="checkbox" class="check-all" /></th>
			<th class="name stretch"><span class="sort_field" rel="title"><?php echo JText::_('ksr_forms_form_name')?></span></th>
			<th class="sort"><span class="sort_field" rel="ordering"><?php echo JText::_('ksr_forms_form_ordering')?></span></th>
			<th class="stat"><span class="sort_field" rel="published"><?php echo JText::_('ksr_forms_form_published')?></span></th>
			<th class="del"><span></span></th>
		</tr>
	</thead>	
	<tbody>
	<? if ($this->items): ?>
		<? foreach ($this->items as $item): ?>
			<? $this->item = &$item; ?>
			<?= $this->loadTemplate('item_form'); ?>
		<? endforeach;?>
	<? else: ?>
		<?= $this->loadTemplate('no_items'); ?>
	<? endif; ?>
	</tbody>
</table>
<div class="pagi"></div>	