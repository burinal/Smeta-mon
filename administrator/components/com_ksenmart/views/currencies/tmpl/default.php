<?php 
/**
 * @copyright   Copyright (C) 2013. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
 
defined('_JEXEC') or die;

JHTML::_('behavior.modal');
?>
<div class="clearfix panel">
    <div class="pull-left">
        <?php echo KSSystem::loadModules('ks-top-left'); ?>
    </div>
    <div class="pull-right">
        <?php echo KSSystem::loadModules('ks-top-right'); ?>
    </div>
    <div class="row-fluid">
        <?php echo KSSystem::loadModules('ks-top-bottom'); ?>
    </div>
</div>
<div id="center">
	<div id="cat">
			<div class="left-column">
				<div id="tree">
					<form id="list-filters">
						<ul>
							<?php echo KSSystem::loadModules('km-list-left')?>
						</ul>
					</form>			
				</div>	
			</div>
			<div class="right-column">
				<div class="right-column-wra">
                    <?php echo $this->loadTemplate('items_list_top');?>
					<?php echo $this->loadTemplate('items_list');?>
				</div>	
			</div>	
	</div>	
</div>
<script>
var CurrenciesList=new KMList({
	'view':'currencies',
	'object':'CurrenciesList',
	'limit':<?php echo $this->state->get('list.limit');?>,
	'limitstart':<?php echo $this->state->get('list.start');?>,
	'total':<?php echo $this->total;?>,
	'order_type':'<?php echo $this->state->get('order_type');?>',
	'order_dir':'<?php echo $this->state->get('order_dir');?>',
	'table':'currencies',
	'sortable':false
});
</script>