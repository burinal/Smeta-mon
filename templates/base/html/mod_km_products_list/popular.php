<?php 
/**
 * @copyright   Copyright (C) 2013. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
 
defined('_JEXEC') or die;
?>
<!-- Popular models -->
<section class="popular_models">
    <h2><?php echo $module->title?></h2>
    <div class="frames">
        <ul>
            <?php foreach($products as $product): ?>
                <li>
                    <a href="<?php echo $product->link; ?>">
                        <span class="door"><img src="<?php echo $product->mini_small_img; ?>" alt="<?php echo $product->title; ?>"></span>
                        <span class="door_back"><img src="<?php echo $product->back_img; ?>" alt="<?php echo $product->title; ?>"></span>
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
    <span class="details_but">Смотреть подробно</span>
    <span class="arr_left inactive"></span>
    <span class="arr_right"></span>
</section>

