<?php
/**
 * Created by PhpStorm.
 * User: leonidas
 * Date: 10/8/18
 * Time: 1:56 PM
 */

class SitemapController
{

    public $maps = 60;

    public function getSitemaps(){


        header("Content-type: text/xml");

        echo '<?xml version="1.0" encoding="UTF-8"?>';
        echo '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        for($i=1;$i<=$this->maps;$i++){

            echo '<sitemap><loc>' . Config::get('Http') . Config::get('Domain') . '/sitemapIndex/' . $i . '.xml</loc></sitemap>';

        }

        echo '</sitemapindex>';

    }

    public function getSitemap($vars){

        if(isset($vars['list']) && $vars['list']>0 && $vars['list']<=60) {

            $daysPerNum=2;

            $listNum = $vars['list'];
            $listNumStart = $listNum-1;
            $startDate = '';
            $endDate   = '';
            if($listNumStart==0){
                $startDate = date('Y-m-d H:i:s');
            } else {
                $startDate = date('Y-m-d H:i:s', strtotime("-". $daysPerNum*$listNumStart ." days"));
            }
            $endDate = date('Y-m-d H:i:s', strtotime("-". $daysPerNum*$listNum ." days"));
            $sitemaps = SitemapModel::getSitemap($startDate,$endDate);


            header("Content-type: text/xml");

            echo "<?xml version='1.0' encoding='UTF-8'?>";
            echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

            foreach($sitemaps AS $sitemap){

                $row = "<url>
                            <loc>". Config::get('Http') . Config::get('Domain') . $sitemap->link . "</loc>
                            <lastmod>" . gmdate('Y-m-d\TH:i:s\Z' , strtotime( $sitemap->up_dt ) ) . "</lastmod>
                            <priority>0.5</priority>
                        </url>";
                echo $row;
            }

            echo "</urlset>";

        }

    }

    public function parseToXML($htmlStr)
    {

        $xmlStr=str_replace('<','&lt;',$htmlStr);
        $xmlStr=str_replace('>','&gt;',$xmlStr);
        $xmlStr=str_replace('"','&quot;',$xmlStr);
        $xmlStr=str_replace("'",'&#39;',$xmlStr);
        $xmlStr=str_replace("&",'&amp;',$xmlStr);
        return $xmlStr;

    }

}