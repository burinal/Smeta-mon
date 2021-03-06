<?php
/**
 * @copyright   Copyright (C) 2013. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

jimport('joomla.application.component.controller');

class KsenMartControllerCatalog extends JControllerLegacy {
	public function __construct($config = array()) {
		$config['base_path'] = JPATH_ROOT . DS . 'components' . DS . 'com_ksenmart';
		parent::__construct($config);
		$this->registerTask('get_product_links', 'get_product_links');
	}

	function filter_products() {
		$jinput = JFactory::getApplication()->input;
		$html_flag = $jinput->getCmd('htmlflag', 1);
		$model = $this->getModel('catalog');
		$view  = $this->getView('catalog', 'html');
		$view->setModel($model, true);
		if($html_flag) {
			ob_start();
			$view->display();
			$html = ob_get_contents();
			ob_end_clean();
		} else {
			$html = '';
		}

		$properties    = $model->getFilterProperties();
		$manufacturers = $model->getFilterManufacturers();
		$countries     = $model->getFilterCountries();
		$pagination    = $view->get('Pagination');
		$total         = $pagination->total;

		$response = array(
			'html'          => $html,
			'properties'    => $properties,
			'manufacturers' => $manufacturers,
			'countries'     => $countries,
			'total'         => $total
		);
		JFactory::getApplication()->close(json_encode($response));
	}

	public function checkbilling() {
		$db = JFactory::getDbo();
		$jinput = JFactory::getApplication()->input;

		
	}

	public function setLayoutView() {
		$layout  = JRequest::getVar('layout', 'grid');
		$session = JFactory::getSession();
		$model   = $this->getModel('category');

		$session->set('layout', $layout);
		$model->setLayoutCatalog($layout);

		JFactory::getApplication()->close();
	}

	public function setDefaultUserCurrency() {
		$currency_id = $this->input->get('currency_id', 0, 'int');
		$response    = array('errors' => 0);
		if (!KSMPrice::setDefaultUserCurrency($currency_id)) {
			$response['errors']++;
		}
		JFactory::getApplication()->close(json_encode($response, true));
	}
}
