<?php

defined('SYSPATH') or die('No direct access allowed.');

class Model_User extends Model_Auth_User {

    protected $_has_many = array(
        'user_tokens' => array('model' => 'user_token'),
        'roles' => array('model' => 'role', 'through' => 'roles_users'),
    );
    protected $_table_name = 'users';
    protected $_table_columns = array(
        'id' => array(),
        'email' => array(),
        'username' => array(),
        'title' => array(),
        'name' => array(),
        'surname' => array(),
        'institution' => array(),
        'department' => array(),
        'street' => array(),
        'zip' => array(),
        'location' => array(),
        'country' => array(),
        'phone' => array(),
        'password' => array(),
        'logins' => array(),
        'last_login' => array(),
        'ip' => array(),
        'last_action' => array(),
        'chdate' => array(),
        'mkdate' => array()
    );

    public function rules() {
       
        return Arr::merge(
                        array(
                    'username' => array(
                        array('not_empty'),
                        array('alpha_dash'),
                        array('min_length', array(':value', 4)),
                        array('max_length', array(':value', 20)),
                        array(array($this, 'unique'), array('username', ':value')),
                    ),
                    'name' => array(
                        array('not_empty'),
                        array('alpha', array(':value', TRUE))
                    ),
                    'surname' => array(
                        array('not_empty'),
                        array('alpha', array(':value', TRUE))
                    ),
                    'street' => array(
                        array('not_empty')
                    ),
                    'zip' => array(
                        array('not_empty'),
                        array('numeric')
                    ),
                    'location' => array(
                        array('not_empty'),
                        array('alpha', array(':value', TRUE))
                    ),
                    'country' => array(
                        array('not_empty'),
                        array('alpha', array(':value', TRUE))
                    ), 'phone' => array(
                        array('phone')
                    ), 'title' => array(
                        array('alpha', array(':value', TRUE))
                    ),
                    'institution' => array(
                        array('alpha', array(':value', TRUE))
                    ), 'department' => array(
                        array('alpha', array(':value', TRUE))
                        )), parent::rules()
        );
    }

    public function extra_rules() {
        return array();
    }

    public static function get_password_validation($values) {
        return Validation::factory($values)
                        ->rule('password', 'min_length', array(':value', 6))
                        ->rule('password_confirm', 'matches', array(':validation', ':field', 'password'));
    }

    public function create_user($values, $expected) {
        return $this->values($values, $expected)->create();
    }

    public function update_user($values, $expected = NULL) {
        if (empty($values['password'])) {
            unset($values['password'], $values['password_confirm']);
        }

        // Validation for passwords
        $extra_validation = Model_User::get_password_validation($values);
        //Extend with extra validation
        foreach ($this->extra_rules() as $field => $rules) {
            $extra_validation->rules($field, $rules);
        }
        return $this->values($values, $expected)->update($extra_validation);
    }

    public function has_roles($roles = array()) {
        $my_roles = array();
        foreach ($this->roles->find_all() as $role) {
            $my_roles[] = $role->name;
        }
        if (count($roles) > 0) {
            return count(array_intersect($my_roles, $roles)) > 0 ? TRUE : FALSE;
        } else {
            return $my_roles;
        }
    }

}

// End User Model