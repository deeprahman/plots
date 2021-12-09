<?php


namespace Plots\Controllers;
use Plots\Core\Request;
use Plots\Core\Config;
use Plots\Core\Db;
use Monolog\Logger;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Monolog\Handler\StreamHandler;

abstract class AbstractController
{
    protected $request;
    protected $db;
    /**
     * @var Config
     */
    protected $config;
    /**
     * @var Environment
     */
    protected $view;
    /**
     * @var Logger
     */
    protected $log;

    public function __construct(Request $request){
        $this->request = $request;
        $this->db = Db::getInstance();
        $this->config = Config::getInstance();
        // Load Twig
        try{
            $this->view = new Environment(
                new FilesystemLoader(__DIR__ . "/Views")
            );
        }catch(\Exception $ex){
            echo $ex->getMessage();
        }
        // Load Logger
        if($this->log instanceof Logger ){
            $this->log = new Logger('Plots');
        }
        $logFile = $this->config->get('log');
        $this->log->pushHandler(
            new StreamHandler(
                $logFile,
                Logger::DEBUG
            )
        );
    }

    protected function render(string $template, array $params = []){
        return $this->view
            ->load($template)
            ->render($params);
    }
}