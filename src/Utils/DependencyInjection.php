<?php


namespace Plots\Utils;

use Exception;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Plots\Core\Config;
use Plots\Core\Db;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class DependencyInjection
{
    use DebugTrait;

    /**
     * @var DependencyInjector
     */
    private $di;

    public function __construct()
    {
        $this->setDi();
    }

    /**
     * @throws \Plots\Exceptions\NotFoundException
     */
    public function getDependencies(): DependencyInjector
    {
        $this->setDb()
            ->setTwig()
            ->setLog()
            ->setConfig();
        return $this->di;
    }

    private function setDi(): DependencyInjection
    {
        $this->di = new DependencyInjector();
        return $this;
    }

    /**
     * @throws \Plots\Exceptions\NotFoundException
     */

    private function setConfig()
    {
        $this->di->set('Utils\Config', Config::getInstance()); // Database class instance
        return $this;
    }

    private function setDb()
    {
        $this->di->set('PDO', Db::getInstance()); // Database class instance
        return $this;
    }

    /**
     * @throws \Plots\Exceptions\NotFoundException
     */
    private function setTwig()
    {
        $twigEnv['debug'] = (bool)$this->isDebug();
        try {
            $loader = new FilesystemLoader(ROOT . "/src/Views");
            $twig = new Environment($loader, $twigEnv);
        } catch (Exception $e) {
            exit($e->getMessage());
        }
        $this->di->set('Twig\Environment', $twig);
        return $this;
    }

    private function setLog(): DependencyInjection
    {
        $logFile = ROOT . '/src/Logs/plots.log';
        $log = new Logger('Plots'); // Logger instance
        $log->pushHandler(
            new StreamHandler(
                $logFile,
                Logger::DEBUG
            )
        );
        $this->di->set('Logger', $log);
        return $this;
    }

}