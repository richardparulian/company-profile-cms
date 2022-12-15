<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Nativesession
{
    public function __construct()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
    }
    // function untuk meng-set session
    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }
    // function untuk memanggil session
    public function get($key)
    {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }
    // function untuk menghapus session
    public function delete($key)
    {
        unset($_SESSION[$key]);
    }
}
