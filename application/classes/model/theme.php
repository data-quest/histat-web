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
    protected $_belongs_to = array(
        'project'=>array('model'=>'project','far_key'=>'ID_Thema')
    );
  
    
    public function getThemes(){
        return DB::select('Aka_Themen.*',array('COUNT(Aka_Projekte.ID_Projekt)','count'),array('SUM(Aka_Projekte.Anzahl_Zeitreihen)','summe'))
                ->from('Aka_Themen')
                ->join('Aka_Projekte','LEFT')
                ->on('Aka_Themen.ID_Thema','=','Aka_Projekte.ID_Thema')
                ->where('Aka_Projekte.ID_Projekt', 'IS NOT ', NULL)
                ->group_by('Thema');
      
         
                
    }
}