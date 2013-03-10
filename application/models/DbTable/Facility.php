<?php

/**
* Application_Model_DbTable_Facility
*
* @uses     Zend_Db_Table_Abstract
*
* @category DbTable facility
* @package  Spiaggia Online
* @author   Concetto Vecchio <info@cvsolutions.it>
* @license  GPL
* @link     http://www.gnu.org/licenses/gpl.html
*/
class Application_Model_DbTable_Facility extends Zend_Db_Table_Abstract
{

    /**
     * $_name
     *
     * @var string
     *
     * @access protected
     */
    protected $_name = 'beach_facility';

    /**
     * $_primary
     *
     * @var string
     *
     * @access protected
     */
    protected $_primary = 'id';

    /**
     * Detail_Facility
     * 
     * @param mixed $id ID facility.
     *
     * @access public
     *
     * @return mixed Value.
     */
    public function Detail_Facility($id)
    {
    	$row = $this->fetchRow(sprintf('id = %d', $id));
    	return $row->toArray();
    }

    /**
     * Full_Auth_Facility
     * 
     * @param mixed $auth ID beach.
     *
     * @access public
     *
     * @return mixed Value.
     */
    public function Full_Auth_Facility($auth)
    {
    	return $this->fetchAll(sprintf('auth = %d', $auth));
    }

    /**
     * New_Facility
     * 
     * @param mixed $fields _POST data.
     *
     * @access public
     *
     * @return mixed Value.
     */
    public function New_Facility($fields)
    {
    	return $this->insert($fields);
    }

    /**
     * Edit_Facility
     * 
     * @param mixed $id     ID.
     * @param mixed $fields _POST data.
     *
     * @access public
     *
     * @return mixed Value.
     */
    public function Edit_Facility($id, $fields)
    {
    	return $this->update($fields, sprintf('id = %d', $id));
    }

    /**
     * Delete_Facility
     * 
     * @param mixed $id ID.
     *
     * @access public
     *
     * @return mixed Value.
     */
    public function Delete_Facility($id)
    {
        return $this->delete(sprintf('id = %d', $id));
    }


}

