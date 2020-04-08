<?php
namespace Reatang\Components\ContextBus;

use ReflectionClass;

/**
 * use DocComment parsing provider
 */
abstract class DocCommentCtx extends BaseCtx {

    protected function boot() {
        foreach ($this->getDocCommentProviders($this) as $name => $provider) {
            $this->register($name, $provider);
        }
    }

    /**
     * 从注释中获取服务提供器
     *
     * @param $ctx
     *
     * @return array
     *
     * @throws \ReflectionException
     */
    protected function getDocCommentProviders($ctx) {
        $ctxReflection = new ReflectionClass($ctx);
        $doc = $ctxReflection->getDocComment();

        $docLines = array_filter(array_map(function ($line) {
            if (($point = strpos($line, '@property')) === false) {
                return '';
            }

            return trim(substr($line, $point + 9));
        }, explode("\n", $doc)));

        $docProviders = [];

        foreach ($docLines as $param) {
            list($class, $providerName) = explode(' ', $param);
            $providerName = strpos($providerName, '$') !== false ? substr($providerName, 1) : $providerName;

            $docProviders[$providerName] = $this->parseClassFullName($ctxReflection, $class);
        }

        return $docProviders;
    }

    /**
     * @param ReflectionClass $ctxReflection
     * @param $className
     * @return mixed
     */
    protected function parseClassFullName($ctxReflection, $className) {
        // 1. 本身就是完整类
        if (strpos($className, '\\') === 0) {
            return $className;
        }

        // 2. 相对与Ctx的路径
        return $ctxReflection->getNamespaceName() . '\\' . $className;
    }
}
