<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf8" />
    <meta http-equiv="Cache-control" content="no-cache" />
    <meta <?php foreach($attributes as $attribute=>$value) { echo $attribute . '="' . $value . '" '; } ?>/>
    <script type="text/javascript" src="https://www.google.com/jsapi?autoload={'modules':[{'name':'visualization','version':'1.1','packages':['geochart']}]}"></script>
    <style type="text/css">
        body,div,dl,dt,dd,ul,ol,li,h1,h2,h3,h4,h5,h6,pre,form,fieldset,input,textarea,p,blockquote,th,td {
            margin: 0;
            padding: 0;
        }
    </style>
</head>
<body>
<div id="regions_div" style="width: 512px; height: 256px;"></div>
<script type="application/javascript">
    google.setOnLoadCallback(drawRegionsMap);

    function drawRegionsMap() {

        var data = [
            ['City', 'Visits'],
            <?php foreach($data as $value):?>['<?=$this->e($value['ip_geo_info.country'])?>', <?=$this->e($value['result'])?>],<?php endforeach; ?>
        ];

        var options = {
            backgroundColor: 'transparent',
            region:'150',
            resolution: 'countries',
            //displayMode: 'markers',
            colorAxis: {colors: ['#fcd', '#c06']}
        };

        var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));

        chart.draw(google.visualization.arrayToDataTable(data), options);
    }
</script>
</body>
</html>
