<?php

    session_start();
    
    if (!isset($_SESSION['logged']))
    {
        header('Location: logging.php');
        exit();
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
                <p id="title3">Messages</p>
                <nav id="contentTitle">
                    Message1
                    <button class="accordion">Info</button>
                    <div class="panel">
                        <p>
                            Message1
                        </p>
                    </div>
                </nav>
                <nav id="contentTitle">
                    Message2
                    <button class="accordion">Info</button>
                    <div class="panel">
                        <p>
                            Message2
                        </p>
                    </div>
                </nav>
            </div>  
            
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