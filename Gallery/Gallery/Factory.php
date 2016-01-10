<?php

namespace Gallery\Gallery;

use Gallery\Gallery;
use Gallery\Image\Repository as ImageRepository;

class Factory
{
    private $imageRepository;

    public function __construct(ImageRepository $imageRepository)
    {
        $this->imageRepository = $imageRepository;
    }

    public function getGallery(array $galleryData)
    {
        return new Gallery($galleryData['id'], $galleryData['name'], $galleryData['slug'], $galleryData['password'], $this->imageRepository);
    }

    private function isGalleryDataValid($galleryData)
    {
        return is_array($galleryData) && empty(
            array_unique(array_keys($galleryData), [
                'id', 'name', 'slug', 'password'
            ]);
        );
    }
}
