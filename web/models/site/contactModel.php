<?php

class contactModel
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

    public function getContactPage(){
        $sql = "SELECT title_{$this->mylang} title,img,descr_{$this->mylang} descr,map,
                meta_title_{$this->mylang} meta_title , meta_description_{$this->mylang} meta_description, meta_keywords_{$this->mylang} meta_keywords
                FROM t_contact WHERE active=1";
        $page = QueryModel::GetSingleColumn( $sql, [] );
        return $page;
    }

}