<?php declare(strict_types = 1);

namespace App\controllers;

use App\core\BaseController;

class HomeController extends BaseController
{
    function index()
    {
        $this->render('home', [
            'author' => 'Moskuza MVC'
        ]);
    }
}