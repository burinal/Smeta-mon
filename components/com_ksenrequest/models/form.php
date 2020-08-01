<?php 
/**
 * @copyright   Copyright (C) 2013. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
 
defined('_JEXEC') or die;

KSSystem::import('models.modelksform');

class KsenRequestModelForm extends JModelKSForm 
{
	
	var $context = 'com_ksenrequest';
	var $app = null;
	var $db = null;
    
	public function __construct()
	{
		parent::__construct();
		
		$this->app = JFactory::getApplication();
		$this->db = JFactory::getDbo();
	}
	
	protected function populateState($ordering = null, $direction = null)
	{
		$this->onExecuteBefore('populateState', array());
		
		$id = $this->app->input->get('id', null, 'int');
		$this->setState('form.id', $id);
		
		$step_id = $this->app->input->get('step_id', 0, 'int');
		$this->setState('form.step_id', $step_id);		
		
		$this->onExecuteAfter('populateState', array());
	}	
    
	public function getKsrForm()
	{
		$this->onExecuteBefore('getKsrForm', array());
		
		$id = $this->getState('form.id');
		
        $query = $this->db->getQuery(true);
        $query
            ->select('*')
            ->from('#__ksenrequest_forms')
            ->where('id = '.$this->db->q($id))
        ;
        $this->db->setQuery($query);
        $form = $this->db->loadObject();
        
		$form->tags = new JHelperTags;
		$form->tags->getItemTags('com_ksenrequest.forms', $form->id);

		$this->onExecuteAfter('getKsrForm', array(&$form));
		return $form;
	}
	
	public function getStep()
	{
		$this->onExecuteBefore('getStep', array());
		
		$dispatcher = JDispatcher::getInstance();
		$form_id = $this->getState('form.id');
		$step_id = $this->getState('form.step_id');
		
        $query = $this->db->getQuery(true);
        $query
            ->select('*')
            ->from('#__ksenrequest_forms_steps')
            ->where('form_id = '.$this->db->q($form_id))
            ->where('id > '.$this->db->q($step_id))
			->order('ordering asc')
        ;
        $this->db->setQuery($query);
        $step = $this->db->loadObject();
		
		if (empty($step))
		{
			return false;
		}
		
		$query = $this->db->getQuery(true);
		$query
			->select('*')
			->from('#__ksenrequest_forms_steps_fields')
			->where('step_id = '.$this->db->q($step->id))
			->where('published = 1')
			->order('ordering asc')
		;
		$this->db->setQuery($query);
		$step->fields = $this->db->loadObjectList('title');	
		
		foreach($step->fields as &$field)
		{
			$results = $dispatcher->trigger('onDisplayFieldView', array($field));
			$field->html = isset($results[0]) && $results[0] ? $results[0] : null;	
		}

		$this->onExecuteAfter('getStep', array(&$step));
		return $step;
	}	
	
	public function validateFields(&$fields, $files)
	{
		$dispatcher = JDispatcher::getInstance();
		
		foreach($fields as $key => $value)
		{
			$query = $this->db->getQuery(true);
			$query
				->select('*')
				->from('#__ksenrequest_forms_steps_fields')
				->where('id = '.$this->db->q($key))
			;
			$this->db->setQuery($query);
			$field = $this->db->loadObject();
				
			$results = $dispatcher->trigger('onValidateFieldValue', array(&$fields, $field, $value));
			$error = isset($results[0]) && $results[0] ? $results[0] : null;	
			
			if (!empty($error))
			{
				$this->setError($error);
				return false;
			}
		}
		
		foreach($files as $key => $file)
		{
			$query = $this->db->getQuery(true);
			$query
				->select('*')
				->from('#__ksenrequest_forms_steps_fields')
				->where('id = '.$this->db->q($key))
			;
			$this->db->setQuery($query);
			$field = $this->db->loadObject();
				
			$results = $dispatcher->trigger('onValidateFieldValue', array(&$fields, $field, $file));
			$error = isset($results[0]) && $results[0] ? $results[0] : null;	
			
			if (!empty($error))
			{
				$this->setError($error);
				return false;
			}		
		}	
		
		return true;
	}
	
	public function createRequest($fields)
	{
		$this->onExecuteBefore('createRequest', array($fields));
		
		$session = JFactory::getSession();
		$dispatcher = JDispatcher::getInstance();
		$form_id = $this->getState('form.id');	
		$url = $_SERVER['HTTP_REFERER'];
		$utm = $session->get('com_ksenmart.utmtags', null);
		$referer = $session->get('com_ksenmart.referer', null);		
		$date = \JFactory::getDate();
		
		$query = $this->db->getQuery(true);
		$query
			->insert('#__ksenrequest_requests')
			->set('form_id = '.$form_id)
			->set('fields = '.$this->db->q(json_encode($fields)))
			->set('url = '.$this->db->q($url))
			->set('utm = '.$this->db->q($utm))
			->set('referer = '.$this->db->q($referer))
			->set('created = '.$this->db->q($date->toSql()))
		;
		$this->db->setQuery($query);
		$this->db->execute();	
		$request_id = $this->db->insertid();
		
		$form = $this->getKsrForm();
		$name = null;
		$email = null;
		$phone = null;
		foreach ($fields as $key => $value) 
		{
			$query = $this->db->getQuery(true);
			$query
				->select('*')
				->from('#__ksenrequest_forms_steps_fields')
				->where('id = '.$this->db->q($key))
			;
			$this->db->setQuery($query);
			$field = $this->db->loadObject();
			
			$results = $dispatcher->trigger('onSetFieldRequestValue', array($field, $value));
			$value = isset($results[0]) && $results[0] ? $results[0] : null;	
			$field->value = !empty($value) ? $value : JText::_('KSR_REQUEST_FIELD_VALUE_EMPTY');
			$field->params = json_decode($field->params, true);
			$fields[$key] = $field;
			
			if (isset($field->params['system-name']) && $field->params['system-name'])
			{
				$name = $field->value;
			}
			if (isset($field->params['system-email']) && $field->params['system-email'])
			{
				$email = $field->value;
			}
			if (isset($field->params['system-phone']) && $field->params['system-phone'])
			{
				$phone = $field->value;
			}			
		}		

		$request_email = JComponentHelper::getParams('com_ksenrequest')->get('request_email');
		$config = new JConfig();
		
		if (!empty($request_email)) 
		{
			$content = KSSystem::loadTemplate(array('request_id' => $request_id, 'fields' => $fields, 'form' => $form, 'url' => $url), 'form', 'admin', 'mail');
			
			$mailfrom = $config->mailfrom;
			$sitename = $config->sitename;
			$sender = array($mailfrom, $sitename);

			$mailer = JFactory::getMailer();
			$mailer->isHtml(true);
			$mailer->setSender($sender);
			$mailer->Subject = JText::sprintf('KSR_REQUEST_ADMIN_MAIL_SUBJECT', $request_id);
			$mailer->Body = $content;
			$mailer->addAddress($request_email, $sitename);	
			$mailer->Send();
		}
		
		if (!empty($email) && !empty($form->thanks_mail))
		{
			$content = $form->thanks_mail;
			foreach($fields as $field)
			{
				$content = str_replace('{'.$field->title.'}', $field->value, $content);
			}
			
			$mailfrom = $config->mailfrom;
			$sitename = $config->sitename;
			$sender = array($mailfrom, $sitename);
			
			$query = $this->db->getQuery(true);
			$query
				->select('*')
				->from('#__ksenrequest_files')
				->where('owner_type = '.$this->db->q('form'))
				->where('owner_id = '.$this->db->q($form->id))
			;
			$this->db->setQuery($query);
			$files = $this->db->loadObjectList();			

			$mailer = JFactory::getMailer();
			$mailer->isHtml(true);
			$mailer->setSender($sender);
			$mailer->Subject = JText::sprintf('KSR_REQUEST_USER_MAIL_SUBJECT', $request_id);
			$mailer->Body = $content;
			$mailer->addAddress($email, $name);	
			
			foreach($files as $file)
			{
				$path = JPATH_ROOT.'/media/com_ksenrequest/files/'.$file->folder.'/'.$file->filename;
				$mailer->addAttachment($path);
			}
			
			$mailer->Send();	
		}
		
		$bitrix_login = JComponentHelper::getParams('com_ksenrequest')->get('bitrix_login');
		$bitrix_password = JComponentHelper::getParams('com_ksenrequest')->get('bitrix_password');
		$bitrix_url = JComponentHelper::getParams('com_ksenrequest')->get('bitrix_url');
		if (!empty($bitrix_login) && !empty($bitrix_password) && !empty($bitrix_url)) 
		{
			$comments = '';
			foreach($fields as $field)
			{
				$comments .= $field->title . ': ' . $field->value . '<br/>';
			}

			$vars = array(
				'LOGIN' => $bitrix_login,
				'PASSWORD' => $bitrix_password,
				'TITLE' => JText::sprintf('KSR_REQUEST_ADMIN_BITRIX_SUBJECT', $request_id, $form->title),
				'SOURCE_ID' => $form->source,
				'NAME' => $name,
				'EMAIL_HOME' => $email,
				'PHONE_HOME' => $phone,
				'SOURCE_DESCRIPTION' => $comments
			);
			$vars = http_build_query($vars);
			$context = array(
				'http' => array(
					'method' => 'POST',
					'header' => 'Content-Type: application/x-www-form-urlencoded' . PHP_EOL,
					'content' => $vars,
				),
			);
			$context  = stream_context_create($context);
			$response = file_get_contents($bitrix_url . '/crm/configs/import/lead.php', false, $context);
		}		
		
		$this->onExecuteAfter('createRequest', array(&$request_id));
		return $request_id;
	}

}
