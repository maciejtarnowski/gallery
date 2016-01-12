<?php

namespace Gallery\Gallery;

interface Repository
{
    public function getById($id);

    public function getBySlug($slug);

    public function getAll();
}
