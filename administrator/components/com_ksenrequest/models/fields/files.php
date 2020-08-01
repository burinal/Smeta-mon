<?php
/**
 * @copyright   Copyright (C) 2013. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

class JFormFieldFiles extends JFormField 
{

	protected $type = 'Files';

	public function getInput() 
	{
		$session = JFactory::getSession();
		$document = JFactory::getDocument();
		$html = '';
		
		$html .= '<div class="files-lists">';
		$html .= '  <div class="row">';
		$html .= '	  <div class="positions">';
		
		foreach($this->value as $file) 
		{
			$url = JUri::root().'media/'.$this->element['extension'].'/files/'.$file->folder.'/'.$file->filename;
			
			$html .= '<div class="position">';
			$html .= '	<div class="col1">';
			$html .= '		<div class="name"><a target="_blank" href="'.$url.'">' . $file->title . '</a></div>';
			$html .= '	</div>';
			$html .= '	<a href="#" class="del"></a>';
			$html .= '	<input type="hidden" value="' . $file->ordering . '" class="ordering" name="' . $this->name . '[' . $file->id . '][ordering]" />';
			$html .= '	<input type="hidden" value="' . $file->filename . '" class="filename" name="' . $this->name . '[' . $file->id . '][filename]" />';
			$html .= '</div>';
		}

		$html .= '  	</div>';
		$html .= '  </div>';
		$html .= ' 	<div class="row">';
		$html .= '		<div class="progress">';
		$html .= ' 			<div class="progress-bar progress-bar-success"></div>';
		$html .= '		</div>';
		$html .= '		<a class="btn add fileinput-button">';
		$html .= '			<span>' . JText::_('KS_UPLOAD') . '</span>';
		$html .= '			<input class="fileupload" type="file" name="files" multiple data-name="'.$this->element['name'].'" data-extension="'.$this->element['extension'].'" data-session_id="'.$session->getId().'" data-session_name="'.$session->getName().'" data-token="'.JSession::getFormToken().'" data-upload_to="'.$this->element['upload_to'].'" data-upload_folder="'.$this->element['upload_folder'].'">';
		$html .= '		</a>';		
		$html .= '  </div>';		
		$html .= '</div>';

		$document->addScript(JUri::base() . 'components/com_ksen/assets/js/upload/jquery.ui.widget.js');
		$document->addScript(JUri::base() . 'components/com_ksen/assets/js/upload/jquery.iframe-transport.js');
		$document->addScript(JUri::base() . 'components/com_ksen/assets/js/upload/jquery.fileupload.js');
		$document->addScript(JUri::base() . 'components/com_ksen/assets/js/upload/uploadfiles.js');

		return $html;
	}

}