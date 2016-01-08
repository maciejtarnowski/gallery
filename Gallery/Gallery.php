<?php

namespace Gallery;

use Gallery\Gallery\Security\Security;

class Gallery
{
    private $id;
    private $name;
    private $slug;
    private $security;
    private $photos;

    public function __construct($id, $name, $slug, Security $security, array $photos)
    {
        $this->id = $id;
        $this->name = $name;
        $this->slug = $slug;
        $this->security = $security;
        $this->photos = $photos;
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

    public function getPhotos()
    {
        return $this->photos;
    }
}
