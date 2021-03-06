<?php

namespace Gallery\Gallery;

use Database\MySql as MySqlDriver;

/*
CREATE TABLE `gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
*/

class MySqlRepository implements Repository
{
    private $driver;
    private $galleryFactory;

    public function __construct(MySqlDriver $driver, Factory $galleryFactory)
    {
        $this->driver = $driver;
        $this->galleryFactory = $galleryFactory;
    }

    public function getById($id)
    {
        return $this->getGallery(
            $this->query('SELECT * FROM `gallery` WHERE `id` = :id', [':id' => $id])
        );
    }

    public function getBySlug($slug)
    {
        return $this->getGallery(
            $this->query('SELECT * FROM `gallery` WHERE `slug` = :slug', [':slug' => $slug])
        );
    }

    public function getAll()
    {
        return $this->getGalleries(
            $this->queryAll('SELECT * FROM `gallery`')
        );
    }

    private function queryAll($query, $parameters = [])
    {
        return $this->driver->queryAll($query, $parameters);
    }

    private function query($query, $parameters = [])
    {
        return $this->driver->query($query, $parameters);
    }

    private function getGallery($galleryData)
    {
        return $this->galleryFactory->getGallery($galleryData);
    }

    private function getGalleries(array $galleriesData)
    {
        return $this->galleryFactory->getGalleries($galleriesData);
    }
}
