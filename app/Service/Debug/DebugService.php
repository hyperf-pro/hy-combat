<?php

namespace App\Service\Debug;

class DebugService
{

    use TraitService;

    public function getType(): string
    {
        return 'test type';
    }


}
