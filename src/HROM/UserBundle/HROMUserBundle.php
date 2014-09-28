<?php

namespace HROM\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class HROMUserBundle extends Bundle
{
    public function getParent() {
	return 'FOSUserBundle';
    }
}
