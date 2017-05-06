<?php

namespace Api\Models;

use Api\Core\Model;

class Home extends Model {
    protected function setModelTable()  {
        $this->table = "databaseTable";
    }

    public function getInfo() {
        $stmt = $this->sqlExec("SELECT first_name FROM $this->table WHERE id = ?", [1]);
        $name = "";
        while ($data = $this->fetchAssoc($stmt)) {
            $name = $data["first_name"];
        }
        return $name;
    }
}
