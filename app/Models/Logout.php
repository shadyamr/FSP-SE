<?php 
namespace App\Models;

class Logout
{
    function __construct() 
    {
        $_SESSION = array();
        session_unset();
        session_destroy();
        header("location: login");
        exit;
    }
}