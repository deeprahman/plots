<?php


namespace Plots\Core;

use Plots\Controllers\CustomerController;
use Plots\Controllers\ErrorController;
use Plots\Utils\DebugTrait;
use Plots\Utils\DependencyInjector;

class Router
{
    use DebugTrait;
    private $routeMap;
    private static $regexPatters = [
        'number' => '\d+',
        'string' => '\w'
    ];

    /**
     * @throws \Plots\Exceptions\NotFoundException
     */
    public function __construct()
    {
        $json = file_get_contents(
            ROOT . "/config/routes.json"
        );
        $this->routeMap = json_decode($json, true);
    }

    /**
     * @throws \Twig\Error\SyntaxError
     * @throws \Plots\Exceptions\NotFoundException
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\LoaderError
     */
    public function route(DependencyInjector $di,Request $request): string
    {
        $path = $request->getPath();

        foreach ($this->routeMap as $route => $info) {
            $regexRoute = $this->getRegexRoute($route, $info);
            if (preg_match("@^/$regexRoute$@", $path)) {
                return $this->executeController(
                    $route, $path, $info, $di,$request
                );
            }
        }
        $errorController = new ErrorController($di,$request);
        return $errorController->notFound();
    }

    private function getRegexRoute(
        string $route,
        array $info
    ): string
    {
        if ( isset ($info['params'])){
            foreach ($info ['params'] as $name => $type){
                $route = str_replace(':' . $name, self::$regexPatters[$type], $route);
            }
        }
        return $route;
    }

    private function extractParams(string $route, string $path):array{
        $params = [];

        $pathParts = explode('/', $path);
        $routeParts = explode('/', $route);

        foreach($routeParts as $key => $routePart){
            if(strpos($routePart, ':') === 0){
                $name = substr($routePart, 1);
                $params[$name] = $pathParts[$key + 1];
            }
        }
        return $params;
    }

    /**
     * @throws \Plots\Exceptions\NotFoundException
     */
    private function executeController(string $route, string $path, array $info, DependencyInjector $di, Request $request):string{
        $controllerName = '\Plots\Controllers\\' . $info['controller'];
        $controller = new $controllerName($di,$request);
        if (isset($info['login']) && $info['login']){  // NOTE: Not required for Plots system
            if($request->getCookies()->has('user')){
                $customerId = $request->getCookies()->get('user');
                $controller->setCustomerId($customerId);
            }else{
                $errorController = new ErrorController($di,$request);
                return $errorController->notAllowed();
            }
        }
        $params = $this->extractParams($route, $path);
        return call_user_func_array([$controller, $info['method']], $params);
    }
}