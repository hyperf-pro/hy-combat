<?php

namespace App\Service\Debug;

/**
 * @method string getType()
 */
trait TraitService
{


    public function test(): void
    {
        var_dump($this->getType());
    }

}
