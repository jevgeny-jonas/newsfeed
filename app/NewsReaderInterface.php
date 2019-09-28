<?php

namespace App;

interface NewsReaderInterface
{
    /**
     * @return string XML
     * @throws App\Exceptions\NewsException If failed to fetch RSS from remote server
     *         (leaves XML correctness check to JavaScript).
     */
    public function getNews(): string;
}
