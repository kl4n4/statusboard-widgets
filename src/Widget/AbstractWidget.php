<?php

namespace Widget;

abstract class AbstractWidget {

    /** @var array */
    protected $params = [];

    abstract public function getWidget();

    /**
     * @param string $params
     * @return $this
     */
    public function setParams($params) {
        if($this->hasParams()) {
            preg_match($this->getParamsRegex(), $params, $this->params);
        }
        return $this;
    }

    protected function getParam($key, $default = null) {
        return @$this->params[$key] ?: $default;
    }

    protected function hasParams() {
        return $this->getParamsRegex() != null;
    }

    protected function getParamsRegex() {
        return null;
    }
}
