<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Project extends ORM {
    protected $_table_name = 'Aka_Projekte';
    protected $_table_columns = array(
        'ID_Projekt' => array(),
        'ID_Thema' => array(),
        'Projektautor' => array(),
        'Projektname' =>array(),
        'Projektbeschreibung'=>array(),
        'Veroeffentlichung'=>array(),
        'Untersuchsungsgebiet'=>array(),
        'Quellen'=>array(),
        'Untergliederung'=>array(),
        'ZA_Studiennummer'=>array(),
        'Datum_der_Archivierung'=>array(),
        'Datum_de_Bearbeitung'=>array(),
        'Bearbeiter_im_ZA'=>array(),
        'Bemerkungen'=>array(),
        'Zugangsklasse'=>array(),
        'Anzahl_Zeitreiehen'=>array(),
        'Zeitraum'=>array(),
        'exportable'=>array(),
        'Fundort'=>array(),
        'Anmerkungsteil'=>array(),
        'datei_inhalt'=>array(),
        'datei_name'=>array(),
        'chdate'=>array()
    );
    protected $_primary_key = 'ID_Projekt';
    public function new_projects(){
        return $this->select(
                array('ZA_Studiennummer','Studiennummer'),
                array('Projektname','Studientitel'),
                array('Projektautor','Autor'),'ID_Projekt'
                )
                ->where('ID_Thema','<>','14')
                ->order_by('chdate', 'DESC')
                ->limit('30');
        
    }
}