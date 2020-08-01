<?php
/**
 * @copyright   Copyright (C) 2013. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
$menu   = JFactory::getApplication()->getMenu();
$active = $menu->getActive();
if (!empty($active) && !empty($active->title)) {
	$title = $active->title;
} else {
	$title = JText::_('KSM_CATALOG_TITLE');
}
?>
<?php echo $this->loadTemplate('sortlinks', 'default'); ?>
<h1><?php echo $title; ?></h1>
    <ul class="goods_list ksm-catalog ksm-block">
        <?php if (!empty($this->rows)): ?>
            <?php foreach ($this->rows as $product): ?>
                <?php echo $this->loadTemplate('item', 'default', array('product' => $product, 'params' => $this->params)); ?>
            <?php endforeach; ?>
        <?php else: ?>
            <?php echo $this->loadTemplate('noproducts', 'default'); ?>
        <?php endif; ?>
    </ul>
	<?php echo $this->loadTemplate('pagination', 'default'); ?>
