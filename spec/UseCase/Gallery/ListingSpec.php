<?php
namespace spec\UseCase\Gallery;

use PhpSpec\ObjectBehavior;
use Gallery\Gallery\Repository as GalleryRepository;

class ListingSpec extends ObjectBehavior
{
    public function let(GalleryRepository $galleryRepository)
    {
        $this->beConstructedWith($galleryRepository);
    }

    function it_returns_all_galleries(GalleryRepository $galleryRepository)
    {
        $galleryRepository
            ->getAll()
            ->shouldBeCalled()
            ->willReturn(['list', 'of', 'galleries']);

        $this->execute()->shouldReturn(['galleries' => ['list', 'of', 'galleries']]);
    }
}