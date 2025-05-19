<?php 

class Kernel {

    private static $url;
    private static $controller;

    public static function run() {
        self::$url = Routeur::getPath();
        self::loadHelper("debug");
        self::loadController();

        $ctrlName = self::$url['controller']."Controller";

        self::$controller = new $ctrlName();

        if(method_exists(self::$controller, self::$url['action'])) {
            call_user_func_array(array(self::$controller, self::$url['action']), self::$url['params']);
        } else {
            echo "Erreur 404 : La page n'existe pas";
        }
        

    }

    private static function loadController() {
        if(file_exists(CONTROLLER.DS.self::$url['controller']."Controller.php")) {
            include_once(CONTROLLER.DS.self::$url['controller']."Controller.php");
        } else {
            echo "Erreur 404 : La page n'existe pas";
        }
    }

    private static function loadHelper($helper) {
        if(file_exists(HELPER.DS.$helper.".php")) {
            include_once(HELPER.DS.$helper.".php");
        } else {
            echo "Erreur : Le helper n'existe pas";
        }
    }

}