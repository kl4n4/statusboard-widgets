<?php

namespace Widget;

use KeenIo\Api;
use Statusboard\DiyHtmlFormatter;

class ActiveUsersWidget extends AbstractWidget {
    public function getWidget() {
        $api = new Api(API_PROJECT, API_READ_KEY);
        $qb = $api->getQueryBuilder();
        $data = $qb->type('count_unique')
            ->collection('Loaded%20a%20Page')
            ->targetProperty('user.userId')
            ->timezone('UTC')
            ->timeframe('this_15_minutes')
            ->execute()
            ->toArray();
        $html = (new DiyHtmlFormatter())
            ->setName('Active Users')
            ->setRefresh(60)
            ->setData($data);
        return $html->setTemplate('diy-active-users')->toHtml();
    }
}
