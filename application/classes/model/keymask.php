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

    public function getDetails($filter = NULL) {
        $details = DB::select("k.ID_CodeKuerz", "Position", "CodeBeschreibung", "Zeichen", "disabled", "Schluessel", array("SUBSTR(Schluessel,Position,Zeichen)", "subkey"), "Code", "CodeBezeichnung")
                ->distinct(true)
                ->from(array("Aka_SchluesselCode", "k"))
                ->join(array('Aka_Codes', 'c'), 'LEFT')
                ->on('k.ID_CodeKuerz', '=', 'c.ID_CodeKuerz')
                ->join(array('Aka_CodeInhalt', 'ci'), 'LEFT')
                ->on('ci.ID_CodeKuerz', '=', 'c.ID_CodeKuerz')
                ->join(array('Daten__Aka', 'da'), 'LEFT')
                ->on('da.ID_HS', '=', 'k.ID_HS')
                ->where("k.ID_HS", "=", $this->ID_HS)
                ->where('Code', '=', DB::expr("SUBSTR(Schluessel,Position,Zeichen)"))
               
              
                
                ->order_by('Position');
        if (is_array($filter))
        //  $details->where('CodeBezeichnung','IN',$filter);
            echo Debug::vars($filter);


        return $details->as_object()
                        ->execute();
    }

    public function getData($keys) {

        $rows = DB::select("Data", "Jahr_Sem", "Schluessel")
                ->distinct(true)
                ->from("Daten__Aka")
                ->where("ID_HS", "=", $this->ID_HS)
                ->where("Schluessel", is_array($keys) ? "IN" : "=", $keys)
                ->order_by("Jahr_Sem")
                ->execute();
        $result = array();
        foreach ($rows as $row) {
            $result[$row['Jahr_Sem']][$row['Schluessel']] = $row['Data'];
        }
        return $result;
    }

    public function getKeys() {
        return DB::select(array("Schluessel", "`key`"))->distinct(true)
                        ->from("Daten__Aka")
                        ->where('ID_HS', '=', $this->ID_HS)
                        ->as_object()
                        ->execute();
    }

}