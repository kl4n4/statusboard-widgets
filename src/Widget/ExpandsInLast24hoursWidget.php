<?php

namespace Widget;

use KeenIo\Api;
use Statusboard\GraphJsonFormatter;

class ExpandsInLast24hoursWidget extends AbstractWidget {
    public function getWidget() {
        $api = new Api(API_PROJECT, API_READ_KEY);
        $qb = $api->getQueryBuilder();
        $data = $qb->type('count')
            ->collection('update_expand')
            ->timezone('UTC')
            ->timeframe('this_24_hours')
            ->interval('hourly')
            ->execute()
            ->toArray();
        return (new GraphJsonFormatter())
            ->setTitle('Update Expands over the last 24 hours')
            ->setData($data)->toJson();
    }
}
