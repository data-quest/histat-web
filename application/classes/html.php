<?php defined('SYSPATH') or die('No direct script access.');

class HTML extends Kohana_HTML{
    public static function anchor($uri, $title = NULL, array $attributes = NULL, $protocol = NULL, $index = TRUE) {
        return parent::anchor(I18n::$lang.'/'.$uri, $title, $attributes, $protocol, $index);
    }
}