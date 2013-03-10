<?php

class LoginController extends Zend_Controller_Action
{

    private $_form = null;
    private $_confirm = 'OK';

    public function init()
    {
        $this->_form = new Application_Form_Auth();
        $this->_form->setDecorators(array('FormElements', 'Form'));
    }

    public function indexAction()
    {
        $this->view->html_form = $this->_form->Login();
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
        $this->view->html_form = $this->_form->Lost_Password();
        $form_data = $this->getRequest()->getPost();
        $pwd = rand();

        if($form_data)
        {
            if($this->_form->isValid($form_data))
            {
                $usermail = $this->_form->getValue('usermail');
                $this->_dbAuth = new Application_Model_DbTable_Auth();
                $row = $this->_dbAuth->Check_Email($usermail);

                $this->_dbAuth->Edit_Auth($row['id'], array('pwd' => sha1($pwd)));

                Plugin_Mail::Send(array(
                    'email'    => $usermail,
                    'subject'  => 'Nuove Credenziali portale',
                    'template' => 'registration.phtml',
                    'params'   => array(
                        'fullname' => $row['fullname'],
                        'usermail' => $row['usermail'],
                        'pwd'      => $pwd
                        )
                    ));

                $this->view->html_success = $this->_confirm;
                $this->view->headMeta()->appendHttpEquiv('refresh', '1; url=/login');

            } else {

                $this->_form->populate($form_data);
            }
        }
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







