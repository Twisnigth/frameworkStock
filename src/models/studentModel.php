<?php

class studentModel extends Model {

    public function __init() {
        $this->table = "student";
        $this->addField("id", [
            "type" => "int",
            "size" => 11,
            "primary_key" => true,
            "auto_increment" => true,
            "relation" => ["type" => "OneToOne", 
                "entity" => "user", 
                "foreign_key" => "id"
            ]
        ]);

        $this->addField("nom", [
            "type" => "varchar",
            "size" => 20
        ]);

        $this->addField("prenom", [
            "type" => "varchar",
            "size" => 20
        ]);

        $this->addField("email", [
            "type" => "varchar",
            "size" => 100
        ]);
    }

    
}