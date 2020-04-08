<?php
namespace Reatang\Components\ContextBus;

use Closure;

/**
 * Context 调用链设计模式
 */
abstract class BaseCtx {

    /**
     * 根Ctx
     * 
     * @var BaseCtx
     */
    private $rootCtx = null;

    /**
     * 构造器
     * 
     * @var array
     */
    private $providers = [];

    /**
     * 单例的实例
     * 
     * @var array
     */
    private $instance = [];

    public function __construct($rootCtx = null) {
        $this->rootCtx = is_null($rootCtx) ? $this : $rootCtx;

        $this->boot();
    }

    /**
     * @return $this
     */
    public function getRootCtx() {
        return $this->rootCtx;
    }

    /**
     * 服务注册入口
     */
    abstract protected function boot();

    /**
     * @param $name
     * @param $provider
     *
     * @return $this
     */
    protected function register($name, $provider) {
        $this->providers[$name] = $provider;

        return $this;
    }

    /**
     * 默认的服务构造器
     *
     * @param $name
     *
     * @return mixed|BaseCtx|Component
     *
     * @throws CtxException
     */
    private function providerInstance($name) {
        
        // 1. 查询提供函数
        $methodName = "get{$name}";

        if (method_exists($this, $methodName)) {
            return $this->{$methodName}();
        }

        // 2. 查询提供器
        if (!isset($this->providers[$name])) {
            throw new CtxException(static::class . " not found provider [{$name}]", 1);
        }

        $provider = $this->providers[$name];

        if (class_exists($provider)) {
            return new $provider($this->rootCtx);
        }

        if ($provider instanceof Closure) {
            return $provider($this);
        }

        throw new CtxException(static::class . " provider [{$name}] cannot instance", 1);
    }

    public function __get($name) {
        if (!isset($this->instance[$name])) {
            $this->instance[$name] = $this->providerInstance($name);
        }

        return $this->instance[$name];
    }
}
