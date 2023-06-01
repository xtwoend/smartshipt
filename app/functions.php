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