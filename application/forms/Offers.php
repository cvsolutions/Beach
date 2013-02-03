<?php

class Application_Form_Offers extends Zend_Form
{

    public function init()
    {
        $this->setAttrib('class', 'custom');
        
        $name = new Zend_Form_Element_Text('name');
        $name->setLabel('Offerta Speciale');
        $name->setRequired(true);
        $name->addValidator('NotEmpty');
        $name->addFilters(array('StringTrim', 'StripTags'));
        
        $from_date = new Zend_Form_Element_Text('from_date');
        $from_date->setLabel('Data di inizio');
        $from_date->setAttrib('class', 'four');
        
        $to_date = new Zend_Form_Element_Text('to_date');
        $to_date->setLabel('Data fine');
        $to_date->setAttrib('class', 'four');

        $description = new Zend_Form_Element_Textarea('description');
        $description->setLabel('Descrizione offerta');
        
        $price = new Zend_Form_Element_Text('price');
        $price->setLabel('Prezzo base');
        $price->setRequired(true);
        $price->addValidator('NotEmpty');
        $price->addFilters(array('StringTrim', 'StripTags'));
        $price->setAttrib('class', 'four');
        
        $photo = new Zend_Form_Element_File('photo');
        $photo->setLabel('Seleziona un file');
        $photo->setDestination(sprintf('%s/uploaded', $_SERVER['DOCUMENT_ROOT']));
        $photo->addValidator('Extension', false, 'jpg,png,gif');
        
        $status = new Zend_Form_Element_Select('status');
        $status->setLabel('Stato');
        $status->setRequired(true);
        $status->addValidator('NotEmpty');
        $status->addMultiOptions(array(0 => 'Sospeso', 1 => 'Attivo'));
        
        $submit = new Zend_Form_Element_Button('submit');
        $submit->setLabel('Salva');
        $submit->setAttrib('class', 'button');
        
        $this->addElements(array($name, $from_date, $to_date, $description, $price, $photo, $status, $submit));
    }


}

