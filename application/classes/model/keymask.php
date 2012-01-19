<?php defined('SYSPATH') or die('No direct access allowed.');

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
    );
   
}