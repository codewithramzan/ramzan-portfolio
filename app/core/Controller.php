<?php

class Controller
{
    protected function view(
        string $view,
        array $data = [],
        string $layout = 'main'
    ): void {

        $viewFile = __DIR__ . '/../views/' . $view . '.php';
        $layoutFile = __DIR__ . '/../views/layouts/' . $layout . '.php';

        if (!file_exists($viewFile)) {
            http_response_code(500);
            die('View not found.');
        }

        extract($data);

        ob_start();

        require $viewFile;

        $content = ob_get_clean();

        if (file_exists($layoutFile)) {
            require $layoutFile;
        } else {
            echo $content;
        }
    }

    protected function redirect(string $url): never
    {
        header('Location: ' . $url);
        exit;
    }

    protected function json(array $data, int $status = 200): never
    {
        http_response_code($status);

        header('Content-Type: application/json');

        echo json_encode($data);

        exit;
    }
}