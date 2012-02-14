<?php

defined('SYSPATH') or die('No direct access allowed.');

class Model_Keymask extends ORM {

    protected $_table_name = 'Aka_Schluesselmaske';
    protected $_table_columns = array(
        'ID_HS' => array(),
        'Name' => array(),
        'ID_Projekt' => array(),
        'chdate' => array()
    );
    protected $_primary_key = 'ID_HS';
    protected $_belongs_to = array('project' => array('model' => 'project', 'foreign_key' => 'ID_Projekt', 'far_key' => 'ID_Projekt'));
    protected $_has_many = array(
        'literatures' => array('model' => 'literature', 'foreign_key' => 'ID_HS', 'far_key' => 'ID_HS'),
        'keycodes' => array('model' => 'keycode', 'foreign_key' => 'ID_HS', 'far_key' => 'ID_HS'),
        'timelines' => array('model' => 'timeline', 'foreign_key' => 'ID_HS', 'far_key' => 'ID_HS'),
    );

    public function getDetails() {
        $codes = DB::select("k.ID_CodeKuerz", "Position", "CodeBeschreibung", "Zeichen", "disabled")
                ->from(array("Aka_SchluesselCode", "k"))
                ->join(array('Aka_Codes', 'c'), 'LEFT')
                ->on('k.ID_CodeKuerz', '=', 'c.ID_CodeKuerz')
                ->where("k.ID_HS", "=", $this->ID_HS)
                ->order_by('Position')
                ->as_object()
                ->execute();
        foreach ($codes as $code) {
            $code->Code = array();
            $sql = DB::select("CodeBezeichnung", "Code")
                    ->from('Aka_CodeInhalt')
                    ->where("ID_CodeKuerz", "=", $code->ID_CodeKuerz)
                    ->as_object()
                    ->execute();
            foreach($sql as $row){
                $code->Code[$row->Code] = $row->CodeBezeichnung;
            }
          
        }
     
        return $codes;
    }

}