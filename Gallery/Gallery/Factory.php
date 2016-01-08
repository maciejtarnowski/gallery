<?php

namespace Gallery\Gallery;

use Gallery\Gallery;
use Gallery\Gallery\Security\Factory as SecurityFactory;

class Factory
{
    private $securityFactory;

    public function __construct(SecurityFactory $securityFactory)
    {
        $this->securityFactory = $securityFactory;
    }

    public function getGallery(array $galleryData)
    {
        return new Gallery($galleryData['id'], $galleryData['name'], $galleryData['slug'], $this->getSecurity($galleryData['security']), []);
    }

    private function getSecurity($securityId)
    {
        return $this->securityFactory->getSecurity($securityId);
    }
}
