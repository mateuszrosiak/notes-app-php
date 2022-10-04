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
    public function getGet(): array
    {
        return $this->get;
    }

    /**
     * @return array
     */
    public function getPost(): array
    {
        return $this->post;
    }


}