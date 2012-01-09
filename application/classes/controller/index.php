<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Index extends Controller_Template {

    protected $assets = array(
        'js' => 'assets/js/',
        'css' => 'assets/css/',
        'img' => 'assets/img/'
    );
    protected $user = NULL;
    protected $config;
    protected $session;
    protected $title = '';
    protected $content = '';
    protected $styles = array();
    protected $scripts = array();
    protected $main_navi;
    protected $sub_navi;

    public function before() {
        //Setup layout
        $this->template = 'index';
        parent::before();
        //Load Config
        $this->config = Kohana::$config->load('config');
        //Setup Stylesheets
        $this->styles [] = 'jquery-ui.css';
        $this->styles [] = 'style.css';
        //Setup Scripts
        $this->scripts [] = 'jquery.min.js';
        $this->scripts [] = 'jquery-ui.min.js';
        $this->scripts [] = 'main.js';

        //Setup Cookie
        Cookie::$salt = $this->config->get('cookie_salt');
        
        //Setup empty content
        $this->content = '';
        //Setup empty title
        $this->title = 'Historische Statistik';

        //Setup Instances of Navigations
        $this->main_navi = new Navigation();
        $this->sub_navi = new Navigation(1);
        //Get user Instance
        $this->user = Auth::instance()->get_user();
        
        //Add main Navigation Items
        $this->main_navi->add('index', __('Home'));
        $this->main_navi->add('data', __('Data'));
        $this->main_navi->add('about', __('About'));
        $this->main_navi->add('galery', __('Galery'));
        $this->main_navi->add('friends', __('Friends'));
    }

    public function action_index() {
        //Activate Home Item
        $this->main_navi->activate(__('Home'));
    }

    public function after() {
        //Assign vars to layout
        $this->template->main_navi = $this->main_navi->get_items();
        $this->template->sub_navi = $this->sub_navi->get_items();
        $this->template->title = $this->title;
        $this->template->content = $this->content;
        $this->template->styles = $this->styles;
        $this->template->scripts = $this->scripts;
        $this->template->assets = $this->assets;
        parent::after();
    }

}