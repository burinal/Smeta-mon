<?php 
/**
 * @copyright   Copyright (C) 2013. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
 
defined('_JEXEC') or die;

class plgKsrformfieldDate extends JPlugin 
{
	
	protected $app;
	
	protected $db;
	
	protected $autoloadLanguage = true;

	public function __construct(& $subject, $config)
	{
		parent::__construct($subject, $config);
		
		if ($this->app->isClient('administrator'))
		{
			return;
		}		
		
		$direction = strtolower(JFactory::getDocument()->getDirection());
		$tag       = JFactory::getLanguage()->getTag();
		$calendar  = JFactory::getLanguage()->getCalendar();
		
		$helperPath = 'system/fields/calendar-locales/date/gregorian/date-helper.min.js';

		if (!empty($calendar) && is_dir(JPATH_ROOT . '/media/system/js/fields/calendar-locales/date/' . strtolower($calendar)))
		{
			$helperPath = 'system/fields/calendar-locales/date/' . strtolower($calendar) . '/date-helper.min.js';
		}


		$localesPath = 'system/fields/calendar-locales/en.js';

		if (is_file(JPATH_ROOT . '/media/system/js/fields/calendar-locales/' . strtolower($tag) . '.js'))
		{
			$localesPath = 'system/fields/calendar-locales/' . strtolower($tag) . '.js';
		}
		elseif (is_file(JPATH_ROOT . '/media/system/js/fields/calendar-locales/' . $tag . '.js'))
		{
			$localesPath = 'system/fields/calendar-locales/' . $tag . '.js';
		}
		elseif (is_file(JPATH_ROOT . '/media/system/js/fields/calendar-locales/' . strtolower(substr($tag, 0, -3)) . '.js'))
		{
			$localesPath = 'system/fields/calendar-locales/' . strtolower(substr($tag, 0, -3)) . '.js';
		}		
		
		$cssFileExt = ($direction === 'rtl') ? '-rtl.css' : '.css';
		
		JHtml::_('script', $localesPath, false, true, false, false, true);
		JHtml::_('script', $helperPath, false, true, false, false, true);
		JHtml::_('script', 'system/fields/calendar.min.js', false, true, false, false, true);
		JHtml::_('stylesheet', 'system/fields/calendar' . $cssFileExt, array(), true);		
	}	
	
	public function onDisplayFieldParamsForm($field_params)
	{
		if ($field_params['type'] != $this->_name)
		{
			return;
		}
		
		$field_params['params'] = json_decode($field_params['params'], true);
		foreach($field_params['params'] as $key => $val)
		{
			$field_params['params-'.$key] = $val;
		}
		unset($field_params['params']);
		
		$form = $this->getForm('params');
		$form->bind($field_params);
		
		$view = new stdClass();
		$view->form = $form;
		
		$html = KSSystem::loadPluginTemplate($this->_name, $this->_type, $view, 'params_form');

		return $html;		
	}
	
	public function onDisplayFieldParamsView($field_params)
	{
		if ($field_params['type'] != $this->_name)
		{
			return;
		}
		
		$view = new stdClass();
		$view->field_params = $field_params;
		
		$html = KSSystem::loadPluginTemplate($this->_name, $this->_type, $view, 'params_view');

		return $html;		
	}	
	
	public function onDisplayFieldView($field_params)
	{
		if ($field_params->type != $this->_name)
		{
			return;
		}
		
		$field_params->params = json_decode($field_params->params, true);
		$field_params->params['placeholder'] = isset($field_params->params['placeholder']) ? $field_params->params['placeholder'] : 0;
		
		$view = new stdClass();
		$view->field_params = $field_params;
		
		$html = KSSystem::loadPluginTemplate($this->_name, $this->_type, $view, 'view');

		return $html;		
	}
	
	public function onValidateFieldValue(&$fields, $field_params, $value)
	{
		return;
	}
	
	public function onSetFieldRequestValue($field_params, $value)
	{
		if ($field_params->type != $this->_name)
		{
			return;
		}

		return $value;		
	}
	
	function getForm($name)
	{
		JForm::addFormPath(JPATH_ROOT . '/plugins/ksrformfield/date/assets/forms');

		$form = JForm::getInstance('ksrformfield.date.'.$name, $name, array(
			'control' => '',
			'load_data' => true
		));

		if (empty($form))
		{
			return false;
		}

		return $form;
	}	

}