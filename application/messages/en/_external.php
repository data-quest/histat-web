<?php

defined('SYSPATH') or die('No direct access allowed.');

return array(
    'password' => array(
        'not_empty' => 'Password is not specified.',
        'min_length' => 'the password should contain at least :param2 characters',
    ),
    'password_confirm' => array(
        'not_empty' => 'password confirmation is not given',
        'matches' => 'wrong passwords',
    ),
    'password_current' => array(
        'not_empty' => 'current password is not specified.',
        'check_password' => 'current password is wrong',
    ),
    'terms'=>array(
        'equals'=> 'general terms of condition are not accepted',
    )
);