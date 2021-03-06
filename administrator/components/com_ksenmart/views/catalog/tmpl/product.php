<?php
/**
 * @copyright   Copyright (C) 2013. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::_('behavior.keepalive');
?>
<form class="form clearfix" method="POST">
    <div class="heading">
        <h3>
			<?php echo $this->title; ?>
        </h3>
		<?php if ($this->product->id): ?>
            <div class="head-link">
                <a href="<?php echo $this->product->link; ?>" target="_blank">
                    <span class="icon-out-2 small"></span><?php echo JText::_('KSM_CATALOG_ITEM_LINK_SITE'); ?>
                </a>
            </div>
		<?php endif; ?>
        <div class="save-close">
            <input type="submit" value="<?php echo JText::_('KS_SAVE'); ?>" class="btn btn-save">
            <input type="button" class="close" onclick="parent.closePopupWindow();">
        </div>
    </div>
    <div class="edit">
        <div class="leftcol">
            <div class="row">
				<?php echo $this->form->getLabel('title'); ?>
				<?php echo $this->form->getInput('title'); ?>
                <span class="linka" rel="meta-data">
							<a><?php echo JText::_('KSM_METADATA'); ?></a>
						</span>
                <span class="linka" rel="alias">
							<a><?php echo JText::_('KSM_ALIAS'); ?></a>
						</span>
            </div>
            <div class="row meta-data" style="display: none">
				<?php echo $this->form->getLabel('metatitle'); ?>
				<?php echo $this->form->getInput('metatitle'); ?>
            </div>
            <div class="row meta-data" style="display: none">
				<?php echo $this->form->getLabel('metadescription'); ?>
				<?php echo $this->form->getInput('metadescription'); ?>
            </div>
            <div class="row meta-data" style="display: none">
				<?php echo $this->form->getLabel('metakeywords'); ?>
				<?php echo $this->form->getInput('metakeywords'); ?>
            </div>
            <div class="row alias" style="display: none">
				<?php echo $this->form->getLabel('alias'); ?>
				<?php echo $this->form->getInput('alias'); ?>
            </div>
            <div class="row">
				<?php echo $this->form->getLabel('product_code'); ?>
				<?php echo $this->form->getInput('product_code'); ?>
            </div>
            <div class="row">
                <div class="col">
					<?php echo $this->form->getLabel('price'); ?>
					<?php echo $this->form->getInput('price'); ?>
                </div>
                <div class="col">
					<?php echo $this->form->getInput('price_type'); ?>
                </div>
                <span class="linka" rel="old_price">
                    <a><?php echo JText::_('KSM_CATALOG_PRODUCT_OLD_PRICE_LBL'); ?></a>
                </span>
                <span class="linka" rel="purchase_price">
                    <a><?php echo JText::_('KSM_CATALOG_PRODUCT_PURCHASE_PRICE_LBL'); ?></a>
                </span>
            </div>
            <div class="row old_price" style="display: none;">
				<?php echo $this->form->getLabel('old_price'); ?>
				<?php echo $this->form->getInput('old_price'); ?>
            </div>
            <div class="row purchase_price" style="display: none;">
				<?php echo $this->form->getLabel('purchase_price'); ?>
				<?php echo $this->form->getInput('purchase_price'); ?>
            </div>
            <div class="row">
                <div class="col">
					<?php echo $this->form->getLabel('in_stock'); ?>
					<?php echo $this->form->getInput('in_stock'); ?>
                </div>
                <div class="col">
					<?php echo $this->form->getInput('product_unit'); ?>
                </div>
                <span class="linka" rel="packaging">
                    <a><?php echo JText::_('KSM_CATALOG_PRODUCT_PACKAGING_LBL'); ?></a>
                </span>
                <span class="linka" rel="features">
                    <a><?php echo JText::_('KSM_CATALOG_PRODUCT_FEATURES'); ?></a>
                </span>
            </div>
            <div class="row packaging" style="display: none;">
				<?php echo $this->form->getLabel('product_packaging'); ?>
				<?php echo $this->form->getInput('product_packaging'); ?>
            </div>
            <div class="row features"  style="display: none;">
		        <?php echo $this->form->getLabel('weight'); ?>
		        <?php echo $this->form->getInput('weight'); ?>
            </div>
            <div class="row features"  style="display: none;">
		        <?php echo $this->form->getLabel('length'); ?>
		        <?php echo $this->form->getInput('length'); ?>
            </div>
            <div class="row features"  style="display: none;">
		        <?php echo $this->form->getLabel('width'); ?>
		        <?php echo $this->form->getInput('width'); ?>
            </div>
            <div class="row features"  style="display: none;">
		        <?php echo $this->form->getLabel('height'); ?>
		        <?php echo $this->form->getInput('height'); ?>
            </div>
            <div class="row">
				<?php echo $this->form->getLabel('tags'); ?>
				<?php echo $this->form->getInput('tags'); ?>
            </div>
            <div class="row">
                <label class="inputname"><?php echo JText::_('KSM_CATALOG_PRODUCT_FLAG'); ?></label>
                <div class="checkb">
					<?php echo $this->form->getInput('new'); ?>
					<?php echo $this->form->getLabel('new'); ?>
                </div>
                <div class="checkb">
					<?php echo $this->form->getInput('promotion'); ?>
					<?php echo $this->form->getLabel('promotion'); ?>
                </div>
                <div class="checkb">
					<?php echo $this->form->getInput('recommendation'); ?>
					<?php echo $this->form->getLabel('recommendation'); ?>
                </div>
                <div class="checkb">
					<?php echo $this->form->getInput('hot'); ?>
					<?php echo $this->form->getLabel('hot'); ?>
                </div>
            </div>
            <div class="row">
                <h3><?php echo $this->form->getLabel('content'); ?></h3>
            </div>
            <div class="row">
				<?php echo $this->form->getInput('content'); ?>
            </div>
            <div class="row">
						<span class="linka" rel="minidesc">
							<a href="#"><?php echo JText::_('KSM_ADD_MINIDESC'); ?></a>
						</span>
            </div>
            <div class="row minidesc" style="display: none;">
				<?php echo $this->form->getInput('introcontent'); ?>
            </div>
			<?php if ($this->product->is_parent): ?>
                <div class="row">
                    <h3><?php echo $this->form->getLabel('childs'); ?></h3>
                </div>
                <div class="row">
					<?php echo $this->form->getInput('childs'); ?>
                </div>
			<?php else: ?>
                <div class="row">
                    <a class="add_childs" href="#"><?php echo JText::_('KSM_CATALOG_PRODUCT_ADD_CHILDS'); ?></a>
                </div>
			<?php endif; ?>
            <div class="row">
				<?php echo $this->form->getInput('properties'); ?>
            </div>
        </div>
        <div class="rightcol">
            <div class="rightcol-wra">
				<?php echo $this->form->getInput('images'); ?>
				<?php echo $this->form->getInput('categories'); ?>
				<?php echo $this->form->getInput('manufacturer'); ?>
				<?php echo $this->form->getInput('relative'); ?>
            </div>
        </div>
        <input type="hidden" name="task" value="save_form_item">
        <input type="hidden" name="close" value="1">
		<?php echo $this->form->getInput('id'); ?>
		<?php echo $this->form->getInput('type'); ?>
		<?php echo $this->form->getInput('is_parent'); ?>
		<?php echo $this->form->getInput('add_child'); ?>
    </div>
</form>