<?php

/**
* Application_Form_Settings
*
* @uses     Zend_Form
*
* @category Form elements
* @package  Spiaggia Online
* @author   Concetto Vecchio <info@cvsolutions.it>
* @license  GPL
* @link     http://www.gnu.org/licenses/gpl.html
*/
class Application_Form_Settings extends Zend_Form
{
    /**
     * $_errors_class
     *
     * @var string
     *
     * @access private
     */
	private $_errors_class = 'disc errors';

    /**
     * init
     * 
     * @access public
     *
     * @return mixed Value.
     */
	public function init()
	{
		$this->setAttrib('class', 'custom');
	}

    /**
     * login
     * 
     * @access public
     *
     * @return mixed Value.
     */
	public function login()
	{
		$usermail = new Zend_Form_Element_Text('usermail');
        $usermail->setLabel('Indirizzo Email');
        $usermail->setRequired(true);
        $usermail->addValidator('NotEmpty');
        $usermail->addValidator('EmailAddress');
        $usermail->addFilters(array('StringTrim', 'StripTags'));
        $usermail->addDecorator('Errors', array('class' => $this->_errors_class));

		$pwd = new Zend_Form_Element_Password('pwd');
		$pwd->setLabel('Password');
		$pwd->setRequired(true);
		$pwd->addValidator('NotEmpty');
		$pwd->addFilters(array('StringTrim', 'StripTags'));
		$pwd->addDecorator('Errors', array('class' => $this->_errors_class));

		$token = new Zend_Form_Element_Hash('hash', 'no_csrf_foo', array('salt' => 'unique'));
		$token->setDecorators(array(
			array(
				'ViewHelper', array('helper' => 'formHidden')
				)));

		$submit = new Zend_Form_Element_Submit('submit');
		$submit->setLabel('Login');
		$submit->setAttrib('class', 'button');

		return $this->addElements(array($usermail, $pwd, $token, $submit));
	}


}

