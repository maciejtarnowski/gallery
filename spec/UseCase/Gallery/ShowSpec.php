<?php

namespace spec\UseCase\Gallery;

use Gallery\Gallery;
use Gallery\Gallery\Repository as GalleryRepository;
use Gallery\Image\Repository as ImageRepository;
use PhpSpec\ObjectBehavior;
use UseCase\Gallery\UnauthorizedException;
use UseCase\UseCaseException;

class ShowSpec extends ObjectBehavior
{
    public function let(GalleryRepository $galleryRepository)
    {
        $this->beConstructedWith($galleryRepository, 'slug', 'password');
    }

    function it_throws_use_case_exception_if_gallery_is_not_found(GalleryRepository $galleryRepository)
    {
        $galleryRepository
            ->getBySlug('slug')
            ->shouldBeCalled()
            ->willReturn(null);

        $this->shouldThrow(new UseCaseException('Gallery not found'))->during('execute');
    }

    function it_throws_unauthorized_exception_if_gallery_is_protected_and_wrong_password_is_provided(
        GalleryRepository $galleryRepository,
        ImageRepository $imageRepository
    ) {
        $gallery = $this->getGallery($imageRepository->getWrappedObject(), 'wrong password');
        $galleryRepository
            ->getBySlug('slug')
            ->shouldBeCalled()
            ->willReturn($gallery);

        $this->shouldThrow(new UnauthorizedException($gallery))->during('execute');
    }

    function it_returns_gallery_and_images_if_gallery_is_not_password_protected(
        GalleryRepository $galleryRepository,
        ImageRepository $imageRepository
    ) {
        $gallery = $this->getGallery($imageRepository->getWrappedObject(), null);
        $galleryRepository
            ->getBySlug('slug')
            ->shouldBeCalled()
            ->willReturn($gallery);
        $imageRepository
            ->getAll()
            ->shouldBeCalled()
            ->willReturn(['all', 'images']);

        $this->execute()->shouldReturn([
            'gallery' => $gallery,
            'images' => ['all', 'images']
        ]);
    }

    function it_returns_gallery_and_images_if_gallery_is_protected_and_password_is_valid(
        GalleryRepository $galleryRepository,
        ImageRepository $imageRepository
    ) {
        $gallery = $this->getGallery($imageRepository->getWrappedObject(), sha1('password'));
        $galleryRepository
            ->getBySlug('slug')
            ->shouldBeCalled()
            ->willReturn($gallery);
        $imageRepository
            ->getAll()
            ->shouldBeCalled()
            ->willReturn(['all', 'images']);

        $this->execute()->shouldReturn([
            'gallery' => $gallery,
            'images' => ['all', 'images']
        ]);
    }

    private function getGallery(ImageRepository $imageRepository, $password = null)
    {
        return new Gallery(1, 'Gallery name', 'gallery-name', $password, '01-01-1979', $imageRepository);
    }
}