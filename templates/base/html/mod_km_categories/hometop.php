<?php 
/**
 * @copyright   Copyright (C) 2013. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
 
defined('_JEXEC') or die;
?>
    <!-- Doors catalog -->
    <section class="doors_catalog">
        <h2>Каталог дверей</h2>
        <ul class="tiles">
            <?php foreach($products as $category): ?>
            <li class="with_description">
                <span class="title"><?php echo $category->title; ?></span>
                <p><?php echo $category->introcontent; ?></p>
                <span class="price"><?php echo $category->val_price; ?></span>
                <a href="<?php echo $category->link; ?>" title="<?php echo $category->title; ?>"><span class="watch_catalog">Смотреть каталог</span></a>
                <a><img class="door" src="<?php echo $category->back_img; ?>" alt="<?php echo $category->title; ?>"></a>
            </li>
            <?php endforeach; ?>

