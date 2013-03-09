<?php

class DashboardController extends Zend_Controller_Action
{

	public function init()
	{
		/* Initialize action controller here */
	}

	public function indexAction()
	{
		$auth = Zend_Auth::getInstance();
		$identity = $auth->getStorage()->read();
		$this->view->identity = $identity;
	}


}

