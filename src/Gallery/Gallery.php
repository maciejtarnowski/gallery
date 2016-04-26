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
    private $createdAt;

    public function __construct($id, $name, $slug, $password, $createdAt, ImageRepository $images)
    {
        $this->id = $id;
        $this->name = $name;
        $this->slug = $slug;
        $this->password = $password;
        $this->createdAt = $createdAt;
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

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function getImages()
    {
        return $this->images;
    }

    public function isPasswordCorrect($password)
    {
        return sha1($password) === $this->getPassword();
    }
}
