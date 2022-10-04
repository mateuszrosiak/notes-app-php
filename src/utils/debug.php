<?php

declare(strict_types=1);

error_reporting(E_ALL);
ini_set('display_errors', '1');

function dump($data)
{
    echo "<div style='background-color:forestgreen; padding: 15px; border: dotted 2px black; display:inline-block; margin: 20px 15px;'>";
    print_r($data);
    echo "</div>";
}