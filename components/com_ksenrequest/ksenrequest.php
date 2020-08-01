<?php 
/**
 * @copyright   Copyright (C) 2013. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
 
defined('_JEXEC') or die;

jimport('joomla.application.component.controller');

$dispatcher = JEventDispatcher::getInstance();
$dispatcher->trigger('onLoadKsen', array('ksenrequest.KSR', array('common'), array(), array('angularJS' => 0, 'plugins' => [])));
$dispatcher->trigger('onBeforeStartComponent',array());
JPluginHelper::importPlugin('krplugins');
JPluginHelper::importPlugin('ksrformfield');

$controller = JControllerLegacy::getInstance('KsenRequest');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();