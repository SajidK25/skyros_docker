<?php
/**
 * Created by PhpStorm.
 * User: lilian
 * Date: 31/8/2018
 * Time: 12:44 μμ
 */

class contentModel
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

    public function getContent($caption){
        $sql = "SELECT  title_{$this->mylang} title,descr_{$this->mylang} descr, img, meta_title_{$this->mylang} meta_title , meta_description_{$this->mylang} meta_description, meta_keywords_{$this->mylang} meta_keywords
                FROM t_content_list
                WHERE caption=? AND active=1";
        $result = QueryModel::GetSingleColumn( $sql , [ $caption ] );
        return $result;
    }

    public function getContentPreview($caption){
        $sql = "SELECT  title_{$this->mylang} title,descr_{$this->mylang} descr, img, meta_title_{$this->mylang} meta_title , meta_description_{$this->mylang} meta_description, meta_keywords_{$this->mylang} meta_keywords
                FROM t_content_list
                WHERE caption=?";
        $result = QueryModel::GetSingleColumn( $sql , [ $caption ] );
        return $result;
    }

    public function getGalleryPage(){
        $sql = "SELECT  title_{$this->mylang} title,img_gallery,
                        meta_title_{$this->mylang} meta_title,
                        meta_keywords_{$this->mylang} meta_keywords,
                        meta_description_{$this->mylang} meta_description
                FROM t_gallery";
        $result = QueryModel::GetSingleColumn( $sql , [] );
        return $result;
    }


    public function getContentByCaption($caption)
    {

        $sql = "SELECT  c.id,
                        c.caption,
                        c.title_{$this->mylang} title,
                        c.description_{$this->mylang} description,
                        c.meta_title_{$this->mylang} meta_title,
                        c.meta_keywords_{$this->mylang} meta_keywords,
                        c.meta_description_{$this->mylang} meta_description,
                        c.image,
                        c.image_header,
                        c.faq_enable,
                        c.content_list_enable,
                        c.faq_menu,
                        CONCAT(c.title_{$this->mylang}) breadcrumbTitles,
                        CONCAT('/',c.caption) breadcrumbLinks,
                        CONCAT('/',c.caption) link
                FROM t_content_list c
                WHERE c.caption=?";
        $result = QueryModel::GetSingleColumn( $sql , [ $caption ] );


        if($result && $result->faq_enable==1){

            $sql = "SELECT tfml.id,tfml.title_{$this->mylang} AS title
                    FROM `template_relation` tr
                    INNER JOIN t_faq_main_list tfml ON tfml.id = tr.id_t AND tfml.active=1
                    WHERE tr.table_s = 't_content_list' AND tr.table_t = 't_faq_main_list' AND tr.id_s = {$result->id}
                    ORDER BY tfml.order_id";

            $result->faq_list = QueryModel::Find_Data($sql);

            for($i=0;$i<count($result->faq_list);$i++) {

                $sql = "SELECT  fl.id,
                            fl.caption, 
                            fl.title_{$this->mylang} title,
                            fl.short_description_{$this->mylang} short_description
                   FROM template_relation tr
                   INNER JOIN t_faq_list fl ON fl.id=tr.id_t AND fl.active=1
                   WHERE tr.id_s={$result->faq_list[$i]->id} AND table_s='t_faq_main_list' AND table_t='t_faq_list'";


                $result->faq_list[$i]->faqs = QueryModel::Find_Data($sql, []);

            }

        }

        if($result && $result->content_list_enable==1){

            $sql = "SELECT tcl.id,tcl.caption,tcl.title_{$this->mylang} AS title,CONCAT('/',tcl.caption) link
                    FROM `template_relation` tr
                    INNER JOIN t_content_list tcl ON tcl.id = tr.id_t AND tcl.active=1
                    WHERE tr.table_s = 't_content_list' AND tr.table_t = 't_content_list' AND tr.id_s = {$result->id}";

            $result->content_list = QueryModel::Find_Data($sql);

        }


        return $result;

    }

    public function getMoreGalleryItems(){
        $sql = "SELECT img_gallery FROM t_gallery";
        $result = QueryModel::GetSingleColumn( $sql , [] );
        return $result;
    }

}