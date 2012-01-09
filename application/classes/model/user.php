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
        'password' => array(),
        'ip' => array(),
        'register_date' => array(),
        'activation_key' => array(),
        'auth_key'=>array(),
        'logins' => array(),
        'last_login' => array()
    );

    public function rules() {

        return Arr::merge(array(
                    'username' => array(
                        array('alpha_dash'),
                        array('min_length', array(':value', 4)),
                        array('max_length', array(':value', 20)),
                        array(array($this, 'unique'), array('username', ':value')),
                    ),
                        ), parent::rules());
    }

    public function extra_rules() {
        return array(
            'terms' => array(
                array('equals', array(':value', 'on')),
            ),
        );
    }

    public static function get_password_validation($values) {
        return Validation::factory($values)
                        ->rule('password', 'min_length', array(':value', 6))
                        ->rule('password_confirm', 'matches', array(':validation', ':field', 'password'));
    }

    public function create_user($values, $expected) {
        // Validation for passwords
        $extra_validation = Model_User::get_password_validation($values)
                ->rule('password', 'not_empty');
        //Extend with extra validation
        foreach ($this->extra_rules() as $field => $rules) {
            $extra_validation->rules($field, $rules);
        }

        return $this->values($values, $expected)->create($extra_validation);
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