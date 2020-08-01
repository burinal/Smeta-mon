<?php 
/**
 * @copyright   Copyright (C) 2013. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
 
defined('_JEXEC') or die;

jimport('joomla.application.component.controller');

class KsenRequestControllerForm extends JControllerLegacy 
{
    
    public function __construct($config = array()) 
	{
        parent::__construct($config);
    }
    
	public function processStep() 
	{
		$app = JFactory::getApplication();
		$session = JFactory::getSession();
		$model = $this->getModel('form');
		$view = $this->getView('form', 'html');
		$form = $model->getKsrForm();
		$step = $model->getStep();
		
		$fields = $app->input->get('fields', array(), 'ARRAY');
		$files = $app->input->files->get('fields', array(), 'RAW');
		
		$return = $model->validateFields($fields, $files);
		if ($return === false)
		{
			$response = new JResponseJson(null, $model->getError(), true);
			$app->close($response);		
		}		
		
		$session_fields = $session->get('com_ksenrequest.form.fields.'.$form->id, array());
		$fields = $session_fields + $fields;
		
		if (!$step)
		{
			$session->set('com_ksenrequest.form.fields.'.$form->id, array());
			$return = $model->createRequest($fields);
			
			if ($form->thanks_modal)
			{
				$model->setState('form.step_id', 0);
				$step = $model->getStep();
				
				$view->form = $form;
				$view->step = $step;
				$view->setLayout($step->layout);
				
				ob_start();
				echo $view->loadTemplate();
				$step_html = ob_get_contents();
				ob_end_clean();					
				
				$view->setLayout('thanks_modal');
				
				ob_start();
				echo $view->loadTemplate();
				$thanks_html = ob_get_contents();
				ob_end_clean();	
		
				$html = array(
					'step_html' => $step_html,
					'thanks_html' => $thanks_html,
				);
				$type = 'thanks_modal';	
			}
			else
			{
				$view->form = $form;
				$view->setLayout('thanks');
				
				ob_start();
				echo $view->loadTemplate();
				$html = ob_get_contents();
				ob_end_clean();	
				
				$type = 'thanks';	
			}
		}
		else
		{
			$session->set('com_ksenrequest.form.fields.'.$form->id, $fields);
			
			$view->form = $form;
			$view->step = $step;
			$view->setLayout($step->layout);
			
			ob_start();
			echo $view->loadTemplate();
			$html = ob_get_contents();
			ob_end_clean();	
			
			$type = 'step';
		}
		
        $response = array('type' => $type, 'html' => $html);
        $response = new JResponseJson($response);
		$app->close($response);
	}
	
}
