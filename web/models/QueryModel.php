<?php
/**
 * Created by PhpStorm.
 * User: leonidas
 * Date: 10/7/2018
 * Time: 10:36 μμ
 */

class QueryModel
{

    private static $master;
    private static $slave;


    private static function getDbData(){

        self::$master['dbname'] = Config::get('DB_DATABASE_MASTER');
        self::$master['user'] = Config::get('DB_USERNAME_MASTER');
        self::$master['pass'] = Config::get('DB_PASSWORD_MASTER');
        self::$master['host'] = Config::get('DB_HOSTNAME_MASTER');

        self::$slave['dbname'] = Config::get('DB_DATABASE_SLAVE');
        self::$slave['user'] = Config::get('DB_USERNAME_SLAVE');
        self::$slave['pass'] = Config::get('DB_PASSWORD_SLAVE');
        self::$slave['host'] = Config::get('DB_HOSTNAME_SLAVE');

    }

    /**
     * Connects to database and returns handler for further query execution.
     *
     * Remember to close the connection by setting the handler to null.
     * @return PDO: Connection handler.
     */
    private static function connect_slave() {
        self::getDbData();

        if(Config::get('HAS_SLAVE')!=1){
            return self::connect_master();
        }

        try {
            $dbh = new PDO("mysql:host=" . self::$slave['host'] . ";dbname=" . self::$slave['dbname'], self::$slave['user'], self::$slave['pass']);
            $dbh->exec("set names utf8");
            return $dbh;
        } catch (PDOException $e) {
            try {
                $dbh = new PDO("mysql:host=" . self::$master['host'] . ";dbname=" . self::$master['dbname'], self::$master['user'], self::$master['pass']);
                $dbh->exec("set names utf8");
                //$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);
                return $dbh;
            } catch (PDOException $e) {
                error_log("Failed to connect to slave database! " . $e->getMessage() . "mysql:host=" . self::$slave['host'] . ";dbname=" . self::$slave['dbname'] .'->' . self::$slave['user'].'->' . self::$slave['pass'], 0);
            }
        }
    }

    private static function connect_master() {
        self::getDbData();

        try {
            $dbh = new PDO("mysql:host=" . self::$master['host'] . ";dbname=" . self::$master['dbname'], self::$master['user'], self::$master['pass']);
            $dbh->exec("set names utf8");
            return $dbh;
        } catch (PDOException $e) {
            error_log("Failed to connect to master database! " . $e->getMessage(), 0);
            return false;
        }
    }

    /**
     * Connects to database, executes a read $query with $params and returns results as array.
     *
     * @param $query : This must be a valid SQL statement for the target database server.
     * @param null $params : Query parameters. An array of values with as many elements as there are bound parameters in
     * the SQL statement being executed.
     * $type ASSOC $type : ASSOC / NUM / OBJECT
     * @return array: Returns an array containing all of the result set rows. Each row is an array indexed by column number
     * as returned in the corresponding result set, starting at column 0.
     */
    public static function Find_Data($query, $params = null, $type = 'OBJECT', $conn = 'slave') {

        if($conn === 'master'){
            $dbh = self::connect_master();
        }
        else {
            $dbh = self::connect_slave();
        }
        if(!$dbh){
            return false;
        }
        if ($params != null) {
            if (!is_array($params)){
                $params = array($params);
            }
        }
        $sth = $dbh->prepare($query);
        if(!$sth->execute($params)){
            error_log("Failed to execute the query... { ".$query." }", 0);
            return false;
        }
        switch($type){
            case 'NUM':
                $result = $sth->fetchAll(PDO::FETCH_NUM);
                break;
            case 'ASSOC':
                $result = $sth->fetchAll(PDO::FETCH_ASSOC);
                break;
            default:
                $result = $sth->fetchAll(PDO::FETCH_OBJ);

        }
        $dbh = NULL;
        if(count((array) $result) > 0){
            return $result;
        } else {
            return false;
        }
    }

    /**
     * Connects to database, executes a read $query with $params and returns the first result.
     * Empty result sets are not handled.
     * TODO: Should we return null if result set is empty?
     *
     * @param $query : This must be a valid SQL statement for the target database server.
     * @param null $params : Query parameters. An array of values with as many elements as there are bound parameters in
     * the SQL statement being executed.
     * @return mixed: The first result from a non-empty result set.
     */
    public static function GetSingleColumn($query, $params = null, $type = 'OBJECT', $conn = 'slave') {
        if($conn == 'master'){
            $dbh = self::connect_master();
        }
        else {
            $dbh = self::connect_slave();
        }
        if(!$dbh){
            return false;
        }
        if ($params != null) {
            if (!is_array($params)) $params = array($params);
        }
        $sth = $dbh->prepare($query);
        if(!$sth->execute($params)){
            error_log("Failed to execute the query... { ".$query." }", 0);
            return false;
        }
        switch($type){
            case 'NUM':
                $result = $sth->fetchAll(PDO::FETCH_NUM);
                break;
            case 'ASSOC':
                $result = $sth->fetchAll(PDO::FETCH_ASSOC);
                break;
            default:
                $result = $sth->fetchAll(PDO::FETCH_OBJ);

        }
        $dbh = NULL;
        if(count((array) $result) > 0){
            return $result[0];
        } else {
            return false;
        }
    }

    /**
     * Connects to database, executes an insert/update/delete $query with $params and returns the last insert id.
     *
     * @param $query : An insert or update or delete query.
     * @param null $params : Query parameters. An array of values with as many elements as there are bound parameters in
     * the SQL statement being executed.
     * @return string: The last insert id is useful for insert queries.
     */
    public static function exec_Query( $query , $params = null ) {
        $dbh = self::connect_master();
        if(!$dbh){
            return false;
        }
        if ( $params != null) {
            if ( !is_array( $params ) ) $params = array( $params );
        }
        $sth = $dbh->prepare( $query );
        if(!$sth->execute($params)){
            error_log("Failed to execute the query... { ".$query." }", 0);
            return false;
        }
        $id = $dbh->lastInsertId();
        $dbh = null;
        return $id;
    }

    /**
     * Connects to database, executes an insert at table $table with $params and returns the last insert id.
     *
     * @param $table : An insert or update or delete query.
     * @param null $params : INSERT parameters. An array of values with as many elements as there are bound parameters in
     * the SQL statement being executed.
     * @return string: The last insert id is useful for insert queries.
     */
    public static function insert_Query( $table , $params ) {
        if(isset($table) && $table!='' && is_array($params) && count($params)>0 ) {
            $dbh = self::connect_master();
            if(!$dbh){
                return false;
            }
            foreach ($params AS $field => $value) {
                $fields[] = '`' . $field . '` = ? ';
                $values[] = $value;
            }
            $query = "INSERT INTO {$table} SET " . implode(',', $fields);
            $sth = $dbh->prepare($query);
            if(!$sth->execute($values)){
                error_log("Failed to execute the query... { ".$query." }", 0);
                return false;
            }
            $id = $dbh->lastInsertId();
            $dbh = null;
        } else {
            $id=0;
        }
        return $id;
    }

    /**
     * Connects to database, executes an insert at table $table with $params and returns the last insert id.
     *
     * @param $table : An insert or update or delete query.
     * @param null $params : INSERT parameters. An array of values with as many elements as there are bound parameters in
     * the SQL statement being executed.
     * @return string: The last insert id is useful for insert queries.
     */
    public static function update_Query( $table , $params, $where = []) {
        if(isset($table) && $table!='' && is_array($params) && count($params)>0 ) {
            foreach ($params AS $field => $value) {
                $fields[] = '`' . $field . '` = ? ';
                $values[] = $value;
            }
            $mywhere='';
            if( count($where) > 0 ){
                foreach ($where AS $field => $value) {
                    $wheres[] = $field . '= ? ';
                    $values[] = $value;
                }
                $mywhere = " WHERE " . implode(' AND ' , $wheres);
            }

            $query="UPDATE {$table} SET " . implode(',' , $fields) . $mywhere;
            $dbh = self::connect_master();
            if(!$dbh){
                return false;
            }
            $sth = $dbh->prepare($query);
            if(!$sth->execute($values)){
                error_log("Failed to execute the query... { ".$query." }", 0);
                return false;
            }
            $id = $dbh->lastInsertId();
            $dbh = null;
        } else {
            $id=0;
        }
        return $id;
    }


}