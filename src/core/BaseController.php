<?php

namespace App\core;

class BaseController
{
  function render($view, $data = [], $layout = 'main')
  {

    ob_start();
    include_once Router::$ROOT_ROUTE . "/views/layouts/$layout.php";
    $layout = ob_get_clean();

    ob_start();
    include_once Router::$ROOT_ROUTE . "/views/$view.php";
    $viewContent = ob_get_clean();

    echo str_replace('{{content}}', $viewContent, $layout);
  }
}
