<?php

namespace Api\Core;

abstract class Model{

    protected $table;
    abstract protected function setModelTable();

    public function __construct() {
        $this->setModelTable();
    }

    protected function sqlExec($sql = "", $bindParams = []) {
        $result = [];
        $dbh = Database::me()->getDB();
        try {
            $stmt = $dbh->prepare($sql);
            $stmt->execute($bindParams);
            return $stmt;
        } catch (\PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    protected function fetchAssoc(&$sth) {
        return $sth->fetch(\PDO::FETCH_ASSOC);
    }
}
