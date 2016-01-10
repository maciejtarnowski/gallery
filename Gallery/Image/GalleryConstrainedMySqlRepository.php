<?php

namespace Gallery;

class GalleryConstrainedMySqlRepository extends MySqlRepository
{
    private $galleryId;

    public function __construct(MySqlDriver $driver, Factory $imageFactory)
    {
        parent::__construct($driver, $imageFactory);
        $this->galleryId = $galleryId;
    }

    public function getById($id)
    {
        return $this->getImage(
            $this->query('SELECT * FROM `image` WHERE `id` = :id AND `gallery_id` = :gallery_id', [':id' => $id, ':gallery_id' => $this->galleryId])
        );
    }

    public function getByHash($hash)
    {
        return $this->getImage(
            $this->query('SELECT * FROM `image` WHERE `hash` = :hash AND `gallery_id` = :gallery_id', [':hash' => $hash, ':gallery_id' => $this->galleryId])
        );
    }

    public function getAll()
    {
        return $this->getImages(
            $this->queryAll('SELECT * FROM `image` WHERE `gallery_id` = :gallery_id', [':gallery_id' => $this->galleryId])
        );
    }
}
