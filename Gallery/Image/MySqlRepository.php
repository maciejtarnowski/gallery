<?php

namespace Gallery\Image;

use Database\MySql as MySqlDriver;

/*
CREATE TABLE `image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hash` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `height` int(11) NOT NULL,
  `width` int(11) NOT NULL,
  `gallery_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `hash` (`hash`),
  UNIQUE KEY `filename` (`filename`),
  KEY `gallery_id` (`gallery_id`),
  CONSTRAINT `image_ibfk_1` FOREIGN KEY (`gallery_id`) REFERENCES `gallery` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
*/
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

    public function getAll()
    {
        return $this->getImages(
            $this->queryAll('SELECT * FROM `image`')
        );
    }

    public function getByHash($hash)
    {
        return $this->getImage(
            $this->query('SELECT * FROM `image` WHERE `hash` = :hash', [':hash' => $hash])
        );
    }

    protected function queryAll($query, $parameters = [])
    {
        return $this->driver->queryAll($query, $parameters);
    }

    protected function query($query, $parameters = [])
    {
        return $this->driver->query($query, $parameters);
    }

    protected function getImage($imageData)
    {
        return $this->imageFactory->getImage($imageData);
    }

    protected function getImages(array $imagesData)
    {
        return $this->imageFactory->getImages($imagesData);
    }
}
