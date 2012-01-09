<?php defined('SYSPATH') or die('No direct script access.');

class Message {
    public static function error($message,$title = null){
       $view = View::factory('message/error');
       $view->message = $message;
       $view->title = $title == null?__('Error'):$title;
       return $view->render();
    }
     public static function info($message,$title = null){
       $view = View::factory('message/info');
       $view->message = $message;
       $view->title = $title == null?__('Info'):$title;
       return $view->render();
    }
}