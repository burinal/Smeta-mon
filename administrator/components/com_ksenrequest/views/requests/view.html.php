<?php 
/**
 * @copyright   Copyright (C) 2013. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
 
defined('_JEXEC') or die;

KSSystem::import('views.viewksadmin');

class KsenRequestViewRequests extends JViewKSAdmin 
{
	
	function display($tpl = null) 
	{
		$this->path->addItem(JText::_('ksr_panel') ,'index.php?option=com_ksen&widget_type=trade&extension=com_ksenrequest');
		$this->path->addItem(JText::_('ksr_requests'));
		
		switch ($this->getLayout()) 
		{
			case 'request':
				$model = $this->getModel();
				$request = $model->getRequest();
				$model->form = 'request';
				$form = $model->getForm();
				if ($form) $form->bind($request);
				$this->title = JText::sprintf('ksr_requests_request_title', $request->id);
				$this->form = $form;
				$this->request = $request;
			break;
			
			default:
				$this->items = $this->get('ListItems');
				$this->total = $this->get('Total');
		}
		parent::display($tpl);
	}
	
}
	