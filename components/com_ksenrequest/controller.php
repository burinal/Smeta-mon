<?php
defined('_JEXEC') or die;

class KsenrequestController extends JControllerLegacy
{

	public function __construct($config = array())
	{
		parent::__construct($config);
	}

	public function display($cachable = false, $urlparams = false)
	{
		$cachable = true;
		$vName = $this->input->getCmd('view', 'form');
		$this->input->set('view', $vName);

		$safeurlparams = array(
			'id' => 'INT',
			'lang' => 'CMD',
			'Itemid' => 'INT'
		);

		parent::display($cachable, $safeurlparams);

		return $this;
	}
}
