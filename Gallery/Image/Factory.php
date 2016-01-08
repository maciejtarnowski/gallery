<?php

namespace Gallery\Image;

use Gallery\Image;

class Factory
{
    public function getImage(array $imageData)
    {
        return new Image($imageData['name'], $imageData['filename'], new Dimensions($imageData['height'], $imageData['width']));
    }

    public function getImages(array $imagesData)
    {
        foreach ($imagesData as $imageData) {
            yield $this->getImage($imageData);
        }
    }
}
