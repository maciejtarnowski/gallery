<?php

namespace Gallery\Image;

interface Repository
{
    public function getById($id);

    public function getByGalleryId($galleryId);

    public function getByHash($hash);
}
