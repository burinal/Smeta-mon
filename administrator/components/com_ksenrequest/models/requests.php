<?php 
/**
 * @copyright   Copyright (C) 2013. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
 
defined('_JEXEC') or die;

KSSystem::import('models.modelksadmin');

class KsenRequestModelRequests extends JModelKSAdmin 
{

    function populateState() 
	{
        $this->onExecuteBefore('populateState');

        $app = JFactory::getApplication();
		
        $value = $app->getUserStateFromRequest($this->context . 'list.limit', 'limit', $this->params->get('admin_product_limit', 30), 'uint');
        $limit = $value;
        $this->setState('list.limit', $limit);

        $value = $app->getUserStateFromRequest($this->context . '.limitstart', 'limitstart', 0);
        $limitstart = ($limit != 0 ? (floor($value / $limit) * $limit) : 0);
        $this->setState('list.start', $limitstart);

        $order_dir = $app->getUserStateFromRequest($this->context . '.order_dir', 'order_dir', 'desc');
        $this->setState('order_dir', $order_dir);
        $order_type = $app->getUserStateFromRequest($this->context . '.order_type', 'order_type', 'id');
        $this->setState('order_type', $order_type);

        $this->onExecuteAfter('populateState');
    }

    function getListItems() 
	{
        $this->onExecuteBefore('getListItems');

		$dispatcher = JDispatcher::getInstance();
        $order_dir = $this->getState('order_dir');
        $order_type = $this->getState('order_type');
        $query = $this->_db->getQuery(true);
        $query
			->select('SQL_CALC_FOUND_ROWS r.*, f.title as form_title')
			->from('#__ksenrequest_requests as r')
			->leftjoin('#__ksenrequest_forms as f ON f.id = r.form_id')
			->order('r.' . $order_type . ' ' . $order_dir)
		;
        $this->_db->setQuery($query, $this->getState('list.start'), $this->getState('list.limit'));
        $requests = $this->_db->loadObjectList();
		
		foreach($requests as &$request)
		{
			$request->created = date('d.m.Y', strtotime($request->created));
			
			$fields = json_decode($request->fields, true);
			$request->fields = array();
			foreach($fields as $key => $value)
			{
				$query = $this->_db->getQuery(true);
				$query
					->select('*')
					->from('#__ksenrequest_forms_steps_fields')
					->where('id = '.$this->_db->q($key))
				;
				$this->_db->setQuery($query);
				$field = $this->_db->loadObject();
				
				if (empty($field) || !$field->requests_list)
				{
					continue;
				}
				
				$results = $dispatcher->trigger('onSetFieldRequestValue', array($field, $value));
				$field->value = isset($results[0]) && $results[0] ? $results[0] : null;	
				$field->value = !empty($field->value) ? $field->value : JText::_('KSR_REQUESTS_REQUEST_FIELD_VALUE_EMPTY');
				
				$request->fields[] = $field;
			}
		}
		
        $query = $this->_db->getQuery(true);
        $query->select('FOUND_ROWS()');
        $this->_db->setQuery($query);
        $this->total = $this->_db->loadResult();

        $this->onExecuteAfter('getListItems', array(&$requests));
        return $requests;
    }

    function getTotal() 
	{
        $this->onExecuteBefore('getTotal');

        $total = $this->total;

        $this->onExecuteAfter('getTotal', array(&$total));
        return $total;
    }

    function deleteListItems($ids) 
	{
        $this->onExecuteBefore('deleteListItems', array(&$ids));

        foreach($ids as $id) {
            $query = $this->_db->getQuery(true);
            $query->delete('#__ksenrequest_requests')->where('id=' . $id);
            $this->_db->setQuery($query);
            $this->_db->execute();
        }

        $this->onExecuteAfter('deleteListItems', array(&$ids));
        return true;
    }

    function getRequest($vars = array()) 
	{
        $this->onExecuteBefore('getRequest', array(&$vars));

        $id = JFactory::getApplication()->input->getInt('id');
        $request = KSSystem::loadDbItem($id, 'requests');
		
        $query = $this->_db->getQuery(true);
        $query
			->select('title')
			->from('#__ksenrequest_forms')
			->where('id = ' . (int)$request->form_id)
		;
        $this->_db->setQuery($query);
        $request->form_title = $this->_db->loadResult();
		
        $request->fields = json_decode($request->fields, true);
	    $request->utm = json_decode($request->utm);

        $this->onExecuteAfter('getRequest', array(&$request));
        return $request;
    }

}