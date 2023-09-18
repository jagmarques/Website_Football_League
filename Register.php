<?php   
    session_start();
    if (isset($_POST['email']))
    {
        //validation flag
		$flag_everything_OK = true;
		
		//check email
		$email = $_POST['email'];
		$emailB = filter_var($email, FILTER_SANITIZE_EMAIL);
		
		if ((filter_var($emailB, FILTER_VALIDATE_EMAIL) == false) || ($emailB!=$email))
		{
			$flag_everything_OK = false;
			$_SESSION['input_email'] = "Incorrect email address!";
		}
		
		//check password
		$password = $_POST['password'];
		
		if ((strlen($password)<4) || (strlen($password)>20))
		{
			$flag_everything_OK = false;
			$_SESSION['input_password'] = "Password under 4 or over 20 characters!";
		}
		
		//check name
		$name = $_POST['name'];
		if ((strlen($name)<1))
		{
			$flag_everything_OK = false;
			$_SESSION['input_name'] = "Name field cannot be empty!";
        }
        
		//check surname
		$surname = $_POST['surname'];
		if ((strlen($surname)<1))
		{
			$flag_everything_OK = false;
			$_SESSION['input_surname'] = "Surname field cannot be empty!";
		}	
        
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $cc = $_POST['cc'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $_SESSION['input_name'] = $name;
        $_SESSION['input_surname'] = $surname;
        $_SESSION['input_cc'] = $cc;
        $_SESSION['input_username'] = $username;
        $_SESSION['input_email'] = $email;
        $_SESSION['input_password'] = $password;
        require_once "connect.php";
        mysqli_report(MYSQLI_REPORT_STRICT);// throw errors, not warnings
        try
        {
            $connection = new mysqli($host, $db_user, $db_password, $db_name);
            if ($connection->connect_errno != 0)
            {
                throw new Exception(mysqli_connect_errno());
            }
            else
            {  
                //check if email exists
				$result = $connection->query("SELECT e_mail FROM player WHERE e_mail='$email'");
				
				if (!$result) throw new Exception($connection->error);
				
				$count_emails = $result->num_rows;
				if($count_emails > 0)
				{
					$flag_everything_OK = false;
					$_SESSION['input_email'] = "Account with this email already exists!";
                }		

                //check if username exists
				$result = $connection->query("SELECT user_name FROM player WHERE user_name='$username'");
				
				if (!$result) throw new Exception($connection->error);
				
				$count_usernames = $result->num_rows;
				if($count_usernames > 0)
				{
					$flag_everything_OK = false;
					$_SESSION['input_username'] = "Account with this username already exists!";
                }		

                //check if cc exists
				$result = $connection->query("SELECT cc FROM player WHERE cc='$cc'");
				
				if (!$result) throw new Exception($connection->error);
				
				$count_cc = $result->num_rows;
				if($count_cc > 0)
				{
					$flag_everything_OK = false;
					$_SESSION['cc'] = "Account with this cc already exists!";
                }	
                 
                //echo 'alert("connected successfully")';
                if($username=='admin')
                    $sql = "INSERT INTO player VALUES ('$name','$surname','$username','$password','$email',NULL,TRUE,TRUE,$cc,'db_project')";
                else
                    $sql = "INSERT INTO player VALUES ('$name','$surname','$username','$password','$email',NULL,FALSE,FALSE,$cc,'db_project')";
                if ($connection->query($sql) === TRUE) {
                    echo "New record created successfully";
                    header('Location: UserTeams.php');
                } else {
                    echo "Error: " . $sql . "<br>" . $connection->error;
                }
                $connection->close();
            }
        }
        catch(Exception $e)
        {
            echo '<span style="color:red;">Server error! Try later</span>';
            echo '<br />Developer info: '.$e;
        }
    }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
<meta charset="utf-8">
<link rel="stylesheet" href="styles/layout.css" type="text/css">
</head>

<body background="images/background.jpg">

    <header id="header">
        <nav>
            <div id="logo"><img  src="images/logo.png"></div>
            <ul>
                <li>
                    <a id="title1" href="About.php">ABOUT</a>
                </li>
                <li>
                    <a id="title1" href="index.php" style="background-color: black; color: white">HOME</a>
                </li>
            </ul>
        </nav>
    </header>

    <div id="container">
        
        <div id="firstbox">
            <div id="firstboxText" style="padding-bottom: 1vw;">
                <p id="title3">Welcome</p>
                <p>INTRUCTIONS:</p>
                <p>How to begin?</p>
                <p>- First, sign up and login.</p>
                <p>- See the contests that you are interested in and choose one of the teams attending that contest.</p>
                <p>- To apply you will need to choose your position.</p>
                <p>- When delivered the money, you will be accepted.</p>
            </div>
        </div>

        <div id="lastbox">
            <form method="post" enctype="multipart/form-data" onsubmit="return validateForm()" name="myForm">
                <div id="intro">
                    <input type="text" placeholder="Name" value="<?php
                                                                    if (isset($_SESSION['input_name']))
                                                                    {
                                                                        echo $_SESSION['input_name'];
                                                                        unset($_SESSION['input_name']);
                                                                    }
                                                                    ?>" name="name" required/> <?php
                                                                    if (isset($_SESSION['input_name']))
                                                                    {
                                                                        echo '<div style="color: white" class="error">'.$_SESSION['input_name'].'</div>';
                                                                        unset($_SESSION['input_name']);
                                                                    }
                                                                    ?></p>
                    <input type="text" placeholder="Surname" name="surname" value="<?php
                                                                    if (isset($_SESSION['input_surname']))
                                                                    {
                                                                        echo $_SESSION['input_surname'];
                                                                        unset($_SESSION['input_surname']);
                                                                    }
                                                                    ?>" name="name" required/> <?php
                                                                    if (isset($_SESSION['input_surname']))
                                                                    {
                                                                        echo '<div style="color: white" class="error">'.$_SESSION['input_surname'].'</div>';
                                                                        unset($_SESSION['input_surname']);
                                                                    }
                                                                    ?></p>
                    <input type="text" placeholder="Card id number" name="cc" value="<?php
                                                                    if (isset($_SESSION['input_cc']))
                                                                    {
                                                                        echo $_SESSION['input_cc'];
                                                                        unset($_SESSION['input_cc']);
                                                                    }
                                                                    ?>" name="name" required/> <?php
                                                                    if (isset($_SESSION['input_cc']))
                                                                    {
                                                                        echo '<div style="color: white" class="error">'.$_SESSION['input_cc'].'</div>';
                                                                        unset($_SESSION['input_cc']);
                                                                    }
                                                                    ?></p>
                    <input type="text" placeholder="Username" name="username" value="<?php
                                                                    if (isset($_SESSION['input_username']))
                                                                    {
                                                                        echo $_SESSION['input_username'];
                                                                        unset($_SESSION['input_username']);
                                                                    }
                                                                    ?>" name="name" required/> <?php
                                                                    if (isset($_SESSION['input_username']))
                                                                    {
                                                                        echo '<div style="color: white" class="error">'.$_SESSION['input_username'].'</div>';
                                                                        unset($_SESSION['input_username']);
                                                                    }
                                                                    ?></p>
                    <input type="email" placeholder="Email" value="<?php
                                                                    if (isset($_SESSION['input_email']))
                                                                    {
                                                                        echo $_SESSION['input_email'];
                                                                        unset($_SESSION['input_email']);
                                                                    }
                                                                    ?>"name="email" required/><?php
                                                                    if (isset($_SESSION['input_email']))
                                                                    {
                                                                        echo '<div style="color: white" class="error">'.$_SESSION['input_email'].'</div>';
                                                                        unset($_SESSION['input_email']);
                                                                    }
                                                                    ?></p>
                    <input type="password" placeholder="Password" value="<?php
                                                                        if (isset($_SESSION['input_password']))
                                                                        {
                                                                            echo $_SESSION['input_password'];
                                                                            unset($_SESSION['input_password']);
                                                                            }
                                                                        ?>" name="password" required/><?php
                                                                        if (isset($_SESSION['input_password']))
                                                                        {
                                                                            echo '<div style="color: white" class="error">'.$_SESSION['input_password'].'</div>';
                                                                            unset($_SESSION['input_password']);
                                                                        }
                                                                        ?>	</p>
                    <input type="submit" class="submit register" name="register" value="Register">
                </div>
            </form> 
        </div>
    </div>

</body>
</html>