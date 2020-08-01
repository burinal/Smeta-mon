<?php
/**
 * @copyright   Copyright (C) 2013. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

class modKsenmartCategoriesHelper
{
    public static function getList($params) {
        $db    = JFactory::getDbo();
        $categories = (array) $params->get('categories', array());
        $parent = $db->getQuery(true);
        $parent
            ->select('p.*')
            ->from('#__ksenmart_categories AS p')
            ->where('p.published = 1')
            ->order('p.ordering ASC');

        if (!empty($categories)) {
            $parent->where('p.id IN (' . implode(',', $categories) . ')');
        }
        $db->setQuery($parent);
        $products = $db->loadObjectList();


        foreach($products as $product) {
            $que = $db->getQuery(true);
            $que
                ->select('m.*')
                ->from('#__ksenmart_files as m')
                ->where('m.owner_id = ' . $product->id)
                ->andwhere('m.owner_type = "category"');
            $db->setQuery($que);
            $back_image = $db->loadObject();
            if (!empty($back_image))
            {
                $product->back_img = KSMedia::resizeImage($back_image->filename, $back_image->folder, '170', '300');
            }
            $product->val_price = KSMPrice::showPriceWithTransform($product->minprice);
            $product->link = JRoute::_('index.php?option=com_ksenmart&view=catalog&categories[0]=' . $product->id . ':' . $product->alias . '&Itemid=' . KSSystem::getShopItemid($product->id));
        }
        return $products;
    }
}