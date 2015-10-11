<?php

namespace KeenIo;

class QueryBuilder {

    /**
     * @var Api $api
     */
    protected $api;

    /**
     * @var string $type
     */
    protected $type;

    /**
     * @var array $parameters
     */
    protected $parameters = array();

    /**
     * @var Result
     */
    protected $result;

    /**
     * @param string $type
     * @return $this
     */
    public function type($type) {
        $this->type = $type;
        return $this;
    }

    public function collection($collection) {
        $this->parameters['event_collection'] = $collection;
        return $this;
    }

    public function targetProperty($targetProperty) {
        $this->parameters['target_property'] = $targetProperty;
        return $this;
    }

    public function groupBy($groupBy) {
        $this->parameters['group_by'] = $groupBy;
        return $this;
    }

    public function timezone($timezone) {
        $this->parameters['timezone'] = $timezone;
        return $this;
    }

    public function timeframe($timeframe) {
        $this->parameters['timeframe'] = $timeframe;
        return $this;
    }

    public function interval($interval) {
        $this->parameters['interval'] = $interval;
        return $this;
    }

    public function filter($filter) {
        $this->parameters['filter'] = $filter;
        return $this;
    }

    public function sort($order) {
        $this->getResult()->sort($order);
        return $this;
    }

    public function limit($limit) {
        $this->getResult()->limit($limit);
        return $this;
    }

    /**
     * @return Result
     */
    public function execute() {
        $url = $this->api->getApiQueryUrl($this->type, $this->getApiQuery());
        return $this->getResult()->setData(@json_decode(file_get_contents($url), true));
    }

    public function getApiQuery() {
        $parameters = [];
        foreach($this->parameters as $key => $value) {
            $parameters[] = $key . '=' . $value;
        }
        return join('&', $parameters);
    }

    /**
     * @return Api
     */
    public function getApi() {
        return $this->api;
    }

    /**
     * @param Api $api
     * @return $this
     */
    public function setApi($api) {
        $this->api = $api;
        return $this;
    }

    /**
     * @return Result
     */
    public function getResult() {
        if(!$this->result) {
            $this->result = new Result();
        }
        return $this->result;
    }

}
