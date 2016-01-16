<?php

namespace Gallery;

use Gallery\Image\Dimensions;

class Image
{
    private $id;
    private $hash;
    private $name;
    private $filename;
    private $galleryId;
    /** @var Dimensions $dimensions */
    private $dimensions;

    public function __construct($id, $hash, $name, $filename, $galleryId, Dimensions $dimensions)
    {
        $this->id = $id;
        $this->hash = $hash;
        $this->name = $name;
        $this->filename = $filename;
        $this->galleryId = $galleryId;
        $this->dimensions = $dimensions;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getHash()
    {
        return $this->hash;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getFilename()
    {
        return $this->filename;
    }

    public function getGalleryId()
    {
        return $this->galleryId;
    }

    public function getDimensions()
    {
        return $this->dimensions;
    }
}
