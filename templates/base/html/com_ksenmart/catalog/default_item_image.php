<?php
/**
 * @copyright   Copyright (C) 2013. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>
<?php //print_r($this->product);?>
<span class="door"><img src="<?php echo $this->product->small_img; ?>" alt="<?php echo $this->product->title; ?>"></span>
<span class="door_back"><img src="<?php echo $this->product->back_img; ?>" alt="<?php echo $this->product->title; ?>"></span>
<div class="ksm-catalog-item-flags">
	<?php if ($this->product->promotion == 1 || ($this->product->old_price > 0 && $this->product->old_price > $this->product->price)): ?>
        <span class="ksm-catalog-item-flag-promotion"></span>
	<?php endif; ?>
	<?php if ($this->product->hot == 1): ?>
        <span class="ksm-catalog-item-flag-hot"></span>
	<?php endif; ?>
	<?php if ($this->product->recommendation == 1): ?>
        <span class="ksm-catalog-item-flag-recommendation"></span>
	<?php endif; ?>
	<?php if ($this->product->new == 1): ?>
        <span class="ksm-catalog-item-flag-new"></span>
	<?php endif; ?>
</div>	
