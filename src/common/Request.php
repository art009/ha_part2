<?php

namespace app\common;

readonly class Request
{
    public function __construct(
        private string $path_request = '/',
        private array  $get = [],
        private array  $post = [],
        private array  $files = [],
    ) {}

    public function getParams(): array
    {
        return $this->get;
    }

    public function getPost(): array
    {
        return $this->post;
    }

    public function getFiles(): array
    {
        return $this->files;
    }

    public function getPathRequest(): string
    {
        $url = explode('?', $this->path_request);
        return $url[0];
    }
}