<?php

namespace UseCase\Gallery\List;

use UseCase\UseCase;
use Gallery\Gallery\Repository as GalleryRepository;

class List implements UseCase
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
