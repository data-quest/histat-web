<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Timeline extends ORM {

    protected $_table_name = 'Lit_ZR';
    protected $_table_columns = array(
        'ID_HS' => array(),
        'Schluessel' => array(),
        'Quelle' => array(),
        'Anmerkung' => array(),
        'Tabelle' => array(),
        'chdate' => array()
    );
    protected $_primary_key = 'ID_HS';
    protected $_belongs_to = array('keymask' => array('model' => 'keymask', 'foreign_key' => 'ID_HS', 'far_key' => 'ID_HS'));

}