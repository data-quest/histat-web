<?php defined('SYSPATH') or die('No direct script access.');

class HTML extends Kohana_HTML{
    public static function anchor($uri, $title = NULL, array $attributes = NULL, $protocol = NULL, $index = TRUE) {
        if (strpos($uri, '://') == FALSE) $uri = I18n::$lang.'/'.$uri;
        return parent::anchor($uri, $title, $attributes, $protocol, $index);
    }
}