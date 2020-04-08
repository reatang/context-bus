<?php

namespace Reatang\Components\ContextBus\Tests\Stubs\Services;


use Reatang\Components\ContextBus\Component;

/**
 * Class A
 * @package Reatang\Components\ContextBus\Tests\Stubs\Services
 *
 * @property \Reatang\Components\ContextBus\Tests\Stubs\Ctx ctx
 */
class A extends Component {

    public function sayHello() {
        return 'Hello ' . $this->ctx->server_a->b->sayWorld();
    }
}