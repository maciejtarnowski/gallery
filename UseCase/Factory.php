<?php

namespace UseCase;

use Gallery\Image\Repository as ImageRepository;
use Gallery\Gallery\Repository as GalleryRepository;

class Factory
{
    private $galleryRepository;
    private $imageRepository;

    public function __construct(GalleryRepository $galleryRepository, ImageRepository $imageRepository)
    {
        $this->galleryRepository = $galleryRepository;
        $this->imageRepository = $imageRepository;
    }

    public function getGalleryList()
    {
        return new Gallery\Listing($this->galleryRepository);
    }

    public function getGalleryShow($slug, $password)
    {
        return new Gallery\Show($this->galleryRepository, $slug, $password);
    }

    public function getGalleryPassword($slug)
    {
        return new Gallery\Password($this->galleryRepository, $slug);
    }

    public function getImageShow($hash)
    {
        return new Image\Show($this->imageRepository, $this->galleryRepository, $hash);
    }
}
