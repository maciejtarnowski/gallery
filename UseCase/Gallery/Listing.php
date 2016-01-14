<?php

namespace UseCase\Gallery;

use UseCase\UseCase;
use Gallery\Gallery\Repository as GalleryRepository;

class Listing implements UseCase
{
    private $galleryRepository;

    public function __construct(GalleryRepository $galleryRepository)
    {
        $this->galleryRepository = $galleryRepository;
    }

    public function execute()
    {
        return [
            'galleries' => $this->galleryRepository->getAll()
        ];
    }
}
