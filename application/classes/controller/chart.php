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
        $this->key   = $id[1];
    }

    public function action_draw() {
        $keymask = ORM::factory('keymask', $this->id_hs);
        $data    = $keymask->getData($this->key);


        $pData = new pData();

        $points = array();
     
        foreach ($data as $y => $d) {
            $points[$y] = 0;
            foreach ($d as $value) {
                $points[$y] = (int) $value['data'];
            }
        }
           var_dump($points);
        $pData->addPoints(array_keys($points), "y");
        $pData->addPoints($points, "v");
        $pData->setSerieOnAxis("v", 0);
        $pData->setSerieOnAxis("y", 1);

        $pData->setAxisXY(0, AXIS_Y);
        $pData->setAxisPosition(0, AXIS_POSITION_LEFT);
        $pData->setAxisXY(1, AXIS_X);
        $pData->setAxisPosition(1, AXIS_POSITION_BOTTOM);




        $pData->setScatterSerie("y", "v");

        $pData->setScatterSerieColor(0, array("R" => 255, "G" => 122, "B" => 0));

        $width    = 800;
        $height   = 400;
        $paddingY = 10;
        $paddingX = 50;
        $top      = $paddingY;
        $left     = $paddingX;
        $right    = $width - $paddingY;
        $bottom   = $height - $paddingX;
        $pImage   = new pImage($width, $height, $pData);
        $pImage->drawRectangle(0, 0, 799, 399, array("R" => 200, "G" => 200, "B" => 200));
        $pImage->setFontProperties(array("FontName" => "modules/pchart/vendor/pChart2.1.3/fonts/verdana.ttf", "FontSize" => 8));
        $pImage->setGraphArea($left, $top, $right, $bottom);
        $settings = array("R" => 255, "G" => 255, "B" => 255, "Surrounding" => -200, "Alpha" => 50);
        $pImage->drawFilledRectangle($left, $top, $right, $bottom, $settings);

        $pImage->setShadow(FALSE);
        $pScatter = new pScatter($pImage, $pData);

        $pScatter->drawScatterScale(array("GridR" => 180, "GridG" => 180, "GridB" => 180, "GridTicks" => 5));
        
        
        $pScatter->drawScatterLineChart();

        
          $headers = array(
          'content-type'        => 'image/png',
          'Content-Disposition' => 'inline; filename="grafik.png"'
          );
          ob_end_clean();
          $this->response->headers($headers)->body($pImage->autoOutput()); 
    }

}
