<?php

namespace App\Service\Reader;

class JsonReader implements Reader
{
    private $path;

    public function __construct(string $path)
    {
        if (!is_file($path)) {
            throw new FileDoesNotExistException(
                'File does not exist on required path'
            );
        }

        $this->path = $path;
    }

    /**
     * @return string
     */
    public function readFile()
    {
        return file_get_contents($this->path);
    }
}