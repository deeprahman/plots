<?php
session_start();
//phpinfo();
use Plots\Core\Request;
use Plots\Core\Router;
use Plots\Utils\DependencyInjection;


const ROOT = __DIR__;
require_once ROOT . '/vendor/autoload.php';

try {
    $di = (new DependencyInjection())->getDependencies(); // Instantiate Dependency Injection
} catch (\Plots\Exceptions\NotFoundException $e) {
    exit($e->getMessage());
}

$router = new Router(); // Instantiate Router
try {
    $response = $router->route($di,new Request());
} catch (\Plots\Exceptions\NotFoundException $e) {
    exit($e->getMessage());
} catch (\Twig\Error\LoaderError $e) {
    exit($e->getMessage());
} catch (\Twig\Error\RuntimeError $e) {
    exit($e->getMessage());
} catch (\Twig\Error\SyntaxError $e) {
    exit($e->getMessage());
}
echo $response;


