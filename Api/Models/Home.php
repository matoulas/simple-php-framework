<?php

namespace Api\Models;

use Api\Core\Model;

class Home extends Model {
    protected function setModelTable()  {
        $this->table = "databaseTable";
    }

    public function getInfo() {
        $stmt = $this->sqlExec("SELECT COUNT(*) FROM $this->table");
        while ($data = $stmt->fetch()) {
            print_r($data);
        }
    }
}
