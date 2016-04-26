<?php

namespace UseCase\Gallery;

use UseCase\UseCase;
use UseCase\UseCaseException;
use Gallery\Gallery\Repository as GalleryRepository;

class Show implements UseCase
{
    private $galleryRepository;
    private $slug;
    private $password;

    public function __construct(GalleryRepository $galleryRepository, $slug, $password = null)
    {
        $this->galleryRepository = $galleryRepository;
        $this->slug = $slug;
        $this->password = $password;
    }

    public function execute()
    {
        $gallery = $this->getGallery();

        if ($gallery->getPassword() && !$gallery->isPasswordCorrect($this->password)) {
            throw new UnauthorizedException($gallery);
        }

        return [
            'gallery' => $gallery,
            'images' => $gallery->getImages()->getAll()
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
