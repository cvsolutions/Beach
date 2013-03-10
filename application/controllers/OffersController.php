<?php

class OffersController extends Zend_Controller_Action
{
    private $_form;
    private $_identity;
    private $_confirm = 'Operazione completata con successo';
    
    public function init()
    {
        $auth = Zend_Auth::getInstance();
        $identity = $auth->getStorage()->read();
        $this->_identity = $identity;

        $this->_form = new Application_Form_Offers();
        $this->_form->setDecorators(array('FormElements', 'Form'));

        $this->_dbAuth = new Application_Model_DbTable_Offers();
    }

    public function indexAction()
    {
        $ID = $this->_identity->id;
        $this->view->offers = $this->_dbAuth->Full_Auth_Offers($ID);
    }

    public function newAction()
    {
        $this->view->html_form = $this->_form->New_Offers();
        $form_data = $this->getRequest()->getPost();

        if($form_data)
        {
            if($this->_form->isValid($form_data))
            {
                $this->_dbAuth->New_Offers(array(
                    'id'          => mt_rand(11111, 99999),
                    'name'        => $this->_form->getValue('name'),
                    'from_date'   => $this->_form->getValue('from_date'),
                    'to_date'     => $this->_form->getValue('to_date'),
                    'description' => $this->_form->getValue('description'),
                    'price'       => $this->_form->getValue('price'),
                    'photo'       => $this->_form->getValue('photo'),
                    'auth'        => $this->_identity->id,
                    'publication' => new Zend_Db_Expr('NOW()'),
                    'status'      => 1
                    ));

                $this->view->html_success = $this->_confirm;

            } else {

                $this->_form->populate($form_data);
            }
        }
    }

    public function editAction()
    {
        $id = $this->_getParam('id', 0);
        $row = $this->_dbAuth->Detail_Offers($id);
        $this->view->html_form = $this->_form->Edit_Offers();
        $form_data = $this->getRequest()->getPost();

        $photo = $row['photo'] != NULL ? $row['photo'] : sprintf('%s.jpg', uniqid());
        $this->_form->photo->addFilter('Rename', $photo);
        
        if($form_data)
        {
            if($this->_form->isValid($form_data))
            {
                $files = $this->_form->getValue('photo') ? $this->_form->getValue('photo') : $row['photo'];

                $this->_dbAuth->Edit_Offers($id, array(
                    'name'        => $this->_form->getValue('name'),
                    'from_date'   => $this->_form->getValue('from_date'),
                    'to_date'     => $this->_form->getValue('to_date'),
                    'description' => $this->_form->getValue('description'),
                    'price'       => $this->_form->getValue('price'),
                    'photo'       => $files,
                    'status'      => $this->_form->getValue('status')
                    ));

                $this->view->html_success = $this->_confirm;
                $this->view->headMeta()->appendHttpEquiv('refresh', '1; url=/offers');

            } else {

                $this->_form->populate($form_data);
            }
        } else {

            $this->_form->populate($row);
        }
    }

    public function deleteAction()
    {
        $id = $this->_getParam('id', 0);
        $row = $this->_dbAuth->Detail_Offers($id);
        if($row['photo'] > 0) unlink(sprintf('%s/uploaded/%s', $_SERVER['DOCUMENT_ROOT'], $row['photo']));
        $this->_dbAuth->Delete_Offers($id);
        $this->_redirect('/offers');
    }


}







