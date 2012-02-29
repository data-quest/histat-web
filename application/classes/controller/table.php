<?php

defined('SYSPATH') or die('No direct script access.');

/**
 * Controller <b>Table</b> 
 */
class Controller_Table extends Controller_Data {

    private $sub_navis = array();
    private $id_hs = null;

    public function before() {
        parent::before();
        $this->sub_navis = array(
            'index' => __('New'),
            'top' => __('Top'),
            'times' => __('Times'),
            'themes' => __('Themes'),
            'authors' => __('Authors')
        );
        $index = Arr::get($this->session->get('action'), 'name', 'index');
        $this->sub_navi->activate($this->sub_navis[$index]);
        $this->id_hs = $this->request->param('id');
    }

    public function action_details() {
        $keymask = ORM::factory('keymask', $this->id_hs);
        $this->scripts[] = 'table.js';
        $view = View::factory(I18n::$lang . '/table/details');
        $list = View::factory(I18n::$lang . '/project/list');
        //assign new projects to subview
        $list->projects = $keymask->project;
        //assign the referrer uri
        $list->uri = URL::site(I18n::$lang . '/table/details/' . $this->id_hs);
        $details = array();
        foreach ($keymask->getDetails() as $detail) {
            $details[$detail->CodeBeschreibung][$detail->Schluessel] = $detail;
            $keys [$detail->Schluessel] = $detail->Schluessel;
        }
       
        $data = $keymask->getData($keys);

         
    
        $view->details = $details;
        $view->keys = $keys;
        $view->data = $data;
        $view->keymask = $keymask;

        $grid = array();

        ini_set('max_execution_time', '1600');

       
        //echo Debug::vars($details);
        foreach ($data as $y => $d) {
            foreach ($keys as $key) {
                $grid[$key][$y] = Arr::get($d, $key, 0.123456789);
            }
        }
       
        foreach ($grid as $key => $data) {
     
            $fileName = 'assets/img/charts/' . $this->id_hs . '-' . $key . '.png';
            if (!file_exists($fileName)) {

                $yAxis = array();
                $points = array();
                foreach ($data as $y => $value) {
                    $points[] = $value;
                    $yAxis[$y] = $y;
                }
                $MyData = new pData();
                $MyData->addPoints($points, "Test");
                //$MyData->addPoints($yAxis, "Labels");
                $MyData->setAbscissa("Labels");
                $name = '';
                foreach ($details as $det) {
                    foreach ($det as $detail) {
                        if ($detail->Schluessel === $key) {
                            $name .= $detail->CodeBezeichnung . ' ';
                        }
                    }
                }
                $MyData->setAbscissaName($name);

                $MyData->setPalette("Labels", array("R" => 255, "G" => 122, "B" => 0, "Angle" => 90));
                $MyData->setPalette("Test", array("R" => 255, "G" => 122, "B" => 0));
                $myPicture = new pImage(800, 400, $MyData);
                $myPicture->drawRectangle(0, 0, 799, 399, array("R" => 200, "G" => 200, "B" => 200));

                /* Write the picture title */
                $myPicture->setFontProperties(array("FontName" => "modules/pchart/vendor/pChart2.1.1/fonts/verdana.ttf", "FontSize" => 8));

                /* Do some cosmetic and draw the chart */
                $myPicture->setGraphArea(60, 10, 780, 360);
                $myPicture->drawFilledRectangle(60, 10, 780, 360, array("R" => 255, "G" => 255, "B" => 255, "Surrounding" => -200, "Alpha" => 10));
                $myPicture->drawScale(array("GridR" => 180, "GridG" => 180, "GridB" => 180));
                $myPicture->setShadow(TRUE, array("X" => 2, "Y" => 2, "R" => 0, "G" => 0, "B" => 0, "Alpha" => 10));
                $myPicture->setFontProperties(array("FontName" => "modules/pchart/vendor/pChart2.1.1/fonts/pf_arma_five.ttf", "FontSize" => 6));
                $myPicture->drawSplineChart();
                $myPicture->setShadow(FALSE);


                /* Render the picture (choose the best way) */
                $myPicture->Render($fileName);
            }
        }







        /* Create the pChart object */

        $view->project = $list->render();
        $this->content = $view->render();
    }

}