<?php
declare(strict_types=1);

namespace App\Controller;

use App\Model\Database;
use App\Request\Request;
use App\View\View;

abstract class AbstractController
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
            case 'showNote':
                $this->showNoteAction();
                break;

            default:
                $this->showNotesAction();
        }
    }

    protected function action()
    {
        return $this->request->getGet('action') ?? [];
    }

}