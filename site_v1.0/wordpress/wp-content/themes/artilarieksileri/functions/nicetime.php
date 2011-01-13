<?php
function nicetime($date)
{
    if(empty($date)) {
        return "Tarih girilmedi";
    }

    $periods         = array("saniye", "dakika", "saat", "gün", "hafta", "ay", "yıl", "on yıl");
    $lengths         = array("60","60","24","7","4.35","12","10");

    $now             = time();
    $unix_date         = strtotime($date);

       // check validity of date
    if(empty($unix_date)) {
        return "Tarih biçimi yanlış";
    }

    // is it future date or past date
    if($now > $unix_date) {
        $difference     = $now - $unix_date;
        $tense         = "önce";

    } else {
        $difference     = $now - $unix_date;
        $tense         = "sonra";
    }

    for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
        $difference /= $lengths[$j];
    }

    $difference = round($difference);

    if($difference != 1) {
        $periods[$j].= "";
    }

    return "$difference $periods[$j] {$tense}";
}
