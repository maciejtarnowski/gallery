<?php

namespace spec\UseCase\Gallery;

use PhpSpec\ObjectBehavior;
use Gallery\Gallery;

class UnauthorizedExceptionSpec extends ObjectBehavior
{
    public function let(Gallery $gallery)
    {
        $this->beConstructedWith($gallery);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('UseCase\Gallery\UnauthorizedException');
    }

    function it_extends_exception()
    {
        $this->shouldHaveType('Exception');
    }
}