<?php

declare(strict_types=1);

namespace App\View;

class View
{
    public string $page;
    public array $params;

    public function render(string $page, array $params = [])
    {
        $this->params = $params;
        require_once("./templates/base.php");
        require_once("./templates/$page.php");
    }

    public static function displayNotification(string $notification): void
    {
        echo '<div id="alert" class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">';
        echo '<span class="font-medium">';
        print_r($notification);
        echo '</span></div>';
    }
}