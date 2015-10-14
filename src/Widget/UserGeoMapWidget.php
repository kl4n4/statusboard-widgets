<?php

namespace Widget;

use KeenIo\Api;
use Statusboard\DiyHtmlFormatter;

class UserGeoMapWidget extends AbstractWidget {
    public function getWidget() {
        $api = new Api(API_PROJECT, API_READ_KEY);
        $qb = $api->getQueryBuilder();
        $data = $qb->type('count_unique')
            ->collection('Loaded%20a%20Page')
            ->targetProperty('user.userId')
            ->filters([
                array(
                    'property_name' => 'ip_geo_info.continent',
                    'operator' => 'eq',
                    'property_value' => 'Europe',
                )
            ])
            ->groupBy('ip_geo_info.country')
            ->timezone('UTC')
            ->timeframe('this_7_days')
            ->execute()
            ->toArray();
        $html = (new DiyHtmlFormatter())
            ->setName('User Geo Map')
            ->setDefaultSize(7,4)
            ->setData($data);
        return $html->setTemplate('diy-user-geo-map')->toHtml();
    }
}
