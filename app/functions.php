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

if(! function_exists('number')) {
    function number($number) {
        if($number < 0) return 'N/A';
        return number_format($number, 2, ",",".");
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
            $text = 'Gentle Breeze';
        else if ($wind > 11 && $wind < 16.9)
            $text = 'Moderate Breeze';
        else if ($wind > 17 && $wind < 21.9)
            $text = 'Fresh Breeze';
        else if ($wind > 22 && $wind < 27.9)
            $text = 'Strong Breeze';
        else if ($wind > 28 && $wind < 33.9)
            $text = 'High Wind';
        else if ($wind > 34 && $wind < 40.9)
            $text = 'Gale';
        else if ($wind > 41 && $wind < 47.9)
            $text = 'Strong/severe Gale';
        else if ($wind > 48 && $wind < 55.9)
            $text = 'Storm';
        else if ($wind > 56 && $wind < 63.9)
            $text = 'Violent Storm';
        else
            $text = 'Hurricane Force';

        return $text;
    }
}

if( ! function_exists('secondsToTime')) {
    function secondsToTime($seconds) {
        if($seconds < 0) {
            return 0;
        }

        $dtF = new \DateTime('@0');
        $dtT = new \DateTime("@$seconds");
        return $dtF->diff($dtT)->format('%a days, %h hours, %i minutes and %s seconds');
    }
}