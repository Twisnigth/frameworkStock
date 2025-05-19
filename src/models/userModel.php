<?php 

class userModel extends Model {

    public function __init() {
        $this->table = "user";
        $this->addField("id", [
            "type" => "int",
            "size" => 11,
            "auto_increment" => true,
            "relation" => "OneToOne",
            "relationEntity" => ["student"]
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