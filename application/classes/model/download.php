<?php

defined('SYSPATH') or die('No direct access allowed.');

class Model_Download extends ORM {

    protected $_table_name = 'user_downloads';
    protected $_primary_key = 'ID';
    protected $_table_columns = array(
        'ID' => array(),
        'username' => array(),
        'projekt_id' => array(),
        'anzahl' => array(),
        'type' => array(),
        'intended_use' => array(),
        'za_nummer' => array(),
        'name'=>array(),
        'mkdate'=>array()
    );

 protected $_belongs_to = array(
          'project'=>array('model'=>'project','foreign_key'=>'projekt_id')
    );
}