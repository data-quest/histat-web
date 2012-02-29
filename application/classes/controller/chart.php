<?php

defined('SYSPATH') or die('No direct script access.');

/**
 * Controller <b>Table</b> 
 */
class Controller_Chart extends Controller_Data {

    private $id_hs;
    private $key;

    public function before() {
        $this->auto_render = FALSE;
        parent::before();

        $id = explode('/', $this->request->param('id'));

        $this->id_hs = $id[0];
        $this->key = $id[1];
    }

  

    public function action_draw() {

        $keymask = ORM::factory('keymask', $this->id_hs);
        $data = $keymask->getData($this->key);
        $pData = new pData();
        $points = array();

        foreach ($data as $y => $d) {
            foreach ($d as $value) {
                $points[] = $value;
            }
            $yAxis[$y] = $y;
        }
        $pData->addPoints($points);
        $pData->addPoints($yAxis, "Labels");
        $pData->setPalette("Serie1", array("R" => 255, "G" => 122, "B" => 0));
        $pData->setAbscissa("Labels");
        $pImage = new pImage(800, 400, $pData);
        $pImage->drawRectangle(0, 0, 799, 399, array("R" => 200, "G" => 200, "B" => 200));
        $pImage->setFontProperties(array("FontName" => "modules/pchart/vendor/pChart2.1.1/fonts/verdana.ttf", "FontSize" => 8));
        $pImage->setGraphArea(60, 10, 790, 330);
        $pImage->drawFilledRectangle(60, 10, 790, 330, array("R" => 255, "G" => 255, "B" => 255, "Surrounding" => -200, "Alpha" => 10));
        $pImage->drawScale(array("GridR" => 180, "GridG" => 180, "GridB" => 180, "LabelRotation" => 90, "LabelSkip" => floor(count($yAxis) / 40 + 1)));
        $pImage->drawSplineChart();
        $pImage->setShadow(FALSE);
        $this->response->headers('Content-Type', 'image/png')->body($pImage->autoOutput());
    }

}