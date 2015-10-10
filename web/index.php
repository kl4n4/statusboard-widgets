<?php

ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

require_once('../vendor/autoload.php');

use KeenIo\Api;
use Statusboard\GraphJsonFormatter;

define('API_READ_KEY', $_SERVER['KEENIO_API_READ_KEY']);
define('API_PROJECT',  $_SERVER['KEENIO_API_PROJECT']);

$AVAILABLE_PARAMS = ['type', 'collection', 'group_by', 'timezone', 'timeframe', 'filter', 'interval', 'sort', 'limit'];

$api = new Api(API_PROJECT, API_READ_KEY);
$qb = $api->getQueryBuilder();

//$data = $qb->type('count')
//    ->collection('update_expand')
//    ->groupBy('label')
//    ->timezone('UTC')
//    ->timeframe('this_2_days')
//    ->sort(Result::SORT_DESC)
//    ->limit(5)
//    ->execute()
//    ->toArray();
//print_r($data);

// parse request and map to query builder
foreach($_GET as $name => $value) {
    if(in_array(strtolower($name), $AVAILABLE_PARAMS)) {
        $param = underscoreToCamelCase(strtolower($name));
        $qb->$param($value);
    }
}

//$str = '2015-10-09T19:00:00.000Z';
//var_dump((new DateTime())->format(DATE_ISO8601));
//$date = (new DateTime($str));
//var_dump($date);
//die($date->format('g a'));

$data = $qb->execute()->toArray();
//print_r($data);

header('Content-Type: application/json');
echo (new GraphJsonFormatter())->setData($data)->toJson();

//echo '{
//  "graph" : {
//    "title" : "Soft Drink Sales",
//    "datasequences" : [
//      {
//        "title" : "X-Cola",
//        "datapoints" : [
//          { "title" : "2008", "value" : 22 },
//          { "title" : "2009", "value" : 24 },
//          { "title" : "2010", "value" : 25.5 },
//          { "title" : "2011", "value" : 27.9 },
//          { "title" : "2012", "value" : 31 },
//        ]
//      },
//      {
//        "title" : "Y-Cola",
//        "datapoints" : [
//          { "title" : "2008", "value" : 18.4 },
//          { "title" : "2009", "value" : 20.1 },
//          { "title" : "2010", "value" : 24.8 },
//          { "title" : "2011", "value" : 26.1 },
//          { "title" : "2012", "value" : 29 },
//        ]
//      }
//    ]
//  }
//}';

function underscoreToCamelCase($string) {
    $func = create_function('$c', 'return strtoupper($c[1]);');
    return preg_replace_callback('/_([a-z])/', $func, $string);
}
