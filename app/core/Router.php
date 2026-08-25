<?php

class Router
{
    private array $routes = [];

    public function get(string $uri, string $action): void
    {
        $this->addRoute('GET', $uri, $action);
    }

    public function post(string $uri, string $action): void
    {
        $this->addRoute('POST', $uri, $action);
    }

    private function addRoute(
        string $method,
        string $uri,
        string $action
    ): void {

        $this->routes[] = [
            'method' => $method,
            'uri' => $this->normalize($uri),
            'action' => $action
        ];
    }

    public function dispatch(
        string $method,
        string $uri
    ): void {

        $uri = $this->normalize($uri);

        foreach ($this->routes as $route) {

            if (
                $route['method'] === $method &&
                $route['uri'] === $uri
            ) {
                $this->runAction($route['action']);
                return;
            }
        }

        http_response_code(404);

        require __DIR__ . '/../views/errors/404.php';
    }

    private function runAction(string $action): void
    {
        [$controllerName, $method] = explode('@', $action);

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

    private function normalize(string $uri): string
    {
        $uri = parse_url($uri, PHP_URL_PATH);

        $uri = trim($uri, '/');

        return $uri === '' ? '/' : '/' . $uri;
    }
}