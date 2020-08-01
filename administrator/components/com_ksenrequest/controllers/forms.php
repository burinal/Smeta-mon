<?php 
/**
 * @copyright   Copyright (C) 2013. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
 
defined('_JEXEC') or die;

jimport('joomla.application.component.controlleradmin');
class KsenRequestControllerForms extends KsenRequestController 
{
	
	function get_field_params() 
	{
		$app = JFactory::getApplication();
		$dispatcher = JDispatcher::getInstance();
		$field_params = $app->input->get('field_params', array(), 'RAW');

		$results = $dispatcher->trigger('onDisplayFieldParamsForm', array($field_params));
		$html = isset($results[0]) && $results[0] ? $results[0] : null;
		
		$response = array('html' => $html);
		$response = json_encode($response);
		JFactory::getDocument()->setMimeEncoding('application/json');
		echo $response;
		JFactory::getApplication()->close();
	}
	
	function get_field_view() 
	{
		$app = JFactory::getApplication();
		$dispatcher = JDispatcher::getInstance();
		$field_params = $app->input->get('field_params', array(), 'RAW');
		
		$field_params['params'] = array();
		foreach($field_params as $key => $val)
		{
			if (mb_substr($key, 0, 7) == 'params-')
			{
				unset($field_params[$key]);
				$key = mb_substr($key, 7, strlen($key) - 7);
				$field_params['params'][$key] = $val;
			}
		}
		$field_params['params'] = json_encode($field_params['params'], JSON_HEX_APOS);			
		$field_params['required'] = isset($field_params['required']) ? $field_params['required'] : 0;
		$field_params['published'] = isset($field_params['published']) ? $field_params['published'] : 0;		
		$field_params['requests_list'] = isset($field_params['requests_list']) ? $field_params['requests_list'] : 0;		

		$results = $dispatcher->trigger('onDisplayFieldParamsView', array($field_params));
		$html = isset($results[0]) && $results[0] ? $results[0] : null;
		
		$response = array('html' => $html);
		$response = json_encode($response);
		JFactory::getDocument()->setMimeEncoding('application/json');
		echo $response;
		JFactory::getApplication()->close();
	}	

}