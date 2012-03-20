<?php

defined('SYSPATH') or die('No direct access allowed.');

class Model_Time extends ORM {

    protected $_table_name = 'Aka_Zeiten';
    protected $_primary_key = 'ID_Zeit';
    protected $_table_columns = array(
        'ID_Zeit' => array(),
        'Zeit' => array(),
        'Position' => array(),
        'chdate' => array()
    );
    protected $_has_many = array(
        'projects' => array('model' => 'project', 'far_key' => 'ID_Zeit', 'foreign_key' => 'ID_Zeit')
    );

    public function getTimes() {
        return DB::select('Aka_Zeiten.*', array('COUNT(Aka_Projekte.ID_Projekt)', 'count'), array('SUM(Aka_Projekte.Anzahl_Zeitreihen)', 'summe'))
                        ->from('Aka_Zeiten')
                        ->join('Aka_Projekte', 'LEFT')
                        ->on('Aka_Zeiten.ID_Zeit', '=', 'Aka_Projekte.ID_Zeit')
                        ->where('Aka_Projekte.ID_Projekt', 'IS NOT ', NULL)
                        ->group_by('Zeit');
    }

}