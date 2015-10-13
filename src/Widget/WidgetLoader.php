<?php

namespace Widget;

class WidgetLoader {

    /**
     * @param string $name
     * @return bool
     */
    public static function exists($name) {
        return file_exists(__DIR__ . '/' . self::getProperWidgetName($name) . '.php');
    }

    /**
     * @param string $name
     * @param string $params as url e.g /production/details
     * @return AbstractWidget
     */
    public static function load($name, $params) {
        $widgetClass = '\\Widget\\' . self::getProperWidgetName($name);
        return (new $widgetClass())->setParams($params);
    }

    protected static function getProperWidgetName($name) {
        $capitalizedName = strtoupper($name[0]) . substr($name, 1);
        return $capitalizedName . 'Widget';
    }
}
