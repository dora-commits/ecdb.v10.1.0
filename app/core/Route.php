<?php

/**
 * class Route 
 * TODO: parse URL and routing to controllers
 */
class Route
{
    protected $controller = 'HomeController';
    protected $method = 'index';
    protected $params = [];
    protected $api = 'Api';

    public function __construct()
    {
        $url = $this->parseUrl();

        // Set a custom exception handler
        set_exception_handler(function ($exception) {
            // Customize how exceptions are displayed
            echo ' Fatal error: Uncaught Exception: ' . htmlspecialchars($exception->getMessage());
            // Optionally log the exception details for further analysis
            error_log($exception->getMessage() . "\n" . $exception->getTraceAsString());
        });

        // TODO: Checking API
        if (strcmp($url[0], "api") == 0) {

            unset($url[0]);

            require_once '../app/api/' . $this->api . '.php';
            $this->api = new $this->api;

            if (isset($url[1])) {

                $this->method = $url[1];

                if (method_exists($this->api, $this->method)) {
                    unset($url[1]);
                    $this->params = $url ? array_values($url) : [];
                    call_user_func_array([$this->api, $this->method], $this->params);
                } else {
                    throw new Exception('Api ' . $this->method . ' does not exist!');
                }

            } else {
                throw new Exception('Api does not exist !');
            }
        } else {
            
            // TODO: Checking Valid Page

            if (!is_null($url)) {
                if (file_exists('../app/controllers/' . ucfirst($url[0]) . 'Controller.php')) {
                    $this->controller = ucfirst($url[0]) . 'Controller';
                    unset($url[0]);
                } else {
                    $this->controller = '_404Controller';
                }
            }

            require_once '../app/controllers/' . $this->controller . '.php';

            $this->controller = new $this->controller;

            if (isset($url[1])) {
                if (method_exists($this->controller, $url[1])) {
                    $this->method = $url[1];
                    unset($url[1]);
                }
            }

            $this->params = $url ? array_values($url) : [];

            call_user_func_array([$this->controller, $this->method], $this->params);
        }
    }

    public function parseUrl()
    {
        if (isset($_GET['url'])) {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
    }
}
