<?php

namespace Ornicar\GravatarBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle as BaseBundle;

class OrnicarGravatarBundle extends BaseBundle
{
    public function getNamespace(): string
    {
        return __NAMESPACE__;
    }

    public function getPath(): string
    {
        return __DIR__;
    }
}
