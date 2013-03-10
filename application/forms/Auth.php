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
        $pwd->setDescription('<a href="login/lostpassword">Ripristina Password</a>');
        $pwd->setRequired(true);
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
     * Lost_Password
     * 
     * @access public
     *
     * @return mixed Value.
     */
    public function Lost_Password()
    {
        $usermail = new Zend_Form_Element_Text('usermail');
        $usermail->setLabel('Indirizzo Email');
        $usermail->setRequired(true);
        $usermail->addValidator('EmailAddress');
        $usermail->setAttrib('class', 'span5');
        $usermail->addFilters(array('StringTrim', 'StripTags'));
        $usermail->setDecorators(array('ViewHelper', 'Errors', 'label'));
        $usermail->addValidator(new Zend_Validate_Db_RecordExists(array('table' => 'beach_auth', 'field' => 'usermail')));
        
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Recupera');
        $submit->setAttrib('class', 'btn');
        $submit->setDecorators(array('ViewHelper', array('HtmlTag', array('tag' => 'p'))));
        
        return $this->addElements(array($usermail, $submit));      
    }

    /**
     * New_Beach
     * 
     * @access public
     *
     * @return mixed Value.
     */
    public function New_Beach()
    {
        $fullname = new Zend_Form_Element_Text('fullname');
        $fullname->setLabel('Stabilimento Balneare');
        $fullname->setRequired(true);
        $fullname->addFilters(array('StringTrim', 'StripTags'));
        $fullname->setAttrib('class', 'span5');
        $fullname->setDecorators(array('ViewHelper', 'Errors', 'label'));

        $usermail = new Zend_Form_Element_Text('usermail');
        $usermail->setLabel('Indirizzo Email');
        $usermail->setRequired(true);
        $usermail->addValidator('EmailAddress');
        $usermail->addFilters(array('StringTrim', 'StripTags'));
        $usermail->setAttrib('class', 'span5');
        $usermail->setDecorators(array('ViewHelper', 'Errors', 'label'));
        $usermail->addValidator(new Zend_Validate_Db_NoRecordExists('beach_auth', 'usermail'));
        
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
     * Full_Edit_Beach
     * 
     * @access public
     *
     * @return mixed Value.
     */
    public function Full_Edit_Beach()
    {
        $fullname = new Zend_Form_Element_Text('fullname');
        $fullname->setLabel('Stabilimento Balneare');
        $fullname->setRequired(true);
        $fullname->addFilters(array('StringTrim', 'StripTags'));
        $fullname->setAttrib('class', 'span5');
        $fullname->setDecorators(array('ViewHelper', 'Errors', 'label'));
        
        $address = new Zend_Form_Element_Text('address');
        $address->setLabel('Indirizzo');
        $address->setRequired(true);
        $address->addFilters(array('StringTrim', 'StripTags'));
        $address->setAttrib('class', 'span5');
        $address->setDecorators(array('ViewHelper', 'Errors', 'label'));
        
        $phone = new Zend_Form_Element_Text('phone');
        $phone->setLabel('Numero di telefono');
        $phone->setRequired(true);
        $phone->addFilters(array('StringTrim', 'StripTags'));
        $phone->setDecorators(array('ViewHelper', 'Errors', 'label'));

        $usermail = new Zend_Form_Element_Text('usermail');
        $usermail->setLabel('Indirizzo Email');
        $usermail->setRequired(true);
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
        $umbrellas->addFilters(array('StringTrim', 'StripTags'));
        $umbrellas->setDecorators(array('ViewHelper', 'Errors', 'label'));

        $policy = new Zend_Form_Element_Textarea('policy');
        $policy->setLabel('Politiche di pagamento & penali');
        $policy->setAttrib('class', 'span7');
        $policy->setAttrib('rows', '10');
        $policy->setDecorators(array('ViewHelper', 'Errors', 'label'));

        $status = new Zend_Form_Element_Select('status');
        $status->setLabel('Account');
        $status->addMultiOptions(array(0 => 'Sospeso', 1 => 'Attivo'));
        $status->setDecorators(array('ViewHelper', 'Errors', 'label'));

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('class', 'btn');
        $submit->setLabel('Salva');
        $submit->setDecorators(array('ViewHelper', array('HtmlTag', array('tag' => 'p'))));

        return $this->addElements(array($fullname, $address, $phone, $usermail, $domain, $latitude, $longitude, $umbrellas, $policy, $status, $submit));
    }
    
    /**
     * Edit_Beach
     * 
     * @access public
     *
     * @return mixed Value.
     */
    public function Edit_Beach()
    {
        $fullname = new Zend_Form_Element_Text('fullname');
        $fullname->setLabel('Stabilimento Balneare');
        $fullname->setRequired(true);
        $fullname->setAttrib('class', 'span5');
        $fullname->addFilters(array('StringTrim', 'StripTags'));
        $fullname->setDecorators(array('ViewHelper', 'Errors', 'label'));

        $address = new Zend_Form_Element_Text('address');
        $address->setLabel('Indirizzo');
        $address->setRequired(true);
        $address->setAttrib('class', 'span5');
        $address->addFilters(array('StringTrim', 'StripTags'));
        $address->setDecorators(array('ViewHelper', 'Errors', 'label'));

        $phone = new Zend_Form_Element_Text('phone');
        $phone->setLabel('Numero di telefono');
        $phone->setRequired(true);
        $phone->addFilters(array('StringTrim', 'StripTags'));
        $phone->setDecorators(array('ViewHelper', 'Errors', 'label'));

        $usermail = new Zend_Form_Element_Text('usermail');
        $usermail->setLabel('Indirizzo Email');
        $usermail->setRequired(true);
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
        $umbrellas->addFilters(array('StringTrim', 'StripTags'));
        $umbrellas->setAttrib('class', 'five');
        $umbrellas->setDecorators(array('ViewHelper', 'Errors', 'label'));

        $policy = new Zend_Form_Element_Textarea('policy');
        $policy->setLabel('Politiche di pagamento & penali');
        $policy->setRequired(true);
        $policy->setAttrib('class', 'span7');
        $policy->setAttrib('rows', '10');
        $policy->setDecorators(array('ViewHelper', 'Errors', 'label'));
        
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('class', 'btn');
        $submit->setLabel('Salva');
        $submit->setDecorators(array('ViewHelper', array('HtmlTag', array('tag' => 'p'))));

        return $this->addElements(array($fullname, $address, $phone, $usermail, $pwd, $domain, $umbrellas, $policy, $submit));
    }


}

