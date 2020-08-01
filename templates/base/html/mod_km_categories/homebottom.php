<?php 
/**
 * @copyright   Copyright (C) 2013. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
 
defined('_JEXEC') or die;
?>
<?php foreach($products as $category): ?>
    <li>
        <span class="title"><?php echo $category->title; ?></span>
        <span class="price"><?php echo $category->val_price; ?></span>
        <a href="<?php echo $category->link; ?>" title="<?php echo $category->title; ?>"><span class="watch_catalog">Смотреть каталог</span></a>
        <a><img class="door" src="<?php echo $category->back_img; ?>" alt="<?php echo $category->title; ?>"></a>
    </li>
<?php endforeach; ?>
    </ul>
    </section>