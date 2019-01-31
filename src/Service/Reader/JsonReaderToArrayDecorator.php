<?php

namespace App\Service\Reader;

class JsonReaderToArrayDecorator implements Reader
{
    /**
     * ArrayReaderDecorator constructor.
     * @param Reader $reader
     */
    public function __construct(Reader $reader)
    {
        $this->reader = $reader;
    }

    public function readFile()
    {
        $file = $this->reader->readFile();
        return json_decode($file, true);
    }
}