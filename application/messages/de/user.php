<?php

defined('SYSPATH') or die('No direct access allowed.');

return array(
    'username' => array(
        'not_empty' => 'Benutzername wurde nicht angegeben.',
        'min_length' => 'Benutzername muss mindestens :param2 Zeichen lang sein.',
        'max_length' => 'Benutzername darf maximal :param2 Zeichen lang sein.',
        'unique' => 'Benutzername ist bereits vergeben.',
        'alpha_dash' => 'Benutzername darf nur aus Zahlen,Buchstaben und Unterstrich bestehen.',
    ),
    'name' => array(
        'not_empty' => 'Vorname wurde nicht angegeben.',
        'name' => 'Vorname ist nicht gültig.'
    ),
    'surname' => array(
        'not_empty' => 'Nachname wurde nicht angegeben.',
        'name' => 'Nachname ist nicht gültig.'
    ),
    'street' => array(
        'not_empty' => 'Straße, Nr. /Postfach wurde nicht angegeben.',
    ),
    'zip' => array(
        'not_empty' => 'Postleitzahl wurde nicht angegeben.',
        'numeric' => 'Postleitzahl ist nicht gültig.'
    ),
    'location' => array(
        'not_empty' => 'Ort wurde nicht angegeben.',
        'alpha' => 'Ort ist nicht gültig.'
    ),
    'country' => array(
        'not_empty' => 'Land wurde nicht angegeben.',
        'alpha' => 'Land ist nicht gültig.'
    ),
    'email' => array(
        'not_empty' => 'E-Mail Adresse wurde nicht angegeben.',
        'email' => 'E-Mail Adresse ist nicht gültig.',
        'unique' => 'E-Mail Adresse ist bereits vergeben.',
    ),
);