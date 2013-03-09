<?php

class LoginController extends Zend_Controller_Action
{

    private $_form = null;

    public function init()
    {
        $this->_form = new Application_Form_Auth();
        $this->_form->setDecorators(array('FormElements', 'Form'));
    }

    public function indexAction()
    {
        $this->view->html_form = $this->_form->login();
        $auth = Zend_Auth::getInstance();
        if($auth->hasIdentity()) $this->redirect('/dashboard');
        $form_data = $this->getRequest()->getPost();

        if($form_data)
        {
            if($this->_form->isValid($form_data))
            {
                $db = Zend_Db_Table::getDefaultAdapter();
                $adapter = new Zend_Auth_Adapter_DbTable($db);
                $adapter->setTableName('beach_auth');
                $adapter->setIdentityColumn('usermail');
                $adapter->setCredentialColumn('pwd');
                $adapter->setCredentialTreatment('SHA1(?) AND status = 1');

                $username = $this->_form->getValue('usermail');
                $password = $this->_form->getValue('pwd');
                $adapter->setIdentity($username);
                $adapter->setCredential($password);

                $result = $auth->authenticate($adapter);
                if($result->isValid())
                {
                    $user = $adapter->getResultRowObject();
                    $auth->getStorage()->write($user);
                    $this->redirect('/dashboard');

                } else {

                    $this->view->html_error = 'Indirizzo E-mail o Password non validi';
                }

            } else {

                $this->_form->populate($form_data);
            }
        }
    }

    public function lostpasswordAction()
    {
        $this->view->html_form = $this->_form->lost_password();
    }

    public function logoutAction()
    {
        Zend_Auth::getInstance()->clearIdentity();
        session_destroy();
        $this->redirect('/');
    }

    public function notauthorizedAction()
    {
        // action body
    }


}







