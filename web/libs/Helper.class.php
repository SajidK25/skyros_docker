<?php

class Helper {


    public static function string($value) {
        return strip_tags(trim(filter_var($value, FILTER_SANITIZE_STRING)));
    }

    public static function int($value) {
        return strip_tags(trim(filter_var($value, FILTER_SANITIZE_NUMBER_INT)));
    }

    public static function float($value) {

        $value = str_replace(',', '.', $value);
        return strip_tags(trim(filter_var($value, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION)));

    }

    public static function HashPassword($pass){
        return hash_hmac("sha256", trim($pass), Config::get('ACCESS_HASH_KEY'));
    }

    public static function email($value) {
        return strip_tags(trim(filter_var($value, FILTER_SANITIZE_EMAIL)));
    }

    public static function priceToFloat($s)
    {
        return floatval($s);
    }

    public static function redirectTo($url, $permanent = false)
    {

        $url = /*$_SERVER['HTTP_HOST'] .*/ self::prefixLink() . $url;

        if($permanent) {

            header('HTTP/1.1 301 Moved Permanently');

        }

        header('Location: '.$url);

        exit();
        
    }

    
    /**
     * @param $date
     * @param $fromTimezone
     * @param $toTimezone
     * @param null $format
     * @return string
     */
    public static function convertTimezone ( $date, $fromTimezone, $toTimezone, $format = null )
    {

        // create a $dt object with the timezone we want
        $dt = new DateTime($date, new DateTimeZone($fromTimezone));


        // change the timezone of the object without changing it's time
        $dt->setTimezone(new DateTimeZone($toTimezone));


        // format the datetime
        if ( $format !== null ) {

            return $dt->format($format);

        }


        return $dt->format('Y-m-d H:i:s');

    }
    

    public static function dump($variable)
    {

        echo '<pre>';
        var_dump($variable);
        echo '</pre>';

    }

    public static function printr($variable)
    {

        echo '<pre>';
        print_r($variable);
        echo '</pre>';

    }

    public static function explode($variable,$key = '{{@}}')
    {

        return explode( $key , $variable );

    }

    public static function implode( $variable , $key = '{{@}}' )
    {

        return implode( $key , $variable );

    }

    public static function truncate($string, $length = 100, $append = "&hellip;")
    {

        $string = html_entity_decode(trim($string));

        if (mb_strlen($string) > $length) {

            /*$string = wordwrap($string, $length);
            $string = explode("\n", $string, 2);
            $string = $string[0] . $append;*/

            $string = mb_substr($string, 0, $length);
            $pos = mb_strrpos(trim($string), ' ');
            $string = mb_substr($string, 0, $pos ? $pos : null);
            
            if ( !empty($append) )
                $string .= $append;
            
        }

        return $string;
    }

    public static function createToken()
    {

        $token = bin2hex(openssl_random_pseudo_bytes(32));

       
        if ( ! session_id() )
            session_start();

        $_SESSION['portal_token'] = $token;

        session_write_close();

        return $token;

    }
    
    public static function validSessionToken($token)
    {
        
        if ( isset($_SESSION['portal_token']) && $_SESSION['portal_token'] == $token ) {
            
            return true;
            
        }
        
        return false;
        
    }
    
    
    public static function encodeUrlParameter($parameter)
    {

        return urlencode(str_replace(' ','-',$parameter));

    }

    public static function decodeUrlParameter($parameter)
    {

        return urldecode(str_replace('-',' ',$parameter));

    }


    /**
     * This function is for building a tree from adjacency model list
     * example : a sql table  'categories' which have column parent_id. Each category would belong to category with id = parent_id
     *
     * @param array $elements ( an array of arrays with type : ['id' => 1, 'parent_id' => 0, 'title' => 'bla1']
     * @param int $parentId ( the id of the starting parent category )
     * @return array
     */
    public static function buildTree(array &$elements, $parentId = 0)
    {

        $branch = array();

        foreach ($elements as &$element) {

            if ($element['parent_id'] == $parentId) {

                $children = self::buildTree($elements, $element['id']);

                if ($children) {
                    $element['children'] = $children;
                }

                $branch[$element['id']] = $element;

                unset($element);
            }
        }

        return $branch;

    }


    /**
     * This function is for printing the array that we make with 
     * the function buildTree
     * 
     * @param $lists
     */
    public static function printList(&$lists)
    {

        echo "<ul>";

        foreach ( $lists as $list ) {

            $title = Helper::encodeUrlParameter($list['title']);

            $link = Link::make("/products/category/{$list['id']}/{$title}");

            echo"<li><a href='{$link}'>{$list['title']}</a>";

            if ( isset($list['children']) &&
                is_array($list['children']) &&
                count($list['children']) > 0 ) {

                self::printList($list['children']);

            }

            echo "</li>";

        }

        echo "</ul>";

    }
    
    public static function printTruncatedHtml($maxLength, $html, $isUtf8=true)
    {
        $printedLength = 0;
        $position = 0;
        $tags = array();
    
        // For UTF-8, we need to count multibyte sequences as one character.
        $re = $isUtf8
            ? '{</?([a-z]+)[^>]*>|&#?[a-zA-Z0-9]+;|[\x80-\xFF][\x80-\xBF]*}'
            : '{</?([a-z]+)[^>]*>|&#?[a-zA-Z0-9]+;}';
    
        while ($printedLength < $maxLength && preg_match($re, $html, $match, PREG_OFFSET_CAPTURE, $position))
        {
            list($tag, $tagPosition) = $match[0];
    
            // Print text leading up to the tag.
            $str = substr($html, $position, $tagPosition - $position);
            if ($printedLength + strlen($str) > $maxLength)
            {
                print(substr($str, 0, $maxLength - $printedLength));
                $printedLength = $maxLength;
                break;
            }
    
            print($str);
            $printedLength += strlen($str);
            if ($printedLength >= $maxLength) break;
            
            if ($tag[0] == '&' || ord($tag) >= 0x80)
            {
                // Pass the entity or UTF-8 multibyte sequence through unchanged.
                print($tag);
                $printedLength++;
            }
            else
            {
                // Handle the tag.
                $tagName = $match[1][0];
                if ($tag[1] == '/')
                {
                    // This is a closing tag.
            
                    $openingTag = array_pop($tags);
                    assert($openingTag == $tagName); // check that tags are properly nested.
            
                    print($tag);
                }
                else if ($tag[strlen($tag) - 2] == '/')
                {
                    // Self-closing tag.
                    print($tag);
                }
                else
                {
                    // Opening tag.
                    print($tag);
                    $tags[] = $tagName;
                }
            }
            
            // Continue after the tag.
            $position = $tagPosition + strlen($tag);
        }
    
        // Print any remaining text.
        if ($printedLength < $maxLength && $position < strlen($html))
            print(substr($html, $position, $maxLength - $printedLength));
    
        // Close any open tags.
        while (!empty($tags))
            printf('</%s>', array_pop($tags));
        
    }

    public static function getIp()
    {
        //check ip from share internet
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {

            $ip=$_SERVER['HTTP_CLIENT_IP'];

        }
        //to check ip is pass from proxy
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {

            $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];

        }
        else {

            $ip=$_SERVER['REMOTE_ADDR'];

        }

        return $ip;
    }

    public static function ipInfo()
    {

        return $xml = simplexml_load_file("http://www.geoplugin.net/xml.gp?ip=".self::getIp());

    }

    public static function encryptData($data = []) {

        $hash = false;
        if($data && is_array($data) && count($data) > 0) {
            $encryption_key = "Key_hash";
            $encrypt_method = 'AES-256-CBC';
            $iv = substr(hash('sha256', $encryption_key), 0, 16);
            $toEncryptJson = json_encode($data);
            $encryptedSsl = openssl_encrypt($toEncryptJson, $encrypt_method, $encryption_key, 0, $iv);
            $hash = urlencode(base64_encode($encryptedSsl));

        }

        return $hash;

    }

    public static function decryptData($hash = '') {

        $decrypted_data = [];
        if($hash && !empty($hash)) {
            $encryption_key = "Key_hash";
            $encrypt_method = 'AES-256-CBC';
            $iv = substr(hash('sha256', $encryption_key), 0, 16);
            $decryptedUrl = base64_decode(urldecode($hash));
            $decryptedSsl = openssl_decrypt($decryptedUrl, $encrypt_method, $encryption_key, 0, $iv);
            $decrypted_data = ($decryptedSsl) ? json_decode($decryptedSsl, true) : null;

        }

        return $decrypted_data;

    }


    public static function generateCode($length = 10, $code_type = 4)
    {
        $validchars[1] = "0123456789";
        $validchars[2] = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $validchars[3] = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $validchars[4] = "!@#$%^&*()_+0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";

        $code = "";
        $counter = 0;

        while ($counter < $length) {
            $actChar = substr($validchars[$code_type], rand(0, strlen($validchars[$code_type]) - 1), 1);

            $code .= $actChar;
            $counter++;
        }
        return $code;
    }



    public static function getFilePathWithUpdateTime($file)
    {

        return $file . '?v=' .  filemtime(__DIR__ . '/..' . $file );

    }

    public static function greekDate($date = '',$type = 'day'){

        $greekMonths = array('Ιανουαρίου','Φεβρουαρίου','Μαρτίου','Απριλίου','Μαΐου','Ιουνίου','Ιουλίου','Αυγούστου','Σεπτεμβρίου','Οκτωβρίου','Νοεμβρίου','Δεκεμβρίου');
        $greekdays = array('Δευτέρα','Τρίτη','Τετάρτη','Πέμπτη','Παρασκευή','Σάββατο','Κυριακή');

        if($date==''){

            $date = date('Y-m-d H:i:s');

        } else {

            $date = date('Y-m-d H:i:s',strtotime($date));

        }


        switch ($type){

            case 'day':
                return $greekdays[date('N', strtotime($date))-1];
                break;


            case 'month':
                return $greekMonths[date('m', strtotime($date))-1];
                break;

            case 'fullDate':
                return $greekdays[date('N', strtotime($date))-1] . ' ' . date('d',strtotime($date)) . ' ' . $greekMonths[date('m', strtotime($date))-1] . ' ' . date('Y',strtotime($date));
                break;

            case 'time':
                return date('H:i', strtotime($date));
                break;

            case 'fullDateTime':
                return $greekdays[date('N', strtotime($date))-1] . ' ' . date('d',strtotime($date)) . ' ' . $greekMonths[date('m', strtotime($date))-1] . ' ' . date('Y',strtotime($date)) . ', ' . date('H:i', strtotime($date));
                break;

            default:
                return date('d-m-Y',strtotime($date));

        }

    }

    public static function getAge($then) {

        $then_ts = strtotime($then);
        $then_year = date('Y', $then_ts);
        $age = date('Y') - $then_year;
        if(strtotime('+' . $age . ' years', $then_ts) > time()) $age--;
        return $age+1;

    }

}