<?php
namespace spec\UseCase;

use PhpSpec\ObjectBehavior;

class UseCaseExceptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('UseCase\UseCaseException');
    }

    function it_extends_exception()
    {
        $this->shouldHaveType('Exception');
    }
}