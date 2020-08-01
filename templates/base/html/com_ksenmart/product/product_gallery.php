<?php
/**
 * @copyright   Copyright (C) 2013. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>
<?php if (!empty($this->images)): ?>
    <div class="door">
				<span class="switch_side front">
					<span class="front">Посмотреть вид снаружи</span>
					<span class="back">Посмотреть вид внутри</span>
				</span>
        <?php foreach ($this->images as $key => $image): ?>
            <?php if (is_string($image->params)) $image->params = json_decode($image->params); ?>
            <?php if($key == 0){?>
                <img class="front_side visible" src="<?php echo $image->img; ?>" title="<?php echo(empty($image->params->title) ? $this->product->title : $image->params->title); ?>" alt="<?php echo(empty($image->params->alt) ? $this->product->title : $image->params->alt); ?>">
            <?php }else{?>
                <img class="back_side" src="<?php echo $image->img; ?>" title="<?php echo(empty($image->params->title) ? $this->product->title : $image->params->title); ?>" alt="<?php echo(empty($image->params->alt) ? $this->product->title : $image->params->alt); ?>">
            <?php } ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
