<?php

namespace spec\UseCase\Gallery;

use PhpSpec\ObjectBehavior;
use Gallery\Gallery\Repository as GalleryRepository;

class PasswordSpec extends ObjectBehavior
{
    public function let(GalleryRepository $galleryRepository)
    {
        $this->beConstructedWith($galleryRepository, 'slug');
    }

    function it_returns_gallery_by_slug(GalleryRepository $galleryRepository)
    {
        $galleryRepository
            ->getBySlug('slug')
            ->shouldBeCalled()
            ->willReturn('some gallery');

        $this->execute()->shouldReturn([
            'gallery' => 'some gallery'
        ]);
    }
}