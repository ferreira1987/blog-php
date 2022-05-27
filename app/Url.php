<?php

class URL
{
    private static $url = null;
    private static $baseUrl = null;

    public static function getBase()
    {
        $startUrl   = (substr($_SERVER["DOCUMENT_ROOT"], -1) == "/" ? strlen($_SERVER["DOCUMENT_ROOT"]) : strlen($_SERVER["DOCUMENT_ROOT"]) + 1);
        $excludeUrl = substr($_SERVER["SCRIPT_FILENAME"], $startUrl, -9);

        if ($excludeUrl == "/") :
            self::$baseUrl = $excludeUrl;
        else :
            self::$baseUrl = "/" . $excludeUrl;
        endif;

        return self::$baseUrl;
    }

    public static function getURL($id)
    {
        if (self::$url == null) :
            self::getURLList();
        endif;

        if (isset(self::$url[$id])) :
            return self::$url[$id];
        endif;

        return null;
    }

    private static function getURLList() {
        $startUrl   = strlen($_SERVER["DOCUMENT_ROOT"]) - 1;
        $excludeUrl = substr($_SERVER["SCRIPT_FILENAME"], $startUrl, -10);

        $request = $_SERVER['REQUEST_URI'];

        $request = substr($request, strlen($excludeUrl));

        $urlTmp = explode("?", $request);
        $request = $urlTmp[0];

        $urlExplodida = explode("/", $request);

        $retorna = array();

        for ($a = 0; $a <= count($urlExplodida); $a ++) {
            if (isset($urlExplodida[$a]) AND $urlExplodida[$a] != "") {
                array_push($retorna, $urlExplodida[$a]);
            }
        }
        self::$url = $retorna;
    }

}
