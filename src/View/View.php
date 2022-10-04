<?php
declare(strict_types=1);

namespace App\View;

class View
{
    public string $page;
    public array $params;

    public function render(string $page, array $params = []) {

        require_once("./templates/base.php");
        require_once("./templates/$page.php");
    }
}