<?php 
/**
 * @copyright   Copyright (C) 2013. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
 
defined('_JEXEC') or die;

class plgKsrformfieldFile extends JPlugin 
{
	
	protected $app;
	
	protected $db;
	
	protected $autoloadLanguage = true;

	public function __construct(& $subject, $config)
	{
		parent::__construct($subject, $config);
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
		
		$view = new stdClass();
		$view->field_params = $field_params;
		
		$html = KSSystem::loadPluginTemplate($this->_name, $this->_type, $view, 'view');

		return $html;		
	}
	
	public function onValidateFieldValue(&$fields, $field_params, $value)
	{
		if ($field_params->type != $this->_name)
		{
			return;
		}
		
		$params = JComponentHelper::getParams('com_media');
		$path = JPATH_ROOT . '/media/com_ksenrequest/files/forms';
		
		$valid_ext = 'bmp,csv,doc,gif,ico,jpg,jpeg,odg,odp,ods,odt,pdf,png,ppt,swf,txt,xcf,xls,BMP,CSV,DOC,GIF,ICO,JPG,JPEG,ODG,ODP,ODS,ODT,PDF,PNG,PPT,SWF,TXT,XCF,XLS,zip';
		$valid_ext = explode(',', $valid_ext);
		$allowed_mime = explode(',', $params->get('upload_mime'));
		$illegal_mime = explode(',', $params->get('upload_mime_illegal'));		
		
		$fileName = JFile::makeSafe($value['name']);
		if (JFile::exists($path . DS . $fileName)) 
		{
			$fileName = microtime(true) . $fileName;
		}
		$ext = JFile::getExt($fileName);
		if (!in_array($ext, $valid_ext))
		{
			return JText::_('PLG_KSRFORMFIELD_FILE_ERROR_INVALID_FILE_TYPE');
		}

		if (function_exists('finfo_open')) 
		{
			$finfo = finfo_open(FILEINFO_MIME);
			$type = finfo_file($finfo, $value['tmp_name']);
			if (strlen($type) && !in_array($type, $allowed_mime) && in_array($type, $illegal_mime)) 
			{
				return JText::_('PLG_KSRFORMFIELD_FILE_ERROR_WARNINVALID_FILE_MIME');
			}
			finfo_close($finfo);
		}
		elseif (function_exists('mime_content_type')) 
		{
			$type = mime_content_type($value['tmp_name']);
			if (strlen($type) && !in_array($type, $allowed_mime) && in_array($type, $illegal_mime)) 
			{
				return JText::_('PLG_KSRFORMFIELD_FILE_ERROR_WARNINVALID_FILE_MIME');
			}
		}
		copy($value['tmp_name'], $path . DS . $fileName);
		$fields[$field_params->id] = JUri::root() . 'media/com_ksenrequest/files/forms/' . $fileName;
		
		return;
	}
	
	public function onSetFieldRequestValue($field_params, $value)
	{
		if ($field_params->type != $this->_name)
		{
			return;
		}
		
		$value = !empty($value) ? '<a target="_blank" href="'.$value.'">'.$value.'</a>' : $value;

		return $value;		
	}
	
	function getForm($name)
	{
		JForm::addFormPath(JPATH_ROOT . '/plugins/ksrformfield/file/assets/forms');

		$form = JForm::getInstance('ksrformfield.file.'.$name, $name, array(
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