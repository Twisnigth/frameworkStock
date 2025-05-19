<?php

class Model extends DB {

    protected $table;
    protected $fields = [];
    private $requester;

    public function __construct() {
        parent::__construct();

        if(method_exists($this, "__init")) {
            $this->__init();
        }

        $this->requester = new Requester($this->co, $this->fields, $this->table);

    }

    protected function addField($field, $params) {
        $this->fields[$field] = $params;
    }

    public function findAll($conditions = null) {
        $requester = $this->requester
                ->select()
                ->from($this->table);

        if ($conditions !== null) {
            $requester->where($conditions);
        }

        return $requester->fetchAll();
    }

    public function find($params) {
        return $this->requester
                ->select()
                ->from($this->table)
                ->where(["id" => $params])
                ->fetch();
    }

    private function insert($values) {
        return $this->requester
            ->insert($values);
    }

    private function update($values) {
        return $this->requester
            ->update($values);
    }

    /*public function findAll() {
        $stmt = $this->co->prepare("SELECT * FROM ".$this->table);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }*/

    /*public function find($params, $debug = false) {

        if(is_array($params)) {
            $query = "SELECT * FROM ".$this->table." WHERE ";
            foreach($params as $col => $val) {
                $query .= $col.' = :'.$col." AND ";
            }
            $query = substr($query, 0, -5);
            $stmt = $this->co->prepare($query);
            $stmt->execute($params);
            return $stmt->fetch(PDO::FETCH_ASSOC);

        } else {
            $stmt = $this->co->prepare("SELECT * FROM ".$this->table." WHERE id = ?");
            $stmt->bindParam(1, $params);
            $stmt->execute();
            if($debug) {
                $this->debugStmt($stmt);
            }
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }*/

    /*private function insert($values)
    {
        $query = "INSERT INTO ".$this->table." (";
        $preparedValues = "";

        foreach ($this->fields as $key => $value) {
            if(!isset($value["auto_increment"])) {
                $query .= $key.", ";
                $preparedValues .= ":".$key.", ";
            }

        }
        $query = substr($query, 0, -2);
        $preparedValues = substr($preparedValues, 0, -2);

        $query .= ") VALUES (".$preparedValues.")";
        $this->prepareAndExecute($query, $values);
        return $this->co->lastInsertId();
    }*/

    /*private function update($values) {
        $query = "UPDATE ".$this->table." SET ";
        $where = "";
        foreach ($this->fields as $key => $value) {
            if(!isset($value["auto_increment"]) && array_key_exists($key, $values)) {
                $query .= $key." = :".$key.", ";
            } else {
                $where .= " WHERE ".$key." = :".$key;
            }
        }
        $query = substr($query, 0, -2);
        $query .= $where;

        return $this->prepareAndExecute($query, $values);
    }*/

    public function save($values) {
        $primaryKey = "";
        foreach($this->fields as $key => $value) {
            if(isset($value['primary_key'])) {
                $primaryKey = $key;
            }
        }
        if(array_key_exists($primaryKey, $values)) {
            return $this->update($values);
        } else {
            return $this->insert($values);
        }

    }

    public function delete($cond) {
        return $this->requester->delete()
                        ->from()
                        ->where($cond)
                        ->execute();

        /*$query = "DELETE FROM ".$this->table." WHERE ";
        foreach ($this->fields as $key => $value) {
            if (array_key_exists($key, $cond)) {
                $query .= $key." = :".$key;
            }
        }

        $this->prepareAndExecute($query, $cond);*/
    }

    protected function prepareAndExecute($query, $params = null) {
        $stmt = $this->co->prepare($query);
        return $stmt->execute($params);
    }

    protected function debugStmt($stmt) {
        echo "<pre>";
        $stmt->debugDumpParams();
        echo "</pre>";
    }


    public function findAllDeux() {
        $data = $this->requester
                ->select()
                ->from($this->table)
                ->join()
                ->where(["id" => 1])
                ->fetchAll();
    }


}