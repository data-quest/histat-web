<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_User extends Controller_Admin {

    public function action_view() {
        $this->sub_navi->activate(__('Users'));
        $id = $this->request->param('id');
        $view = View::factory(I18n::$lang . '/admin/user/view');


        $user = ORM::factory('user', $id);
        $view->user = $user;

        $this->content = $view->render();
    }

    public function action_lock() {
        $id = $this->request->param('id');
        if ($id) {
            $user = ORM::factory('user', $id);

            $user->locked = 1;
            $user->save();
            if ($user->save()) {
                $this->request->redirect('admin/users/locked#' . $id);
            } else {
                $this->request->redirect('admin/users/lockedfail#' . $id);
            }
        }
    }

    public function action_unlock() {
        $id = $this->request->param('id');
        if ($id) {
            $user = ORM::factory('user', $id);
            $user->locked = 0;
            if ($user->save()) {
                $this->request->redirect('admin/users/unlocked#' . $id);
            } else {
                $this->request->redirect('admin/users/unlockedfail#' . $id);
            }
        }
    }

    public function action_resend_password() {
        $id = $this->request->param('id');
        if ($id) {
            $user = ORM::factory('user', $id);


            try {
                //Add additional values which dont comes from Form
                $password = Text::random('alnum');
                $post = array(
                    'chdate' => time(),
                    'password' => $password
                );



                // Edit the user using form values
                $user->change_password($post, array(
                    'password',
                    'chdate'
                ));

                  $mailBody = View::factory(I18n::$lang . '/mails/passwordchanged');
                $mailBody->username = $user->username;
                $mailBody->password = $password;
                $mailBody->name = $user->name;
                $mailBody->surname = $user->surname;
                $email = Email::factory(__(':username your account informations', array(':username' => $user->username)))
                        ->to($user->email)
                        ->from($this->config->get('from'))
                        ->message($mailBody->render(), 'text/html')
                        ->send();
                $this->request->redirect('admin/users/pwsend#' . $id);
            } catch (ORM_Validation_Exception $e) {
                echo Debug::vars($e->errors());
             //   $this->request->redirect('admin/users/pwsendfail#' . $id);
            }
        }
    }

}