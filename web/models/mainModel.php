<?php
/**
 * Created by PhpStorm.
 * User: leonidas
 * Date: 8/2/18
 * Time: 2:06 PM
 */

class mainModel
{

    public $mylang;
    static $lang_lektiko;

    public function __construct()
    {

        $url = explode('/', $_SERVER['REQUEST_URI']);
        $lang = $url[1];

        $this->mylang = Config::get('defaultLanguage');

        if($lang=='en'){
            $this->mylang = $lang;
        }

        $lang_lektiko = $this->mylang;

    }

    public function linkPrefix(){

        if ( $this->mylang == Config::get('defaultLanguage') ) {

            return '';

        }

        return '/' . $this->mylang;

    }

    public function getSliderPage()
    {

        $sql = "SELECT *,
                    title_{$this->mylang} title,description_{$this->mylang} description,
                    link_{$this->mylang} link,link_text_{$this->mylang} link_text,subtitle_{$this->mylang} subtitle
                FROM t_home_slider 
                WHERE active=1
                ORDER BY sort_order";
        $sliders = QueryModel::Find_Data( $sql , []);
        return $sliders;

    }

    public function getAllakseToraPage()
    {

        $sql = "SELECT *,
                    title_{$this->mylang} title,description_{$this->mylang} description
                FROM t_homebox_2 
                WHERE active=1
                ORDER BY sort_order";
        $allakse = QueryModel::Find_Data( $sql , []);
        return $allakse;

    }

    public function getCategoriesKikloiPage()
    {

        $sql = "SELECT *,
                    title_{$this->mylang} title,description_{$this->mylang} description,
                    link_{$this->mylang} link,link_text_{$this->mylang} link_text
                FROM t_homebox_1 
                WHERE active=1
                ORDER BY sort_order";
        $kikloi = QueryModel::Find_Data( $sql , []);
        return $kikloi;

    }



    public function getMinisite($host)
    {
        $sql = "SELECT * FROM minisites WHERE active=1 AND deleted=0 AND FIND_IN_SET( ? , domain )";
        $configs = QueryModel::GetSingleColumn( $sql , [ $host ]);
        return $configs;
    }

    public function getMenu( $menu_id = 1 , $site_id = 1 )
    {
        $now_date=date('Y-m-d H:i:s');

        $sql="SELECT m.id,m.title_{$this->mylang} AS title,m.type,m.target,m.order_id,table_name,table_record_id,parent_id,
                  CASE
                    WHEN m.type='custom' AND m.url_{$this->mylang}!='' THEN m.url_{$this->mylang}
                    ELSE '#'
                  END AS url
              FROM menu m 
              WHERE m.site_id = ? AND m.parent_id=? AND m.deleted=0 AND m.menu_id=? AND m.active=1
              ORDER BY m.order_id";

        $menu = QueryModel::Find_Data( $sql , [ $site_id , 0 , $menu_id ] );

        if( $menu ) {

            for ($i = 0; $i < count($menu); $i++) {

                if($menu[$i]->type=='template') {

                    $menu[$i]->url = $this->getMenuTemplateLink($menu[$i]->table_name, $menu[$i]->table_record_id);

                }

                $menu2 = QueryModel::Find_Data($sql, [$site_id, $menu[$i]->id, $menu_id]);

                if( $menu2 ) {

                    for ($j = 0; $j < count($menu2); $j++) {

                        if($menu2[$j]->type=='template') {

                            $menu2[$j]->url = $this->getMenuTemplateLink($menu2[$j]->table_name, $menu2[$j]->table_record_id);

                        }

                        $menu3 = QueryModel::Find_Data($sql, [$site_id, $menu2[$j]->id, $menu_id]);

                        if( $menu3 ) {

                            for ($k = 0; $k < count($menu3); $k++) {

                                if($menu3[$k]->type == 'template') {

                                    $menu3[$k]->url = $this->getMenuTemplateLink($menu3[$k]->table_name, $menu3[$k]->table_record_id);

                                }

                            }

                            $menu2[$j]->submenu = $menu3;

                        }

                    }

                    $menu[$i]->submenu = $menu2;

                }

            }

        }

        return $menu;

    }

    public function getMenuTemplateLink($table_name,$table_record_id){

        switch ($table_name){

            case 't_content_list':

                $sql_caption = "SELECT caption FROM {$table_name} WHERE id={$table_record_id}";
                $caption = QueryModel::GetSingleColumn($sql_caption);
                return Link::make('/' . $caption->caption);

                break;

            case 't_news_categories':

                $sql_caption = "SELECT caption FROM {$table_name} WHERE id={$table_record_id}";
                $caption = QueryModel::GetSingleColumn($sql_caption);
                return Link::make('/news/' . $caption->caption);

                break;

            default:
                return '#';

        }

    }

    public function getConfigs( $site_id = 1 )
    {

        $sql = "SELECT * FROM configs WHERE site_id=?";
        $configs = QueryModel::GetSingleColumn( $sql , [ $site_id ]);
        return $configs;

    }

    public function getAllFromCustomTable( $tableName , $id=1)
    {

        $sql = "SELECT * FROM t_{$tableName} WHERE id=1";
        $data = QueryModel::GetSingleColumn( $sql );
        return $data;

    }

    public function getSettings()

    {

        $sql = "SELECT title_{$this->mylang} title,logo,facebook,instagram,youtube,phone,email,twitter,map,cookies_text_{$this->mylang} cookies_text,copyrights_text_{$this->mylang} copyrights_text,
                meta_title_{$this->mylang} meta_title,meta_description_{$this->mylang} meta_description, meta_keywords_{$this->mylang} meta_keywords
                FROM t_settings";
        $data = QueryModel::GetSingleColumn( $sql );

        return $data;

    }


    public function addhittoart($articleId)
    {

        if($articleId>0) {

            $sql = "UPDATE articles SET hits=hits+1 WHERE id=?";
            QueryModel::exec_Query( $sql , [ $articleId ] );

        }

    }

    public function getArticleLinkFromId($articleId)
    {

        if($articleId>0)
        {

            $sql = "SELECT link FROM article_links WHERE article_id = ?";
            $link = QueryModel::GetSingleColumn($sql, [$articleId]);

            if( $link && $link['link'] !== '' )
            {

                return $link['link'];

            }

            return false;

        }

        return false;

    }

    public function addNewsletterEmail($email){

        $params = [

            "email" => $email,
            "caption" => $email,
            "active" => 1

        ];

        $data = QueryModel::insert_Query('t_newsletter',$params);
        return $data;

    }

    public static function getLang($label,$lang)
    {

        $sql = "SELECT title_{$lang} title
                FROM t_langs WHERE label=?";
        $lang = QueryModel::GetSingleColumn( $sql, [$label] , 'ASSOC');
        $langTitle = $lang["title"];
        return $langTitle;

    }

}