<?php defined('SYSPATH') or die('No direct script access.');

class History {

    public static function record() {
        $s = Session::instance();
        $h = $s->get('history', array());
        $i = count($h);
        $h[$i + 1] = Request::current()->uri();
        $s->set('history', $h);
    }
    public static function go($i = 0){
        $s = Session::instance();
        $h = $s->get('history');
        $c = count($h);
        return  $h[$c-$i];
    }
}