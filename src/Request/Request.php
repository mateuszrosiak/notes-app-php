<?php
declare(strict_types=1);
namespace App\Request;

class Request
{
    private $get;
    private $post;

    public function __construct(array $get, array $post) {
        $this->get = $get;
        $this->post = $post;
    }

    /**
     * @return array
     */
    public function getGet(string $name): ?string
    {
        return $this->get[$name] ?? null;
    }

    /**
     * @return array
     */
    public function getPost(string $name): ?string
    {
        return $this->post[$name] ?? null;
    }

    public function checkIfPost(): bool {
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }

}