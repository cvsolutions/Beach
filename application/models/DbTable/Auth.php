<?php

/**
* Application_Model_DbTable_Auth
*
* @uses     Zend_Db_Table_Abstract
*
* @category Category
* @package  Package
* @author    <>
* @license  
* @link     
*/
class Application_Model_DbTable_Auth extends Zend_Db_Table_Abstract
{

    /**
     * $_name
     *
     * @var string
     *
     * @access protected
     */
    protected $_name = 'beach_auth';

    /**
     * $_primary
     *
     * @var string
     *
     * @access protected
     */
    protected $_primary = 'id';

    /**
     * Detail_Auth_Admin
     * 
     * @param mixed $id Description.
     *
     * @access public
     *
     * @return mixed Value.
     */
    public function Detail_Auth_Admin($id)
    {
    	$row = $this->fetchRow(sprintf('id = %d', $id));
        return $row->toArray();
    }

    /**
     * Full_Auth
     * 
     * @access public
     *
     * @return mixed Value.
     */
    public function Full_Auth()
    {
        return $this->fetchAll();
    }

    /**
     * New_Auth
     * 
     * @param mixed $fields _POST data.
     *
     * @access public
     *
     * @return mixed Value.
     */
    public function New_Auth($fields)
    {
    	return $this->insert($fields);
    }

    /**
     * Edit_Auth
     * 
     * @param mixed $id     ID.
     * @param mixed $fields _POST data.
     *
     * @access public
     *
     * @return mixed Value.
     */
    public function Edit_Auth($id, $fields)
    {
        return $this->update($fields, sprintf('id = %d', $id));
    }


}

