<?php 
/**
 * @copyright   Copyright (C) 2013. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
 
defined('_JEXEC') or die;

if ( file_exists( __DIR__ . '/defines.php' ) ) {
    include_once __DIR__ . '/defines.php';
}
if ( !defined( '_JDEFINES' ) ) {
    define( 'JPATH_BASE', __DIR__ );
    require_once JPATH_BASE . '/includes/defines.php';
}
require_once JPATH_BASE . '/includes/framework.php';

$path = $this->baseurl.'/templates/base';
?>
<div class="demonstration">
    <?php echo $this->loadTemplate('gallery', 'product'); ?>
	<div class="order_master">
		<span class="but" data-popup="order_master">Вызвать мастера на замер</span>
				Хотите <a>узнать больше</a> о двери?
    </div>
</div>
<div class="details">
      <?php echo $this->loadTemplate('title', 'product');?>
      <?php echo $this->loadTemplate('info1','product');?>
</div>
</section>
<?php echo $this->loadTemplate('childs'); ?>
<?php echo $this->loadTemplate('related', 'product'); ?>

