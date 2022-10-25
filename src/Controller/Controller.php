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
            case 'deleteNote':
                $this->deleteNoteAction();
                break;
            default:
                $this->showNotesAction();
        }
    }

    private function action()
    {
        return $this->request->getGet('action') ?? [];
    }

    private function showNotesAction()
    {
        $sortBy = $this->request->getGet('sortby') ?? 'creationDate';
        $sortOrder = $this->request->getGet('sortorder') ?? 'asc';
        $searchPhrase = $this->request->getGet('searchPhrase') ?? '';

        $notes = $this->database->getAllNotes($sortBy, $sortOrder, $searchPhrase);

        $this->view->render('base', [
            'notes'  => $notes,
            'before' => $this->request->getGet('before') ?? [],
            'note'   => $note ?? [],
            'sort' => [
                'by' => $sortBy,
                'order' => $sortOrder
            ],
            'searchPhrase' => $searchPhrase
        ]);
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

    private function deleteNoteAction()
    {

        if ($this->request->checkIfPost()) {
            $noteId = $this->request->getPost('deleteNote');
            $this->database->deleteNote((int) $noteId);

            header('Location: /?before=noteDeleted');
            exit;
        }

        $this->view->render('base', [
            'notes'  => $this->database->getAllNotes(),
            'before' => $this->request->getGet('before') ?? [],
        ]);

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