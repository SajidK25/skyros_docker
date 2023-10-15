<?php
/**
 * Created by PhpStorm.
 * User: John Saltapidas
 * Date: 5/12/2019
 * Time: 13:25
 */

class newsController extends mainController
{

    public $recipients = 'jsaltapi@ibhellas.gr';
    public $limit = 5;

    function getNewsList($vars)
    {

        $body_classes = 'news_list';

        $pagenum = (isset($vars['pagenum']) && $vars['pagenum'] > 0) ? $vars['pagenum'] : 1;
        $caption = urldecode($vars['caption']);
        $now_url = explode('?', $_SERVER['REQUEST_URI'])[0];
        $now_url = explode('/page', $now_url)[0];


        $news_model = new newsModel();
        $data = $news_model->getNewsCategory($caption);

        if (!$data) {
            $this->getErrorPage(404);
        }

        $data->header_banner = $data->img;

        //$data->news_category_title = $data->title;
        //$data->news_category_url = "/news/".$caption;

        $data->news = $news_model->getNewsByCategoryId($data->id, $pagenum, $this->limit);
        $this->getSeo($data);

        if ($this->mylang == 'el'){
            $lang_pre = '';
        }else{
            $lang_pre = '/en';
        }

        $data->link = $now_url;

        $data->pages = $data->news[1];
        $data->page = $pagenum;
        $data->news = $data->news[0];



        $this->templates->addData(compact('body_classes','data','now_url','mainCaption','caption','lang_pre'));

        echo $this->templates->render("pages/{$this->myTemplate}/list");

    }


    function getNeo($vars)
    {

        $body_classes = 'news single';

        $caption_id = $vars['id'];
        $caption = $vars['caption'];


        $news_model = new newsModel();
        $data = $news_model->getNeoPage($caption_id,$caption);

        if (!$data) {
            $this->getErrorPage(404);
        }

        $data->header_banner = $data->category->img;
        $data->category_news_title = $data->category->title;
        $data->category_news_caption = "/news/".$data->category->caption;

        $this->getSeo($data);




        $this->templates->addData(compact('body_classes','data'));

        echo $this->templates->render("pages/{$this->myTemplate}/neo_content");

    }

    function getNeoPreview($vars)
    {

        $body_classes = 'news single';

        $caption_id = $vars['id'];
        $caption = $vars['caption'];


        $news_model = new newsModel();
        $data = $news_model->getNeoPagePreview($caption_id,$caption);

        if (!$data) {
            $this->getErrorPage(404);
        }

        if(!isset($_COOKIE['disable_cdn_caching']) && $_COOKIE['disable_cdn_caching']!=1 ) {
            header('Location: /');
            exit();
        }

        $data->header_banner = $data->category->img;
        $data->category_news_title = $data->category->title;
        $data->category_news_caption = "/news/".$data->category->caption;

        $this->getSeo($data);




        $this->templates->addData(compact('body_classes','data'));

        echo $this->templates->render("pages/{$this->myTemplate}/neo_content");

    }

}