<?php

defined('SYSPATH') or die('No direct access allowed.');

class Model_Tablelog extends ORM {

    protected $_table_name = 'table_logs';
    protected $_table_columns = array(
        'id'=>array(),
        'ID_HS' => array(),
        'ID_Projekt' => array(),
        'Schluessel' => array(),
        'Jahr_Sem' => array(),
        'username' => array(),
        'old_value' => array(),
        'new_value' => array(),
        'chdate' => array()
    );
    protected $_has_many = array();
}