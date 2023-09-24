<?php


if(! function_exists('calc_crow')) {
    function calc_crow($lat1, $lon1, $lat2, $lon2) {
        $radius = 6371; // in KM
        $dLat = to_rad($lat2 - $lat1);
        $dLon = to_rad($lon2 - $lat2);

        $a = sin($dLat / 2) * sin($dLat / 2) + sin($dLon / 2) * sin($dLon/2) * cos($lat1) * cos($lat2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $d = $radius * $c;

        return $d;
    }
}

if(! function_exists('to_rad')) {
    function to_rad($val) {
        return ($val * pi()) / 180;
    }
}

if(! function_exists('scaleBeafort')) {
    function scaleBeafort($wind) {
        $text = '';
        if ($wind <= 1)
            $text = 'Calm';
        else if ($wind > 1 && $wind < 3.9)
            $text = 'Light Air';
        else if ($wind > 4 && $wind < 6.9)
            $text = 'Light Breeze';
        else if ($wind > 7 && $wind < 10.9)
            $text = 'Gentle breeze';
        else if ($wind > 11 && $wind < 16.9)
            $text = 'Moderate breeze';
        else if ($wind > 17 && $wind < 21.9)
            $text = 'Fresh breeze';
        else if ($wind > 22 && $wind < 27.9)
            $text = 'Strong breeze';
        else if ($wind > 28 && $wind < 33.9)
            $text = 'High $wind';
        else if ($wind > 34 && $wind < 40.9)
            $text = 'Gale';
        else if ($wind > 41 && $wind < 47.9)
            $text = 'Strong/severe gale';
        else if ($wind > 48 && $wind < 55.9)
            $text = 'Storm';
        else if ($wind > 56 && $wind < 63.9)
            $text = 'Violent storm';
        else
            $text = 'Hurricane force';

        return $text;
    }
}