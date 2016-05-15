<?php

namespace spec\UseCase;

use PhpSpec\ObjectBehavior;
use Gallery\Gallery\Repository as GalleryRepository;
use Gallery\Image\Repository as ImageRepository;
use UseCase\Gallery\Listing;
use UseCase\Gallery\Password;
use UseCase\Gallery\Show as GalleryShow;
use UseCase\Image\Show as ImageShow;

class FactorySpec extends ObjectBehavior
{
    public function let(GalleryRepository $galleryRepository, ImageRepository $imageRepository)
    {
        $this->beConstructedWith($galleryRepository, $imageRepository);
    }

    function it_returns_gallery_list_usecase()
    {
        $this->getGalleryList()->shouldHaveType(Listing::class);
    }

    function it_returns_gallery_show_usecase()
    {
        $this->getGalleryShow('slug', 'password')->shouldHaveType(GalleryShow::class);
    }

    function it_returns_gallery_password_usecase()
    {
        $this->getGalleryPassword('slug')->shouldHaveType(Password::class);
    }

    function it_returns_image_show_usecase()
    {
        $this->getImageShow(md5('hash'))->shouldHaveType(ImageShow::class);
    }
}