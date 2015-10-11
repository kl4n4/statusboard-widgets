<?php

namespace Widget;

use Statusboard\DiyHtmlFormatter;
use Updatemi\Api;

class LatestUpdatesWidget extends AbstractWidget {
    public function getWidget() {
        $updates = (new Api())->getLatestUpdates();
        $table = (new DiyHtmlFormatter())
            ->setName('Latest Updates')
            ->setRefresh(300)
            ->setData($updates);
//        print_r($updates);die();
        return $table->setTemplate('diy-latest-updates')->toHtml();
    }
}
