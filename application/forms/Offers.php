<?php

/**
* Application_Form_Offers
*
* @uses     Zend_Form
*
* @category Form elements
* @package  Spiaggia Online
* @author   Concetto Vecchio <info@cvsolutions.it>
* @license  GPL
* @link     http://www.gnu.org/licenses/gpl.html
*/
class Application_Form_Offers extends Zend_Form
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
     * New_Offers
     * 
     * @access public
     *
     * @return mixed Value.
     */
    public function New_Offers()
    {
        $name = new Zend_Form_Element_Text('name');
        $name->setLabel('Offerta Speciale');
        $name->setRequired(true);
        $name->setAttrib('class', 'span5');
        $name->addFilters(array('StringTrim', 'StripTags'));
        $name->setDecorators(array('ViewHelper', 'Errors', 'label'));
        
        $from_date = new Zend_Form_Element_Text('from_date');
        $from_date->setLabel('Data di inizio');
        $from_date->setAttrib('class', 'calendar');
        $from_date->setDecorators(array('ViewHelper', 'Errors', 'label'));

        $to_date = new Zend_Form_Element_Text('to_date');
        $to_date->setLabel('Data fine');
        $to_date->setAttrib('class', 'calendar');
        $to_date->setDecorators(array('ViewHelper', 'Errors', 'label'));

        $description = new Zend_Form_Element_Textarea('description');
        $description->setLabel('Descrizione offerta');
        $description->setRequired(true);
        $description->setAttrib('class', 'span7');
        $description->setAttrib('rows', '10');
        $description->setDecorators(array('ViewHelper', 'Errors', 'label'));
        
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
        
        return $this->addElements(array($name, $from_date, $to_date, $description, $price, $photo, $submit));
    }

    /**
     * Edit_Offers
     * 
     * @access public
     *
     * @return mixed Value.
     */
    public function Edit_Offers()
    {
        $name = new Zend_Form_Element_Text('name');
        $name->setLabel('Offerta Speciale');
        $name->setRequired(true);
        $name->setAttrib('class', 'span5');
        $name->addFilters(array('StringTrim', 'StripTags'));
        $name->setDecorators(array('ViewHelper', 'Errors', 'label'));
        
        $from_date = new Zend_Form_Element_Text('from_date');
        $from_date->setLabel('Data di inizio');
        $from_date->setAttrib('class', 'calendar');
        $from_date->setDecorators(array('ViewHelper', 'Errors', 'label'));

        $to_date = new Zend_Form_Element_Text('to_date');
        $to_date->setLabel('Data fine');
        $to_date->setAttrib('class', 'calendar');
        $to_date->setDecorators(array('ViewHelper', 'Errors', 'label'));

        $description = new Zend_Form_Element_Textarea('description');
        $description->setLabel('Descrizione offerta');
        $description->setAttrib('class', 'span7');
        $description->setAttrib('rows', '10');
        $description->setDecorators(array('ViewHelper', 'Errors', 'label'));
        
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
        
        return $this->addElements(array($name, $from_date, $to_date, $description, $price, $photo, $status, $submit));
    }


}

