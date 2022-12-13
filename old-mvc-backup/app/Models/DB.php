<?php 
namespace App\Models;

class DB
{
    public function __construct()
    {
        return new mysqli("example.com", "user", "password", "database");
    }
}