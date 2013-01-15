<?php

defined('SYSPATH') or die('No direct access allowed.');

class Model_Cart extends ORM {

    protected $_table_name = 'warenkorb';
    protected $_primary_key = 'id';
    protected $_table_columns = array(
        'id' => array(),
        'ID_HS' => array(),
        'filter' => array(),
        'filter_text' => array(),
        'user_id' => array(),
        'chdate' => array(),
        'timelines' => array()
    );

    protected $_belongs_to = array(
        'user' => array('model' => 'user', 'foreign_key' => 'user_id', 'far_key' => 'id'),
        'keymask' => array('model' => 'keymask', 'foreign_key' => 'ID_HS', 'far_key' => 'ID_HS')
    );

}
