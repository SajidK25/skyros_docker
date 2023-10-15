<?php

class pagesController extends mainController
{

    public function gallery()
    {
        $body_classes = 'home';
        $this->getSeo(false);
        $homepage = new stdClass();
        $this->templates->addData(compact('body_classes', 'homepage'));
        echo $this->templates->render("pages/{$this->myTemplate}/gallery");
    }

    public function content1()
    {
        $body_classes = 'home';
        $this->getSeo(false);
        $homepage = new stdClass();
        $this->templates->addData(compact('body_classes', 'homepage'));
        echo $this->templates->render("pages/{$this->myTemplate}/content");
    }

    public function content2()
    {
        $body_classes = 'home';
        $this->getSeo(false);
        $homepage = new stdClass();
        $this->templates->addData(compact('body_classes', 'homepage'));
        echo $this->templates->render("pages/{$this->myTemplate}/content_2col");
    }

    public function list1()
    {
        $body_classes = 'home';
        $this->getSeo(false);
        $homepage = new stdClass();
        $this->templates->addData(compact('body_classes', 'homepage'));
        echo $this->templates->render("pages/{$this->myTemplate}/list");
    }

    public function list2()
    {
        $body_classes = 'home';
        $this->getSeo(false);
        $homepage = new stdClass();
        $this->templates->addData(compact('body_classes', 'homepage'));
        echo $this->templates->render("pages/{$this->myTemplate}/list_2col");
    }
}