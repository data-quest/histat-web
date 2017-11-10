<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_User_Login extends ORM {

    protected $_table_name = 'user_logins';
    protected $_table_columns = array(
        'user_id' => array(),
        'mkdate' => array(),
        'id' => array()
    );
  protected $_belongs_to = array(
          'user'=>array('model'=>'User')
    );
}
