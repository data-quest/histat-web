<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Auth extends Controller_Index {

    private $layout;

    public function before() {
        parent::before();
        $this->main_navi->activate(__('Login'));
        $this->sub_navi->add('auth/login', __('Login'));
        $this->sub_navi->add('auth/create', __('Create'));
        $this->sub_navi->add('auth/send', __('Send new password'));
        $this->layout = View::factory('auth/layout');
        $this->layout->content = '';
    }

    public function action_index() {
        //if user is logged in display Error page
        if ($this->user) {
            throw new HTTP_Exception_404();
        }

        $this->action_login();
    }

    public function action_login() {
        //if user is logged in display Error page
        if ($this->user) {
            throw new HTTP_Exception_404();
        }
        $this->sub_navi->activate(__('Login'));
        $view = View::factory(I18n::$lang . '/auth/login');

        if (HTTP_Request::POST == $this->request->method()) {
            // Attempt to login user
            $remember = array_key_exists('remember', $this->request->post()) ? (bool) $this->request->post('remember') : FALSE;
            $user = Auth::instance()->login($this->request->post('username'), $this->request->post('password'), $remember);
            // If successful...
            if ($user) {
                $this->request->redirect(I18n::$lang . '/index');
            } else {
                $view->incorrect = TRUE;
            }
        }
        $this->layout->content = $view->render();
    }

    public function action_logout() {
        //if user is logged in display Error page
        if ($this->user == NULL) {
            throw new HTTP_Exception_404();
        }
        Auth::instance()->logout();
        $this->request->redirect(I18n::$lang . '/index');
    }

    public function action_create() {
        //if user is logged in display Error page
        if ($this->user) {
            throw new HTTP_Exception_404();
        }

        $view = View::factory(I18n::$lang . '/auth/create');
        $view->errors = array();
        $this->sub_navi->activate(__('Create'));
        if (HTTP_Request::POST == $this->request->method()) {
            try {
                $password = Text::random('alnum');
                //Add additional values which dont comes from Form
                $additional = array(
                    'ip' => $_SERVER['REMOTE_ADDR'],
                    'chdate'=>time(),
                    'mkdate' => time(),
                    'password' => $password
                );

                $post = Arr::merge($this->request->post(), $additional);
                // Create the user using form values
                $user = ORM::factory('user');
                $user->create_user($post, array(
                    'username',
                    'password',
                    'email',
                    'mkdate',
                    'chdate',
                    'title',
                    'name',
                    'surname',
                    'institution',
                    'department',
                    'street',
                    'zip',
                    'location',
                    'country',
                    'phone',
                    'ip'
                ));

                // Grant user login role
                $user->add('roles', ORM::factory('role', array('name' => 'login')));

                // Reset values so form is not sticky
                $_POST = array();

                //Change the View
                $view = View::factory(I18n::$lang . '/auth/create_success');
                $view->email = $post['email'];

                $mailBody = View::factory(I18n::$lang . '/mails/activate');
                $mailBody->username = $post['username'];
                $mailBody->password = $password;
                $mailBody->name = $post['name'];
                $mailBody->surname = $post['surname'];
                $email = Email::factory(__(':username your account informations', array(':username' => $post['username'])))
                        ->to($post['email'])
                        ->from($this->config->get('from'))
                        ->message($mailBody->render(), 'text/html')
                        ->send();
            } catch (ORM_Validation_Exception $e) {
                $view->errors = $e->errors(I18n::$lang);
            }
        }



        $this->layout->content = $view->render();
    }

    public function action_send_again() {
        //if user is logged in display Error page
        if ($this->user != NULL) {
            throw new HTTP_Exception_404();
        }
        $this->layout->icon = 'mail-open';
        $this->title = 'Web.OS - ' . _('Resend activation key');
        $view = View::factory('auth/activate');
        $view->error = NULL;
        if (HTTP_Request::POST == $this->request->method()) {
            $email = $this->request->post('email');

            if ($email != NULL) {
                $user = ORM::factory('user', array('email' => $email));
                if (!$user->loaded()) {
                    $view->error = __('User not found.');
                } else {
                    if ($user->activation_key != NULL) {
                        $activation_key = Text::random('alnum');
                        $user->activation_key = $activation_key;
                        $user->save();
                        $body = View::factory(I18n::$lang . '/mails/activation');
                        $body->username = $user->username;
                        $body->activation_key = $activation_key;
                        $view = View::factory(I18n::$lang . '/user/resend_success');
                        $view->email = $email;
                        $email = Email::factory(__(':username Activate your account', array(':username' => $user->username)))
                                ->to($email)
                                ->from('noreply@cruel-online.de', 'Cruel Online')
                                ->message($body->render(), 'text/html')
                                ->send();
                    } else {
                        $view->error = __('Account is already active.');
                    }
                }
            }
        }
        $this->content = $view->render();
    }

    public function after() {
        $this->content = $this->layout->render();
        parent::after();
    }

}