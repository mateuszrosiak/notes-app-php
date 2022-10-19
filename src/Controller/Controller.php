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

    public function __construct(Request $request)
    {
        $this->view     = new View();
        $this->database = new Database(require_once("./src/config/config.php"));
        $this->request  = $request;
    }

    public function run()
    {
        switch ($this->action()) {
            case 'addNote':
                $page = 'addNote';
                break;
            default:
                $page = 'base';
        }

        $viewParams = [
            'notes' => $this->database->getAllNotes()
        ];

        if ($this->request->checkIfPost()) {

            $data = [
                'title' => $this->request->getPost('title'),
                'note' => $this->request->getPost('note'),
            ];

            $this->database->addNote($data);
            header('Location: /?before=noteCreated');
            exit;
        };

        $this->view->render($page, [
            'notes' => $this->database->getAllNotes(),
            'before' => $this->request->getGet('before')
        ]);
    }

    private function action()
    {
        return $this->request->getGet('action') ?? [];
    }

}