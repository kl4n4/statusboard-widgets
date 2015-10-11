<?php

namespace Statusboard;

class GraphJsonFormatter extends DataFormatter {

    /** @var string */
    protected $title = 'Graph';

    protected function getDataSequences() {
        if(count($this->data) <= 0) {
            return [];
        }

        // simple bar chart
        if(array_key_exists('result', $this->data[0])) {
            return [array(
                'title' => 'Expands',
                'datapoints' => array_map(function($entry) {
                    return array(
                        'title' => $entry['label'],
                        'value' => $entry['result']
                    );
                }, $this->data)
            )];
        }
        // line chart with intervals
        elseif(array_key_exists('timeframe', $this->data[0])) {
            return [array(
                'title' => 'Expands',
                'datapoints' => array_map(function($entry) {
                    return array(
                        'title' => (new \DateTime($entry['timeframe']['start']))->format('g a'),
                        'value' => $entry['value']
                    );
                }, $this->data)
            )];
        }
    }

    public function toJson() {
        $config = array(
            'title' => $this->getTitle(),
            'datasequences' => $this->getDataSequences()
        );
        return json_encode(array('graph' => $config), JSON_PRETTY_PRINT);
    }

    /**
     * @return string
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * @param string $title
     * @return $this
     */
    public function setTitle($title) {
        $this->title = $title;
        return $this;
    }
}
