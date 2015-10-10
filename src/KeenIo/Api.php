<?php

namespace KeenIo;

class Api {

    const API_ENDPOINT = 'https://api.keen.io/3.0/projects/%s/queries/%s?api_key=%s&%s';

    private $projectId;
    private $apiReadKey;

    function __construct($projectId, $apiReadKey) {
        $this->projectId = $projectId;
        $this->apiReadKey = $apiReadKey;
    }

    /**
     * @return QueryBuilder
     */
    public function getQueryBuilder() {
        return (new QueryBuilder())->setApi($this);
    }

    public function getApiQueryUrl($type, $queryString) {
        return sprintf($this->getApiEndpoint(), $this->projectId, $type, $this->apiReadKey, $queryString);
    }

    public function getApiEndpoint() {
        return self::API_ENDPOINT;
    }
}
