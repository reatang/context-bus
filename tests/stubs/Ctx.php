<?php

namespace Reatang\Components\ContextBus\Tests\Stubs;

use Reatang\Components\ContextBus\BaseCtx;

use Reatang\Components\ContextBus\Tests\Stubs\Services\Ctx as ServerACtx;

/**
 * Class Ctx
 * @package Reatang\Components\ContextBus\Tests\Stubs
 *
 * @property ServerACtx server_a
 */
class Ctx extends BaseCtx {

    protected function boot() {
        $this->register('server_a', ServerACtx::class);
    }
}