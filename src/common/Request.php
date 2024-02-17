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

    /**
     * Get запрос
     * @return array
     */
    public function getParams(): array
    {
        return $this->get;
    }

    /**
     * Post запрос
     * @return array
     */
    public function getPost(): array
    {
        return $this->post;
    }

    /**
     * Передача файлов
     * @return array
     */
    public function getFiles(): array
    {
        return $this->files;
    }

    /**
     * Запрос без get параметров
     * @return string
     */
    public function getPathRequest(): string
    {
        $url = explode('?', $this->path_request);
        return $url[0];
    }
}