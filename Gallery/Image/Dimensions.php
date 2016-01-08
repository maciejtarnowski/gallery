<?php

namespace Gallery\Image;

class Dimensions
{
    private $height;
    private $width;

    public function __construct($height, $width)
    {
        $this->height = $height;
        $this->width = $width;
    }

    public function getHeight()
    {
        return $this->height;
    }

    public function getWidth()
    {
        return $this->width;
    }

    public function __toString()
    {
        return $this->getWidth() . 'x' . $this->getHeight();
    }
}
