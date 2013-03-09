<?php

/**
* Application_Model_LibraryAcl
*
* @uses     Zend_Acl
*
* @category Category
* @package  Package
* @author    <>
* @license  
* @link     
*/
class Application_Model_LibraryAcl extends Zend_Acl
{

    /**
     * __construct
     * 
     * @access public
     *
     * @return mixed Value.
     */
	public function __construct()
	{
		/** not authenicated */
		$this->addRole(new Zend_Acl_Role('guest'));

		/** authenticated as member inherit guest privilages */
		$this->addRole(new Zend_Acl_Role('user'), 'guest');

		/** authenticated as admin inherit member privilages */
		$this->addRole(new Zend_Acl_Role('admin'), 'guest');

		/** define Resources */
		$this->add(new Zend_Acl_Resource('error'));
		$this->add(new Zend_Acl_Resource('index'));
		$this->add(new Zend_Acl_Resource('login'));
		$this->add(new Zend_Acl_Resource('settings'));
		$this->add(new Zend_Acl_Resource('dashboard'));
		$this->add(new Zend_Acl_Resource('user'));
		$this->add(new Zend_Acl_Resource('facility'));
		$this->add(new Zend_Acl_Resource('offers'));


		/** assign privileges */
		$this->allow('guest', array('index', 'error'));
		$this->allow('guest', 'settings', array('index', 'notauthorized'));
		$this->allow('guest', 'login', array('index', 'logout', 'lostpassword', 'notauthorized'));

		$this->allow('admin', 'settings', array('index', 'dashboard', 'logout'));
		$this->allow('admin', 'user', array('index', 'new', 'fulledit', 'delete'));

		$this->allow('user', 'dashboard', array('index', 'logout'));
		$this->allow('user', 'user', array('edit', 'logout'));
		$this->allow('user', 'facility', array('index', 'new'));
		$this->allow('user', 'offers', array('index', 'new'));

	}

}