<?php
declare(strict_types=1);

namespace App\Controller;

use App\Model\Database;
use App\Request\Request;
use App\View\View;


class Controller
{
    public View $view;
    public Request $request;
    protected Database $database;
    private $config = "test";

    public function __construct(Request $request) {
        $this->request = $request;
        $this->view = new View();
        $this->database = new Database(require_once("./src/config/config.php"));
    }

    public function run(){

        switch($this->action()) {
            case 'addNote':
                $page = 'addNote';
                break;
            default:
                $page = 'base';
        }

        $this->view->render($page);
    }

    private function action(){
        return $this->request->getGet()['action'] ?? [];
    }

}