<?php
/**
 * Created by PhpStorm.
 * User: leonidas
 * Date: 9/10/18
 * Time: 4:56 PM
 */

class gitController extends mainController
{

    public function deploy()
    {

        $content = file_get_contents("php://input");
        $json = json_decode($content, true);
        $file = fopen(Config::get('GIT_LOGFILE'), "a");
        $time = time();
        $token = false;
//        error_log($content, 1);
//        error_log($content);
//        foreach ($_SERVER as $k => $v) {
//            error_log($k . ' - ' . $v);
//        }

// retrieve the token
        if (!$token && isset($_SERVER["HTTP_X_HUB_SIGNATURE"])) {
            list($algo, $token) = explode("=", $_SERVER["HTTP_X_HUB_SIGNATURE"], 2) + array("", "");
        }

// log the time
        date_default_timezone_set("UTC");
        fputs($file, date("d-m-Y (H:i:s)", $time) . "\n");



// Check for a GitHub signature
        if (!empty(Config::get('GIT_TOKEN')) && isset($_SERVER["HTTP_X_HUB_SIGNATURE"]) && $token !== hash_hmac($algo, $content, Config::get('GIT_TOKEN'))) {
            $this->forbid($file, "X-Hub-Signature does not match TOKEN");
// Check for a GitLab token
        } elseif (!empty(Config::get('GIT_TOKEN')) && isset($_SERVER["HTTP_X_GITLAB_TOKEN"]) && $token !== Config::get('GIT_TOKEN')) {
            $this->forbid($file, "X-GitLab-Token does not match TOKEN");
// Check for a $_GET token
        } elseif (!empty(Config::get('GIT_TOKEN')) && isset($_GET["token"]) && $token !== Config::get('GIT_TOKEN')) {
            $this->forbid($file, $_GET["token"] . " does not match TOKEN");
// if none of the above match, but a token exists, exit
        } elseif (!empty(Config::get('GIT_TOKEN')) && !isset($_SERVER["HTTP_X_HUB_SIGNATURE"]) && !isset($_SERVER["HTTP_X_GITLAB_TOKEN"]) && !isset($_GET["token"])) {
            $this->forbid($file, "No token detected");
        } else {
            // check if pushed branch matches branch specified in config
            if ($json["changes"][0]["ref"]["displayId"] === Config::get('GIT_BRANCH')) {
                fputs($file, $content . PHP_EOL);

                // ensure directory is a repository
                if (file_exists(Config::get('GIT_DIR') . ".git") && is_dir( Config::get('GIT_DIR') ) ) {
                    try {
                        // pull
                        fputs($file, "*** AUTO PULL INITIATED ***" . "\n");
                        chdir( Config::get('GIT_DIR') );
                        //$result = shell_exec(Config::get('GIT'). " pull -v 2>&1 ");
                        $result = shell_exec(Config::get('GIT'));


                        fputs($file, $result . "\n");

                        // return OK to prevent timeouts on AFTER_PULL
                        $this->ok();

                        // execute AFTER_PULL if specified
                        if ( !empty( Config::get('AFTER_PULL') ) ) {
                            try {
                                fputs($file, "*** AFTER_PULL INITIATED ***" . "\n");
                                $result = shell_exec( Config::get('AFTER_PULL') );
                                fputs($file, $result . "\n");
                            } catch (Exception $e) {
                                fputs($file, $e . "\n");
                            }
                        }
                        fputs($file, "*** AUTO PULL COMPLETE ***" . "\n");
                    } catch (Exception $e) {
                        fputs($file, $e . "\n");
                    }
                } else {
                    fputs($file, "=== ERROR: DIR is not a repository ===" . "\n");
                }
            } else {
                fputs($file, "=== ERROR: Pushed branch does not match BRANCH ===\n");
            }
        }

        fputs($file, "\n\n" . PHP_EOL);
        fclose($file);
    }

    // function to forbid access
    public function forbid($file, $reason)
    {
        // explain why
        if ($reason) fputs($file, "=== ERROR: " . $reason . " ===\n");
        fputs($file, "*** ACCESS DENIED ***" . "\n\n\n");
        fclose($file);

        // forbid
        header("HTTP/1.0 403 Forbidden");
        exit;
    }

// function to return OK
    public function ok()
    {
        ob_start();
        header("HTTP/1.1 200 OK");
        header("Connection: close");
        header("Content-Length: " . ob_get_length());
        ob_end_flush();
        ob_flush();
        flush();
    }

}
