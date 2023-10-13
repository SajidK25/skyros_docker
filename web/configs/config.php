<?php
/**
 * On deployment, copy and rename this file to config.php. Set 
 * variables according to server settings.
 */

Config::set('ACCESS_TOKEN_ADMIN', 'wmltkpn9wd3p7k54r7je');
Config::set('ACCESS_HASH_KEY', 'dc1w8psuw6yrex10c924if382zwnpqk0fsxpp0d9usezmgjt0lgeb1uly25m');

// Database Master
Config::set('DB_HOSTNAME_MASTER', 'mysql');
Config::set('DB_USERNAME_MASTER', 'skyros');
Config::set('DB_PASSWORD_MASTER', 'skyros');
Config::set('DB_DATABASE_MASTER', 'skyros');
// Config::set('DB_HOSTNAME_MASTER', '172.16.64.1');
// Config::set('DB_USERNAME_MASTER', 'skyros');
// Config::set('DB_PASSWORD_MASTER', 'lEfYc8rS0gn7CoCJNb9pEJuC0MefdsfD1JKQbZjlV');
// Config::set('DB_DATABASE_MASTER', 'skyros');

// Database slave
Config::set('DB_HOSTNAME_SLAVE', Config::get('DB_HOSTNAME_MASTER'));
Config::set('DB_USERNAME_SLAVE', Config::get('DB_USERNAME_MASTER'));
Config::set('DB_PASSWORD_SLAVE', Config::get('DB_PASSWORD_MASTER'));
Config::set('DB_DATABASE_SLAVE', Config::get('DB_DATABASE_MASTER'));

Config::set('HAS_SLAVE', 1);

Config::set('ImagePath', 'https://mediaskyros.dev.ibserver.gr/images/');
Config::set('ImagePathReal', 'https://mediaskyros.dev.ibserver.gr/uploads/media/');

include 'config-project.php';
