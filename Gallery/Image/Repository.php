<?php

namespace Gallery\Image;

interface Repository
{
    public function getById($id);

    public function getAll();

    public function getByHash($hash);
}
