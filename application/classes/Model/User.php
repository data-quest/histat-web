<?php

defined('SYSPATH') or die('No direct access allowed.');

class Model_User extends Model_Auth_User {

    protected $_has_many = array(
        'user_tokens' => array('model' => 'User_Token'),
        'user_logins' => array('model' => 'User_Login'),
        'roles' => array('model' => 'Role', 'through' => 'roles_users'),
        'cart_items' => array('model' =>'Cart')
    );
    protected $_table_name = 'users';
    protected $_table_columns = array(
        'id' => array(),
        'email' => array(),
        'username' => array(),
        'title' => array(),
        'name' => array(),
        'surname' => array(),
        'institution' => array(),
        'department' => array(),
        'street' => array(),
        'zip' => array(),
        'location' => array(),
        'country' => array(),
        'phone' => array(),
        'password' => array(),
        'logins' => array(),
        'last_login' => array(),
        'ip' => array(),
        'last_action' => array(),
        'locked'=>array(),
        'chdate' => array(),
        'mkdate' => array()
    );

    public function rules() {
        
        return array(
            'username' => array(
                array('not_empty'),
                array('alpha_dash'),
                array('min_length', array(':value', 4)),
                array('max_length', array(':value', 20)),
                array(array($this, 'unique'), array('username', ':value')),
            ),
            'password' => array(
                array('not_empty'),
            ),
            'email' => array(
                array('not_empty'),
                array('email'),
                array(array($this, 'unique'), array('email', ':value')),
            ),
            'name' => array(
                array('not_empty'),
                array('name', array(':value', TRUE))
            ),
            'surname' => array(
                array('not_empty'),
                array('name', array(':value', TRUE))
            ),
            'street' => array(
                array('not_empty')
            ),
            'zip' => array(
                array('not_empty'),
                array('numeric')
            ),
            'location' => array(
                array('not_empty'),
                array('alpha', array(':value', TRUE))
            ),
            'country' => array(
                array('not_empty'),
                array('alpha', array(':value', TRUE))
            ),
            'locked'=>array(
                array('range',array(':value',0,1))
            ),
            'phone' => array(
            // array('phone')
            ),
            'title' => array(
              //  array('alpha', array(':value', TRUE))
            ),
            'institution' => array(
           //     array('alpha', array(':value', TRUE))
            ),
            'department' => array(
              //  array('alpha', array(':value', TRUE))
                ));
       
    }

    public function extra_rules() {
        return array();
    }

    public static function get_password_validation($values) {
        return Validation::factory($values)
                        ->rule('password', 'min_length', array(':value', 6))
                        ->rule('password_confirm', 'matches', array(':validation', ':field', 'password'));
    }

    public function create_user($values, $expected) {
        return $this->values($values, $expected)->create();
    }

    public function update_password($values, $expected = NULL) {

        $validation = Validation::factory($values)
                ->rule('password', 'not_empty')
                ->rule('password', 'min_length', array(':value', 6))
                ->rule('password_confirm', 'matches', array(':validation', ':field', 'password'));
        return $this->values($values, $expected)->update($validation);
    }
       public function change_password($values, $expected = NULL) {

        $validation = Validation::factory($values)
                ->rule('password', 'not_empty')
                ->rule('password', 'min_length', array(':value', 6));
        return $this->values($values, $expected)->update($validation);
    }
    public function update_user($values, $expected = NULL) {
        if (empty($values['password'])) {
            unset($values['password'], $values['password_confirm']);
        }

        // Validation for passwords
        $extra_validation = Model_User::get_password_validation($values);
        //Extend with extra validation
        foreach ($this->extra_rules() as $field => $rules) {
            $extra_validation->rules($field, $rules);
        }
        return $this->values($values, $expected)->update($extra_validation);
    }

    public function has_roles($roles = array()) {
        $my_roles = array();
        foreach ($this->roles->find_all() as $role) {
            $my_roles[$role->name] = true;
        }
        if (count($roles) > 0) {
            return count(array_intersect_key($my_roles, array_flip($roles))) > 0 ? TRUE : FALSE;
        } else {
            return $my_roles;
        }
    }

    public function complete_login() {

        if ($this->_loaded) {

            // Update the number of logins
            $this->logins = new Database_Expression('logins + 1');

            // Set the last login date
            $this->last_login = time();
            try{
            // Save the user
            $this->update();
            }catch(ORM_Validation_Exception $e){
                echo Debug::vars($e->errors(I18n::$lang));
            }
            $login = ORM::factory('User_Login');
            $login->user_id = $this->id;
            $login->mkdate = time();
            $login->create();
        }
    }
    
    public function getCartItems(){
        /*
         *     foreach ($this->user->cart_items->find_all() as $item) {
            
            $keymask = $item->keymask;
               
            $projectID = $keymask->project->ID_Projekt;
       
            $bearbeitung = '';
            $datum = substr($keymask->project->Datum_der_Bearbeitung, -4);
            if (!empty($datum)) {
                $bearbeitung = '[' . $datum . ']';
            }

            $projectName = __(':author, (:pub_year :edit_year) :project', array(':author' => $keymask->project->Projektautor,
                ':pub_year' => $keymask->project->Publikationsjahr,
                ':edit_year' => $bearbeitung,
                ':project' => $keymask->project->Projektname
                    ));


            $tableID = $item->ID_HS;
            $tableName = $keymask->Name;
            $filter = $item->filter;
            $filterText = json_decode($item->filter_text);
            $filters[$projectID][$tableID][$filter] = array('text' => $filterText, 'timelines' => $item->timelines);
            $projects[$projectID] = array('name' => $projectName,
                'za' => $keymask->project->ZA_Studiennummer,
                'theme' => $keymask->project->theme->Thema
            );

            $tables[$projectID][$tableID] = $tableName;
        }
         */
        $result = DB::select("ID_Projekt","ID_HS","sm.Name","Projektautor","Publikationsjahr","Datum_der_Bearbeitung","Projektname","filter_text","filter","timelines","ZA_Studiennummer","Thema")
                ->distinct(TRUE)
                ->from(array("warenkorb","w"))
                ->join(array("Aka_Schluesselmaske","sm"),"LEFT")
                ->using("ID_HS")
                ->join(array("Aka_Projekte","p"),"LEFT")
                ->using("ID_Projekt")
                ->join(array("Aka_Themen","t"),"LEFT")
                ->using("ID_Thema")
                ->where("user_id","=",$this->id)
             
                ->order_by("w.chdate","DESC");
        return $result->as_object()->execute();
    }

}

// End User Model
