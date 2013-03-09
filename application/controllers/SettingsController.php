<?php

/**
* SettingsController
*
* @uses     Zend_Controller_Action
*
* @category Category
* @package  Package
* @author    <>
* @license  
* @link     
*/
class SettingsController extends Zend_Controller_Action
{

    /**
     * $_form
     *
     * @var mixed
     *
     * @access private
     */
    private $_form = null;

    /**
     * init
     * 
     * @access public
     *
     * @return mixed Value.
     */
    public function init()
    {
		$this->_form = new Application_Form_Settings();
        $this->_form->setDecorators(array('FormElements', 'Form'));
    }

    /**
     * indexAction
     * 
     * @access public
     *
     * @return mixed Value.
     */
    public function indexAction()
    {
		$this->view->html_form = $this->_form->login();
		$auth = Zend_Auth::getInstance();
		if($auth->hasIdentity()) $this->redirect('/settings/dashboard');
		$form_data = $this->getRequest()->getPost();

		if($form_data)
		{
			if($this->_form->isValid($form_data))
			{
				$db = Zend_Db_Table::getDefaultAdapter();
				$adapter = new Zend_Auth_Adapter_DbTable($db);
				$adapter->setTableName('beach_settings');
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
					$this->redirect('/settings/dashboard');

				} else {

					$this->view->html_error = 'Indirizzo E-mail o Password non validi';
				}

			} else {

				$this->_form->populate($form_data);
			}
		}
    }

    /**
     * dashboardAction
     * 
     * @access public
     *
     * @return mixed Value.
     */
    public function dashboardAction()
    {
        $auth = Zend_Auth::getInstance();
        $identity = $auth->getStorage()->read();
        $this->view->identity = $identity;
    }

    /**
     * logoutAction
     * 
     * @access public
     *
     * @return mixed Value.
     */
    public function logoutAction()
    {
        Zend_Auth::getInstance()->clearIdentity();
        session_destroy();
		$this->redirect('/');
    }

    /**
     * notauthorizedAction
     * 
     * @access public
     *
     * @return mixed Value.
     */
    public function notauthorizedAction()
    {
        // action body
    }

}
