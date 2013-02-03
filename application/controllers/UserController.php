<?php

class UserController extends Zend_Controller_Action
{
    private $_form;

    public function init()
    {
        $this->_form = new Application_Form_Auth();
    }

    public function indexAction()
    {
        // action body
    }

    public function newAction()
    {
        $this->view->html_form = $this->_form->new_beach();
    }

    public function fulleditAction()
    {
        $this->view->html_form = $this->_form->full_edit_beach();
    }

    public function deleteAction()
    {
        // action body
    }

    public function editAction()
    {
        $this->view->html_form = $this->_form->edit_beach();
    }


}









