<?php

class Router
{
    /**
     * Registered application routes.
     */
    private array $routes = [];

    /**
     * Register a GET route.
     */
    public function get(
        string $uri,
        string $action,
        array $middleware = []
    ): void {

        $this->addRoute(
            'GET',
            $uri,
            $action,
            $middleware
        );
    }

    /**
     * Register a POST route.
     */
    public function post(
        string $uri,
        string $action,
        array $middleware = []
    ): void {

        $this->addRoute(
            'POST',
            $uri,
            $action,
            $middleware
        );
    }

    /**
     * Add a route to the route collection.
     */
    private function addRoute(
        string $method,
        string $uri,
        string $action,
        array $middleware = []
    ): void {

        $this->routes[] = [

            'method' => strtoupper($method),

            'uri' => $this->normalize($uri),

            'action' => $action,

            'middleware' => $middleware

        ];
    }

    /**
     * Dispatch the current request.
     */
    public function dispatch(
        string $method,
        string $uri
    ): void {

        $method = strtoupper($method);

        $uri = $this->normalize($uri);

        foreach ($this->routes as $route) {

            if (
                $route['method'] === $method &&
                $route['uri'] === $uri
            ) {

                /*
                |--------------------------------------------------------------------------
                | Run Middleware
                |--------------------------------------------------------------------------
                */

                $this->runMiddleware(
                    $route['middleware']
                );

                /*
                |--------------------------------------------------------------------------
                | Run Controller Action
                |--------------------------------------------------------------------------
                */

                $this->runAction(
                    $route['action']
                );

                return;
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Route Not Found
        |--------------------------------------------------------------------------
        */

        http_response_code(404);

        require BASE_PATH .
            '/app/views/errors/404.php';
    }

    /**
     * Execute all middleware attached to a route.
     */
    private function runMiddleware(
        array $middleware
    ): void {

        foreach ($middleware as $middlewareClass) {

            if (!class_exists($middlewareClass)) {

                throw new Exception(
                    "Middleware {$middlewareClass} not found."
                );
            }

            if (
                !method_exists(
                    $middlewareClass,
                    'handle'
                )
            ) {

                throw new Exception(
                    "Middleware {$middlewareClass}::handle() not found."
                );
            }

            $middlewareClass::handle();
        }
    }

    /**
     * Execute a controller action.
     */
    private function runAction(
        string $action
    ): void {

        $parts = explode('@', $action);

        if (count($parts) !== 2) {

            throw new Exception(
                "Invalid controller action: {$action}"
            );
        }

        [$controllerName, $method] = $parts;

        $controllerClass = $controllerName;

        if (!class_exists($controllerClass)) {

            throw new Exception(
                "Controller {$controllerClass} not found."
            );
        }

        $controller = new $controllerClass();

        if (!method_exists($controller, $method)) {

            throw new Exception(
                "Method {$method} not found."
            );
        }

        $controller->$method();
    }

    /**
     * Normalize a URI.
     */
    private function normalize(
        string $uri
    ): string {

        $uri = parse_url(
            $uri,
            PHP_URL_PATH
        );

        $uri = trim(
            $uri,
            '/'
        );

        return $uri === ''
            ? '/'
            : '/' . $uri;
    }
}