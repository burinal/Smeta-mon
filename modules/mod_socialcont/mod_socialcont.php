<?php 
/**
* @package   SocialCont 2.0 module 21.10.2015
* @author    Sergey Pronin http://seregin-pro.ru/
* @copyright Copyright (C) SEREGIN-PRO. All rights reserved.
* @license   GNU General Public License version 2
*/
defined('_JEXEC') or die('Restricted access');

require_once dirname(__FILE__).'/helper.php';

$to =         $params->get('mail_to');
$view_mode	= $params->get('view_mode');
$panel_pos	= $params->get('panel_pos');
$buttons['vk']	= $params->get('vk');
$buttons['facebook']	= $params->get('facebook');
$buttons['twitter']	= $params->get('twitter');
$buttons['odn']	= $params->get('odn');
$buttons['gp']	= $params->get('gp');
$buttons['youtube'] = $params->get('youtube');
$buttons['instagram']	= $params->get('instagram');
$jquery	= $params->get('jquery');
$opacity_ico	= $params->get('opacity_ico');

require(JModuleHelper::getLayoutPath('mod_socialcont'));
?>