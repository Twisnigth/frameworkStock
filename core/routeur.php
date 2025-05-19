<?php

class Routeur {
    private static $url; 
    private static $urlParsed;
    private static $finalUrl;

    public static function getPath() {
        self::$url = $_SERVER['PATH_INFO'];
        
        if(!empty(self::$url)) {
            self::parsedUrl();

            self::$finalUrl['controller'] = self::$urlParsed[0];
            self::$finalUrl['action'] = self::$urlParsed[1];
            array_splice(self::$urlParsed, 0, 2);
            if(!empty(self::$urlParsed)) {
                self::$finalUrl['params'] = self::$urlParsed;
            } else {
                 self::$finalUrl['params'] = [];
            }
        }

        return self::$finalUrl;
        
    }

    private static function parsedUrl() {
        self::$urlParsed = explode('/', self::$url);
        array_splice(self::$urlParsed, 0, 1);
    }
}