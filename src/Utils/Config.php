<?php

namespace Plots\Core;
use Plots\Exceptions\NotFoundException;

final class Config
{
    private $data;
    private static $instance;

    private function __construct(){
        $json = file_get_contents(
            ROOT . '/config/config.json'
        );
        $this->data = json_decode($json, true);
    }

    public static function getInstance(){
        if(self::$instance == null){
            self:: $instance = new Config();
        }
        return self::$instance;
    }

    /**
     * @throws NotFoundException
     */
    public function get($key){
        if(!isset($this->data[$key])){
            throw new NotFoundException("Key $key not found");
        }
        return $this->data[$key];
    }
}