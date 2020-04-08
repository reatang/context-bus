<?php
namespace Reatang\Components\ContextBus;

/**
 * Bus Component
 */
class Component {

    protected $ctx;

    public function __construct(BaseCtx $ctx) {
        $this->ctx = $ctx;
    }
}
