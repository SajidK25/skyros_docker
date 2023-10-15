<?php

class homeController extends mainController
{

    public $recipients = 'support@ibhellas.gr';

    function index()
    {


        $body_classes = 'home';

        $this->getSeo(false);

        //$homepage = new stdClass();

        $home = new homeModel();

        $homepage = $home->getHomeData();

        //slider
        $i = 0;
        foreach (json_decode($homepage->slider) AS $slide){
            $homepage->slides[$i] = $home->getItemForHome($slide);
            $i++;
        }

        //box1
        $i = 0;
        foreach (json_decode($homepage->box_1) AS $box1){
            $homepage->box1[$i] = $home->getItemForHome($box1);
            $i++;
        }

        //box2
        $i = 0;
        foreach (json_decode($homepage->box_2) AS $box2){
            $homepage->box2[$i] = $home->getItemForHome($box2);
            $i++;
        }

        //sections text

        $homepage->text_section_1 = $home->getItemForHome(json_decode($homepage->text_section_1)[0]);
        $homepage->text_section_2 = $home->getItemForHome(json_decode($homepage->text_section_2)[0]);
        $homepage->text_section_3 = $home->getItemForHome(json_decode($homepage->text_section_3)[0]);

        unset($homepage->box_1,$homepage->box_2,$homepage->slider,$homepage->caption);


        //var_dump($homepage); exit;

        $this->templates->addData(compact('body_classes','homepage'));

        echo $this->templates->render("pages/{$this->myTemplate}/home");

    }


    public function getSlider()
    {

        $main = new mainModel($this->language->code());

        $sliders = new stdClass();
        $sliders->all      = $main->getSliderPage();

        $this->templates->addData(compact('sliders'));

    }

    function getSiteMap()
    {
        $home = new homeModel();

        $map = $home->getSiteMapPage();

        $this->getSeo(false);

        $this->templates->addData(compact('map'));

        echo $this->templates->render("pages/{$this->myTemplate}/sitemap");

    }


}