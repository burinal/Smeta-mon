<?php
defined('_JEXEC') or die;

JEventDispatcher::getInstance()->trigger('onLoadKsen', array('ksenrequest', array('common'), array(), array('angularJS' => 0)));
KSLoader::loadLocalHelpers(array('common'));
JPluginHelper::importPlugin('ksrformfield');

$lang = JFactory::getLanguage();
$lang->load('com_ksenrequest', JPATH_ROOT.'/components/com_ksenrequest', null, false, false) || $lang->load('com_ksenrequest', JPATH_ROOT, null, false, false);

JHtml::stylesheet('com_ksenrequest/form.css', false, true);
JHtml::script('com_ksenrequest/form.js', false, true);

require_once dirname(__file__) . '/helper.php';
$form_html = modKSRFormHelper::getFormHtml($params);

if (!empty($form_html))
{
	require JModuleHelper::getLayoutPath('mod_ksr_form', $params->get('layout', 'default'));	
}
