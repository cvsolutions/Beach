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
        $usermail->setAttrib('class', 'span5');
        $usermail->addFilters(array('StringTrim', 'StripTags'));
        $usermail->setDecorators(array('ViewHelper', 'Errors', 'label'));
        
        $pwd = new Zend_Form_Element_Password('pwd');
        $pwd->setLabel('Password');
        $pwd->setDescription('<a href="login/lostpassword">Ripristina Password</a>');
        $pwd->setRequired(true);
        $pwd->addValidator('NotEmpty');
        $pwd->setAttrib('class', 'span5');
        $pwd->addFilters(array('StringTrim', 'StripTags'));
        $pwd->setDecorators(array('ViewHelper', 'Errors', 'label', array('Description', array('escape' => false, 'tag' => 'p'))));

        $token = new Zend_Form_Element_Hash('hash', 'no_csrf_foo', array('salt' => 'unique'));
        $token->setDecorators(array(array('ViewHelper', array('helper' => 'formHidden'))));

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('class', 'btn btn-large btn-primary');
        $submit->setLabel('Login');
        $submit->setDecorators(array('ViewHelper', array('HtmlTag', array('tag' => 'p'))));

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
        $usermail->setDecorators(array('ViewHelper', 'Errors', 'label'));
        
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Recupera');
        $submit->setAttrib('class', 'btn');
        $submit->setDecorators(array('ViewHelper', array('HtmlTag', array('tag' => 'p'))));
        
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
        $fullname = new Zend_Form_Element_Text('fullname');
        $fullname->setLabel('Stabilimento Balneare');
        $fullname->setRequired(true);
        $fullname->addValidator('NotEmpty');
        $fullname->addFilters(array('StringTrim', 'StripTags'));
        $fullname->setAttrib('class', 'span5');
        $fullname->setDecorators(array('ViewHelper', 'Errors', 'label'));

        $usermail = new Zend_Form_Element_Text('usermail');
        $usermail->setLabel('Indirizzo Email');
        $usermail->setRequired(true);
        $usermail->addValidator('NotEmpty');
        $usermail->addValidator('EmailAddress');
        $usermail->addFilters(array('StringTrim', 'StripTags'));
        $usermail->setAttrib('class', 'span5');
        $usermail->setDecorators(array('ViewHelper', 'Errors', 'label'));
        
        $latitude = new Zend_Form_Element_Text('latitude');
        $latitude->setLabel('Google Maps (Latitudine)');
        $latitude->setDecorators(array('ViewHelper', 'Errors', 'label'));
        
        $longitude = new Zend_Form_Element_Text('longitude');
        $longitude->setLabel('Google Maps (Longitudine)');
        $longitude->setDecorators(array('ViewHelper', 'Errors', 'label'));

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Salva');
        $submit->setAttrib('class', 'btn');
        $submit->setDecorators(array('ViewHelper', array('HtmlTag', array('tag' => 'p'))));
        
        return $this->addElements(array($fullname, $usermail, $latitude, $longitude, $submit));
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
        $fullname = new Zend_Form_Element_Text('fullname');
        $fullname->setLabel('Stabilimento Balneare');
        $fullname->setRequired(true);
        $fullname->addValidator('NotEmpty');
        $fullname->addFilters(array('StringTrim', 'StripTags'));
        $fullname->setAttrib('class', 'span5');
        $fullname->setDecorators(array('ViewHelper', 'Errors', 'label'));
        
        $address = new Zend_Form_Element_Text('address');
        $address->setLabel('Indirizzo');
        $address->setRequired(true);
        $address->addValidator('NotEmpty');
        $address->addFilters(array('StringTrim', 'StripTags'));
        $address->setAttrib('class', 'span5');
        $address->setDecorators(array('ViewHelper', 'Errors', 'label'));
        
        $phone = new Zend_Form_Element_Text('phone');
        $phone->setLabel('Numero di telefono');
        $phone->setRequired(true);
        $phone->addValidator('NotEmpty');
        $phone->addFilters(array('StringTrim', 'StripTags'));
        $phone->setDecorators(array('ViewHelper', 'Errors', 'label'));

        $usermail = new Zend_Form_Element_Text('usermail');
        $usermail->setLabel('Indirizzo Email');
        $usermail->setRequired(true);
        $usermail->addValidator('NotEmpty');
        $usermail->addValidator('EmailAddress');
        $usermail->addFilters(array('StringTrim', 'StripTags'));
        $usermail->setAttrib('class', 'span5');
        $usermail->setDecorators(array('ViewHelper', 'Errors', 'label'));

        $domain = new Zend_Form_Element_Text('domain');
        $domain->setLabel('Sito internet');
        $domain->setAttrib('class', 'span5');
        $domain->setDecorators(array('ViewHelper', 'Errors', 'label'));

        $latitude = new Zend_Form_Element_Text('latitude');
        $latitude->setLabel('Google Maps (Latitudine)');
        $latitude->setDecorators(array('ViewHelper', 'Errors', 'label'));

        $longitude = new Zend_Form_Element_Text('longitude');
        $longitude->setLabel('Google Maps (Longitudine)');
        $longitude->setDecorators(array('ViewHelper', 'Errors', 'label'));
        
        $umbrellas = new Zend_Form_Element_Text('umbrellas');
        $umbrellas->setLabel('Numero di ombrelloni');
        $umbrellas->setRequired(true);
        $umbrellas->addValidator('NotEmpty');
        $umbrellas->addFilters(array('StringTrim', 'StripTags'));
        $umbrellas->setDecorators(array('ViewHelper', 'Errors', 'label'));
        
        $rows = new Zend_Form_Element_Text('rows');
        $rows->setLabel('Numero di file');
        $rows->setRequired(true);
        $rows->addValidator('NotEmpty');
        $rows->addFilters(array('StringTrim', 'StripTags'));
        $rows->setDecorators(array('ViewHelper', 'Errors', 'label'));

        $policy = new Zend_Form_Element_Textarea('policy');
        $policy->setLabel('Politiche di pagamento & penali');
        $policy->setAttrib('class', 'span7');
        $policy->setDecorators(array('ViewHelper', 'Errors', 'label'));

        $status = new Zend_Form_Element_Select('status');
        $status->setLabel('Account');
        $status->setRequired(true);
        $status->addValidator('NotEmpty');
        $status->addMultiOptions(array(0 => 'Sospeso', 1 => 'Attivo'));
        $status->setDecorators(array('ViewHelper', 'Errors', 'label'));

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('class', 'btn');
        $submit->setLabel('Salva');
        $submit->setDecorators(array('ViewHelper', array('HtmlTag', array('tag' => 'p'))));

        return $this->addElements(array($fullname, $address, $phone, $usermail, $domain, $latitude, $longitude, $umbrellas, $rows, $policy, $status, $submit));
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
        $name->setAttrib('class', 'span5');
        $name->addFilters(array('StringTrim', 'StripTags'));
        $name->setDecorators(array('ViewHelper', 'Errors', 'label'));

        $address = new Zend_Form_Element_Text('address');
        $address->setLabel('Indirizzo');
        $address->setRequired(true);
        $address->addValidator('NotEmpty');
        $address->setAttrib('class', 'span5');
        $address->addFilters(array('StringTrim', 'StripTags'));
        $address->setDecorators(array('ViewHelper', 'Errors', 'label'));

        $phone = new Zend_Form_Element_Text('phone');
        $phone->setLabel('Numero di telefono');
        $phone->setRequired(true);
        $phone->addValidator('NotEmpty');
        $phone->addFilters(array('StringTrim', 'StripTags'));
        $phone->setDecorators(array('ViewHelper', 'Errors', 'label'));

        $usermail = new Zend_Form_Element_Text('usermail');
        $usermail->setLabel('Indirizzo Email');
        $usermail->setRequired(true);
        $usermail->addValidator('NotEmpty');
        $usermail->addValidator('EmailAddress');
        $usermail->setAttrib('class', 'span5');
        $usermail->addFilters(array('StringTrim', 'StripTags'));
        $usermail->setDecorators(array('ViewHelper', 'Errors', 'label'));

        $pwd = new Zend_Form_Element_Text('pwd');
        $pwd->setLabel('Password');
        $pwd->setDecorators(array('ViewHelper', 'Errors', 'label'));

        $domain = new Zend_Form_Element_Text('domain');
        $domain->setLabel('Sito internet');
        $domain->setAttrib('class', 'span5');
        $domain->setDecorators(array('ViewHelper', 'Errors', 'label'));

        $umbrellas = new Zend_Form_Element_Text('umbrellas');
        $umbrellas->setLabel('Numero di ombrelloni');
        $umbrellas->setRequired(true);
        $umbrellas->addValidator('NotEmpty');
        $umbrellas->addFilters(array('StringTrim', 'StripTags'));
        $umbrellas->setAttrib('class', 'five');
        $umbrellas->setDecorators(array('ViewHelper', 'Errors', 'label'));

        $rows = new Zend_Form_Element_Text('rows');
        $rows->setLabel('Numero di file');
        $rows->setRequired(true);
        $rows->addValidator('NotEmpty');
        $rows->addFilters(array('StringTrim', 'StripTags'));
        $rows->setDecorators(array('ViewHelper', 'Errors', 'label'));
        
        $policy = new Zend_Form_Element_Textarea('policy');
        $policy->setLabel('Politiche di pagamento & penali');
        $policy->setAttrib('class', 'span7');
        $policy->setDecorators(array('ViewHelper', 'Errors', 'label'));
        
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('class', 'btn');
        $submit->setLabel('Salva');
        $submit->setDecorators(array('ViewHelper', array('HtmlTag', array('tag' => 'p'))));

        return $this->addElements(array($name, $address, $phone, $usermail, $pwd, $domain, $umbrellas, $rows, $policy, $submit));
    }


}

