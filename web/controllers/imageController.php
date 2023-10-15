<?php
/**
 * Created by PhpStorm.
 * User: leonidas
 * Date: 12/12/18
 * Time: 12:36 PM
 */

class imageController
{


    protected $mediaFolder = __DIR__ . '/../uploads/media/';
    protected $tmpFolder   = __DIR__ . '/../tmp/';
    protected $imageDetails;


    public $defaultImage = 'no_image.png';
    public $filename;
    public $tpmImageName;
    public $cropImage = 0;
    public $acceptedExtensions = ['jpg','jpeg','gif','png'];


    public function getImage($vars)
    {

        $this->filename = $this->mediaFolder . $vars['file'];

        $this->checkIfFileExists();

        $this->checkFileType($vars['hsize'] , $vars['wsize']);
        $this->getImageDetails();
        $this->addImageHeader();
        $this->getTmpImageName( $vars['file'] , $vars['hsize'] , $vars['wsize'] );

        $this->checkIfTmpImageExists();

        $this->calculateImageSizes($vars['hsize'] , $vars['wsize']);
        $this->createNewImage();
        $this->saveAndOutputImage();

    }

    protected function checkIfFileExists(){

        if( !file_exists( $this->filename ) )
        {

            $this->filename = $this->mediaFolder . $this->defaultImage;

        }

    }

    protected function checkFileType($hsize,$wsize){

        $myext = explode('.',$this->filename);
        $myext = strtolower($myext[count($myext)-1]);

        if(!in_array($myext,$this->acceptedExtensions)) {

            switch ($myext) {

                case 'svg':
                    header('Content-type: image/svg+xml');
                    $file = file_get_contents($this->filename);
                    echo $file;
                    break;

                default:
                    if($hsize==0 && $wsize>0){
                        $hsize = $wsize;
                    } else if($hsize>0 && $wsize==0){
                        $wsize = $hsize;
                    } else if($hsize==0 && $wsize==0){

                        $wsize = 300;
                        $hsize = 300;

                    }
                    $image = [
                        'size' => $wsize . 'x' . $hsize,
                        'type' => 'jpg',
                        'background' => '000000',
                        'color' => 'ffffff',
                        'mytext' => strtoupper($myext)
                    ];
                    $this->getDummyImage($image);
                    break;

            }

            exit;

        }

    }

    protected function getImageDetails(){

        $this->imageDetails = new stdClass();
        $this->imageDetails->aa = getimagesize( $this->filename );
        $this->imageDetails->width = $this->imageDetails->aa[0];
        $this->imageDetails->height = $this->imageDetails->aa[1];
        $this->imageDetails->mime = $this->imageDetails->aa['mime'];
        $this->imageDetails->ext = explode('/' , $this->imageDetails->mime)[1];

    }

    protected function checkIfImageIsSvg(){

        if($this->imageDetails->ext == 'svg')
        {

            header('Content-type: image/svg+xml');
            $file = file_get_contents($this->filename);
            echo $file;
            exit;

        }

    }

    protected function addImageHeader(){

        header('Pragma: public');
        header('Cache-Control: max-age=604800');
        header('Expires: '. gmdate('D, d M Y H \G\M\T', time() + 186400));
        header('Content-type: ' . $this->imageDetails->mime);

    }

    protected function getTmpImageName( $file , $hsize , $wsize ){

        $this->tpmImageName = explode('/' , $file );
        $this->tpmImageName = implode('_' , $this->tpmImageName );
        $this->tpmImageName = $hsize . '_' . $wsize . '_' . $this->tpmImageName;

    }

    protected function checkIfTmpImageExists(){

        if( file_exists( $this->tmpFolder . $this->tpmImageName ) && ( !isset( $_REQUEST['decache'] ) || ( isset( $_REQUEST['decache'] ) && $_REQUEST['decache'] != 1 ) ) ) {

            $file = file_get_contents( $this->tmpFolder . $this->tpmImageName );
            echo $file;
            exit;

        }

    }

    protected function calculateImageSizes($hsize , $wsize){

        $b=1;
        $this->imageDetails->newWidth = $this->imageDetails->width * $b;
        $this->imageDetails->newHeight = $this->imageDetails->height * $b;

        if( $hsize > 0 && $wsize > 0 )
        {

            $this->cropImage = 1;
            $this->imageDetails->thumbWidth = $wsize;
            $this->imageDetails->thumbHeight = $hsize;
            $this->imageDetails->originalAspect = $this->imageDetails->width / $this->imageDetails->height;
            $this->imageDetails->thumbAspect = $this->imageDetails->thumbWidth / $this->imageDetails->thumbHeight;

            if ( $this->imageDetails->originalAspect >= $this->imageDetails->thumbAspect )
            {

                // If image is wider than thumbnail (in aspect ratio sense)
                $this->imageDetails->newHeight = $this->imageDetails->thumbHeight;
                $this->imageDetails->newWidth = $this->imageDetails->width / ( $this->imageDetails->height / $this->imageDetails->thumbHeight);

            }
            else
            {

                // If the thumbnail is wider than the image
                $this->imageDetails->newWidth = $this->imageDetails->thumbWidth;
                $this->imageDetails->newHeight = $this->imageDetails->height / ($this->imageDetails->width / $this->imageDetails->thumbWidth);

            }

        }
        else if( $hsize > 0 && $wsize == 0 )
        {

            $a = 100 * $hsize;
            $b = $a / $this->imageDetails->height;
            $b = $b / 100;
            $this->imageDetails->newWidth = $this->imageDetails->width * $b;
            $this->imageDetails->newHeight = $this->imageDetails->height * $b;

        }
        else if( $wsize > 0 && $hsize == 0 )
        {

            $a = 100 * $wsize;
            $b = $a / $this->imageDetails->width;
            $b = $b / 100;
            $this->imageDetails->newWidth = $this->imageDetails->width * $b;
            $this->imageDetails->newHeight = $this->imageDetails->height * $b;

        }


    }

    protected function createNewImage(){

        $this->imageDetails->image_p = ( $this->cropImage == 1 ) ? imagecreatetruecolor( $this->imageDetails->thumbWidth , $this->imageDetails->thumbHeight ) : imagecreatetruecolor( $this->imageDetails->newWidth , $this->imageDetails->newHeight );

        imagealphablending( $this->imageDetails->image_p , false );

        $transparency = imagecolorallocatealpha( $this->imageDetails->image_p, 0, 0, 0, 127);

        imagefill( $this->imageDetails->image_p, 0, 0, $transparency );

        imagesavealpha( $this->imageDetails->image_p, true );

        $ext = strtolower( $this->imageDetails->ext );

        switch ( $ext ) {

            case 'jpg':
            case 'jpeg':
                $this->imageDetails->image = imagecreatefromjpeg( $this->filename );
                break;
            case 'gif':
                $this->imageDetails->image = imagecreatefromgif( $this->filename );
                break;
            case 'png':
                $this->imageDetails->image = imagecreatefrompng( $this->filename );
                break;
            default:
                $this->imageDetails->image = false;
                break;
        }

        if( $this->cropImage == 1 ) {

            imagecopyresampled( $this->imageDetails->image_p , $this->imageDetails->image , 0 - ($this->imageDetails->newWidth - $this->imageDetails->thumbWidth) / 2, 0 - ($this->imageDetails->newHeight - $this->imageDetails->thumbHeight) / 2, 0, 0, $this->imageDetails->newWidth, $this->imageDetails->newHeight, $this->imageDetails->width, $this->imageDetails->height);

        } else {

            imagecopyresampled( $this->imageDetails->image_p , $this->imageDetails->image , 0, 0, 0, 0, $this->imageDetails->newWidth, $this->imageDetails->newHeight, $this->imageDetails->width, $this->imageDetails->height);

        }

    }

    protected function saveAndOutputImage(){

        // Output
        switch ( $this->imageDetails->ext ) {
            case 'jpg':
            case 'jpeg':
                imagejpeg($this->imageDetails->image_p, $this->tmpFolder . $this->tpmImageName , 85);
                break;
            case 'gif':
                imagegif($this->imageDetails->image_p, $this->tmpFolder . $this->tpmImageName );
                break;
            case 'png':
                imagepng($this->imageDetails->image_p, $this->tmpFolder . $this->tpmImageName );
                break;
            default:
                $image = false;
                break;
        }

        $file = file_get_contents( $this->tmpFolder . $this->tpmImageName );
        echo $file;
        exit;

    }

    public function clearTmpFolder($vars){

        $search = '*';

        if(isset($_REQUEST['start_with'])){
            $search = $_REQUEST['start_with'] . $search;
        }

        if(isset($_REQUEST['end_with'])){
            $search .= $_REQUEST['end_with'];
        }

        $files = glob($this->tmpFolder . $search ); // get all file names
        $deletedFiles = 0;
        $allFiles = 0;

        foreach($files as $file){ // iterate files

            if(is_file($file)){

                $allFiles++;
                $a=date("d-m-Y H:i:s", filemtime($file));

                if(isset($vars['clear']) && $vars['clear']=='all'){

                    $b=date("d-m-Y H:i:s",strtotime('+ 1 day'));

                } else {

                    $b=date("d-m-Y H:i:s", strtotime('-1 month'));

                }

                $diff=date_diff(date_create($a),date_create($b));

                if($diff->days>0 && $diff->invert==0){

                    echo "{$file} was last modified: " . date ("d-m-Y H:i:s", filemtime($file));
                    echo "<br/>";
                    echo "<br/>";
                    echo date("d-m-Y H:i:s",strtotime('-1 month'));
                    echo "<br/>";
                    echo "<br/>";
                    unlink($file); // delete file
                    $deletedFiles++;

                }

            }

        }

        echo "<h1>CLEAR TMP FILES</h1>";
        echo "<h3>{$deletedFiles} / {$allFiles} FILES CLEARED...</h3>";

    }



    public function getDummyImage($vars){

        $size = (isset($vars['size']) && $vars['size']!=='' ) ? $vars['size'] : '300x250';

        $size = explode('x' , $size );

        $type = (isset($vars['type'])) ? $vars['type'] : 'jpg';
        $width = $size[0];
        $height = (isset($size[1])) ? $size[1] : $size[0];
        $background = (isset($vars['background'])) ? $vars['background'] : 'f5f5f5';
        $color = (isset($vars['color'])) ? $vars['color'] : '000000';
        $fontSize = 10;



        $r_bg = hexdec(substr($background,0,2));
        $g_bg = hexdec(substr($background,2,2));
        $b_bg = hexdec(substr($background,4,2));

        $r_tx = hexdec(substr($color,0,2));
        $g_tx = hexdec(substr($color,2,2));
        $b_tx = hexdec(substr($color,4,2));

        $text =  (isset($_REQUEST['text'])) ? $_REQUEST['text'] : $width . 'X' . $height;

        $text =  (isset($vars['mytext'])) ? $vars['mytext'] : $text;

        $xPosition = (($width/2)-((imagefontwidth($fontSize)*strlen($text))/2));
        $yPosition = (($height/2)-(imagefontheight($fontSize)/2));

        header("Content-Type: image/{$type}");
        $im = @imagecreate($width, $height)
        or die("Cannot Initialize new GD image stream");
        $background_color = imagecolorallocate($im, $r_bg, $g_bg, $b_bg);
        $text_color = imagecolorallocate($im, $r_tx, $g_tx, $b_tx);
        imagestring($im, $fontSize, $xPosition, $yPosition, $text, $text_color);



        if($type=='png'){

            imagepng($im);

        } else {

            imagejpeg($im,null,85);

        }
        imagedestroy($im);


    }



}