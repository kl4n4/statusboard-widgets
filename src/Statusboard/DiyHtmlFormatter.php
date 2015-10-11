<?php

namespace Statusboard;

class DiyHtmlFormatter extends HtmlDataFormatter {

    /** @var array */
    protected $validAttributes = ['refresh-every-n-seconds','allows-resizing','default-size','min-size','max-size','allows-scrolling'];
    /** @var array */
    protected $attributes = array(
        'application-name' => 'DiyHtmlFormatter',
//        'data-refresh-every-n-seconds' => 300,
//        'data-allows-resizing' => 'YES',
//        'data-default-size' => '4,4',
//        'data-min-size' => '4,4',
//        'data-max-size' => '8,4',
//        'data-allows-scrolling' => 'NO'
    );

    /**
     * @param string $name
     * @return DiyHtmlFormatter
     */
    public function setName($name) {
        return $this->setAttribute('name', $name);
    }

    /**
     * @param int $seconds
     * @return DiyHtmlFormatter
     */
    public function setRefresh($seconds) {
        return $this->setAttribute($this->validAttributes[0], $seconds);
    }

    /**
     * @param int $x
     * @param int $y
     * @return DiyHtmlFormatter
     */
    public function setDefaultSize($x, $y) {
        return $this->setAttribute($this->validAttributes[2], $x . ',' . $y);
    }

    /**
     * @param int $x
     * @param int $y
     * @return DiyHtmlFormatter
     */
    public function setMinSize($x, $y) {
        return $this->setAttribute($this->validAttributes[3], $x . ',' . $y);
    }

    /**
     * @param int $x
     * @param int $y
     * @return DiyHtmlFormatter
     */
    public function setMaxSize($x, $y) {
        return $this->setAttribute($this->validAttributes[4], $x . ',' . $y);
    }

    /**
     * @param boolean $bool
     * @return DiyHtmlFormatter
     */
    public function allowResizing($bool) {
        return $this->setAttribute($this->validAttributes[1], $bool ? 'YES' : 'NO');
    }

    /**
     * @param boolean $bool
     * @return DiyHtmlFormatter
     */
    public function allowScrolling($bool) {
        return $this->setAttribute($this->validAttributes[5], $bool ? 'YES' : 'NO');
    }

    /**
     * @param string $key
     * @param string $value
     * @return $this
     */
    public function setAttribute($key, $value) {
        if($key == 'name') {
            $this->attributes['application-' . $key] = $value;
        } elseif(in_array($key, $this->validAttributes)) {
            $this->attributes['data-' . $key] = $value;
        }
        return $this;
    }

    public function toHtml() {
        if(!$this->template) {
            throw new \Exception('You must specify a template that should be used');
        }
        return $this->getTemplates()->render($this->template, ['attributes' => $this->attributes, 'data' => $this->data]);
    }

}
