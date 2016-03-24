<?php

    // basic log

    $user = "COOKIE: user_session ".( isset($_COOKIE['user_session']) ? $_COOKIE['user_session'] : "" );
    $ip1 = "REMOTE_ADDR: ".$_SERVER['REMOTE_ADDR'];
    $ip2 = "REMOTE_PORT: ".$_SERVER['REMOTE_PORT'];
    @$ip3 = "HTTP_X_FORWARDED_FOR: ".$_SERVER['HTTP_X_FORWARDED_FOR']; // verificar porque da erro
    $data1 = "QUERY_STRING: ".$_SERVER['REQUEST_URI'];
    $data2 = "HTTP_USER_AGENT: ".$_SERVER['HTTP_USER_AGENT'];
    $date = "TIMESTAMP: ".date("Y-m-d H:i:s");

    $app['monolog']->addDebug(" ");
    $app['monolog']->addDebug(" ");
    $app['monolog']->addDebug("######################################################");
    $app['monolog']->addDebug("TRACK:");
    $app['monolog']->addDebug("[$user]");
    $app['monolog']->addDebug("[$ip1]");
    $app['monolog']->addDebug("[$ip2]");
    $app['monolog']->addDebug("[$ip3]");
    $app['monolog']->addDebug("[$data1]");
    $app['monolog']->addDebug("[$data2]");
    $app['monolog']->addDebug("[$date]");
    $app['monolog']->addDebug("######################################################");

    //