<?php
/**
 * On deployment, copy and rename this file to config.php. Set 
 * variables according to server settings.
 */

Config::set('ACCESS_TOKEN_ADMIN', '{ACCESS_TOKEN_ADMIN}');
Config::set('ACCESS_HASH_KEY', '{ACCESS_HASH_KEY}');

// Database Master
Config::set('DB_HOSTNAME_MASTER', '{DB_HOSTNAME_MASTER}');
Config::set('DB_USERNAME_MASTER', '{DB_USERNAME_MASTER}');
Config::set('DB_PASSWORD_MASTER', '{DB_PASSWORD_MASTER}');
Config::set('DB_DATABASE_MASTER', '{DB_DATABASE_MASTER}');

// Database slave
Config::set('DB_HOSTNAME_SLAVE', Config::get('DB_HOSTNAME_MASTER'));
Config::set('DB_USERNAME_SLAVE', Config::get('DB_USERNAME_MASTER'));
Config::set('DB_PASSWORD_SLAVE', Config::get('DB_PASSWORD_MASTER'));
Config::set('DB_DATABASE_SLAVE', Config::get('DB_DATABASE_MASTER'));

Config::set('HAS_SLAVE', 1);

Config::set('ImagePath', '{ImagePath}');
Config::set('ImagePathReal', '{ImagePathReal}');

include 'config-project.php';
