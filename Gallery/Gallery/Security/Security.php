<?php

namespace Gallery\Gallery\Security;

use Gallery\Gallery\Security\AuthorisationData;

interface Security
{
    public function authorise(AuthorisationData $authorisation);
}
