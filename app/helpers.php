<?php
if (!function_exists('get_user_country')) {
    function get_user_country(){
        $location_info = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$_SERVER['REMOTE_ADDR']));
        logger($location_info);
        return $location_info['geoplugin_countryName'];
    };
}
?>
