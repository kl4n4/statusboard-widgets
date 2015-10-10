<?php

namespace Statusboard;


use League\Plates\Engine;

class TableHtmlFormatter extends DataFormatter {

    /** @var Engine */
    protected static $templates;

    public function getTemplates() {
        if(!self::$templates) {
            // Create new Plates engine
            self::$templates = new Engine(__DIR__ . '/../../views', 'tpl');
            self::$templates->registerFunction('substr', function ($string, $start, $length) {
                return substr($string, $start, $length);
            });
        }
        return self::$templates;
    }

    public function toHtml() {
        return $this->getTemplates()->render('table-deployments', ['data' => $this->data]);
    }
}
