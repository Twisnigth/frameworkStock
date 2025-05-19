<?php

class DB {

    private $DB_HOST;
    private $DB_USER;
    private $DB_PASSWORD;
    private $DB_PORT;
    private $DB_NAME;
    private $DB_CHARSET;
    protected $co;

    public function __construct() {

        $this->getConfig("default");
        $this->connect();
    }

    private function connect() {
        $this->co = new PDO('mysql:host='.$this->DB_HOST.';port='.$this->DB_PORT.';dbname='.$this->DB_NAME.';charset='.$this->DB_CHARSET, $this->DB_USER, $this->DB_PASSWORD);
    }

    private function getConfig($connectionName) {
        $config = include(ROOT.DS."config.php");
        if (!is_array($config) || !isset($config['connections'][$connectionName])) {
            die("Erreur: Configuration de base de données invalide ou manquante.");
        }
        $this->DB_HOST = $config['connections'][$connectionName]['host'];
        $this->DB_USER = $config['connections'][$connectionName]['user'];
        $this->DB_PASSWORD = $config['connections'][$connectionName]['password'];
        $this->DB_PORT = $config['connections'][$connectionName]['port'];
        $this->DB_NAME = $config['connections'][$connectionName]['dbname'];
        $this->DB_CHARSET = $config['connections'][$connectionName]['charset'];
    }
}