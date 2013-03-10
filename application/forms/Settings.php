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
     * init
     * 
     * @access public
     *
     * @return mixed Value.
     */
    public function init()
    {
        $this->setAttrib('class', '');
    }

    /**
     * Login
     * 
     * @access public
     *
     * @return mixed Value.
     */
    public function Login()
    {
        $usermail = new Zend_Form_Element_Text('usermail');
        $usermail->setLabel('Indirizzo Email');
        $usermail->setRequired(true);
        $usermail->addValidator('EmailAddress');
        $usermail->setAttrib('class', 'span5');
        $usermail->addFilters(array('StringTrim', 'StripTags'));
        $usermail->setDecorators(array('ViewHelper', 'Errors', 'label'));
        
        $pwd = new Zend_Form_Element_Password('pwd');
        $pwd->setLabel('Password');
        $pwd->setRequired(true);
        $pwd->addFilters(array('StringTrim', 'StripTags'));
        $pwd->setAttrib('class', 'span5');
        $pwd->setDecorators(array('ViewHelper', 'Errors', 'label'));

        $token = new Zend_Form_Element_Hash('hash', 'no_csrf_foo', array('salt' => 'unique'));
        $token->setDecorators(array(array('ViewHelper', array('helper' => 'formHidden'))));

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('class', 'btn btn-large btn-primary');
        $submit->setLabel('Login');
        $submit->setDecorators(array('ViewHelper', array('HtmlTag', array('tag' => 'p'))));
        // $submit->removeDecorator('DtDdWrapper');
        
        return $this->addElements(array($usermail, $pwd, $token, $submit));
    }


}

