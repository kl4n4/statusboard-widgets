<?php

ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

require_once(__DIR__ . '/../vendor/autoload.php');

use KeenIo\Api;
use Widget\WidgetLoader;

define('API_READ_KEY', $_SERVER['KEENIO_API_READ_KEY']);
define('API_PROJECT',  $_SERVER['KEENIO_API_PROJECT']);

$AVAILABLE_PARAMS = ['type', 'collection', 'group_by', 'timezone', 'timeframe', 'filter', 'interval', 'sort', 'limit'];

// widgets
if(preg_match('/\/widgets\/(.*)/i', @$_SERVER['REDIRECT_URL'], $matches)) {
    if(($widgetName = @$matches[1]) && WidgetLoader::exists($widgetName)) {
        $widget = WidgetLoader::load($widgetName);
        die($widget->getWidget());
    } else {
        die('Widget "' . $widgetName . '" not installed/available');
    }
}
// explorer
elseif(preg_match('/\/explorer(\/([a-zA-Z_]*))?/i', @$_SERVER['REDIRECT_URL'], $matches)) {
    if(@$matches[2]) {
        $_GET['type'] = $matches[2];
    }
    $api = new Api(API_PROJECT, API_READ_KEY);
    $qb = $api->getQueryBuilder();

    // parse request and map to query builder
    foreach($_GET as $name => $value) {
        if(in_array(strtolower($name), $AVAILABLE_PARAMS)) {
            $param = underscoreToCamelCase(strtolower($name));
            $qb->$param($value);
        }
    }
    $data = $qb->execute()->toArray();
    die(json_encode($data, JSON_PRETTY_PRINT));
}

die('you either need to load a widget (/widget/{WIDGET_NAME}) or use the explorer (/explorer/{PARAMS})');

function underscoreToCamelCase($string) {
    $func = create_function('$c', 'return strtoupper($c[1]);');
    return preg_replace_callback('/_([a-z])/', $func, $string);
}
