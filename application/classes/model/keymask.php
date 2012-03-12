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

    public function getDetails($filter) {
        $details = DB::select("k.ID_CodeKuerz", "Position", "CodeBeschreibung", "Zeichen", "disabled", "Code", "CodeBezeichnung")
                ->distinct(true)
                ->from(array("Aka_SchluesselCode", "k"))
                ->join(array('Aka_Codes', 'c'), 'LEFT')
                ->on('k.ID_CodeKuerz', '=', 'c.ID_CodeKuerz')
                ->join(array('Aka_CodeInhalt', 'ci'), 'LEFT')
                ->on('ci.ID_CodeKuerz', '=', 'c.ID_CodeKuerz')
                ->where("k.ID_HS", "=", $this->ID_HS)
                ->order_by('Position')
                ->as_object()
                ->execute();

        $result = array();
        $keys = $this->getKeys($filter);
   
        foreach ($keys as $key) {
            foreach ($details as $detail) {
                if ($detail->Code === substr($key->key, $detail->Position - 1, $detail->Zeichen)) {
                    $result['details'][$detail->ID_CodeKuerz][$key->key] = $detail;
                    $result['titles'][$key->key][]=$detail->CodeBezeichnung;
                    $result['filters'][$detail->ID_CodeKuerz][$detail->Code . '_' . $detail->Position . '_' . $detail->Zeichen] = $detail->CodeBezeichnung;
                    $result['keys'][$key->key] = $key->key;
                }
            }
        }

        return $result;
    }

    public function getFilter($filter = NULL) {
        if ($filter) {


            $details = DB::select(array("INSERT(REPEAT('_',LENGTH(Schluessel)),Position+1,Zeichen,CONCAT(Code))", "subkey"), "Zeichen", "Position", "Code")
                    ->distinct(TRUE)
                    ->from(array("Aka_CodeInhalt", 'ci'))
                    ->join(array("Aka_Codes", "c"), "LEFT")
                    ->on("c.ID_CodeKuerz", "=", "ci.ID_CodeKuerz")
                    ->join(array("Aka_SchluesselCode", "sc"), 'LEFT')
                    ->on("c.ID_CodeKuerz", "=", "sc.ID_CodeKuerz")
                    ->join(array("aka_schluesselindex", "si"), "LEFT")
                    ->on("si.ID_HS", "=", "sc.ID_HS")
                    ->where("ci.Code", "IN", $filter)
                    ->where("sc.ID_HS", "=", $this->ID_HS)
                    ->as_object()
                    ->execute();
            return $details;
        }
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

    public function getKeys($filter) {
        return DB::select(array("Schluessel", "`key`"))->distinct(true)
                        ->from("Lit_ZR")
                        ->where('ID_HS', '=', $this->ID_HS)
                        ->where("Schluessel", "LIKE", $filter)
                
                        ->as_object()
                        ->execute();
    }

}