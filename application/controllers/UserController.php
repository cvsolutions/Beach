<?php

class UserController extends Zend_Controller_Action
{
    private $_form;
    private $_confirm = 'OK';

    public function init()
    {
        $this->_form = new Application_Form_Auth();
        $this->_form->setDecorators(array('FormElements', 'Form'));
        
        $this->_dbAuth = new Application_Model_DbTable_Auth();
    }

    public function indexAction()
    {
        $this->view->users = $this->_dbAuth->Full_Auth();
    }

    public function newAction()
    {
        $this->view->html_form = $this->_form->New_Beach();
        $form_data = $this->getRequest()->getPost();
        $pwd = rand();

        if($form_data)
        {
            if($this->_form->isValid($form_data))
            {
                $this->_dbAuth->New_Auth(array(
                    'id'        => mt_rand(11111, 99999),
                    'fullname'  => $this->_form->getValue('fullname'),
                    'usermail'  => $this->_form->getValue('usermail'),
                    'pwd'       => sha1($pwd),
                    'latitude'  => $this->_form->getValue('latitude'),
                    'longitude' => $this->_form->getValue('longitude'),
                    'longitude' => $this->_form->getValue('longitude'),
                    'role'      => 'user',
                    'entry'     => new Zend_Db_Expr('NOW()'),
                    'status'    => 1
                    ));

                Plugin_Mail::Send(array(
                    'email'    => $this->_form->getValue('usermail'),
                    'subject'  => 'Nuove Credenziali portale',
                    'template' => 'registration.phtml',
                    'params'   => array(
                        'fullname' => $this->_form->getValue('fullname'),
                        'usermail' => $this->_form->getValue('usermail'),
                        'pwd'      => $pwd
                        )
                    ));

                $this->view->html_success = $this->_confirm;

            } else {

                $this->_form->populate($form_data);
            }
        }
    }

    public function fulleditAction()
    {
        $id = $this->_getParam('id', 0);
        $row = $this->_dbAuth->Detail_Auth_Admin($id);

        $this->view->html_form = $this->_form->Full_Edit_Beach();
        $this->_form->usermail->addValidator(new Zend_Validate_Db_NoRecordExists(
            'beach_auth',
            'usermail', array(
                'field' => 'id',
                'value' => $id
                )));

        $form_data = $this->getRequest()->getPost();

        if($form_data)
        {
            if($this->_form->isValid($form_data))
            {
                $this->_dbAuth->Edit_Auth($id, array(
                    'fullname'  => $this->_form->getValue('fullname'),
                    'address'   => $this->_form->getValue('address'),
                    'phone'     => $this->_form->getValue('phone'),
                    'usermail'  => $this->_form->getValue('usermail'),
                    'domain'    => $this->_form->getValue('domain'),
                    'latitude'  => $this->_form->getValue('latitude'),
                    'longitude' => $this->_form->getValue('longitude'),
                    'umbrellas' => $this->_form->getValue('umbrellas'),
                    'policy'    => $this->_form->getValue('policy'),
                    'status'    => $this->_form->getValue('status')
                    ));
                $this->view->html_success = $this->_confirm;
                $this->view->headMeta()->appendHttpEquiv('refresh', '1; url=/user');

            } else {

                $this->_form->populate($form_data);
            }

        } else {

            $this->_form->populate($row);
        }
    }

    public function deleteAction()
    {
        // action body
    }

    public function editAction()
    {
        $auth = Zend_Auth::getInstance();
        $identity = $auth->getStorage()->read();
        $row = $this->_dbAuth->Detail_Auth_Admin($identity->id);
        $old_pwd = $row['pwd'];
        $row['pwd'] = '';
        
        $this->view->html_form = $this->_form->Edit_Beach();
        $this->_form->usermail->addValidator(new Zend_Validate_Db_NoRecordExists(
            'beach_auth',
            'usermail', array(
                'field' => 'id',
                'value' => $identity->id
                )));

        $form_data = $this->getRequest()->getPost();

        if($form_data)
        {
            if($this->_form->isValid($form_data))
            {
                $this->_dbAuth->Edit_Auth($identity->id, array(
                    'fullname'  => $this->_form->getValue('fullname'),
                    'address'   => $this->_form->getValue('address'),
                    'phone'     => $this->_form->getValue('phone'),
                    'usermail'  => $this->_form->getValue('usermail'),
                    'pwd'       => $this->_form->getValue('pwd') != NULL ? sha1($this->_form->getValue('pwd')) : $old_pwd,
                    'domain'    => $this->_form->getValue('domain'),
                    'umbrellas' => $this->_form->getValue('umbrellas'),
                    'policy'    => $this->_form->getValue('policy')
                    ));
                $this->view->html_success = $this->_confirm;
                $this->view->headMeta()->appendHttpEquiv('refresh', '1; url=/dashboard');

            } else {

                $this->_form->populate($form_data);
            }

        } else {

            $this->_form->populate($row);
        }
    }


}
