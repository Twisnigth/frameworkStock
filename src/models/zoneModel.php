<?php

class zoneModel extends Model {

    public function __init() {
        $this->table = "zone";
        $this->addField("id", [
            "type" => "int",
            "size" => 11,
            "primary_key" => true,
            "auto_increment" => true,
            "relation" => ["type" => "OneToMany",
                "entity" => "stock",
                "foreign_key" => "zone_id"
            ]
        ]);

        $this->addField("libelle", [
            "type" => "varchar",
            "size" => 100
        ]);

        $this->addField("rue", [
            "type" => "varchar",
            "size" => 255
        ]);

        $this->addField("code_postal", [
            "type" => "varchar",
            "size" => 10
        ]);

        $this->addField("ville", [
            "type" => "varchar",
            "size" => 100
        ]);
    }

}