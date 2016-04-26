<?php

namespace Gallery\Image;

use Gallery\Image;

class Factory
{
    public function getImage($imageData)
    {
        if (!$this->isImageDataValid($imageData)) {
            return null;
        }

        return new Image($imageData['id'], $imageData['hash'], $imageData['name'], $imageData['filename'], $imageData['gallery_id'], new Dimensions($imageData['height'], $imageData['width']));
    }

    public function getImages(array $imagesData)
    {
        foreach ($imagesData as $imageData) {
            if (!$this->isImageDataValid($imageData)) {
                continue;
            }

            yield $this->getImage($imageData);
        }
    }

    private function isImageDataValid($imageData)
    {
        return is_array($imageData) && empty(
            array_diff([
                'id', 'hash', 'name', 'filename', 'height', 'width', 'gallery_id'
            ], array_keys($imageData))
        );
    }
}
