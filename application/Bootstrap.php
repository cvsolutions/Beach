<?php

/**
* Bootstrap
*
* @uses     Zend_Application_Bootstrap_Bootstrap
*
* @category Bootstrap
* @package  Spiaggia Online
* @author   Concetto Vecchio <info@cvsolutions.it>
* @license  GPL
* @link     http://www.gnu.org/licenses/gpl.html
*/
class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    /**
     * _initAutoload
     * 
     * @access protected
     *
     * @return mixed Value.
     */
	protected function _initAutoload()
	{
		$moduleLoader = new Zend_Application_Module_Autoloader(array(
			'namespace' => '',
			'basePath' => APPLICATION_PATH
			));
		return $moduleLoader;
	}

    /**
     * _initPlugins
     * 
     * @access protected
     *
     * @return mixed Value.
     */
	protected function _initPlugins()
	{
		$acl = new Application_Model_LibraryAcl();
		$auth = Zend_Auth::getInstance();

		$front = Zend_Controller_Front::getInstance();
		$front->registerPlugin( new Plugin_AccessCheck($acl, $auth));
	}

}

