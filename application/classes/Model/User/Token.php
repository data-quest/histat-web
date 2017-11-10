<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_User_Token extends Model_Auth_User_Token {

    protected $_table_name = 'user_tokens';
    protected $_table_columns = array(
        'user_id' => array(),
        'user_agent' => array(),
        'token' => array(),
        'type' => array(),
        'created' => array(),
        'expires' => array()
    );

}

// End User Token Model