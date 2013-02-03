<?php

class LoginController extends Zend_Controller_Action
{

    private $_form = null;

    public function init()
    {
        $this->_form = new Application_Form_Auth();
    }

    public function indexAction()
    {
        $this->view->html_form = $this->_form->login();
    }

    public function lostpasswordAction()
    {
        $this->view->html_form = $this->_form->lost_password();
    }

    public function logoutAction()
    {
        // action body
    }


}





