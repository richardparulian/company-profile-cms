<?php defined('BASEPATH') or exit('No direct script access allowed');

//is admin
function is_admin()
{
    $ci = &get_instance();
    if ($ci->M_Auth->is_logged_in()) {
        return true;
    }
    return false;
}
if (!function_exists('format_indo')) {
    function format_indo($date)
    {
        date_default_timezone_set('Asia/Jakarta');

        $Day    = array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");


        $Month  = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");

        $years  = substr($date, 0, 4);
        $month  = substr($date, 5, 2);
        $dates  = substr($date, 8, 2);
        $time   = substr($date, 11, 5);
        $day    = date("w", strtotime($date));
        $result = $Day[$day] . ", " . $dates . " " . $Month[(int)$month - 1] . " " . $years;
        //$result = $tgl . " " . $Bulan[(int)$bulan - 1] . " " . $tahun . " " . $waktu;

        return $result;
    }
}


if (!function_exists('format_month')) {
    function format_month($date)
    {
        date_default_timezone_set('Asia/Jakarta');

        $Month  = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");

        $month  = substr($date, 5, 2);

        $result = $Month[(int)$month - 1];

        return $result;
    }
}
