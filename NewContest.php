<?php

    session_start();
    
    if (!isset($_SESSION['logged']))
    {
        header('Location: logging.php');
        exit();
    }  
    if (isset($_POST['name']))
    {
        $name = $_POST['name'];
        $location = $_POST['location'];
		$start=$_POST['start'];
		$end=$_POST['end'];
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
                echo 'alert("connected successfully")';
                $sql = "INSERT INTO contest VALUES ('$name','$start','$end', '".$_SESSION['user_username']. "', 'db_project',0,'$location',0)";
                if ($connection->query($sql) === TRUE) {
                    echo '<p id="title1">New record created successfully</p>';
                    header('Location: ManContests.php');
                } else {
                    echo '<p id="title1"> Error: </p>'. $sql . "<br>" . $connection->error;
                }
                $connection->close();
            }
        }
        catch(Exception $e)
        {
            echo '<span id="title1" style="color:red;">Server error! Try later</span>';
            echo '<br /><p id="title1">Developer info: '.$e . '</p>';
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
                <li id="dropdown">
                    <a id="title1">ACCOUNT</a>
                    <div id="dropdown-content">
                        <a id="title1" href="EditUser.php">Edit</a>
                        <a id="title1" href="Messages.php">Messages</a>
                        <a id="title1" href="index.php">Log Out</a>
                    </div>        
                </li>
                <li>
                    <a id="title1" href="AboutLogged.php">ABOUT</a>
                </li>
                <li>
                    <a id="title1" href="CapTeams.php" style="background-color: black; color: white">HOME</a>
                </li>
            </ul>
        </nav>
    </header>

    <div id="container">
        
        <div id="firstbox">

            <div id="firstboxText">
                <form method="post" enctype="multipart/form-data" onsubmit="return validateForm()" name="myForm">
                <p id="title3" style="padding-bottom: 1.1vw;">New Contest</p>
                <p id="title1">Name:</p>
                <p><input type="text" placeholder="Name" value="<?php
                                                                        if (isset($_SESSION['input_name']))
                                                                        {
                                                                            echo $_SESSION['input_name'];
                                                                            unset($_SESSION['input_name']);
                                                                        }
                                                                    ?>"name="name" required></p>
				<p id="title1">Location:</p>
                <p><input type="text" placeholder="location" name="location" required></p>
				<p id="title1">Start:</p>
                <p><input type="date" placeholder="date" name="start" required></p>
				<p id="title1">End:</p>
                <p><input type="date" placeholder="date" name="end" required></p>
                
                <p><input type="submit" name="save" id="save" class="submit save_contest" value="Save"></p>

            </div>

            <div id="goBackDiv"><a href="ManContests.php"><button id="goBack">Go Back >></button></a></div>
        
        </div>

        <div id="lastbox">
            <div id="wrapper">

                <img id="user" src="images/user.png" alt="user" width="120">
                <p id="title4"><?php echo $_SESSION['user_username']?></p>
                <p id="title4"><?php echo $_SESSION['user_name']?></p>
                <p id="title4">Email</p>
                <a href="mailto:****@****"><?php echo $_SESSION['user_email']?></a>
                <p id="title4">Phone Number</p>
                <p>
                    <?php 
                        if($_SESSION['user_phonenumber']==NULL){
                            echo '<p> No phone number available </p';
                        }
                        else{
                            echo $_SESSION['user_phonenumber'];
                        }
                    ?>  
                </p>
            </div>
        </div>

    </div>

    <script>
        var acc = document.getElementsByClassName("accordion");
        var i;

        for (i = 0; i < acc.length; i++) 
        {
            acc[i].onclick = function() 
            {
                this.classList.toggle("active");
                this.nextElementSibling.classList.toggle("show");
            }
        }
    </script>

</body>
</html>