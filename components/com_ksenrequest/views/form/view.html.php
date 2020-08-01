<?php 
/**
 * @copyright   Copyright (C) 2013. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
 
defined('_JEXEC') or die;

KSSystem::import('views.viewks');

class KsenRequestViewForm extends JViewKS 
{

	public function display($tpl = null)
	{
	    $this->form = $this->get('KsrForm');
	    $this->step = $this->get('Step');

		$this->setLayout($this->form->layout);
		
		$app = JFactory::getApplication();
		$this->_addPath('template', JPATH_THEMES . '/' . $app->getTemplate() . '/html/com_ksenrequest/form');

		JHtml::stylesheet('com_ksenrequest/form.css', false, true);
		JHtml::script('com_ksenrequest/form.js', false, true);

        parent::display($tpl);
    }
	
}