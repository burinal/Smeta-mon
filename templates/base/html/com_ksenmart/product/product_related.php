<?php 
/**
 * @copyright   Copyright (C) 2013. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
 
defined('_JEXEC') or die;
?>

<?php if (count($this->related) > 0){ ?>
<!-- Popular models -->
<section class="popular_models">
    <h2>Смотрите также</h2>
    <div class="frames">
        <ul>
            <?php foreach($this->related as $product){?>
                <?php echo $this->loadOtherTemplate('item', 'default', 'catalog', array('product' => $product, 'params' => $this->params)); ?>
            <?php } ?>
        </ul>
    </div>
    <span class="details_but">Смотреть подробно</span>
    <span class="arr_left inactive"></span>
    <span class="arr_right"></span>
<?php } ?>

