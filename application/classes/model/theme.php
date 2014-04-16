<?php defined('SYSPATH') or die('No direct access allowed.');

 class Model_Theme extends ORM {

    protected $_table_name = 'Aka_Themen';
    protected $_primary_key = 'ID_Thema';

    protected $_table_columns = array(
        'ID_Thema' => array(),
        'Thema' => array(),
        'Position' => array(),
        'chdate' => array()
    );
   
    protected $_has_many = array(
        'projects' => array('model'=>'project','far_key'=>'ID_Thema','foreign_key'=>'ID_Thema')
    );
    
    public function getThemes($isAdmin = false) {
        $result = DB::select('Aka_Themen.*', array(DB::expr('COUNT(Aka_Projekte.ID_Projekt)'), 'count'), array(DB::expr('SUM(Aka_Projekte.Anzahl_Zeitreihen)'), 'summe'))
                ->from('Aka_Themen')
                ->join('Aka_Projekte','LEFT')
                ->on('Aka_Themen.ID_Thema','=','Aka_Projekte.ID_Thema')
                ->where('Aka_Projekte.ID_Projekt', 'IS NOT ', NULL);
        if (!$isAdmin) {
            $result->where('Aka_Themen.ID_Thema', '!=', Kohana::$config->load('config.test_import_id'));
        }
        return $result->group_by('Thema')->order_by('Position', 'ASC')->order_by('Thema', 'ASC');
    }
   
}