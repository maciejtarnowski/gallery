<?php

namespace UseCase\Image;

use UseCase\UseCase;
use Gallery\Image\Repository as ImageRepository;

class Show implements UseCase
{
    private $imageRepository;
    private $hash;

    public function __construct(ImageRepository $imageRepository, $hash)
    {
        $this->imageRepository = $imageRepository;
        $this->hash = $hash;
    }

    public function execute()
    {
        return [
            'photo' => $this->imageRepository->getByHash($this->hash)
        ];
    }
}
