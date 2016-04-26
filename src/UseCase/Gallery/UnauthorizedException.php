<?php

namespace UseCase\Gallery;

use Exception;

use Gallery\Gallery;

class UnauthorizedException extends Exception
{
    private $gallery;

    public function __construct(Gallery $gallery)
    {
        $this->gallery = $gallery;
    }

    public function getGallery()
    {
        return $this->gallery;
    }
}
