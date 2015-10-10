<?php

namespace KeenIo;


class Result {

    const SORT_ASC = 1;
    const SORT_DESC = -1;

    /**
     * @var array
     */
    protected $data;

    /**
     * @var int
     */
    protected $order;

    /**
     * @var int
     */
    protected $limit;

    function setData($data) {
        $this->data = @$data['result'] ?: [];
        return $this;
    }

    public function sort($order) {
        $this->order = $order == self::SORT_DESC ? $order : self::SORT_ASC;
        return $this;
    }

    public function limit($limit) {
        $this->limit = intval($limit);
        return $this;
    }

    public function toArray() {
        $result = $this->data;
        if(is_array($result)) {
            if($this->order) {
                usort($result, function($a, $b) {
                    return $this->order == self::SORT_ASC ? $a['result'] - $b['result'] : $b['result'] - $a['result'];
                });
            }
            if($this->limit && is_int($this->limit)) {
                $result = array_slice($result, 0, $this->limit);
            }
        }
        return $result;
    }
}
