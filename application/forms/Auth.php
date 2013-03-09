<?php

/**
* Application_Form_Auth
*
* @uses     Zend_Form
*
* @category Form elements
* @package  Spiaggia Online
* @author   Concetto Vecchio <info@cvsolutions.it>
* @license  GPL
* @link     http://www.gnu.org/licenses/gpl.html
*/
class Application_Form_Auth extends Zend_Form
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
        $pwd->setDescription('<a href="login/lostpassword">Ripristina Password</a>');
        $pwd->setDecorators(array(
            'ViewHelper', array(
                'Description', array(
                    'escape' => false, 
                    'tag' => false
                    )),
            array(
                'HtmlTag', array('tag' => 'dd')),
            array('Label', array('tag' => 'dt')),'Errors'));
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
    
    /**
     * lost_password
     * 
     * @access public
     *
     * @return mixed Value.
     */
    public function lost_password()
    {
        $usermail = new Zend_Form_Element_Text('usermail');
        $usermail->setLabel('Indirizzo Email');
        $usermail->setRequired(true);
        $usermail->addValidator('NotEmpty');
        $usermail->addValidator('EmailAddress');
        $usermail->addFilters(array('StringTrim', 'StripTags'));
        
        $submit = new Zend_Form_Element_Button('submit');
        $submit->setLabel('Recupera');
        $submit->setAttrib('class', 'button');
        
        return $this->addElements(array($usermail, $submit));      
    }

    /**
     * new_beach
     * 
     * @access public
     *
     * @return mixed Value.
     */
    public function new_beach()
    {
        $name = new Zend_Form_Element_Text('name');
        $name->setLabel('Stabilimento Balneare');
        $name->setRequired(true);
        $name->addValidator('NotEmpty');
        $name->addFilters(array('StringTrim', 'StripTags'));

        $usermail = new Zend_Form_Element_Text('usermail');
        $usermail->setLabel('Indirizzo Email');
        $usermail->setRequired(true);
        $usermail->addValidator('NotEmpty');
        $usermail->addValidator('EmailAddress');
        $usermail->addFilters(array('StringTrim', 'StripTags'));
        
        $pwd = new Zend_Form_Element_Password('pwd');
        $pwd->setLabel('Password');
        $pwd->setRequired(true);
        $pwd->addValidator('NotEmpty');
        $pwd->addFilters(array('StringTrim', 'StripTags'));

        $latitude = new Zend_Form_Element_Text('latitude');
        $latitude->setLabel('Google Maps (Latitudine)');
        $latitude->setAttrib('class', 'five');
        
        $longitude = new Zend_Form_Element_Text('longitude');
        $longitude->setLabel('Google Maps (Longitudine)');
        $longitude->setAttrib('class', 'five');

        $submit = new Zend_Form_Element_Button('submit');
        $submit->setLabel('Salva');
        $submit->setAttrib('class', 'button');
        
        return $this->addElements(array($name, $usermail, $pwd, $latitude, $longitude, $submit));
    }
    
    /**
     * full_edit_beach
     * 
     * @access public
     *
     * @return mixed Value.
     */
    public function full_edit_beach()
    {
        $name = new Zend_Form_Element_Text('name');
        $name->setLabel('Stabilimento Balneare');
        $name->setRequired(true);
        $name->addValidator('NotEmpty');
        $name->addFilters(array('StringTrim', 'StripTags'));
        
        $address = new Zend_Form_Element_Text('address');
        $address->setLabel('Indirizzo');
        $address->setRequired(true);
        $address->addValidator('NotEmpty');
        $address->addFilters(array('StringTrim', 'StripTags'));
        
        $phone = new Zend_Form_Element_Text('phone');
        $phone->setLabel('Numero di telefono');
        $phone->setRequired(true);
        $phone->addValidator('NotEmpty');
        $phone->addFilters(array('StringTrim', 'StripTags'));
        $phone->setAttrib('class', 'five');

        $usermail = new Zend_Form_Element_Text('usermail');
        $usermail->setLabel('Indirizzo Email');
        $usermail->setRequired(true);
        $usermail->addValidator('NotEmpty');
        $usermail->addValidator('EmailAddress');
        $usermail->addFilters(array('StringTrim', 'StripTags'));

        $pwd = new Zend_Form_Element_Text('pwd');
        $pwd->setLabel('Password');
        
        $domain = new Zend_Form_Element_Text('domain');
        $domain->setLabel('Sito internet');

        $latitude = new Zend_Form_Element_Text('latitude');
        $latitude->setLabel('Google Maps (Latitudine)');
        $latitude->setAttrib('class', 'five');

        $longitude = new Zend_Form_Element_Text('longitude');
        $longitude->setLabel('Google Maps (Longitudine)');
        $longitude->setAttrib('class', 'five');
        
        $umbrellas = new Zend_Form_Element_Text('umbrellas');
        $umbrellas->setLabel('Numero di ombrelloni');
        $umbrellas->setRequired(true);
        $umbrellas->addValidator('NotEmpty');
        $umbrellas->addFilters(array('StringTrim', 'StripTags'));
        $umbrellas->setAttrib('class', 'five');
        
        $rows = new Zend_Form_Element_Text('rows');
        $rows->setLabel('Numero di file');
        $rows->setRequired(true);
        $rows->addValidator('NotEmpty');
        $rows->addFilters(array('StringTrim', 'StripTags'));
        $rows->setAttrib('class', 'five');

        $policy = new Zend_Form_Element_Textarea('policy');
        $policy->setLabel('Politiche di pagamento & penali');
        
        $role = new Zend_Form_Element_Select('role');
        $role->setLabel('Ruolo');
        $role->setRequired(true);
        $role->addValidator('NotEmpty');
        $role->addMultiOptions(array(1 => 'Admin', 2 => 'Lido'));
        
        $status = new Zend_Form_Element_Select('status');
        $status->setLabel('Account');
        $status->setRequired(true);
        $status->addValidator('NotEmpty');
        $status->addMultiOptions(array(0 => 'Sospeso', 1 => 'Attivo'));

        $submit = new Zend_Form_Element_Button('submit');
        $submit->setLabel('Salva');
        $submit->setAttrib('class', 'button');

        return $this->addElements(array($name, $address, $phone, $usermail, $pwd, $domain, $latitude, $longitude, $umbrellas, $rows, $policy, $role, $status, $submit));
    }
    
    /**
     * edit_beach
     * 
     * @access public
     *
     * @return mixed Value.
     */
    public function edit_beach()
    {
        $name = new Zend_Form_Element_Text('name');
        $name->setLabel('Stabilimento Balneare');
        $name->setRequired(true);
        $name->addValidator('NotEmpty');
        $name->addFilters(array('StringTrim', 'StripTags'));

        $address = new Zend_Form_Element_Text('address');
        $address->setLabel('Indirizzo');
        $address->setRequired(true);
        $address->addValidator('NotEmpty');
        $address->addFilters(array('StringTrim', 'StripTags'));

        $phone = new Zend_Form_Element_Text('phone');
        $phone->setLabel('Numero di telefono');
        $phone->setRequired(true);
        $phone->addValidator('NotEmpty');
        $phone->addFilters(array('StringTrim', 'StripTags'));
        $phone->setAttrib('class', 'five');

        $usermail = new Zend_Form_Element_Text('usermail');
        $usermail->setLabel('Indirizzo Email');
        $usermail->setRequired(true);
        $usermail->addValidator('NotEmpty');
        $usermail->addValidator('EmailAddress');
        $usermail->addFilters(array('StringTrim', 'StripTags'));

        $pwd = new Zend_Form_Element_Text('pwd');
        $pwd->setLabel('Password');

        $domain = new Zend_Form_Element_Text('domain');
        $domain->setLabel('Sito internet');

        $umbrellas = new Zend_Form_Element_Text('umbrellas');
        $umbrellas->setLabel('Numero di ombrelloni');
        $umbrellas->setRequired(true);
        $umbrellas->addValidator('NotEmpty');
        $umbrellas->addFilters(array('StringTrim', 'StripTags'));
        $umbrellas->setAttrib('class', 'five');

        $rows = new Zend_Form_Element_Text('rows');
        $rows->setLabel('Numero di file');
        $rows->setRequired(true);
        $rows->addValidator('NotEmpty');
        $rows->addFilters(array('StringTrim', 'StripTags'));
        $rows->setAttrib('class', 'five');
        
        $policy = new Zend_Form_Element_Textarea('policy');
        $policy->setLabel('Politiche di pagamento & penali');
        
        $submit = new Zend_Form_Element_Button('submit');
        $submit->setLabel('Salva');
        $submit->setAttrib('class', 'button');

        return $this->addElements(array($name, $address, $phone, $usermail, $pwd, $domain, $umbrellas, $rows, $policy, $submit));
    }


}

