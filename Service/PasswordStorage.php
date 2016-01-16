<?php

namespace Service;

class PasswordStorage
{
    public function setForGallerySlug($gallerySlug, $password)
    {
        $_SESSION[md5($gallerySlug)] = $password;
    }

    public function getForGallerySlug($gallerySlug)
    {
        return isset($_SESSION[md5($gallerySlug)]) ? $_SESSION[md5($gallerySlug)] : null;
    }
}
