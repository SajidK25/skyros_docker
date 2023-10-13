<?php


class newsModel
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

    public function getNewsCategory($category){

        $sql = "SELECT caption,id,title_{$this->mylang} title,img, 
                meta_title_{$this->mylang} meta_title, meta_description_{$this->mylang} meta_description, meta_keywords_{$this->mylang} meta_keywords
                FROM t_news_categories
                WHERE caption=? AND active=1";
        $news_cat = QueryModel::GetSingleColumn( $sql, [ $category ] );
        return $news_cat;
    }

    public function getNewsByCategoryId($cat_id,$page,$limit){
        $start = ($page - 1) * $limit;
        $sql1 = "SELECT COUNT(1) asum FROM t_news_list
                WHERE news_category=? AND active=1 ORDER BY cdatetime DESC";
        $items = QueryModel::GetSingleColumn($sql1, [$cat_id])->asum;
        $pages = ceil($items / $limit);
        $sql2 = "SELECT caption,id,file,title_el title,short_descr_el short_descr,descr_el descr,img,pub_date, meta_title_el meta_title, meta_description_el meta_description, meta_keywords_el meta_keywords
                FROM t_news_list
                WHERE news_category=? AND active=1 ORDER BY cdatetime DESC LIMIT $start,$limit";
        $news = QueryModel::Find_Data($sql2, [$cat_id]);
        return [ $news , $pages , $items];
    }

    public function getNeoPage($id,$caption){

        $sql = "SELECT caption,id,title_el title,descr_el descr,img,pub_date,file, meta_title_el meta_title, meta_description_el meta_description, meta_keywords_el meta_keywords
                FROM t_news_list
                WHERE id=? AND caption=? AND active=1";
        $neo = QueryModel::GetSingleColumn( $sql, [ $id,$caption ] );

        if ($neo) {

            $sql2 = "SELECT title_{$this->mylang} title,caption, img
                FROM t_news_categories
                WHERE id=? AND active=1";
            $neo->category = QueryModel::GetSingleColumn($sql2, [$neo->news_category]);
            return $neo;
        }else{
            return false;
        }
    }

    public function getNeoPagePreview($id,$caption){

        $sql = "SELECT caption,id,title_{$this->mylang} title,descr_{$this->mylang} descr,img,pub_date, meta_title_{$this->mylang} meta_title, meta_description_{$this->mylang} meta_description, meta_keywords_{$this->mylang} meta_keywords
                FROM t_news_list
                WHERE id=? AND caption=?";
        $neo = QueryModel::GetSingleColumn( $sql, [ $id,$caption ] );

        if ($neo) {

            $sql2 = "SELECT title_{$this->mylang} title,caption, img
                FROM t_news_categories
                WHERE id=? AND active=1";
            $neo->category = QueryModel::GetSingleColumn($sql2, [$neo->news_category]);
            return $neo;
        }else{
            return false;
        }
    }

}