<?php
/**
 * @copyright   Copyright (C) 2013. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

KSSystem::import('models.modelksadmin');

class KsenRequestModelForms extends JModelKSAdmin
{

	public function __construct()
	{
		parent::__construct();
		$this->ext_name_com = 'com_ksenrequest';
		$this->ext_prefix   = 'KsenrequestTable';
	}

	protected function populateState()
	{
		$this->onExecuteBefore('populateState');

		$app = JFactory::getApplication();

		$value = $app->getUserStateFromRequest($this->context . 'list.limit', 'limit', $this->params->get('admin_product_limit', 30), 'uint');
		$limit = $value;
		$this->setState('list.limit', $limit);

		$value      = $app->getUserStateFromRequest($this->context . '.limitstart', 'limitstart', 0);
		$limitstart = ($limit != 0 ? (floor($value / $limit) * $limit) : 0);
		$this->setState('list.start', $limitstart);

		$order_dir = $app->getUserStateFromRequest($this->context . '.order_dir', 'order_dir', 'asc');
		$this->setState('order_dir', $order_dir);
		$order_type = $app->getUserStateFromRequest($this->context . '.order_type', 'order_type', 'ordering');
		$this->setState('order_type', $order_type);

		$this->onExecuteAfter('populateState');
	}

	function getListItems()
	{
		$this->onExecuteBefore('getListItems');

		$order_dir  = $this->getState('order_dir');
		$order_type = $this->getState('order_type');

		$query = $this->_db->getQuery(true);
		$query->select('SQL_CALC_FOUND_ROWS f.*')->from('#__ksenrequest_forms AS f')->order($order_type . ' ' . $order_dir);
		$query->group('f.id');
		$this->_db->setQuery($query, $this->getState('list.start'), $this->getState('list.limit'));
		$items = $this->_db->loadObjectList();
		$query = $this->_db->getQuery(true);
		$query->select('FOUND_ROWS()');
		$this->_db->setQuery($query);
		$this->total = $this->_db->loadResult();

		$this->onExecuteAfter('getListItems', array(&$items));

		return $items;
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

		foreach ($ids as $id)
		{
			$query = $this->_db->getQuery(true);
			$query->delete('#__ksenrequest_forms')->where('id=' . $id);
			$this->_db->setQuery($query);
			$this->_db->execute();

			$query = $this->_db->getQuery(true);
			$query
				->select('id')
				->from('#__ksenrequest_forms_steps')
				->where('form_id = ' . $id)
				->order('ordering asc');
			$this->_db->setQuery($query);
			$step_ids = $this->_db->loadColumn();

			foreach ($step_ids as $step_id)
			{
				$query = $this->_db->getQuery(true);
				$query->delete('#__ksenrequest_forms_steps_fields')->where('step_id=' . $step_id);
				$this->_db->setQuery($query);
				$this->_db->execute();
			}

			$query = $this->_db->getQuery(true);
			$query->delete('#__ksenrequest_forms_steps')->where('form_id=' . $id);
			$this->_db->setQuery($query);
			$this->_db->execute();

			KSMedia::deleteItemMedia($id, 'form');
		}

		$this->onExecuteAfter('deleteListItems', array(&$ids));

		return true;
	}

	function copyListItems($form_ids)
	{
		$this->onExecuteBefore('copyListItems', array(&$form_ids));

		foreach ($form_ids as $form_id)
		{
			$table = $this->getTable('Forms');
			$table->load($form_id);
			$table->id    = null;
			$table->title .= ' (1)';
			if (!$table->store())
			{
				return false;
			}
			$new_form_id = $table->id;

			$query = $this->_db->getQuery(true);
			$query
				->select('id')
				->from('#__ksenrequest_forms_steps')
				->where('form_id = ' . $form_id)
				->order('ordering asc');
			$this->_db->setQuery($query);
			$step_ids = $this->_db->loadColumn();

			foreach ($step_ids as $step_id)
			{
				$stable = $this->getTable('FormsSteps');
				$stable->load($step_id);
				$stable->form_id = $new_form_id;
				$stable->id      = null;

				if (!$stable->store())
				{
					return false;
				}
				$new_step_id = $stable->id;

				$query = $this->_db->getQuery(true);
				$query
					->select('id')
					->from('#__ksenrequest_forms_steps_fields')
					->where('step_id = ' . $step_id)
					->order('ordering asc');
				$this->_db->setQuery($query);
				$field_ids = $this->_db->loadColumn();

				foreach ($field_ids as $field_id)
				{
					$ftable = $this->getTable('FormsStepsFields');
					$ftable->load($field_id);
					$ftable->step_id = $new_step_id;
					$ftable->id      = null;

					if (!$ftable->store())
					{
						return false;
					}
				}
			}

			$query = $this->_db->getQuery(true);
			$query->select('id')->from('#__ksenrequest_files')->where('owner_id=' . $form_id)->where('owner_type = ' . $this->_db->q('form'));
			$this->_db->setQuery($query);
			$file_ids = $this->_db->loadColumn();
			foreach ($file_ids as $file_id)
			{
				$ftable = $this->getTable('Files');
				$ftable->load($file_id);
				$old_filename     = $ftable->filename;
				$filename         = $ftable->filename;
				$filename         = explode('.', $filename);
				$filename         = microtime(true) . '.' . $filename[count($filename) - 1];
				$ftable->filename = $filename;
				$ftable->owner_id = $new_form_id;
				$ftable->id       = null;

				if ($ftable->store())
				{
					if ($ftable->media_type == 'image')
					{
						copy(JPATH_ROOT . DS . 'media' . DS . 'com_ksenrequest' . DS . 'images' . DS . $ftable->folder . DS . 'original' . DS . $old_filename, JPATH_ROOT . DS . 'media' . DS . 'com_ksenmart' . DS . 'images' . DS . $ftable->folder . DS . 'original' . DS . $filename);
					}
					elseif ($ftable->media_type == 'file')
					{
						copy(JPATH_ROOT . DS . 'media' . DS . 'com_ksenrequest' . DS . 'files' . DS . $ftable->folder . DS . $old_filename, JPATH_ROOT . DS . 'media' . DS . 'com_ksenmart' . DS . 'files' . DS . $ftable->folder . DS . $filename);
					}
				}
				else
				{
					return false;
				}
			}
		}

		$this->onExecuteAfter('copyListItems', array(&$form_ids));

		return true;
	}

	function getKSForm($categories = array())
	{
		$this->onExecuteBefore('getKSForm', array(&$categories));

		$id   = JFactory::getApplication()->input->getInt('id');
		$form = KSSystem::loadDbItem($id, 'forms', 'Ksenrequest');
		$form = KSMedia::setItemMedia($form, 'form');

		$query = $this->_db->getQuery(true);
		$query
			->select('*')
			->from('#__ksenrequest_forms_steps')
			->where('form_id = ' . (int) $id)
			->order('ordering asc');
		$this->_db->setQuery($query);
		$form->steps = $this->_db->loadObjectList();

		foreach ($form->steps as $key => $step)
		{
			$query = $this->_db->getQuery(true);
			$query
				->select('*')
				->from('#__ksenrequest_forms_steps_fields')
				->where('step_id = ' . $step->id)
				->order('ordering asc');
			$this->_db->setQuery($query);
			$form->steps[$key]->fields = $this->_db->loadAssocList();
		}

		$tagsHelper = new JHelperTags;
		$form->tags = $tagsHelper->getTagIds(array($form->id), 'com_ksenrequest.form');

		$this->onExecuteAfter('getKSForm', array(&$form));

		return $form;
	}

	function saveForm($data)
	{
		$this->onExecuteBefore('saveForm', array(&$data));
		
		$data['thanks_modal'] = isset($data['thanks_modal']) ? $data['thanks_modal'] : 0;
		$data['published'] = isset($data['published']) ? $data['published'] : 0;
		
		$table = $this->getTable('Forms');
		if (empty($data['id']))
		{
			$query = $this->_db->getQuery(true);
			$query->update('#__ksenrequest_forms')->set('ordering = ordering + 1');
			$this->_db->setQuery($query);
			$this->_db->execute();
		}

		if ((!empty($data['tags']) && $data['tags'][0] != ''))
		{
			$table->newTags = $data['tags'];
		}

		if (!$table->bindCheckStore($data))
		{
			$this->setError($table->getError());

			return false;
		}
		$id = $table->id;
		KSMedia::saveItemMedia($id, $data, 'form', 'forms');

		$in_steps = array();
		foreach ($data['steps'] as $key => $step)
		{
			$table = $this->getTable('FormsSteps');

			$step['form_id']    = $id;
			$step['hide_title'] = isset($step['hide_title']) ? $step['hide_title'] : 0;
			if ($step['id'] < 0)
			{
				unset($step['id']);
			}

			if (!$table->bindCheckStore($step))
			{
				$this->setError($table->getError());

				return false;
			}
			$step_id    = $table->id;
			$in_steps[] = $step_id;

			$in_fields = array();
			if (empty($step['fields']))
			{
				$step['fields'] = [];
			}

			foreach ($step['fields'] as $key => $field)
			{
				$table = $this->getTable('FormsStepsFields');

				$field['step_id'] = $step_id;
				if ($field['id'] < 0)
				{
					unset($field['id']);
				}

				if (!$table->bindCheckStore($field))
				{
					$this->setError($table->getError());

					return false;
				}
				$field_id    = $table->id;
				$in_fields[] = $field_id;
			}

			$query = $this->_db->getQuery(true);
			$query->delete('#__ksenrequest_forms_steps_fields')->where('step_id = ' . $step_id);
			if (count($in_fields))
			{
				$query->where('id not in (' . implode(',', $in_fields) . ')');
			}
			$this->_db->setQuery($query);
			$this->_db->execute();
		}

		$query = $this->_db->getQuery(true);
		$query->select('id')->from('#__ksenrequest_forms_steps')->where('form_id = ' . $id);
		if (count($in_steps))
		{
			$query->where('id not in (' . implode(',', $in_steps) . ')');
		}
		$this->_db->setQuery($query);
		$stepsIds = $this->_db->loadColumn();

		if (!empty($stepsIds))
		{
			$query = $this->_db->getQuery(true);
			$query->delete('#__ksenrequest_forms_steps')->where('id IN (' . implode(',', $stepsIds) . ')');
			$this->_db->setQuery($query);
			$this->_db->execute();

			$query = $this->_db->getQuery(true);
			$query->delete('#__ksenrequest_forms_steps_fields');
			$query->where('step_id IN (' . implode(',', $stepsIds) . ')');
			$this->_db->setQuery($query);
			$this->_db->execute();
		}

		$on_close = 'window.parent.FormsList.refreshList();                                       ';
		$return   = array('id' => $id, 'on_close' => $on_close);

		$this->onExecuteAfter('saveForm', array(&$return));

		return $return;
	}

}
