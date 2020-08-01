<?php 
/**
 * @copyright   Copyright (C) 2013. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
 
defined('_JEXEC') or die;
?>
<!-- Visual carousel -->
<section class="visual_carousel <?php echo $class_sfx?>">
    <h1><?php echo $module->title?></h1>
    <div class="frames">
        <ul>
            <?php foreach($products as $product): ?>
                <li class="no-opacity">
                    <a href="<?php echo $product->link; ?>">
                        <span class="image"><img src="<?php echo $product->mini_small_img; ?>" alt="<?php echo $product->title; ?>"></span>
                        <span class="title"><?php echo $product->title; ?></span>
                    </a>
                    <div class="price">от <?php echo $product->price; ?> &#8381;</div>
                    <div class="description">
                        <?php echo $product->introcontent; ?>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <ul class="switch">
        <li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li>
    </ul>
    <span class="arr_left inactive"></span>
    <span class="arr_right"></span>
</section>
