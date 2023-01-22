<?php

declare(strict_types=1);

namespace App\Core;

use App\Exceptions\RouteNotFoundException;

/**
 * Router class
 */
class Router
{
    /** @var array $routes array of routes */
    private array $routes;

    /**
     * register the routes
     *
     * @param string $requestMethod Request method type
     * @param string $route Route name
     * @param callable|array $route Route name
     * @return self
     **/
    public function register(string $requestMethod, string $route, callable|array $action): self
    {
        $this->routes[$requestMethod][$route] = $action;
        return $this;
    }

    /**
     * register get routes
     *
     * @param string $route Route name
     * @param callable|array $route Route name
     * @return self
     **/
    public function get(string $route, callable|array $action): self
    {
        return $this->register('GET', $route, $action);
    }

    /**
     * register post routes
     *
     * @param string $route Route name
     * @param callable|array $route Route name
     * @return self
     **/
    public function post(string $route, callable|array $action): self
    {
        return $this->register('POST', $route, $action);
    }

    /**
     * Return all routes
     *
     * @return array
     **/
    public function routes(): array
    {
        return $this->routes;
    }

    /**
     * Resolve router
     *
     * @param string $requestUri request uri
     * @param string $requestMethod request method
     * @throws RouteNotFoundException
     **/
    public function resolve(string $requestUri, string $requestMethod)
    {
        $route =  explode("?", $requestUri)[0];
        $action = $this->routes[$requestMethod][$route] ?? null;

        if (!$action) {
            throw new RouteNotFoundException();
        }

        if (is_callable($action)) {

            return call_user_func($action);
        }

        if (is_array($action)) {
            [$controller, $method] = $action;
            if (class_exists($controller)) {
                $controller = new $controller();

                if (method_exists($controller, $method)) {
                    return call_user_func_array([$controller, $method], []);
                }
            }
        }


        throw new RouteNotFoundException();
    }
}
