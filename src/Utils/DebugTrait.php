<?php


namespace Plots\Utils;


use Plots\Core\Config;
use Plots\Exceptions\NotFoundException;

trait DebugTrait
{
    protected $debug;

    /**
     * @throws NotFoundException
     */
    protected function isDebug():int
    {
        if(!isset($this->debug)){
            $this->debug = ('true' == Config::getInstance()->get('debug'))?1:0;
        }
        return $this->debug;
    }
    /**
     * @throws \Plots\Exceptions\NotFoundException
     */
    protected function debugEcho($message){
        try{
            if('true' == Config::getInstance()->get('debug')){
                var_dump($message);
                echo(PHP_EOL);
            }
        }catch(NotFoundException $e){
            exit($e->getMessage());
        }
    }
}