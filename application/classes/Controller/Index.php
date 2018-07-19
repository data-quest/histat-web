<?php

defined('SYSPATH') or die('No direct script access.');

/**
 * Controller <b>Index</b> is the Main Controller
 */
class Controller_Index extends Controller_Template {

    /**
     * Directory Paths to Assets
     * @var array $assets [js|css|img]
     */
    protected $assets = array(
        'js' => 'assets/js/',
        'css' => 'assets/css/',
        'img' => 'assets/img/'
    );

    /**
     * Instance of Auth Class
     * @var Object $user
     */
    protected $user = NULL;

    /**
     * Object of Config class, use method <b>get</b> to get Values from config/config.php
     * @var Object $config
     * @example
     * $this->config->get('foo'); //get foo from config/config.php
     * @link http://kohanaframework.org/3.2/guide/kohana/config
     */
    protected $config;

    /**
     * Instance of Session object
     * @var Object $session
     * @link http://kohanaframework.org/3.2/guide/kohana/sessions
     */
    protected $session;

    /**
     * Page Title
     * @var string $title
     */
    protected $title = '';

    /**
     * Page Content , accepts HTML and View
     * @var string $content
     */
    protected $content = '';

    /**
     * css Styles
     * @var array $styles
     * @example
     * $this->styles[] = 'myfile.css'; //Add new CSS style
     */
    protected $styles = array();

    /**
     * js Scripts
     * @var array $scripts
     * @example
     * $this->scripts[]='myscript.js'; //Add new JS Script
     */
    protected $scripts = array();

    /**
     * Navigation object of main Navigation (see classes/navigation.php)
     * @var Navigation $main_navi
     */
    protected $main_navi;

    /**
     * Navigation object of main Navigation (see classes/navigation.php)
     * @var Navigation $sub_navi
     */
    protected $sub_navi;
    protected $xsrf;
    protected $desription = 'Startseite';
    protected $project = '';
    protected $table = '';
    protected $table_filters = '';

    public function before() {
        //Setup layout
        $this->template = 'index';
        parent::before();
        //Load Config
        $this->config = Kohana::$config->load('config');
        //Setup Stylesheets
        $this->styles [] = 'style.css';
        //Setup Scripts
        $this->scripts [] = 'jquery.min.js';
        $this->scripts [] = 'jquery-ui.min.js';
        $this->scripts [] = 'search.js';
        $this->scripts [] = 'main.js';
        $this->scripts [] = 't.js?et=qPKGYV';
          I18n::lang($this->request->param('lang','de'));
        //Setup Cookie
        Cookie::$salt = $this->config->get('cookie_salt');
        //Setup Session
        $this->session = Session::instance();
        //Setup empty content
        $this->content = '';
        //Setup empty title
        $this->title = __('Historical Statistics');

        //Setup Instances of Navigations
        $this->main_navi = new Navigation();
        $this->sub_navi = new Navigation(1);
        //Get user Instance
        $this->user = Auth::instance()->get_user();


        //Add main Navigation Items
        $this->main_navi->add('index', __('Home'));
        $this->main_navi->add('data', __('Data'));
        //$this->main_navi->add('pages/about', __('About'));
        //$this->main_navi->add('pages/galery', __('Galery'));


        //If user is not loged in
        if (!$this->user) {
            Auth::instance()->force_login('guest');
            $this->user = Auth::instance()->get_user();
        }

        //If user has roles login OR admin, display logout button
        if (!$this->user->has_roles(array('login', 'admin'))) {
            $this->main_navi->add('auth', __('Login'));
        }
        if($this->user->has_roles(array('admin'))){
             $this->main_navi->add('admin', __('Admin'));
        }
        //Bind Assets Directories global to all Views
        View::bind_global('assets', $this->assets);

        //Read or Create new xsrf Token
        $this->xsrf = $this->session->get('xsrf', md5(Text::random('alnum')));
        //Save xsrf Token
        $this->session->set('xsrf', $this->xsrf);


    }

    public function action_index() {
        //Activate Home Item
        $this->main_navi->activate(__('Home'));
        //Get the view home.php
        $view = View::factory('home');
        //Assign Vars to home.php
        $view->base_url = Kohana::$base_url;
        $view->welcome = View::factory(I18n::$lang . '/pages/welcome')->render(); //render view/<lang>/welcome.php
        $view->stats = View::factory(I18n::$lang . '/pages/stats')->render(); //render view/<lang>/stats.php
        $view->priorities = View::factory(I18n::$lang . '/pages/priorities')->render(); //render view/<lang>/priorities.php
        $view->partners = View::factory(I18n::$lang . '/pages/partners')->render(); //render view/<lang>/partners.php
        //Render View and setup Content
        $this->content = $view->render();
    }

    private function page_name() {

        $c = $this->request->controller();
        $a = $this->request->action();
        return ('HISTAT/' . urlencode(I18n::$lang.Kohana::$config->load('etracker')->get($c . '/' . $a)) . ':' . $c . '/' . $a . ($this->project ? '/' . $this->project : ''));
    }
    private function area(){
             $c = $this->request->controller();
        $a = $this->request->action();
        return ('HISTAT/' . urlencode(I18n::$lang.'/'.$c . '/' . $a));

    }

    public function after() {

        //Disable assign vars if template is not a view(ajax Request)
        if ($this->template instanceof View) {
            $times = DB::select(array(DB::expr('COUNT(ID_HS)'), 'amount'))->from('Lit_ZR')->as_object()->execute();
            $studies = DB::select(array(DB::expr('COUNT(*)'), 'amount'))->from('Aka_Projekte')->as_object()->execute();
             $project = ORM::factory('Project')->get_newest();
            //Assign vars to layout
            $this->template->searchbar = View::factory(I18n::$lang . '/search/bar')->render(); //render view/<lang>/searchbar.php
            $this->template->main_navi = $this->main_navi->get_items();
            $this->template->sub_navi = $this->sub_navi->get_items();
            $this->template->title = $this->title;
            $this->template->content = $this->content;
            $this->template->styles = $this->styles;
            $this->template->scripts = $this->scripts;
            $this->template->xsrf = $this->xsrf;
            $this->template->times = number_format($times[0]->amount, 0, ',', '.');
            $this->template->studies = number_format($studies[0]->amount, 0, ',', '.');
            $date = time();
            if(count($project)>0){ $date = strtotime($project[0]->chdate);}
            $this->template->date = date("d.m.Y",$date);
            $this->template->user = $this->user;
            $this->template->pagename = urlencode($this->page_name());
             $this->template->area = urlencode($this->area());
            //Main Layout will be rendered in after method
        }
        parent::after();
    }

}