<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf8"/>
    <meta http-equiv="Cache-control" content="no-cache"/>
    <meta
    <?php foreach($attributes as $attribute=>$value) { echo $attribute . '="' . $value . '" '; } ?>/>
    <link rel="stylesheet" href="/css/default.css"/>
    <!--
    <style type="text/css">
        @font-face {
            font-family: "Roadgeek2005SeriesD";
            src: url("http://panic.com/fonts/Roadgeek 2005 Series D/Roadgeek 2005 Series D.otf");
        }

        body, * {

        }

        body, div, dl, dt, dd, ul, ol, li, h1, h2, h3, h4, h5, h6, pre, form, fieldset, input, textarea, p, blockquote, th, td {
            margin: 0;
            padding: 0;
        }

        fieldset, img {
            border: 0;
        }

        /* Settin' up the page */

        html, body, #main {
            overflow: hidden; /* */
        }

        body {
            color: white;
            font-family: 'Roadgeek2005SeriesD', sans-serif;
            font-size: 20px;
            line-height: 24px;
        }

        body, html, #main {
            background: transparent !important;
        }

        /*
        #spacepeopleContainer
        {
            width: 250px;
            height: 250px;
            text-align: center;
            background: url('data:image/png;base64,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') left bottom no-repeat;
            background-size: 250px 187px;
        }
        #spacepeopleContainer *
        {
            font-weight: normal;
        }
        */

        h1 {
            font-size: 120px;
            line-height: 120px;
            margin-top: 15px;
            margin-bottom: 28px;
            color: white;
            text-shadow: 0 -2px 0 black;
            text-transform: uppercase;
        }

        h2 {
            width: 180px;
            margin: 0 auto;
            padding-top: 20px;
            font-size: 16px;
            line-height: 18px;
            color: #7e7e7e;
            text-transform: uppercase;
        }
    </style>
    -->
    <style type="text/css">
        @media screen and (min-device-width: 1600px) and (max-device-width: 2400px) {
            html {
                background: black;
            }
        }
    </style>
</head>

<body>
<div id="main">

    <?=$this->section('content')?>

</div>
</body>
</html>
