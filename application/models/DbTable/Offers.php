<?php

/**
* Application_Model_DbTable_Offers
*
* @uses     Zend_Db_Table_Abstract
*
* @category DbTable offers
* @package  Spiaggia Online
* @author   Concetto Vecchio <info@cvsolutions.it>
* @license  GPL
* @link     http://www.gnu.org/licenses/gpl.html
*/
class Application_Model_DbTable_Offers extends Zend_Db_Table_Abstract
{

    /**
     * $_name
     *
     * @var string
     *
     * @access protected
     */
    protected $_name = 'beach_offers';

    /**
     * $_primary
     *
     * @var string
     *
     * @access protected
     */
    protected $_primary = 'id';

    /**
     * Detail_Offers
     * 
     * @param mixed $id ID.
     *
     * @access public
     *
     * @return mixed Value.
     */
    public function Detail_Offers($id)
    {
        $row = $this->fetchRow(sprintf('id = %d', $id));
        return $row->toArray();
    }

    /**
     * Full_Auth_Offers
     * 
     * @param mixed $auth ID beach.
     *
     * @access public
     *
     * @return mixed Value.
     */
    public function Full_Auth_Offers($auth)
    {
        return $this->fetchAll(sprintf('auth = %d', $auth));
    }

    /**
     * New_Offers
     * 
     * @param mixed $fields _POST data.
     *
     * @access public
     *
     * @return mixed Value.
     */
    public function New_Offers($fields)
    {
    	return $this->insert($fields);
    }

    /**
     * Edit_Offers
     * 
     * @param mixed $id     ID.
     * @param mixed $fields _POST data.
     *
     * @access public
     *
     * @return mixed Value.
     */
    public function Edit_Offers($id, $fields)
    {
        return $this->update($fields, sprintf('id = %d', $id));
    }

    /**
     * Delete_Offers
     * 
     * @param mixed $id ID.
     *
     * @access public
     *
     * @return mixed Value.
     */
    public function Delete_Offers($id)
    {
        return $this->delete(sprintf('id = %d', $id));
    }

}

