<?php

namespace Reatang\Components\ContextBus\Tests\Stubs\Services;


use Reatang\Components\ContextBus\Component;

/**
 * Class B
 * @package Reatang\Components\ContextBus\Tests\Stubs\Services
 *
 * @property \Reatang\Components\ContextBus\Tests\Stubs\Ctx ctx
 */
class B extends Component {
    public function sayWorld () {
        return 'World';
    }
}