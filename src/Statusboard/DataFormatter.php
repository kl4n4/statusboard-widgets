<?php

namespace Statusboard;

abstract class DataFormatter {

    /** @var array */
    protected $data;

    /**
     * @return array
     */
    public function getData() {
        return $this->data;
    }

    /**
     * @param array $data
     * @return $this
     */
    public function setData($data) {
        $this->data = $data;
        return $this;
    }

}
