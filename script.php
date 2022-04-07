<?php

use DiDom\Document;

require 'vendor/autoload.php';

    $shoes = [
        0 => [
            'stockx_name' => 'air-jordan-6-retro-travis-scott-british-khaki'
        ],
        1 => [
            'stockx_name' => 'jordan-3-retro-joker'
        ]
    ];


    $my_shoes = $shoes;
    $my_size = 14; //US

    foreach ($my_shoes as $key => $shoe)
    {
        $url = 'https://stockx.com/it-it/'. $shoe['stockx_name'];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Cookie: stockx_default_sneakers_size=" . $my_size));
        curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:75.0) Gecko/20100101 Firefox/75.0');
        $output = curl_exec($ch);
        curl_close($ch);

        $document = new Document($output);

        $elements = $document->find('.css-xfmxd4');
        $last_price_sell = $elements[0]->text();
        $my_shoes[$key]['last_sale_price'] = $last_price_sell;
    }

    print_r($my_shoes);




