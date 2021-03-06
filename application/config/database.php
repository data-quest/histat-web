<?php

defined('SYSPATH') or die('No direct access allowed.');

return array
    (
    'default' => array(
        'type' => 'PDO',
        'connection' => array(
            /**
             * The following options are available for PDO:
             *
             * string   dsn         Data Source Name
             * string   username    database username
             * string   password    database password
             * boolean  persistent  use persistent connections?
             */
            'dsn' => 'mysql:host=127.0.0.1;dbname=histat_1',
            'username' => '',
            'password' => '',
            'persistent' => FALSE,
        ),
        /**
         * The following extra options are available for PDO:
         *
         * string   identifier  set the escaping identifier
         */
        'table_prefix' => '',
        'identifier' => '`',
        'charset' => 'utf8',
        'caching' => FALSE,
        'profiling' => (Kohana::$environment !== Kohana::PRODUCTION),
    ),

);
