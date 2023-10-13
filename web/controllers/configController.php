<?php
/**
 * Created by PhpStorm.
 * User: leonidas
 * Date: 8/2/18
 * Time: 4:10 PM
 */



class configController
{

    public static function getFilePathWithUpdateTime($file)
    {

        return $file . '?v=' .  filemtime(DIR_ROOT . $file );

    }

    public static function getImagePath($file,$height=0,$width=0)
    {

        return Config::get('ImagePath') . $height . '/' . $width . '/' . $file ;

    }

    public static function echoSvgFileToCode($file,$local=0)
    {
        if($local==1){
            $icon = file_get_contents(DIR_ROOT  . $file );
        } else {
            $icon = file_get_contents($file);
        }
        return $icon;

    }

    public function getLinkMake()
    {
        if(isset($_POST['link']) && $_POST['link']!==''){

            return Link::make($_POST['link']);

        }
        return '';

    }


    public function getTranslate()
    {
        if(isset($_POST['key']) && $_POST['key']!==''){

            return $this->getTranslate($_POST['key']);

        }
        return '';

    }



    public static function replaceImageOnDescr($descr)
    {

        $from = [
            "https://www.liberal.gr/admin/uploads/",
            "https://media.liberal.gr/admin/uploads/"
        ];
        $to = [
            "https://media.liberal.gr/images5/800/0/",
            "https://media.liberal.gr/images5/800/0/"
        ];
        return str_replace( $from , $to , $descr );

    }

    public static function get_dfp_ad($adv)
    {
        $adcode = '';
        if($adv !== '') {

            $adcode= '<div class="col-lg-12 text-center my-outer-ad">
                        <div style="display:none;" id="' . $adv . '">
                            <script>googletag.cmd.push(function() { googletag.display("' . $adv . '"); });</script>
                        </div>
                    </div>';

        }

        return $adcode;

    }
}