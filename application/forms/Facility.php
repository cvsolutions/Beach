<?php

/**
* Application_Form_Facility
*
* @uses     Zend_Form
*
* @category Form elements
* @package  Spiaggia Online
* @author   Concetto Vecchio <info@cvsolutions.it>
* @license  GPL
* @link     http://www.gnu.org/licenses/gpl.html
*/
class Application_Form_Facility extends Zend_Form
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
     * New_Facility
     * 
     * @access public
     *
     * @return mixed Value.
     */
    public function New_Facility()
    {
        $name = new Zend_Form_Element_Text('name');
        $name->setLabel('Nome del servizio');
        $name->setRequired(true);
        $name->addFilters(array('StringTrim', 'StripTags'));
        $name->setAttrib('class', 'span5');
        $name->setDecorators(array('ViewHelper', 'Errors', 'label'));
        
        $type = new Zend_Form_Element_Select('type');
        $type->setLabel('Tipologia di prezzo');
        $type->setRequired(true);
        $type->addMultiOptions(array(1 => 'Free', 2 => 'Giornaliero', 3 => 'Una Tantum'));
        $type->setDecorators(array('ViewHelper', 'Errors', 'label'));
        
        $price = new Zend_Form_Element_Text('price');
        $price->setLabel('Prezzo base');
        $price->setRequired(true);
        $price->addFilters(array('StringTrim', 'StripTags'));
        $price->setDecorators(array('ViewHelper', 'Errors', 'label'));
        
        $photo = new Zend_Form_Element_File('photo');
        $photo->setLabel('Seleziona un file');
        $photo->setRequired(true);
        $photo->setDestination(sprintf('%s/uploaded', $_SERVER['DOCUMENT_ROOT']));
        $photo->addFilter('Rename', sprintf('%s.jpg', uniqid()));
        $photo->addValidator('Extension', false, 'jpg,png,gif');
        $photo->setDecorators(array('File', 'Errors', 'label'));
          
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Salva');
        $submit->setAttrib('class', 'btn');
        $submit->setDecorators(array('ViewHelper', array('HtmlTag', array('tag' => 'p'))));
        
        return $this->addElements(array($name, $type, $price, $photo, $submit));
    }

    /**
     * Edit_Facility
     * 
     * @access public
     *
     * @return mixed Value.
     */
    public function Edit_Facility()
    {
        $name = new Zend_Form_Element_Text('name');
        $name->setLabel('Nome del servizio');
        $name->setRequired(true);
        $name->addFilters(array('StringTrim', 'StripTags'));
        $name->setAttrib('class', 'span5');
        $name->setDecorators(array('ViewHelper', 'Errors', 'label'));
        
        $type = new Zend_Form_Element_Select('type');
        $type->setLabel('Tipologia di prezzo');
        $type->setRequired(true);
        $type->addMultiOptions(array(1 => 'Free', 2 => 'Giornaliero', 3 => 'una Tantum'));
        $type->setDecorators(array('ViewHelper', 'Errors', 'label'));
        
        $price = new Zend_Form_Element_Text('price');
        $price->setLabel('Prezzo base');
        $price->setRequired(true);
        $price->addFilters(array('StringTrim', 'StripTags'));
        $price->setDecorators(array('ViewHelper', 'Errors', 'label'));
        
        $photo = new Zend_Form_Element_File('photo');
        $photo->setLabel('Seleziona un file');
        $photo->setDestination(sprintf('%s/uploaded', $_SERVER['DOCUMENT_ROOT']));
        $photo->addValidator('Extension', false, 'jpg,png,gif');
        $photo->setDecorators(array('File', 'Errors', 'label'));

        $status = new Zend_Form_Element_Select('status');
        $status->setLabel('Stato');
        $status->addMultiOptions(array(0 => 'Sospeso', 1 => 'Attivo'));
        $status->setDecorators(array('ViewHelper', 'Errors', 'label'));
        
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Salva');
        $submit->setAttrib('class', 'btn');
        $submit->setDecorators(array('ViewHelper', array('HtmlTag', array('tag' => 'p'))));
        
        return $this->addElements(array($name, $type, $price, $photo, $status, $submit));
    }


}

