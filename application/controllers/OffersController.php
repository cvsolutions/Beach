<?php

class OffersController extends Zend_Controller_Action
{
    private $_form;
    
    public function init()
    {
        $this->_form = new Application_Form_Offers();
    }

    public function indexAction()
    {
        // action body
    }

    public function newAction()
    {
        $this->view->html_form = $this->_form;
    }

    public function editAction()
    {
        $this->view->html_form = $this->_form;
    }

    public function deleteAction()
    {
        // action body
    }


}







