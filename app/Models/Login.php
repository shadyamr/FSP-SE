<?php 
namespace App\Models;

class Login
{
    public function login($username, $password)
    {
        $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $query = sprintf("SELECT * FROM users WHERE Username = '%s';",
            $conn->real_escape_string($username));

        $result = mysqli_query($conn, $query);
        $user = mysqli_fetch_assoc($result);
        if(password_verify($password, $user['Password']))
        {
            echo "WORK!";
            $_SESSION['login'] = $user['ID'];
            header('Location: home');
        }
        else
        {
            echo "DOESN'T WORK";
        }
    }

    /*public function checkDuplicate($username)
    {
        $query = sprintf("SELECT Username FROM users WHERE Username = '%s';",
            $conn->real_escape_string($username));

        $result = $conn->query($query);
        $duplicateUser = $result->fetchAssoc();
        return $duplicateUser;
    }*/
}