<?php

class Router
{
    private static $instance;
    private $notFound;
    private $defaultRoute;

    public static function getInstance()
    {
        if (!isset(self::$instance)){
            self::$instance = new Router();
        }

        return self::$instance;
    }

    public function setNotFound($action)
    {
        $this->notFound = $action;
    }

    public function setDefault($action)
    {
        $this->defaultRoute = $action;
    }

    public function dispatch($params)
    {
        $parsedUrl = $this->parseUrl($params[0]);
        return $parsedUrl;
    }

    /**
     * process url and return parsed addresses
     * @return array of target path
     */
    private function parseUrl($url)
    {
        $parsedUrl = parse_url($url);
        $parsedUrl["path"] = ltrim($parsedUrl["path"], "/");
        $parsedUrl["path"] = trim($parsedUrl["path"]);
        return explode("/", $parsedUrl["path"]);
    }

}
