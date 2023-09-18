<?php

    session_start();
    
    if((!isset($_POST['email']))||(!isset($_POST['pass'])))
    {
        header('Location: index.php');  
        exit();
    }
    
    require_once "connect.php";
    $connection = @new mysqli($host, $db_user, $db_password, $db_name);
    
    if ($connection->connect_errno!=0)
    {
        echo "Error: ".$connection->connect_errno;
    }
    else
    {
        $e_mail = $_POST['email'];
        $password = $_POST['pass'];
        $e_mail = htmlentities($e_mail, ENT_QUOTES, "UTF-8");
    
        if ($result= @$connection->query(sprintf("Select * from player where e_mail ='%s' AND password = '%s'" , mysqli_real_escape_string($connection,$e_mail),mysqli_real_escape_string($connection,$password))))
        {
            $count_users = $result->num_rows;
            if($count_users>0)
            {
                $row = $result->fetch_assoc();
                

                //if (password_verify($pass, $row['password']))
                
                    $_SESSION['logged'] = true;
                    $_SESSION['user_email'] = $row['e_mail'];
                    $_SESSION['user_name'] = $row['first_name'];
                    $_SESSION['user_surname'] = $row['last_name'];
                    $_SESSION['user_username'] = $row['user_name'];
                    $_SESSION['user_phonenumber'] = $row['phone_number'];
                    $_SESSION['user_admin'] = $row['admin'];
                    $_SESSION['manager'] = $row['can_open_contest'];

                    unset($_SESSION['error_log']);
                    $result->free_result();
                    header('Location: manteams.php');
                
            } 
            else
            {
                $_SESSION['error_log'] = '<span style="color:red id="title1">Wrong login or username!</span>';
                header('Location: index.php');  
            }
        }
        else
        {
            $_SESSION['error_log'] = '<span style="color:red" id="title1">No User</span>';
            header('Location: index.php');
        }
    
        $connection->close();
    }

    
?>