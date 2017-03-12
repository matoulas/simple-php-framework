<?php

namespace Api\Core;

class Database {

    private static $me;
    private $dbh;

    private function dbConn() {
        if(stream_resolve_include_path("Api/Config/database.inc")) {
            if (is_null($this->dbh)) {
                $database = include "Api/Config/database.inc";
                try {
                    $dbh = new \PDO(
                        "mysql:host=".$database["host"].";port=".$database["port"].";dbname=".$database["dbname"],
                        $database["username"],
                        $database["password"],
                        array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
                    );
                    ($database['debug'] == 1) and $dbh->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                    $this->dbh = $dbh;
                } catch (\PDOException $e) {
                    ($database['debug'] == 1) ? die("Error!: ".$e->getMessage()."<br/>") : die("Internal Server Error 500");
                }
            }
            return $this->dbh;

        } else {
            die("Cannot find database.inc inside Config folder");
        }
    }

    public static function initialize() {
        !is_null(self::$me) and die ("Only one instance per App");
        self::$me = new self();
    }

    public static function me(){
        is_null(self::$me) and die("No instance found");
        return self::$me;
    }

    public function clear(){
        !is_null($this->dbh) and ($this->dbh = null);
        self::$me = null;
    }

    public function getDB() {
        return $this->dbConn();
    }
}
