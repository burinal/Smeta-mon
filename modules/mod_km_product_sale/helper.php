<?php
/**
 * @copyright   Copyright (C) 2013. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

class modKMProductSaleHelper {

	public static function getList($params) {
		$db    = JFactory::getDbo();
		$categories = (array) $params->get('categories', array());
		$parent = $db->getQuery(true);
		$parent
			->select('p.id')
			->from('#__ksenmart_products AS p')
			->where('p.published = 1')
			->where('p.parent_id = 0')
            ->where('p.price = (SELECT MIN(m.price) FROM #__ksenmart_products AS m)')
			->order('p.ordering ASC')
			->group('p.id');

		if (!empty($categories)) {
			$parent->leftJoin('#__ksenmart_products_categories as pc ON p.id=pc.product_id');
			$parent->where('pc.category_id IN (' . implode(',', $categories) . ')');
		}
		$db->setQuery($parent, 0, $params->get('col', 1));
		$parent = $db->loadColumn();

		/* child */
        $idm = $parent[0];
        $products = array();
        $query  = $db->getQuery(true);
        $query
            ->select('m.id')
            ->from('#__ksenmart_products AS m')
            ->where('m.parent_id=' . $idm)
            ->where('m.published=1');
        $db->setQuery($query);
        $ids = $db->loadObjectList();
        if (!empty($ids))
        {
            foreach ($ids as $id)
            {
                $products[] = KSMProducts::getProduct($id->id);
            }
        }
		return $products;
	}

}