<?php


namespace Plots\Controllers;

use Exception;
use PDO;
use Plots\Core\Request;
use Plots\Core\Config;
use Plots\Core\Db;
use Monolog\Logger;
use Plots\Utils\DebugTrait;
use Plots\Utils\DependencyInjector;
use Twig\Environment;
use Twig\Error\Error as TwigException;
use Twig\Loader\FilesystemLoader;
use Monolog\Handler\StreamHandler;

abstract class AbstractController
{
    use DebugTrait;
    protected $properties = ['title' => 'Error Page'];
    protected $request;
    protected $di;
    /**
     * @var PDO
     */
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

    /**
     * @throws \Plots\Exceptions\NotFoundException
     */
    public function __construct(
        DependencyInjector $di,
        Request $request
    )
    {
        $this->request = $request;
        $this->di = $di;
        $this->db = $di->get('PDO');
        $this->log = $di->get('Logger');
        $this->view = $di->get('Twig\Environment');
        $this->config = $di->get('Utils\Config');
    }


    /**
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     * @throws \Twig\Error\LoaderError
     */
    protected function render(string $template, array $params = []): string
    {
        return $this->view->render($template, $params);
    }
}