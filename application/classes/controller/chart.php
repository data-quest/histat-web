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
        $id = explode('/', $this->request->post('id'));
        $this->id_hs = $id[0];
        $this->key = $id[1];
    }

    public function action_index() {

        $keymask = ORM::factory('keymask', $this->id_hs);
        $keys = array();
        $details = array();
        foreach ($keymask->getDetails() as $detail) {
            $details[$detail->Schluessel][] = $detail->CodeBezeichnung;
        }

        $data = $keymask->getData($this->key);



        ini_set('max_execution_time', '1600');
        $fileName = 'assets/img/charts/' . $this->id_hs . '-' . $this->key . '.png';
        if (file_exists($fileName))
            unlink($fileName);
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

        $pData->setSerieTicks("Labels", 10);
        $pData->setPalette("Serie1", array("R" => 255, "G" => 122, "B" => 0));
        $pData->setAbscissa("Labels");
        $pImage = new pImage(800, 400, $pData);
        $pImage->drawRectangle(0, 0, 799, 399, array("R" => 200, "G" => 200, "B" => 200));


        $pImage->setFontProperties(array("FontName" => "modules/pchart/vendor/pChart2.1.1/fonts/verdana.ttf", "FontSize" => 8));

        $pImage->drawText(400, 24, implode(" - ",$details[$this->key]), array("FontSize" => 11, "Align" => TEXT_ALIGN_BOTTOMMIDDLE));
        $pImage->setGraphArea(60, 40, 780, 330);
        $pImage->drawFilledRectangle(60, 40, 780, 330, array("R" => 255, "G" => 255, "B" => 255, "Surrounding" => -200, "Alpha" => 10));
        $pImage->drawScale(array("GridR" => 180, "GridG" => 180, "GridB" => 180, "LabelRotation" => 90, "LabelSkip" => floor(count($yAxis) / 40 + 1)));
        $pImage->setShadow(TRUE, array("X" => 2, "Y" => 2, "R" => 0, "G" => 0, "B" => 0, "Alpha" => 10));
        $pImage->setFontProperties(array("FontName" => "modules/pchart/vendor/pChart2.1.1/fonts/pf_arma_five.ttf", "FontSize" => 6));
        $pImage->drawSplineChart();
        $pImage->setShadow(FALSE);
        $pImage->render($fileName);

        $this->response->body($fileName);
    }

}