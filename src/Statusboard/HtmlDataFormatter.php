<?php

namespace Statusboard;

use League\Plates\Engine;

abstract class HtmlDataFormatter extends DataFormatter {

    /** @var Engine */
    protected static $templates;

    /** @var string */
    protected $template;

    public function toHtml() {
        if(!$this->template) {
            throw new \Exception('You must specify a template that should be used');
        }
        return $this->getTemplates()->render($this->template, ['data' => $this->data]);
    }

    protected function getTemplates() {
        if(!self::$templates) {
            // Create new Plates engine
            self::$templates = new Engine(__DIR__ . '/../../views', 'tpl');
            self::$templates->registerFunction('substr', function ($string, $start, $length) {
                return substr($string, $start, $length);
            });
            self::$templates->registerFunction('cleanWikiSyntax', function ($string) {
                return preg_replace("/\[(wiki|url)\=(?P<url>https?:\/\/[^\]]*)\](?P<text>[^\[]*)\[\/(wiki|url)\]/i", "$3", $string);
            });
        }
        return self::$templates;
    }

    /**
     * @return string
     */
    public function getTemplate() {
        return $this->template;
    }

    /**
     * @param string $template
     * @return $this
     */
    public function setTemplate($template) {
        $this->template = $template;
        return $this;
    }

}
