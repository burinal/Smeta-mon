<?php 
/**
 * @copyright   Copyright (C) 2013. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
 
defined('_JEXEC') or die;

class JFormFieldFormSteps extends JFormField 
{
	
	protected $type = 'FormSteps';
	
	public function getInput() 
	{
		$db = JFactory::getDBO();
		$document = JFactory::getDocument();
		$dispatcher = JDispatcher::getInstance();
		$html = '';
		
		if (empty($this->value))
		{
			$first_step = new stdClass();
			$first_step->id = -1; 
			$first_step->title = null; 
			$first_step->hide_title = 0; 
			$first_step->layout = null; 
			$first_step->button_text = JText::_('KSR_FORMS_FORM_STEP_BUTTON_SEND_LBL'); 
			$first_step->ordering = 1; 
			$first_step->fields = array(
				-1 => array(
					'id' => -1,
					'step_id' => -1,
					'type' => 'text',
					'title' => JText::_('KSR_FORMS_FORM_DEFAULT_FIELD_NAME_TITLE'),
					'params' => '{"placeholder":"1","system-name":"1"}',
					'class' => null,
					'required' => 1, 
					'published' => 1, 
					'requests_list' => 1,
					'ordering' => 1
				),
				-2 => array(
					'id' => -2,
					'step_id' => -1,
					'type' => 'email',
					'title' => JText::_('KSR_FORMS_FORM_DEFAULT_FIELD_EMAIL_TITLE'),
					'params' => '{"placeholder":"1","system-email":"1"}',
					'class' => null,
					'required' => 1, 
					'published' => 1, 
					'requests_list' => 1,
					'ordering' => 2
				),
				-3 => array(
					'id' => -3,
					'step_id' => -1,
					'type' => 'phone',
					'title' => JText::_('KSR_FORMS_FORM_DEFAULT_FIELD_PHONE_TITLE'),
					'params' => '{"placeholder":"1","system-phone":"1"}',
					'class' => null,
					'required' => 1, 
					'published' => 1, 
					'requests_list' => 1,
					'ordering' => 3
				)	
			); 
			
			$this->value = array(
				0 => $first_step
			);
		}
		
		$steps_class = count($this->value) > 1 ? 'can-delete' : '';
		$html .= '<div class="form-steps '.$steps_class.'">';
		$html .= '	<h3 class="headname">'.JText::_('KSR_FORMS_FORM_FIELDS_TITLE').'</h3>';
		
		$step_name = $this->name.'[{id}]';
		
		$html .= '<div class="form-step-mask active" data-id="{id}" data-name="'.$step_name.'">';
		$html .= '	<h4 class="headname"><span class="form-step-head-title">'.JText::_('KSR_FORMS_FORM_STEP_EMPTY_TITLE').'</span> <span class="form-step-head-title-hidden">'.JText::_('KSR_FORMS_FORM_STEP_HIDDEN_TITLE').'</span><a class="drag" href="#"></a><a class="ch" href="#"></a><a href="#" class="sh show"></a><a class="del" href="#">&times;</a></h4>';
		$html .= '	<div class="form-step-content">';
		$html .= '		<div class="row">';
		$html .= '			<ul class="form-step-fields">';
		$html .= '			</ul>';
		$html .= '		</div>';
		$html .= '		<div class="row">';
		$html .= '			<div class="form-step-button">';
		$html .= '				<label>'.JText::_('KSR_FORMS_FORM_STEP_BUTTON_TITLE').'</label>';
		$html .= '				<button type="button">'.JText::_('KSR_FORMS_FORM_STEP_BUTTON_SEND_LBL').'</button>';
		$html .= '				<a href="#" class="ch-inline">'.JText::_('KSR_FORMS_FORM_STEP_BUTTON_CHANGE_LBL').'</a>';
		$html .= '				<a href="#" class="ch"></a>';
		$html .= '			</div>';			
		$html .= '		</div>';			
		$html .= '		<div class="row">';
		$html .= '			<a href="#" class="add add-step-field">'.JText::_('KSR_FORMS_FORM_ADD_FIELD_LBL').'</a>';
		$html .= '			<a href="#" class="add add-step">'.JText::_('KSR_FORMS_FORM_ADD_STEP_LBL').'</a>';
		$html .= '		</div>';
		$html .= '	</div>';
		
		$html .= '	<div id="form-step-settings-{id}" class="popup-window" data-step-id="{id}">';
		$html .= '		<div class="popup-window-inner">';
		$html .= '			<div class="heading">';
		$html .= '				<h3>' . JText::_('KSR_FORMS_FORM_STEP_SETTINGS_TITLE') . '</h3>';
		$html .= '				<div class="save-close">';
		$html .= '					<button class="close" onclick="return false;"></button>';
		$html .= '				</div>';
		$html .= '			</div>';
		$html .= '			<div class="contents">';
		$html .= '				<div class="contents-inner">';
		$html .= '					<div class="row">';
		$html .= '						<label class="inputname">'.JText::_('KSR_FORMS_FORM_STEP_TITLE_LBL').'</label>';
		$html .= '						<fake-input type="text" name="'.$step_name.'[title]" class="inputbox form-step-title" value="">';
		$html .= '					</div>';
		$html .= '					<div class="row">';
		$html .= '						<label class="inputname">'.JText::_('KSR_FORMS_FORM_STEP_HIDE_TITLE_LBL').'</label>';
		$html .= '						<div class="checkb">';
		$html .= '							<fake-input type="checkbox" name="'.$step_name.'[hide_title]" class="form-step-hide-title" value="1">';
		$html .= '						</div>';				
		$html .= '					</div>';				
		$html .= '					<div class="row">';
		$html .= '						<label class="inputname">'.JText::_('KSR_FORMS_FORM_STEP_LAYOUT_LBL').'</label>';
		$html .= '						'.$this->getStepLayouts($step_name, null, true);
		$html .= '					</div>';	
		$html .= '				</div>';
		$html .= '			</div>';
		$html .= '		</div>';
		$html .= '	</div>';	
		
		$html .= '	<div id="form-step-button-settings-{id}" class="popup-window" data-step-id="{id}">';
		$html .= '		<div class="popup-window-inner">';
		$html .= '			<div class="heading">';
		$html .= '				<h3>' . JText::_('KSR_FORMS_FORM_STEP_BUTTON_SETTINGS_TITLE') . '</h3>';
		$html .= '				<div class="save-close">';
		$html .= '					<button class="close" onclick="return false;"></button>';
		$html .= '				</div>';
		$html .= '			</div>';
		$html .= '			<div class="contents">';
		$html .= '				<div class="contents-inner">';
		$html .= '					<div class="row">';
		$html .= '						<label class="inputname">'.JText::_('KSR_FORMS_FORM_STEP_BUTTON_TEXT_LBL').'</label>';
		$html .= '						<fake-input type="text" name="'.$step_name.'[button_text]" class="inputbox form-step-button-text" value="'.JText::_('KSR_FORMS_FORM_STEP_BUTTON_SEND_LBL').'">';
		$html .= '					</div>';
		$html .= '				</div>';
		$html .= '			</div>';
		$html .= '		</div>';
		$html .= '	</div>';	
		
		$html .= '	<fake-input type="hidden" name="'.$step_name.'[ordering]" class="form-step-ordering" value="">';
		$html .= '	<fake-input type="hidden" name="'.$step_name.'[id]" class="form-step-id" value="{id}">';
		$html .= '</div>';
		
		foreach($this->value as $step)
		{
			$step_name = $this->name.'['.$step->id.']';
			$step_title = !empty($step->title) ? $step->title : JText::_('KSR_FORMS_FORM_STEP_EMPTY_TITLE');
			$step_button_text = !empty($step->button_text) ? $step->button_text : JText::_('KSR_FORMS_FORM_STEP_BUTTON_SEND_LBL');
			
			$html .= '<div class="form-step active '.($step->hide_title && !empty($step->title) ? 'title-hidden' : '').'" data-id="'.$step->id.'" data-name="'.$step_name.'">';
			$html .= '	<h4 class="headname"><span class="form-step-head-title">'.$step_title.'</span> <span class="form-step-head-title-hidden">'.JText::_('KSR_FORMS_FORM_STEP_HIDDEN_TITLE').'</span><a class="drag" href="#"></a><a class="ch" href="#"></a><a href="#" class="sh show"></a><a class="del" href="#">&times;</a></h4>';
			$html .= '	<div class="form-step-content">';
			$html .= '		<div class="row">';
			$html .= '			<ul class="form-step-fields">';
			
			foreach($step->fields as $field)
			{
				$field['step_name'] = $step_name;
				
				$results = $dispatcher->trigger('onDisplayFieldParamsView', array($field));
				$html .= isset($results[0]) && $results[0] ? $results[0] : null;			
			}
			
			$html .= '			</ul>';
			$html .= '		</div>';
			$html .= '		<div class="row">';
			$html .= '			<div class="form-step-button">';
			$html .= '				<label>'.JText::_('KSR_FORMS_FORM_STEP_BUTTON_TITLE').'</label>';
			$html .= '				<button type="button">'.$step_button_text.'</button>';
			$html .= '				<a href="#" class="ch-inline">'.JText::_('KSR_FORMS_FORM_STEP_BUTTON_CHANGE_LBL').'</a>';
			$html .= '				<a href="#" class="ch"></a>';
			$html .= '			</div>';			
			$html .= '		</div>';			
			$html .= '		<div class="row">';
			$html .= '			<a href="#" class="add add-step-field">'.JText::_('KSR_FORMS_FORM_ADD_FIELD_LBL').'</a>';
			$html .= '			<a href="#" class="add add-step">'.JText::_('KSR_FORMS_FORM_ADD_STEP_LBL').'</a>';
			$html .= '		</div>';
			$html .= '	</div>';
			
			$html .= '	<div id="form-step-settings-'.$step->id.'" class="popup-window" data-step-id="'.$step->id.'">';
			$html .= '		<div class="popup-window-inner">';
			$html .= '			<div class="heading">';
			$html .= '				<h3>' . JText::_('KSR_FORMS_FORM_STEP_SETTINGS_TITLE') . '</h3>';
			$html .= '				<div class="save-close">';
			$html .= '					<button class="close" onclick="return false;"></button>';
			$html .= '				</div>';
			$html .= '			</div>';
			$html .= '			<div class="contents">';
			$html .= '				<div class="contents-inner">';
			$html .= '					<div class="row">';
			$html .= '						<label class="inputname">'.JText::_('KSR_FORMS_FORM_STEP_TITLE_LBL').'</label>';
			$html .= '						<input type="text" name="'.$step_name.'[title]" class="inputbox form-step-title" value="'.$step->title.'">';
			$html .= '					</div>';
			$html .= '					<div class="row">';
			$html .= '						<label class="inputname">'.JText::_('KSR_FORMS_FORM_STEP_HIDE_TITLE_LBL').'</label>';
			$html .= '						<div class="checkb">';
			$html .= '							<input type="checkbox" name="'.$step_name.'[hide_title]" class="form-step-hide-title" value="1" '.($step->hide_title ? 'checked' : '').'>';
			$html .= '						</div>';				
			$html .= '					</div>';				
			$html .= '					<div class="row">';
			$html .= '						<label class="inputname">'.JText::_('KSR_FORMS_FORM_STEP_LAYOUT_LBL').'</label>';
			$html .= '						'.$this->getStepLayouts($step_name, $step->layout);
			$html .= '					</div>';	
			$html .= '				</div>';
			$html .= '			</div>';
			$html .= '		</div>';
			$html .= '	</div>';	
			
			$html .= '	<div id="form-step-button-settings-'.$step->id.'" class="popup-window" data-step-id="'.$step->id.'">';
			$html .= '		<div class="popup-window-inner">';
			$html .= '			<div class="heading">';
			$html .= '				<h3>' . JText::_('KSR_FORMS_FORM_STEP_BUTTON_SETTINGS_TITLE') . '</h3>';
			$html .= '				<div class="save-close">';
			$html .= '					<button class="close" onclick="return false;"></button>';
			$html .= '				</div>';
			$html .= '			</div>';
			$html .= '			<div class="contents">';
			$html .= '				<div class="contents-inner">';
			$html .= '					<div class="row">';
			$html .= '						<label class="inputname">'.JText::_('KSR_FORMS_FORM_STEP_BUTTON_TEXT_LBL').'</label>';
			$html .= '						<input type="text" name="'.$step_name.'[button_text]" class="inputbox form-step-button-text" value="'.$step_button_text.'">';
			$html .= '					</div>';
			$html .= '				</div>';
			$html .= '			</div>';
			$html .= '		</div>';
			$html .= '	</div>';	
			
			$html .= '	<input type="hidden" name="'.$step_name.'[ordering]" class="form-step-ordering" value="'.$step->ordering.'">';
			$html .= '	<input type="hidden" name="'.$step_name.'[id]" class="form-step-id" value="'.$step->id.'">';
			$html .= '</div>';			
		}
		
		$html .= '</div>';
		
		$query = $db->getQuery(true);
		$query
			->select('name, element')
			->from('#__extensions')
			->where('folder = '.$db->q('ksrformfield'))
			->where('enabled = 1')
		;
		$db->setQuery($query);
		$field_types = $db->loadObjectList();
		
		$html.= '<div id="form-steps-field-types-list" class="popup-window">';
		$html.= '	<div class="popup-window-inner">';
		$html.= '		<div class="heading">';
		$html.= '			<h3>' . JText::_('KSR_FORMS_FORM_FIELD_TYPES_LBL') . '</h3>';
		$html.= '			<div class="save-close">';
		$html.= '				<button class="close" onclick="return false;"></button>';
		$html.= '			</div>';
		$html.= '		</div>';
		$html.= '		<div class="contents">';
		$html.= '			<div class="contents-inner">';
		$html.= '				<div class="slide_module">';
		$html.= '					<div class="row">';
		$html.= '						<ul>';
		foreach($field_types as $field_type) 
		{
			$html.= '						<li data-type="'.$field_type->element.'">';
			$html.= '							<label>' . JText::_($field_type->name) . '</label>';
			$html.= '						</li>';
		}
		$html.= '						</ul>';
		$html.= '					</div>';
		$html.= '				</div>';
		$html.= '			</div>';
		$html.= '		</div>';
		$html.= '	</div>';
		$html.= '</div>';
		
		$document->addScript(JURI::base() . 'components/com_ksenrequest/assets/js/jquery.formdata.js');		
		$document->addScript(JURI::base() . 'components/com_ksenrequest/assets/js/formsteps.js');		
		
		return $html;
	}
	
	protected function getStepLayouts($step_name, $selected, $fake = false)
	{
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);

		$query->select('e.element, e.name')
			->from('#__extensions as e')
			->where('e.client_id = 0')
			->where('e.type = ' . $db->quote('template'))
			->where('e.enabled = 1')
		;
		$db->setQuery($query);
		$templates = $db->loadObjectList('element');

		$component_path = JPath::clean(JPATH_ROOT . '/components/com_ksenrequest/views/form/tmpl');
		$component_layouts = array();
		$groups = array();

		if (is_dir($component_path) && ($component_layouts = JFolder::files($component_path, '^step_.*\.php$', false, true)))
		{
			$groups['_'] = array();
			$groups['_']['id'] = 'step_layout__';
			$groups['_']['text'] = JText::sprintf('JOPTION_FROM_COMPONENT');
			$groups['_']['items'] = array();

			foreach ($component_layouts as $i => $file)
			{
				$value = basename($file, '.php');
				$component_layouts[$i] = $value;
				$text = $value == 'step_default' ? JText::_('ksr_forms_form_step_default_layout_lbl') : $value;
				$groups['_']['items'][] = JHtml::_('select.option', '_:' . $value, $text);
			}
		}

		if ($templates)
		{
			foreach ($templates as $template)
			{
				$template_path = JPath::clean(JPATH_ROOT . '/templates/' . $template->element . '/html/com_ksenrequest/form');

				if (is_dir($template_path) && ($files = JFolder::files($template_path, '^step_.*\.php$', false, true)))
				{
					foreach ($files as $i => $file)
					{
						if (in_array(basename($file, '.php'), $component_layouts))
						{
							unset($files[$i]);
						}
					}

					if (count($files))
					{
						$groups[$template->name] = array();
						$groups[$template->name]['id'] = 'step_layout_' . $template->element;
						$groups[$template->name]['text'] = JText::sprintf('JOPTION_FROM_TEMPLATE', $template->name);
						$groups[$template->name]['items'] = array();

						foreach ($files as $file)
						{
							$value = basename($file, '.php');
							$text = $value;
							$groups[$template->name]['items'][] = JHtml::_('select.option', $template->element . ':' . $value, $text);
						}
					}
				}
			}
		}

		$html = array();
		$selected = array($selected);
		$attr = ' class="inputbox"';
		
		$html[] = JHtml::_('select.groupedlist', $groups, $step_name.'[layout]', array('id' => null, 'group.id' => 'id', 'list.attr' => $attr, 'list.select' => $selected));
		$html = implode($html);
		
		if ($fake)
		{
			$html = str_replace('select', 'fake-select', $html);
		}

		return $html;
	}
	
}
