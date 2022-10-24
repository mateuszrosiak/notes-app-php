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
                $this->addNoteAction();
                break;
            case 'editNote':
                $this->editNoteAction();
                break;
            default:
                $this->showNotesAction();
        }
    }

    private function action()
    {
        return $this->request->getGet('action') ?? [];
    }

    private function addNoteAction()
    {
        if ($this->request->checkIfPost()) {
            $data = [
                'title' => $this->request->getPost('title'),
                'note'  => $this->request->getPost('note'),
            ];

            $this->database->addNote($data);

            header('Location: /?before=noteCreated');
            exit;
        }

        $this->view->render('addNote');
    }

    private function showNotesAction()
    {
        $this->view->render('base', [
            'notes'  => $this->database->getAllNotes(),
            'before' => $this->request->getGet('before') ?? [],
            'note'   => $note ?? [],
        ]);
    }

    private function editNoteAction()
    {
        $note = $this->getNote();

        if ($this->request->checkIfPost()) {
            $data = [
                'id'    => (int)$this->request->getGet('id'),
                'title' => $this->request->getPost('title'),
                'note'  => $this->request->getPost('note'),
            ];

            $this->database->updateExistingNote($data['id'], $data);

            header('Location: /?before=noteUpdated');
            exit;
        }
        $this->view->render('editNote', $note);
    }

    private function getNote(): array
    {
        if ($this->request->getGet('id')) {
            $noteId = (int)$this->request->getGet('id');

            return $note = $this->database->getSpecificNote($noteId);
        };

        return [];
    }


}