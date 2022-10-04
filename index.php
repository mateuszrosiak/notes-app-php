<?php
declare(strict_types=1);

namespace App;

use App\Controller\Controller;
use App\Request\Request;

require_once("./vendor/autoload.php");

$request = new Request($_GET, $_POST);

$controller = new Controller($request);
$controller->run();
