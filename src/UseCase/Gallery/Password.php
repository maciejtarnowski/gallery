<?php

namespace UseCase\Gallery;

use UseCase\UseCase;
use Gallery\Gallery\Repository as GalleryRepository;

class Password implements UseCase
{
    private $galleryRepository;
    private $slug;

    public function __construct(GalleryRepository $galleryRepository, $slug)
    {
        $this->galleryRepository = $galleryRepository;
        $this->slug = $slug;
    }

    public function execute()
    {
        return [
            'gallery' => $this->galleryRepository->getBySlug($this->slug)
        ];
    }
}
