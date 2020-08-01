<?php
defined('_JEXEC') or die;

KSSystem::import('views.viewksadmin');

class KsenRequestViewForms extends JViewKSAdmin
{
	
    function display($tpl = null) 
	{
		$this->path->addItem(JText::_('ksr_panel'), 'index.php?option=com_ksen&extension=com_ksenrequest');
        $this->path->addItem(JText::_('ksr_forms'));
				
        switch ($this->getLayout()) 
		{
            case 'form':
                $this->document->addScript(JURI::base() . 'components/com_ksenrequest/assets/js/form.js');
                $model = $this->getModel();
                $this->ksform = $model->getKSForm();
                $model->form = 'form';
                $form = $model->getForm();
                if($form) $form->bind($this->ksform);
                $this->title = JText::_('ksr_forms_form_editor');
                $this->form = $form;
            break;
            
            default:
                $this->items = $this->get('ListItems');
                $this->total = $this->get('Total');
        }

        parent::display($tpl);
    }
	
}
