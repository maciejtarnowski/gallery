<?php

namespace Gallery;

use Gallery\Image\Repository as ImageRepository;

class Gallery
{
    private $id;
    private $name;
    private $slug;
    private $password;
    private $images;

    public function __construct($id, $name, $slug, $password, ImageRepository $images)
    {
        $this->id = $id;
        $this->name = $name;
        $this->slug = $slug;
        $this->password = $password;
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

    public function getPassword()
    {
        return $this->password;
    }

    public function getImages()
    {
        return $this->images;
    }
}
