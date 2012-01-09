<?php defined('SYSPATH') or die('No direct script access.');

class Form extends Kohana_Form{
    
   public static function open($action = NULL, array $attributes = NULL) {
       return parent::open(I18n::$lang.'/'.$action, $attributes);
   }

}