<?php
defined('_JEXEC') or die;

if (!class_exists('KsenRequestModelForm'))
{
	require_once JPATH_ROOT.'/components/com_ksenrequest/models/form.php';
}
if (!class_exists('KsenRequestViewForm'))
{
	require_once JPATH_ROOT.'/components/com_ksenrequest/views/form/view.html.php';
}

class modKSRFormHelper 
{

	public static function getFormHtml($params = null)
	{
		$app = JFactory::getApplication();
		$form_id = $params->get('form');
		$id = $app->input->get('id', null);
		$app->input->set('id', $form_id);
		$controller = KSSystem::getController('form', 'ksenrequest');
		$model = $controller->getModel('form', 'ksenrequestModel');
		$view = $controller->getView('form', 'html');	
		$view->setModel($model, true);

		ob_start();
		echo $view->display();
		$form_html = ob_get_contents();
		ob_end_clean();			
		
		$app->input->set('id', $id);

		return $form_html;
	}

}