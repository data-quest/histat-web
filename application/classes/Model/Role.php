<?php

defined('SYSPATH') or die('No direct access allowed.');

class Model_Role extends Model_Auth_Role {

    protected $_table_name = 'roles';
    protected $_table_columns = array(
        'id' => array(),
        'name' => array(),
        'description' => array()
    );

}

// End Role Model