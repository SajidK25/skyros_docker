<?php
/**
 * Created by PhpStorm.
 * User: leonidas
 * Date: 5/15/18
 * Time: 2:20 PM
 */

class contentController extends mainController
{

//    function getContent($vars)
//    {
//
//        if ($vars['caption'] === '405') {
//
//            $this->getErrorPage(405);
//
//        } else if ( $vars['caption'] === '404' ) {
//
//            $this->getErrorPage(404);
//
//        } else {
//
//
//            $contents = new contentModel();
//            $data = $contents->getContentByCaption($vars['caption']);
//
//            $body_classes = "content " . $vars['caption'];
//
//            //$this->addJsModule('Content');
//            $this->getSeo($data);
//            //$this->getBreadcrumb($content);
//
//            $this->templates->addData(compact('data','body_classes'));
//
//            echo $this->templates->render("pages/{$this->myTemplate}/content");
//
//        }
//    }

    function getDemo($vars){

        if ($vars['test'] !== '') {

            $file=$vars['test'];
            $body_classes = "content form";

            $this->addJsModule('Forms');
            $this->getSeo(false);
            $this->getBreadcrumb(false);

            $this->templates->addData(compact('body_classes'));

            echo $this->templates->render("pages/{$this->myTemplate}/{$file}");

        }

    }

    function getContentPost($vars)
    {

        $contents = new contentModel();
        $data = $contents->getContent($vars['caption']);

        if (!$data) {
            $this->getErrorPage(404);
        }

        $body_classes = "content " . $vars['caption'];

//        if($content && $content->image != ''){
//
//            $content->image = configController::getImagePath($content->image,0,1250);
//
//        }

        $data->header_banner = $data->img;

        $this->getSeo($data);

        $this->templates->addData(compact('data','body_classes'));

        echo $this->templates->render("pages/{$this->myTemplate}/content");

    }

    function getContentPostPreview($vars)
    {

        $contents = new contentModel();
        $data = $contents->getContentPreview($vars['caption']);

        if (!$data) {
            $this->getErrorPage(404);
        }

        if(!isset($_COOKIE['disable_cdn_caching']) && $_COOKIE['disable_cdn_caching']!=1 ) {
            header('Location: /');
            exit();
        }

        $body_classes = "content " . $vars['caption'];

//        if($content && $content->image != ''){
//
//            $content->image = configController::getImagePath($content->image,0,1250);
//
//        }

        $data->header_banner = $data->img;

        $this->getSeo($data);

        $this->templates->addData(compact('data','body_classes'));

        echo $this->templates->render("pages/{$this->myTemplate}/content");

    }

    function getGallery()
    {

        $contents = new contentModel();
        $data = $contents->getGalleryPage();

        //var_dump($data); exit;

        if (!$data) {
            $this->getErrorPage(404);
        }

        $data->max_items = count(json_decode($data->img_gallery));

        $data->img_gallery = array_slice(json_decode($data->img_gallery),0,20);
        $data->items = 20;

        //var_dump(json_decode($data->img_gallery)); exit;

        $data->header_banner = $data->img;

        $body_classes = "gallery";

        $this->addJsModule('Gallery');

        $this->getSeo($data);

        $this->templates->addData(compact('data','body_classes'));

        echo $this->templates->render("pages/{$this->myTemplate}/gallery");

    }

    function loadMoreFromGallery(){

            $return = new stdClass();
            $return->error = true;

            if(isset($_POST) && isset($_POST['items']) ){

                $items = $_POST['items'];
                //$max_items = $_POST['items'];

                $contents = new contentModel();
                $data = $contents->getMoreGalleryItems();



                //$data->img_gallery = array_slice(json_decode($data->img_gallery),0,20);
                //$data->items = 20;

                if (count(json_decode($data->img_gallery)) <= $items){
                    $return->error = true;

                }else {

                    //$items = int($items) +20;

                    $start = (int)$items;
                    //$return->start = $start;
                    //$end = $items + 20;


                    $data->img_gallery = array_slice(json_decode($data->img_gallery),$start,20);
                    $return->img_gallery = $data->img_gallery;
                    $return->error = false;

                }

                echo json_encode($return);

            }else{

                $return->error = true;
                echo json_encode($return);

            }

    }


}