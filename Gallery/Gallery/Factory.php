<?php

namespace Gallery\Gallery;

use Gallery\Gallery;
use Gallery\Gallery\Security\Factory as SecurityFactory;
use Gallery\Image\Repository as ImageRepository;

class Factory
{
    private $securityFactory;
    private $imageRepository;

    public function __construct(SecurityFactory $securityFactory, ImageRepository $imageRepository)
    {
        $this->securityFactory = $securityFactory;
        $this->imageRepository = $imageRepository;
    }

    public function getGallery(array $galleryData)
    {
        return new Gallery($galleryData['id'], $galleryData['name'], $galleryData['slug'], $this->getSecurity($galleryData['security']), $this->imageRepository);
    }

    private function getSecurity($securityId)
    {
        return $this->securityFactory->getSecurity($securityId);
    }
}
