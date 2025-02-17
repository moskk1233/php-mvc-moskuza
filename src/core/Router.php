<?php

declare(strict_types=1);

namespace App\core;

const ALLOW_METHOD = ['GET', 'POST'];

class Router
{
    private array $routes = [];
    private array $activeMiddlewares = [];
    public static string $ROOT_ROUTE;

    public function __construct(string $ROOT_ROUTE)
    {
        self::$ROOT_ROUTE = $ROOT_ROUTE;
    }

    public function get($uri, $action, $middleware = []): void
    {
        $this->routes['GET'][$uri] = [
            'action' => $action,
            'middleware' => array_merge($this->activeMiddlewares, $middleware)
        ];
    }

    public function post($uri, $action, $middleware = []): void
    {
        $this->routes['POST'][$uri] = [
            'action' => $action,
            'middleware' => array_merge($this->activeMiddlewares, $middleware)
        ];
    }

    public function use($middleware): void
    {
        $this->activeMiddlewares[] = $middleware;
    }

    public function run(): void
    {
        $uri = parse_url($_SERVER['REQUEST_URI'])['path'];
        $method = strtoupper($_SERVER['REQUEST_METHOD']);

        if (!isset($this->routes[$method][$uri])) {
            if (!in_array($method, ALLOW_METHOD)) {
                http_response_code(405);
                echo "405 Method Not Allow";
                exit;
            }

            http_response_code(404);
            echo "404 Not Found";
            exit;
        }

        $route = $this->routes[$method][$uri];
        $action = $route['action'];
        $middlewares = $route['middleware'];

        foreach ($middlewares as $middleware) {
            $middleware();
        }

        $class = new $action[0];
        $classMethod = $action[1];
        $class->$classMethod();
        exit;
    }
}
