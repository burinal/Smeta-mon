<?php
/**
 * @copyright   Copyright (C) 2013. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

class JFormFieldRequestFields extends JFormField 
{

	protected $type = 'RequestFields';

	public function getInput() 
	{
		$dispatcher = JDispatcher::getInstance();
		$db = JFactory::getDbo();
		$html = '';
		
		$html .= '<div class="form-fields">';
		$html .= '	<div class="row fields-row">';

		foreach ($this->value as $key => $value) 
		{
			$query = $db->getQuery(true);
			$query
				->select('*')
				->from('#__ksenrequest_forms_steps_fields')
				->where('id = '.$db->q($key))
			;
			$db->setQuery($query);
			$field = $db->loadObject();
			
			if (empty($field))
			{
				continue;
			}
			
			$results = $dispatcher->trigger('onSetFieldRequestValue', array($field, $value));
			$value = isset($results[0]) && $results[0] ? $results[0] : null;	
			$value = !empty($value) ? $value : JText::_('KSR_REQUESTS_REQUEST_FIELD_VALUE_EMPTY');
				
			$html .= '<div class="row">';
			$html .= '	<label class="inputname"><b>' . $field->title . ':</b></label>';
			$html .= '	<label class="inputname width240px">' . $value . '</label>';
			$html .= '</div>';
		}

		$html .= '	</div>';
		$html .= '</div>';


		return $html;
	}
	
}
