<?php

namespace spec\UseCase\Image;

use Gallery\Gallery;
use Gallery\Gallery\Repository as GalleryRepository;
use Gallery\Image;
use Gallery\Image\Repository as ImageRepository;
use PhpSpec\ObjectBehavior;
use UseCase\UseCaseException;

class ShowSpec extends ObjectBehavior
{
    public function let(ImageRepository $imageRepository, GalleryRepository $galleryRepository)
    {
        $this->beConstructedWith($imageRepository, $galleryRepository, md5('hash'));
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('UseCase\Image\Show');
    }

    function it_throws_usecase_exception_if_image_is_not_found(ImageRepository $imageRepository)
    {
        $imageRepository
            ->getByHash(md5('hash'))
            ->shouldBeCalled()
            ->willReturn(null);

        $this->shouldThrow(new UseCaseException('Image not found'))->during('execute');
    }

    function it_throws_usecase_exception_if_gallery_is_not_found(
        ImageRepository $imageRepository,
        GalleryRepository $galleryRepository
    ) {
        $imageRepository
            ->getByHash(md5('hash'))
            ->willReturn($this->getImage());
        $galleryRepository
            ->getById('galleryId')
            ->shouldBeCalled()
            ->willReturn(null);

        $this->shouldThrow(new UseCaseException('Image not found'))->during('execute');
    }

    function it_returns_image_and_gallery(ImageRepository $imageRepository, GalleryRepository $galleryRepository)
    {
        $image = $this->getImage();
        $imageRepository
            ->getByHash(md5('hash'))
            ->willReturn($image);

        $gallery = $this->getGallery($imageRepository->getWrappedObject());
        $galleryRepository
            ->getById('galleryId')
            ->willReturn($gallery);

        $this->execute()->shouldReturn([
            'image' => $image,
            'gallery' => $gallery
        ]);
    }

    private function getImage()
    {
        return new Image(1, md5('hash'), 'name', 'filename', 'galleryId', new Image\Dimensions(100, 100));
    }

    private function getGallery(ImageRepository $imageRepository)
    {
        return new Gallery(
            'galleryId',
            'gallery name',
            'gallery-name',
            'password',
            '01-01-1970',
            $imageRepository
        );
    }
}