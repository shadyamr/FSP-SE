<?php 
namespace App\Models;

use App\Models\DB;

class User
{
    protected $username;
    protected $firstname;
    protected $lastname;
    
    function __construct() 
    {
        $user = $this->getUserData($_SESSION['login']);
        $username = $user["Username"];
        $firstname = $user["FirstName"];
        $lastname = $user["LastName"];
    }

    function getUserData($id)
    {
        $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $query = sprintf("SELECT * FROM users WHERE ID = '%s';",
            $conn->real_escape_string($id));

        $result = mysqli_query($conn, $query);
        $user = mysqli_fetch_assoc($result);
        return $user;
    }
}