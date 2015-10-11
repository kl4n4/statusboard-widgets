<?php

namespace Widget;

use Statusboard\DiyHtmlFormatter;
use Updatemi\Api;

class LatestUpdatesWidget extends AbstractWidget {
    public function getWidget() {
        $updates = (new Api())->getLatestUpdates(4);
        $html = (new DiyHtmlFormatter())
            ->setName('Latest Updates')
            ->setRefresh(300)
            ->setData($updates);
        return $html->setTemplate('diy-latest-updates')->toHtml();
    }
}
