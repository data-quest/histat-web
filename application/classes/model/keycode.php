<?php

defined('SYSPATH') or die('No direct access allowed.');

class Model_Keycode extends ORM {

    protected $_table_name = 'Aka_SchluesselCode';
    protected $_table_columns = array(
        'ID_HS' => array(),
        'ID_CodeKuerz' => array(),
        'Position' => array(),
        'disabled' => array(),
        'chdate' => array()
    );
    protected $_primary_key = 'ID_CodeKuerz';
    protected $_belongs_to = array(
        'keymask' => array( 'foreign_key' => 'ID_HS', 'far_key' => 'ID_HS')
    );
    protected $_has_many = array(
        'codes' => array('model' => 'code', 'foreign_key' => 'ID_CodeKuerz', 'far_key' => 'ID_CodeKuerz'),
    );

}