<?php

namespace Gallery\Gallery;

use Gallery\Gallery;
use Gallery\Image\GalleryConstrainedRepositoryFactory;

class Factory
{
    private $imageRepository;

    public function __construct(GalleryConstrainedRepositoryFactory $repositoryFactory)
    {
        $this->repositoryFactory = $repositoryFactory;
    }

    public function getGallery($galleryData)
    {
        if (!$this->isGalleryDataValid($galleryData)) {
            return null;
        }
        return new Gallery($galleryData['id'], $galleryData['name'], $galleryData['slug'], $galleryData['password'], $galleryData['created_at'], $this->getRepository($galleryData['id']));
    }

    public function getGalleries(array $galleriesData)
    {
        foreach ($galleriesData as $galleryData) {
            if (!$this->isGalleryDataValid($galleryData)) {
                continue;
            }

            yield $this->getGallery($galleryData);
        }
    }

    private function isGalleryDataValid($galleryData)
    {
        return is_array($galleryData) && empty(
            array_diff([
                'id', 'name', 'slug', 'password', 'created_at'
            ], array_keys($galleryData))
        );
    }

    private function getRepository($galleryId)
    {
        return $this->repositoryFactory->getRepository($galleryId);
    }
}
