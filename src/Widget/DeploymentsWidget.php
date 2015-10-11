<?php

namespace Widget;

use Statusboard\TableHtmlFormatter;

class DeploymentsWidget extends AbstractWidget {
    public function getWidget() {
        $table = (new TableHtmlFormatter())->setData([
            array('name' => 'Updatemi Service', 'revision' => '9cfcd8f050752b0c1ab2f7cccf702cae83f7f4e8', 'branch' => 'beta', 'date' => 'May 10, 2015'),
            array('name' => 'Updatemi', 'revision' => 'b2f7cccf79cfcd8f050752b0c1a02cae83f7f4e8', 'branch' => 'master', 'date' => 'August 14, 2015'),
            array('name' => 'Image Service', 'revision' => '02cae83f7f9cfcd8f050752b0c1ab2f7cccf74e8', 'branch' => 'feature/test', 'date' => 'June 25, 2015'),
        ]);
        return $table->setTemplate('table-deployments')->toHtml();
    }
}
