<?php

class stockModel extends Model {

    public function countByZone($zone_id, $exclude_id = null) {
        if ($exclude_id) {
            $stmt = $this->co->prepare("SELECT COUNT(*) as count FROM ".$this->table." WHERE zone_id = ? AND id != ?");
            $stmt->execute([$zone_id, $exclude_id]);
        } else {
            $stmt = $this->co->prepare("SELECT COUNT(*) as count FROM ".$this->table." WHERE zone_id = ?");
            $stmt->execute([$zone_id]);
        }
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'];
    }

    public function __init() {
        $this->table = "produit";
        $this->addField("id", [
            "type" => "int",
            "size" => 11,
            "primary_key" => true,
            "auto_increment" => true
        ]);

        $this->addField("nom", [
            "type" => "varchar",
            "size" => 100
        ]);

        $this->addField("quantite", [
            "type" => "int",
            "size" => 11
        ]);

        $this->addField("prix_ht", [
            "type" => "float"
        ]);

        $this->addField("prix_ttc", [
            "type" => "float"
        ]);

        $this->addField("taux_tva", [
            "type" => "float"
        ]);

        $this->addField("image", [
            "type" => "varchar",
            "size" => 255
        ]);

        $this->addField("zone_id", [
            "type" => "int",
            "size" => 11,
            "relation" => ["type" => "ManyToOne",
                "entity" => "zone",
                "foreign_key" => "id"
            ]
        ]);
    }

}