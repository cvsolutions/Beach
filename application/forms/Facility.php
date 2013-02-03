<?php

class Application_Form_Facility extends Zend_Form
{

    public function init()
    {
        $this->setAttrib('class', 'custom');
        
        $name = new Zend_Form_Element_Text('name');
        $name->setLabel('Nome del servizio');
        $name->setRequired(true);
        $name->addValidator('NotEmpty');
        $name->addFilters(array('StringTrim', 'StripTags'));
        
        $type = new Zend_Form_Element_Select('type');
        $type->setLabel('Tipologia di prezzo');
        $type->setRequired(true);
        $type->addValidator('NotEmpty');
        $type->addMultiOptions(array(1 => 'Free', 2 => 'Giornaliero', 3 => 'una Tantum'));
        
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
        
        $this->addElements(array($name, $type, $price, $photo, $status, $submit));
    }


}

