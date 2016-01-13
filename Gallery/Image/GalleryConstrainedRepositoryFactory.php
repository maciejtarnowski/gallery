<?php

namespace Gallery\Image;

use Database\MySql;

class GalleryConstrainedRepositoryFactory
{
    private $database;
    private $imageFactory;

    public function __construct(MySql $database, Factory $imageFactory)
    {
        $this->database = $database;
        $this->imageFactory = $imageFactory;
    }

    public function getRepository($galleryId)
    {
        return new GalleryConstrainedMySqlRepository($this->database, $this->imageFactory, $galleryId);
    }
}
