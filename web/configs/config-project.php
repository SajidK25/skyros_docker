<?php
/**
 * This file contains project related configuration.
 */

/**
 * Set the root of the site
 */

Config::set('Root', '/');
Config::set('Http', (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') ? 'https://' : 'http://');
Config::set('Domain', $_SERVER['HTTP_HOST']);


/**
 *
 *  Git Settings
 *
 */

Config::set("GIT", "ssh-agent bash -c 'ssh-add /var/www/vhosts/ibserver.gr/.ssh/id_rsa_gitdeploy; git pull -v 2>&1'");                                             // The path to the git executable
Config::set("GIT_TOKEN", "oM3Cihooka3teix2yohkaiKeeWahlo");                     // The secret token to add as a GitHub or GitLab secret, or otherwise as https://www.example.com/?token=secret-token
Config::set("GIT_REMOTE_REPOSITORY", "gitdev.ibserver.gr:/aap/allaboutp.git");  // The SSH URL to your repository
Config::set("GIT_DIR", __DIR__ . '/../' );                                      // The path to your repostiroy; this must begin with a forward slash (/)
Config::set("GIT_BRANCH", "master");                                            // The branch route
Config::set("GIT_LOGFILE", __DIR__ . "/../logs/deploy.log");                               // The name of the file you want to log to.
Config::set("GIT_AFTER_PULL", "");

/**
 * SMTP details
 */

Config::set('useSMTP', 1);
Config::set('Host', 'smtp.sendgrid.net');
Config::set('SMTPAuth', true);
Config::set('Username', 'IbHelSup');
Config::set('Password', 'diakgavVept9');
Config::set('SMTPSecure', 'tls');
Config::set('Port', '587');


/**
 *  Mailchimp Data
 */

Config::set('Mailchimp_api_key', '');
Config::set('Mailchimp_list_id', '');

/**
 * Supported Languages
 */

Config::set('supportedLanguages', ['el', 'en']);

/**
 * Set the default language
 */

Config::set('defaultLanguage', 'el');

/**
 * Google Api Key
 */

Config::set('GoogleApiKey', 'AIzaSyDgkmHcgznum0KBa9xxMUfEsn7p7tmnYS0');

//skyros api
//Config::set('GoogleApiKey', 'AIzaSyCYJW70k_oXBKIovR1Un6yElHTrXq-Apl8');

//Config::set('reCAPTCHASiteKey', '6LfCx2gUAAAAAIhirjezSGf1faphqtVbfa9Cnv1p');
Config::set('reCAPTCHASiteKey', '6Lfx0MYUAAAAAIEO11bLl7TRolUxHbuTuN8wp3ks');
Config::set('reCAPTCHASecretKey', '6Lfx0MYUAAAAAMNudY3QH9r0gNovK2dNQm5SXAbn');


/**
 * Set the path of the translations
 */

Config::set('translationsPath', 'translations/default.php');

/**
 * Site name
 */

Config::set('SiteName', 'Petrogaz');
Config::set('SiteImages', '/dist/images/');

Config::set('DemoSite', 1);
