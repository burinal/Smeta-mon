<?php 
/**
 * @copyright   Copyright (C) 2013. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
 
defined('_JEXEC') or die;

use Joomla\CMS\Application\ApplicationHelper;

KSSystem::import('tables.ksentable');

class KsenrequestTableForms extends KsenTable 
{
    
    public function __construct(\JDatabaseDriver $db) 
	{
        parent::__construct('#__ksenrequest_forms', 'id', $db);
		
		JTableObserverTags::createObserver($this, array('typeAlias' => 'com_ksenrequest.form'));
		JTableObserverContenthistory::createObserver($this, array('typeAlias' => 'com_ksenrequest.form'));
    }
	
	public function check()
	{
		if (trim($this->alias) == '')
		{
			$this->alias = $this->title;
		}

		$this->alias = ApplicationHelper::stringURLSafe($this->alias);

		if (trim(str_replace('-', '', $this->alias)) == '')
		{
			$this->alias = \JFactory::getDate()->format('Y-m-d-H-i-s');
		}
		
		return true;
	}
	
	public function store($updateNulls = false)
	{
		$date = \JFactory::getDate();

		if (!$this->id)
		{
			$this->created = $date->toSql();
		}
		
		return parent::store($updateNulls);
	}
		
}