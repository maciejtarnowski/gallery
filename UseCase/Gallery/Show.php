<?php

namespace UseCase\Gallery;

use UseCase\UseCase;
use UseCase\Exception as UseCaseException;
use Gallery\Gallery\Repository as GalleryRepository;

class Show implements UseCase
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
        $gallery = $this->getGallery();

        return [
            'gallery' => $gallery,
            'photos' => $gallery->getImages()->getAll()
        ];
    }

    private function getGallery()
    {
        $gallery = $this->galleryRepository->getBySlug($this->slug);

        if (!$gallery) {
            throw new UseCaseException('Gallery not found');
        }

        return $gallery;
    }
}
