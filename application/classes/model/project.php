<?php

defined('SYSPATH') or die('No direct access allowed.');

class Model_Project extends ORM {

    protected $_table_name = 'Aka_Projekte';
    protected $_primary_key = 'ID_Projekt';
    protected $_has_many = array(
        'keymasks' => array('model' => 'keymask', 'foreign_key' => 'ID_Projekt', 'far_key' => 'ID_Projekt'),
    );
    protected $_has_one = array(
        'theme' => array('model' => 'theme', 'foreign_key' => 'ID_Thema', 'far_key' => 'ID_Thema'),
        'time' => array('model' => 'theme', 'foreign_key' => 'ID_Zeit', 'far_key' => 'ID_Zeit')
    );
    protected $_belongs_to = array(
        'theme' => array('model' => 'theme', 'foreign_key' => 'ID_Thema', 'far_key' => 'ID_Thema'),
        'time' => array('model' => 'theme', 'foreign_key' => 'ID_Zeit', 'far_key' => 'ID_Zeit')
    );
    protected $_table_columns = array(
        'ID_Projekt' => array(),
        'ID_Thema' => array(),
        'ID_Zeit' => array(),
        'Projektautor' => array(),
        'Projektname' => array(),
        'Projektbeschreibung' => array(),
        'Veroeffentlichung' => array(),
        'Untersuchsungsgebiet' => array(),
        'Quellen' => array(),
        'Untergliederung' => array(),
        'ZA_Studiennummer' => array(),
        'Publikationsjahr' => array(),
        'Datum_der_Archivierung' => array(),
        'Datum_de_Bearbeitung' => array(),
        'Bearbeiter_im_ZA' => array(),
        'Bemerkungen' => array(),
        'Zugangsklasse' => array(),
        'Anzahl_Zeitreihen' => array(),
        'Zeitraum' => array(),
        'exportable' => array(),
        'Fundort' => array(),
        'Anmerkungsteil' => array(),
        'datei_inhalt' => array(),
        'datei_name' => array(),
        'chdate' => array()
    );

    public function new_projects() {

        return $this->select(
                                array('ZA_Studiennummer', 'Studiennummer'), array('Projektname', 'Studientitel'), array('Projektautor', 'Autor'), 'ID_Projekt', 'Anzahl_Zeitreihen'
                        )
                        ->where('ID_Thema', '!=', Kohana::$config->load('config.example_theme_id'))
                        ->order_by('chdate', 'DESC')
                        ->limit('20');
    }

    public function top_projects() {


        $result = DB::select(
                        'Zeitraum', 'Anzahl_Zeitreihen', array('ZA_Studiennummer', 'Studiennummer'), array('Projektname', 'Studientitel'), array('Projektautor', 'Autor'), 'ID_Projekt', 'Thema','Datum_der_Bearbeitung','Publikationsjahr'
                )
                ->from('Aka_Projekte')
                ->join('user_downloads', 'INNER')
                ->on('ID_Projekt', '=', 'projekt_id')
                ->join('Aka_Themen', 'INNER')
                ->using('ID_Thema')
                ->where('ID_Thema', '!=', Kohana::$config->load('config.example_theme_id'))
                ->group_by('projekt_id')
                ->order_by(DB::expr('count(user_downloads.id)'), 'DESC')
                ->limit('20')
                ->as_object($this)
                ->execute();

        return $result;
    }

    public function getUsedTables() {
        return DB::select("lz.ID_HS")->distinct(true)
                        ->from(array("Aka_Projekte", "p"))
                        ->join(array('Aka_Schluesselmaske', 'sm'), 'INNER')->on('p.ID_Projekt', '=', 'sm.ID_Projekt')
                        ->join(array('Lit_ZR', 'lz'), 'INNER')->on('sm.ID_HS', '=', 'lz.ID_HS')
                        ->where('p.ID_Projekt', '=', $this->ID_Projekt)
                        ->order_by('lz.ID_HS')->as_object()->execute();
    }

    public function getAuthors() {

        return DB::select('ID_Projekt', 'Projektautor')
                        ->from(array('Aka_Projekte', 'p'))
                        ->where('p.ID_Thema', '!=', Kohana::$config->load('config.example_theme_id'))
                        ->where('p.Projektautor', 'IS NOT', NULL)
                        ->order_by('Projektautor')
                
                        ->as_object()
                        ->execute();
    }
    public function getKeymasks(){
        return DB::select('Name','ID_HS')
                ->from(array('Aka_Schluesselmaske','sm'))
                ->where('ID_Projekt','=',$this->ID_Projekt)
                ->order_by('Name')->as_object()->execute();
                
                
    }
    public function getTimelines($id){
             return DB::select(array(DB::expr('COUNT(lz.ID_HS)'),'timelines'))
                ->from(array('Aka_Schluesselmaske','sm'))
                ->join(array('Lit_ZR','lz'))
                ->on('lz.ID_HS','=','sm.ID_HS')
                ->where('sm.ID_Projekt','=',$this->ID_Projekt)
                     ->where('sm.ID_HS','=',$id)
                ->as_object()->execute();
    }
    public function search($post = NULL) {

        $theme = Arr::get($post, 'theme', '-1');
        if ($theme === '-1')
            $theme = null;
        $text = Arr::get($post, 'text', '');
        if(empty($text) || $text == 'Suchbegriff'){
            $text = NULL;
              Search::set_search_query();
        }else{
            Search::set_search_query($text);
             $text = Database::instance()->quote($text);
                
        }
     
        $title = Arr::get($post, 'title', NULL);
        $source = Arr::get($post, 'source', NULL);
        $description = Arr::get($post, 'description', NULL);
        $min = Arr::get($post, 'min', 1200);
        $max = Arr::get($post, 'max', date('Y',time()));
        $id = Arr::get($post, 'id', NULL);
        $select = 'p.ID_Projekt,p.Projektname,p.ZA_Studiennummer,t.Thema,p.Datum_der_Bearbeitung,p.Projektautor,p.Publikationsjahr';
        $result = array();

        

        if ($title) {

            if ($id) {
                $select = 'asx.ID_HS,asx.Schluessel,asx.hs_name,asx.ID_Projekt,asx.count_data,asx.min_jahr_sem,asx.max_jahr_sem';
            }

            //schluessel index match
            $db = DB::select($select)
                    ->from(array('Aka_Projekte', 'p'))
                    ->join(array('aka_schluesselindex', 'asx'), 'INNER')
                    ->using('ID_Projekt')
                    ->join(array('Aka_Themen', 't'), 'INNER')
                    ->using('ID_Thema')
                    ->where('asx.min_jahr_sem', '>=', $min)
                    ->where('asx.max_jahr_sem', '<=', $max);
            if ($id) {
                $db->where('p.ID_Projekt', '=', $id);
            }
            if ($theme) {
                $db->where('p.ID_Thema', '=', $theme);
            } else {
                $db->where('p.ID_Thema', '!=', Kohana::$config->load('config.example_theme_id'));
            }
            if($text)
            $db->where(DB::expr("MATCH(schluessel_index)"), ' ', DB::expr("AGAINST(:text IN BOOLEAN MODE)", array(':text' => $text)));
            
            if(!$id)
            $db->group_by('asx.ID_Projekt');;
           
            foreach ($db->as_object()->execute() as $value) {
                if ($id) {
                    $result['tables'][$value->ID_HS]['name'] = $value->hs_name;
                    $result['tables'][$value->ID_HS]['keys'][$value->Schluessel] = $value->Schluessel;
                } else {
                    $bearbeitung = '';
                    $datum = substr($value->Datum_der_Bearbeitung, -4);
                    if (!empty($datum)) {
                        $bearbeitung = '[' . $datum . ']';
                    }

                    $name = __(':author, (:pub_year :edit_year) :project', array(':author' => $value->Projektautor,
                        ':pub_year' => $value->Publikationsjahr,
                        ':edit_year' => $bearbeitung,
                        ':project' => $value->Projektname
                            ));

                    $result[$value->ID_Projekt] = Arr::get($result, $value->ID_Projekt, array(
                                'name' => $name,
                                'za' => $value->ZA_Studiennummer,
                                'theme' => $value->Thema
                            ));
                    $result[$value->ID_Projekt]['data'] = true;
                }
            }
           
            if ($id) {

                foreach (Arr::get($result, 'tables', array()) as $id_hs => $value) {
                    $result['tables'][$id_hs]['filter'] = Search::create_filter($value['keys']);
                }
            }


            //hs_name match

            $db = DB::select($select)
                    ->from(array('Aka_Projekte', 'p'))
                    ->join(array('aka_schluesselindex', 'asx'), 'INNER')
                    ->using('ID_Projekt')
                    ->join(array('Aka_Themen', 't'), 'INNER')
                    ->using('ID_Thema')
                    ->where('asx.min_jahr_sem', '>=', $min)
                    ->where('asx.max_jahr_sem', '<=', $max);
            if ($id) {
                $db->where('p.ID_Projekt', '=', $id);
            }
            if ($theme) {
                $db->where('p.ID_Thema', '=', $theme);
            } else {
                $db->where('p.ID_Thema', '!=', Kohana::$config->load('config.example_theme_id'));
            }
             if($text)
            $db->where(DB::expr("MATCH(hs_name)"), ' ', DB::expr("AGAINST(:text IN BOOLEAN MODE)", array(':text' => $text)));
             
              if(!$id)
             $db->group_by('asx.ID_Projekt');;
           
            foreach ($db->as_object()->execute() as $value) {
                if ($id) {
                    $result['tables'][$value->ID_HS]['name'] = $value->hs_name;
                    $result['tables'][$value->ID_HS]['keys'][$value->Schluessel] = $value->Schluessel;
                    $result['tables'][$value->ID_HS]['filter'] = false;
                } else {
                          $bearbeitung = '';
                    $datum = substr($value->Datum_der_Bearbeitung, -4);
                    if (!empty($datum)) {
                        $bearbeitung = '[' . $datum . ']';
                    }

                    $name = __(':author, (:pub_year :edit_year) :project', array(':author' => $value->Projektautor,
                        ':pub_year' => $value->Publikationsjahr,
                        ':edit_year' => $bearbeitung,
                        ':project' => $value->Projektname
                            ));

                    $result[$value->ID_Projekt] = Arr::get($result, $value->ID_Projekt, array(
                                'name' => $name,
                                'za' => $value->ZA_Studiennummer,
                                'theme' => $value->Thema
                            ));
                    $result[$value->ID_Projekt]['data'] = true;
                }
            }
        }
        if ($description) {
            if ($id) {
                $select = 'p.ID_Projekt,p.Projektname, p.Projektbeschreibung, p.Anmerkungsteil, p.Untergliederung,p.Veroeffentlichung,p.Quellen,CONCAT(Veroeffentlichung, \' GESIS Köln, Deutschland ZA\', CONCAT_WS(\' \', ZA_Studiennummer,\'Datenfile\',Bemerkungen)) as quote';
            }

            $db = DB::select($select)
                    ->from(array('Aka_Projekte', 'p'))
                    ->join(array('aka_schluesselindex', 'asx'), 'INNER')
                    ->using('ID_Projekt')
                    ->join(array('Aka_Themen', 't'), 'INNER')
                    ->using('ID_Thema')
                    ->where('asx.min_jahr_sem', '>=', $min)
                    ->where('asx.max_jahr_sem', '<=', $max);
            if ($id) {
                $db->where('p.ID_Projekt', '=', $id);
            }
            if ($theme) {
                $db->where('p.ID_Thema', '=', $theme);
            } else {
                $db->where('p.ID_Thema', '!=', Kohana::$config->load('config.example_theme_id'));
            }
             if($text)
            $db->where(DB::expr("MATCH(Projektname, Projektbeschreibung, Untergliederung,Veroeffentlichung,Quellen)"), ' ', DB::expr('AGAINST(:text IN BOOLEAN MODE)', array(':text' => $text)));
             
              if(!$id)
             $db->group_by('asx.ID_Projekt');


            foreach ($db->as_object()->execute() as $value) {

                if ($id) {
                    $result['Zitierpflicht'] = Search::get_search_excerpt($value->quote);
                    $result['Projektname'] = Search::get_search_excerpt($value->Projektname);
                    $result['Projektbeschreibung'] = Search::get_search_excerpt($value->Projektbeschreibung);
                    $result['Anmerkungsteil'] = Search::get_search_excerpt($value->Anmerkungsteil);
                    $result['Untergliederung'] = Search::get_search_excerpt($value->Untergliederung);
                    $result['Veroeffentlichung'] = Search::get_search_excerpt($value->Veroeffentlichung);
                    $result['Quellen'] = Search::get_search_excerpt($value->Quellen);
                } else {
                         $bearbeitung = '';
                    $datum = substr($value->Datum_der_Bearbeitung, -4);
                    if (!empty($datum)) {
                        $bearbeitung = '[' . $datum . ']';
                    }

                    $name = __(':author, (:pub_year :edit_year) :project', array(':author' => $value->Projektautor,
                        ':pub_year' => $value->Publikationsjahr,
                        ':edit_year' => $bearbeitung,
                        ':project' => $value->Projektname
                            ));

                    $result[$value->ID_Projekt] = Arr::get($result, $value->ID_Projekt, array(
                                'name' => $name,
                                'za' => $value->ZA_Studiennummer,
                                'theme' => $value->Thema
                            ));
                    $result[$value->ID_Projekt]['description'] = true;
                }
            }
        }
        
        if ($source) {
            if ($id) {
                $select = 'asx.ID_HS,asx.hs_name,asx.Schluessel,asx.count_data,Quelle';
            }
            $db = DB::select($select)
                    ->from(array('Aka_Projekte', 'p'))
                    ->join(array('aka_schluesselindex', 'asx'), 'INNER')
                    ->using('ID_Projekt')
                    ->join(array('Aka_Themen', 't'), 'INNER')
                    ->using('ID_Thema')
                    ->join(array('Lit_ZR', 'lz'))
                    ->using('ID_HS', 'Schluessel')
                    ->where('asx.min_jahr_sem', '>=', $min)
                    ->where('asx.max_jahr_sem', '<=', $max);
            if ($id) {
                $db->where('p.ID_Projekt', '=', $id);
            }
            if ($theme) {
                $db->where('p.ID_Thema', '=', $theme);
            } else {
                $db->where('p.ID_Thema', '!=', Kohana::$config->load('config.example_theme_id'));
            } 
            if($text)
            $db->where(DB::expr("MATCH(Quelle)"), ' ', DB::expr("AGAINST(:text IN BOOLEAN MODE)", array(':text' => $text)));
               
             if(!$id)
            $db->group_by('asx.ID_Projekt');
            
            foreach ($db->as_object()->execute() as $value) {

                if ($id) {
                    $result['tables'][$value->ID_HS]['name'] = $value->hs_name;
                    $result['tables'][$value->ID_HS]['source'] = $value->Quelle;
                    $result['tables'][$value->ID_HS]['keys'][$value->Schluessel] = $value->Schluessel;
                    $result['tables'][$value->ID_HS]['filter'] = false;
                    //$result['tables'][$value->ID_HS]['values'][] = $value;
                } else {
                        $bearbeitung = '';
                    $datum = substr($value->Datum_der_Bearbeitung, -4);
                    if (!empty($datum)) {
                        $bearbeitung = '[' . $datum . ']';
                    }

                    $name = __(':author, (:pub_year :edit_year) :project', array(':author' => $value->Projektautor,
                        ':pub_year' => $value->Publikationsjahr,
                        ':edit_year' => $bearbeitung,
                        ':project' => $value->Projektname
                            ));

                    $result[$value->ID_Projekt] = Arr::get($result, $value->ID_Projekt, array(
                                'name' => $name,
                                'za' => $value->ZA_Studiennummer,
                                'theme' => $value->Thema
                            ));
                    $result[$value->ID_Projekt]['data'] = true;
                }
            }
        }

        if ($id) {

            foreach (Arr::get($result, 'tables', array()) as $id_hs => $value) {
                $result['tables'][$id_hs]['keys'] = array_keys($value['keys']);
            }
        }
        
        return $result;
    }

}