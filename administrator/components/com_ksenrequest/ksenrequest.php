<?php
/**
 * @copyright   Copyright (C) 2013. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$dispatcher = JDispatcher::getInstance();
$dispatcher->trigger(
	'onLoadKsen',
	array(
		'ksenrequest.KSR',
		array('admin', 'common'),
		array(),
		array(
			'angularJS' => 0,
			'admin' => true,
			'plugins' => [],
		)
	)
);

KSLoader::loadLocalHelpers(array('common'));
JPluginHelper::importPlugin('ksrformfield');
KSSystem::loadJSLanguage();

$document = JFactory::getDocument();
$document->addStyleSheet(JURI::base() . 'components/com_ksenrequest/assets/css/style.css');

require_once JPATH_COMPONENT . '/controller.php';

$controller = JControllerLegacy::getInstance('KsenRequest');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();