<?php

defined('SYSPATH') or die('No direct access allowed.');

abstract class Auth extends Kohana_Auth {

    public function get_user($default = NULL) {

        $user = parent::get_user($default);
       
        if (!$user) {
            return $default;
        } else {
            try{
            $user->ip = $_SERVER['REMOTE_ADDR'];
            $user->last_action = time();          
            $user->update();
            return $user;
            }catch(ORM_Validation_Exception $e){
                Debug::vars($e->errors(I18n::$lang));
            }
        }
    }

    public function hash($str) {
        return hash($this->_config['hash_method'], $str);
    }



}