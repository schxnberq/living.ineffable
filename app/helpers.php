<?php

use Carbon\Carbon;

function nice_date(Carbon $date)
{
    return $date->diffForHumans(); // ->format('d.m.Y');
}

function doTheDamnThang($url, $img)
{
    $html = file_get_contents($url);

    $doc = new \DOMDocument();
    @$doc->loadHTML($html);

    $tags  = $doc->getElementsByTagName('img');
    $metas = $doc->getElementsByTagName('meta');
    $divs  = $doc->getElementsByTagName('div');

    foreach ($tags as $tag) {
        if (strpos($url, 'ikea')) {
            if ($tag->getAttribute('id') == "productImg") {
                $img = "https://www.ikea.com" . $tag->getAttribute('src');
            }
        }

        if (strpos($url, 'xxxlutz')) {
            if ($tag->getAttribute("id") == "flyzoom") {
                $img = $tag->getAttribute("src");
            }
        }

        if (strpos($url, 'leiner')) {

            if ($tag->getAttribute("data-zoom-image")) {
                $img = $tag->getAttribute("data-zoom-image");
                $img = str_replace("product_slide_large", "product_slide", $img);
                break;
            }
        }

        if (strpos($url, 'urbanoutfitters')) {
            if ($tag->getAttribute("data-qa-product-image")) {
                
            }
        }
        

    }

    foreach ($metas as $key => $meta) {

        if (strpos($url, 'home24')) {
            if ($meta->getAttribute("itemprop") == "image") {
                $img = $meta->getAttribute("content");
            }
            $img = str_replace("80x80", "900x900", $img);
        }
    }

    return $img;
}
