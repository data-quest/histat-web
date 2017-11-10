<?php

defined('SYSPATH') or die('No direct access allowed.');

class Model_Code extends ORM {

    protected $_table_name = 'Aka_Codes';
    protected $_table_columns = array(
        'ID_CodeKuerz' => array(),
        'CodeBeschreibung' => array(),
        'Zeichen' => array(),
        'chdate' => array()
    );
    protected $_primary_key = 'ID_CodeKuerz';
    protected $_belongs_to = array(
        'keycode' => array('model' => 'Keycode', 'foreign_key' => 'ID_CodeKuerz', 'far_key' => 'ID_CodeKuerz'),
        );


}
