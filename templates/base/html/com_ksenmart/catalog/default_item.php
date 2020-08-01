<?php
/**
 * @copyright   Copyright (C) 2013. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>
<li data-id="<?php echo $this->product->id; ?>">
    <a href="<?php echo $this->product->link; ?>">
        <?php echo $this->loadTemplate('item_image'); ?>
        <span class="title"><?php echo $this->product->title; ?></span>
    </a>
    <?php if (!empty($this->product->old_price)): ?>
        <div class="price old_price"><?php echo $this->product->val_old_price; ?></div>
    <?php endif; ?>
    <div class="price"><?php echo $this->product->val_price; ?></div>
    <div class="description">
        <?php echo $this->product->introcontent; ?>
    </div>
</li>
