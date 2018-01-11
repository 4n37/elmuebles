<?php
class Request{

    private $parameters;

    public function __construct(){
        $this->parameters = array_merge($_GET, $_POST);
    }

    public function isParameter($name) {
        return isset($this->parameters[$name]);
    }

    public function getParameter($name, $default) {
        if ($this->isParameter($name)) {
            return $this->parameters[$name];
        } else {
            return $default;
        }
    }

}
