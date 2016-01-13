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

    public function getGallery(array $galleryData)
    {
        return new Gallery($galleryData['id'], $galleryData['name'], $galleryData['slug'], $galleryData['password'], $this->getRepository($galleryData['id']));
    }

    private function isGalleryDataValid($galleryData)
    {
        return is_array($galleryData) && empty(
            array_unique(array_keys($galleryData), [
                'id', 'name', 'slug', 'password'
            ]);
        );
    }

    private function getRepository($galleryId)
    {
        return $this->repositoryFactory->getRepository($galleryId);
    }
}
