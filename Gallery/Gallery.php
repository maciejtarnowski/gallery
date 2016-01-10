<?php

namespace Gallery;

use Gallery\Gallery\Security\Security;
use Gallery\Image\Repository as ImageRepository;

class Gallery
{
    private $id;
    private $name;
    private $slug;
    private $security;
    private $images;

    public function __construct($id, $name, $slug, Security $security, ImageRepository $images)
    {
        $this->id = $id;
        $this->name = $name;
        $this->slug = $slug;
        $this->security = $security;
        $this->images = $images;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function getSecurity()
    {
        return $this->security;
    }

    public function getImages()
    {
        return $this->images;
    }
}
