<?php

namespace Widget;

use KeenIo\Api;
use KeenIo\Result;
use Statusboard\GraphJsonFormatter;

class MostExpandedUpdatesWidget extends AbstractWidget {
    public function getWidget() {
        $api = new Api(API_PROJECT, API_READ_KEY);
        $qb = $api->getQueryBuilder();
        $data = $qb->type('count')
            ->collection('update_expand')
            ->groupBy('label')
            ->timezone('UTC')
            ->timeframe('this_2_days')
            ->sort(Result::SORT_DESC)
            ->limit(5)
            ->execute()
            ->toArray();
        return (new GraphJsonFormatter())
            ->setTitle('Most Expanded Updates in the last 2 days')
            ->setData($this->trimTitles($data))
            ->toJson();
    }

    private function trimTitles($data) {
        foreach($data as &$entry) {
            $entry['label'] = mb_strimwidth(@$entry['label'], 0, 25, "...");
        }
        return $data;
    }
}
