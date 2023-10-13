<?php
/**
 * Created by PhpStorm.
 * User: leonidas
 * Date: 7/5/18
 * Time: 5:11 PM
 */

class homeModel
{
    public $mylang;

    public function __construct()
    {

        $url = explode('/', $_SERVER['REQUEST_URI']);
        $lang = $url[1];

        $this->mylang = Config::get('defaultLanguage');

        if($lang=='en'){
            $this->mylang = $lang;
        }

    }

    public static function getFromTable($table)
    {

        $sql = "SELECT * FROM t_{$table} WHERE active=1";
        $res = QueryModel::Find_Data( $sql, [] , 'ASSOC');
        return $res;

    }

    public function getHomeData(){

        //echo $this->mylang;exit;

        $sql = "SELECT slider, spacer_1,spacer_2, text_section_1,text_section_2,  text_section_3, video_img, video_url, box_1,box_2,map_img,
                label_box_1_{$this->mylang} label_box_1,label_box_2_{$this->mylang} label_box_2,
                map_title_{$this->mylang} map_title,video_title_{$this->mylang} video_title
                FROM t_dashboard
                WHERE active=1";
        $news_cat = QueryModel::GetSingleColumn( $sql, [] );

        //var_dump($news_cat); exit;

        return $news_cat;
    }

    public function getItemForHome($id){

        $sql = "SELECT title_{$this->mylang} title, descr_{$this->mylang} descr,img,
                url_text_{$this->mylang} url_text,url_link_{$this->mylang} url_link
                FROM t_home_items
                WHERE active=1 AND id=?";
        $item = QueryModel::GetSingleColumn( $sql, [$id] );
        return $item;
    }


    public function getSiteMapPage(){

        $map = new stdClass();

        $sql1 = "SELECT caption
                FROM t_content_list
                WHERE active=1";
        $map->content = QueryModel::Find_Data( $sql1, [] );

        $sql2 = "SELECT caption,id
                FROM t_news_list
                WHERE active=1";
        $map->news = QueryModel::Find_Data( $sql2, [] );

        $sql3 = "SELECT caption
                FROM t_news_categories
                WHERE active=1";
        $map->news_cats = QueryModel::Find_Data( $sql3, [] );


        return $map;
    }

}