<?php

defined('SYSPATH') or die('No direct access allowed.');

return array(
    'password' => array(
        'not_empty' => '$Passwort wurde nicht angegeben',
        'min_length' => '$Passwort muss mindestens :param2 Zeichen lang sein.',
    ),
    'password_confirm' => array(
        'not_empty' => '$Passwort Bestätigung wurde nicht angegeben',
        'matches' => '$Passwörter stimmen nicht überein',
    ),
    'password_current' => array(
        'not_empty' => '$Aktuelles Passwort wurde nicht angegeben',
        'check_password' => '$Aktuelles Passwort stimmt nicht',
    ),
    'terms'=>array(
        'equals'=> '$Allgemeine Geschäftsbedingungen wurden nicht akzeptiert.',
    )
);