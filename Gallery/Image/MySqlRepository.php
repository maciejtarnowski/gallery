<?php

namespace Gallery\Image;

use Database\MySql as MySqlDriver;

class MySqlRepository implements Repository
{
    private $driver;
    private $imageFactory;

    public function __construct(MySqlDriver $driver, Factory $imageFactory)
    {
        $this->driver = $driver;
        $this->imageFactory = $imageFactory;
    }

    public function getById($id)
    {
        return $this->getImage(
            $this->query('SELECT * FROM `image` WHERE `id` = :id', [':id' => $id])
        );
    }

    public function getAllByGalleryId($galleryId)
    {
        return $this->getImages(
            $this->queryAll('SELECT * FROM `image` WHERE `gallery_id` = :gallery_id', [':gallery_id' => $galleryId])
        );
    }

    public function getByHash($hash)
    {
        return $this->getImage(
            $this->query('SELECT * FROM `image` WHERE `hash` = :hash', [':hash' => $hash])
        );
    }

    private function queryAll($query, $parameters)
    {
        return $this->driver->queryAll($query, $parameters);
    }

    private function query($query, $parameters)
    {
        return $this->driver->query($query, $parameters);
    }

    private function getImage(array $imageData)
    {
        return $this->imageFactory->getImage($imageData);
    }

    private function getImages(array $imagesData)
    {
        return $this->imageFactory->getImages($imagesData);
    }
}
