<?php

class Requester {

    private $query;
    private $co;
    private $values;
    private $stmt;
    private $fields;
    private $relations;
    private $table;
    private $primaryKey;

    public function __construct($co, $fields, $table) {
        $this->co = $co;
        $this->fields = $fields;
        $this->table = $table;
        $this->setParams();
    }

    private function setParams() {
        foreach($this->fields as $field => $params) {
            if(isset($params["primary_key"]) && $params["primary_key"]) {
                $this->primaryKey = $field;
            }
            if(isset($params["relation"])) {
                $this->relations["id"] = $params["relation"];
            }
        }
    }

    public function select($fields = "*") {
        $this->query = "SELECT ";

        if(is_array($fields)) {
            foreach ($fields as $value) {
                $this->query.= $value.", ";
            }

            $this->query = substr($this->query, 0, -2);
        } else {
            $this->query.= $fields;
        }
        return $this;

    }

    public function from($table = null) {
        if(!is_null($table)) {
            $this->table = $table;
        }
        $this->query .= " FROM ".$this->table." ";
        return $this;
    }

    public function join() {
        $this->query .= "INNER JOIN ";
        foreach($this->relations as $field => $params) {
            $this->query .= $params["entity"]." ON "
            .$this->table.".".$this->primaryKey." = "
            .$params["entity"].".".$params["foreign_key"]." ";
        }

        return $this;
    }

    public function where($cond, $value = null, $operator = "=") {
        $this->query .= " WHERE ";

        if(is_array($cond)) {
            foreach($cond as $k => $v) {
                $this->query .= $this->table.".".$k." = :".$k." AND ";
                if(!empty($this->values)) {
                    $this->values = [];
                }
                if(is_array($v)) {
                    $this->values = $v;
                } else {
                    $this->values[$k] = $v;
                }
            }
            $this->query = substr($this->query, 0, -5);
        } else {
            if(!is_null($value)) {
                $this->query .= $cond." ".$operator." :".$cond;
                $this->values[$cond] = $value;
            } else {
                $this->query .= $cond." ".$operator." :".$cond;

            }
        }

        return $this;
    }

    public function insert($values) {
        $this->query = "INSERT INTO ".$this->table."(";
        $preparedValues = "";

        $filteredValues = [];
        $fields = [];

        foreach ($this->fields as $key => $fieldParams) {
            if(!isset($fieldParams["auto_increment"])) {
                if(array_key_exists($key, $values)) {
                    $fields[] = $key;
                    $preparedValues .= ":".$key.", ";
                    $filteredValues[$key] = $values[$key];
                }
            }
        }

        if (empty($fields)) {
            throw new Exception("Aucun champ à insérer");
        }

        $this->query .= implode(", ", $fields);
        $preparedValues = substr($preparedValues, 0, -2);

        $this->query .= ") VALUES (".$preparedValues.")";
        $this->values = $filteredValues;

        $this->execute();
        return $this->co->lastInsertId();
    }

    public function update($values) {
        $this->query = "UPDATE ".$this->table." SET ";

        if (!isset($values[$this->primaryKey])) {
            throw new Exception("La clé primaire doit être présente dans les valeurs pour la mise à jour");
        }

        $filteredValues = [];
        $filteredValues[$this->primaryKey] = $values[$this->primaryKey];

        $setClause = "";
        foreach ($this->fields as $key => $fieldParams) {
            if(!isset($fieldParams["auto_increment"]) && array_key_exists($key, $values)) {
                $setClause .= $key." = :".$key.", ";
                $filteredValues[$key] = $values[$key];
            }
        }

        if (empty($setClause)) {
            throw new Exception("Aucun champ à mettre à jour");
        }

        $this->query .= substr($setClause, 0, -2);
        $this->query .= " WHERE ".$this->primaryKey." = :".$this->primaryKey;

        $this->values = $filteredValues;

        $this->execute();
        return $this->stmt->rowCount();
    }

    public function delete() {
        $this->query = "DELETE";
        return $this;
    }

    public function debugQuery() {
        var_dump($this->query);
    }

    public function execute() {
        return $this->prepareAndExecute();
    }

    public function fetch($mode=PDO::FETCH_ASSOC) {
        $this->execute();
        return $this->stmt->fetch($mode);

    }

    public function fetchAll($mode=PDO::FETCH_ASSOC) {
        $this->execute();
        return $this->stmt->fetchAll($mode);

    }

    protected function prepareAndExecute() {
        try {
            $this->stmt = $this->co->prepare($this->query);
            $result = $this->stmt->execute($this->values);

            if($this->stmt->rowCount()) {
                return $this->stmt->rowCount();
            }

            return $result;
        } catch (PDOException $e) {
            echo "Erreur SQL: " . $e->getMessage() . "<br>";
            echo "Code: " . $e->getCode() . "<br>";
            echo "Requête: " . $this->query . "<br>";
            echo "Valeurs: <pre>"; print_r($this->values); echo "</pre>";
            throw $e;
        }
    }

}