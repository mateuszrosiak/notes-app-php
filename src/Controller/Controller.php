<?php

declare(strict_types=1);

namespace App\Controller;

class Controller extends AbstractController
{
    public function showNotesAction()
    {
        $sortBy       = $this->request->getGet('sortby') ?? 'creationDate';
        $sortOrder    = $this->request->getGet('sortorder') ?? 'asc';
        $searchPhrase = $this->request->getGet('searchPhrase') ?? '';

        $notes = $this->database->getAllNotes(
            $sortBy,
            $sortOrder,
            $searchPhrase
        );

        $this->view->render('base', [
            'notes'        => $notes,
            'before'       => $this->request->getGet('before') ?? [],
            'note'         => $note ?? [],
            'sort'         => [
                'by'    => $sortBy,
                'order' => $sortOrder,
            ],
            'searchPhrase' => $searchPhrase,
        ]);
    }

    public function addNoteAction()
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

    public function editNoteAction()
    {
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
        $this->view->render('editNote', $this->getNote());
    }

    public function deleteNoteAction(): void
    {
        if ($this->request->checkIfPost()) {
            $noteId = $this->request->getPost('deleteNote');
            $this->database->deleteNote((int)$noteId);

            header('Location: /?before=noteDeleted');
            exit;
        }

        $this->view->render('base', [
            'notes'  => $this->database->getAllNotes(),
            'before' => $this->request->getGet('before') ?? [],
        ]);
    }

    public function showNoteAction(): void
    {
        $this->view->render('showNote', $this->getNote());
    }

    public function getNote(): array
    {
        if ($this->request->getGet('id')) {
            $noteId = (int)$this->request->getGet('id');

            return $note = $this->database->getSpecificNote($noteId);
        };

        return [];
    }

}