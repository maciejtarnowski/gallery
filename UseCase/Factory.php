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
        return Gallery\List($this->galleryRepository);
    }

    public function getGalleryShow($slug)
    {
        return Gallery\Show($this->galleryRepository, $slug);
    }

    public function getImageShow($hash)
    {
        return Image\Show($this->imageRepository, $hash);
    }
}
