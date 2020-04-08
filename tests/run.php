<?php

include __DIR__ . '/../vendor/autoload.php';

$ctx = new \Reatang\Components\ContextBus\Tests\Stubs\Ctx();

if ($ctx->server_a->a->sayHello() == 'Hello World') {
    echo 'PASS' . PHP_EOL;
} else {
    echo 'NOT PASS' . PHP_EOL;
}