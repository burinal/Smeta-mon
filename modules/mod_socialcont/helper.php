<?php 
/**
* @package   SocialCont module 11.11.2015
* @author    Sergey Pronin http://seregin-pro.ru/
* @copyright Copyright (C) SEREGIN-PRO. All rights reserved.
* @license   GNU General Public License version 2
*/

defined('_JEXEC') or die;

class modSocialcontHelper {
	
	public function getIcon($buttons){
		foreach($buttons as $button => $link){
			if($buttons[$button] != ''){
				$ln .= '<a rel="nofollow" target="_blank" href="' . $link . '">';
				$ln .= '<img class="opacity" src="modules/mod_socialcont/tmpl/img/' . $button . '.png"/></a>';
			}
        }		
	return $ln;
    }
	
	public function getHeightPanel($buttons){
		$i = 1;
		$result = 0;
		foreach($buttons as $button => $link){
			if($buttons[$button] != ''){
				$i++;
			}
        }
		$result = $i * 35 - 5;
		return $result;
	}
	
	public static function getAjax(){

		jimport('joomla.application.module.helper');
		$jinput = JFactory::getApplication()->input;
		
		if($jinput->get('name', '', 'string') != '' && 
		filter_var($jinput->get('email', '', 'string'), FILTER_VALIDATE_EMAIL) != '' && 
		$jinput->get('captcha', '', 'int') == '1' && $jinput->get('subject', '', 'string') != '' && $jinput->get('text', '', 'string') != ''){	
		
			$message['name']    = $jinput->get('name', '', 'string');
			$message['email']   = $jinput->get('email', '', 'string');
			$message['subject'] = $jinput->get('subject', '', 'string');
			$message['text']    = $jinput->get('text', '', 'string');
			$message['captcha'] = $jinput->get('captcha', '', 'int');
				
			$headers = "Content-type: text/plain; charset=utf-8\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "From:" . $message['email'] . "\r\n";
	
			if(mail($to, $message['subject'], 
				JText::_("MOD_SOCIALCONT_GREETING_MSG")."\r\n"
				.JText::_("MOD_SOCIALCONT_NAME_FORM")."\r\n========================================\r\n"
				.JText::_("MOD_SOCIALCONT_FROM_NAME") . $message['name'] . "\r\n"
				.JText::_("MOD_SOCIALCONT_TEXT_MSG")."\r\n-----------------\r\n" . $message['text'] ."\n========================================\r\n"
				.JText::_("MOD_SOCIALCONT_END_MSG")."\r\n", $headers)){
				
				return array(
					"num" => 0, 
					"message" => JText::_("MOD_SOCIALCONT_SUCCESS"));			
			}
			else{
				return array(
					"num" => 1, 
					"message" => JText::_("MOD_SOCIALCONT_ERROR"));
			}
		}
		else{
			return array(
				"num" => 2, 
				"message" => JText::_("MOD_SOCIALCONT_WARNING"));
		}		
	}
}
?>