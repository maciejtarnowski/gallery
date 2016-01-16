<?php

namespace UseCase\Image;

use UseCase\UseCase;
use UseCase\UseCaseException;
use Gallery\Image\Repository as ImageRepository;
use Gallery\Gallery\Repository as GalleryRepository;

class Show implements UseCase
{
    private $imageRepository;
    private $galleryRepository;
    private $hash;
    private $password;

    public function __construct(ImageRepository $imageRepository, GalleryRepository $galleryRepository, $hash)
    {
        $this->imageRepository = $imageRepository;
        $this->galleryRepository = $galleryRepository;
        $this->hash = $hash;
    }

    public function execute()
    {
        $image = $this->imageRepository->getByHash($this->hash);

        if (!$image) {
            throw new UseCaseException('Image not found');
        }

        $gallery = $this->galleryRepository->getById($image->getGalleryId());

        if (!$gallery) {
            throw new UseCaseException('Image not found');
        }

        return [
            'image' => $image,
            'gallery' => $gallery
        ];
    }
}
