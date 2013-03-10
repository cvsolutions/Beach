<?php

/**
* Plugin_AccessCheck
*
* @uses     Zend_Controller_Plugin_Abstract
*
* @category Access Check
* @package  Spiaggia Online
* @author   Concetto Vecchio <info@cvsolutions.it>
* @license  GPL
* @link     http://www.gnu.org/licenses/gpl.html
*/
class Plugin_AccessCheck extends Zend_Controller_Plugin_Abstract
{

    /**
     * $_acl
     *
     * @var mixed
     *
     * @access private
     */
    private $_acl = null;

    /**
     * $_auth
     *
     * @var mixed
     *
     * @access private
     */
    private $_auth = null;

    /**
     * __construct
     *
     * @param mixed   \Zend_Acl   acl .
     * @param mixed   \Zend_Auth  auth.
     *
     * @access public
     *
     * @return mixed Value.
     */
    public function __construct(Zend_Acl $acl, Zend_Auth $auth)
    {
        $this->_acl = $acl;
        $this->_auth = $auth;
    }

    /**
     * preDispatch
     *
     * @param mixed   \Zend_Controller_Request_Abstract request.
     *
     * @access public
     *
     * @return mixed Value.
     */
    public function preDispatch(Zend_Controller_Request_Abstract $request)
    {
        $request_controller = $request->getControllerName();
        $request_action = $request->getActionName();
        $role = 'guest';

        $identity = $this->_auth->getStorage()->read();
        if ($identity) {
            $role = $identity->role;
        }

        if (!$this->_acl->isAllowed($role, $request_controller, $request_action)) {
            // $controller = $role == 'admin' ? 'settings' : 'login';
            $request->setControllerName('login');
            $request->setActionName('notauthorized');
        }
    }
}
