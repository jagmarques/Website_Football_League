<?php

    session_start();
    
    if (!isset($_SESSION['logged']))
    {
        header('Location: userteams.php');
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
                    <a id="title1" href="userteams.php" style="background-color: black; color: white">HOME</a>
                </li>
            </ul>
        </nav>
    </header>

    <div id="container">

        <div id="firstbox">

            <div id="firstboxText">
                <div id="userFunds"> 
                    <button class="accordion addFunds">Add Funds</button>
                    <div class="panel addFunds">
                        <p><input type="text" placeholder="Value" name="fund"></p>
                        <p><input type="submit" class="submit save_fund" value="Add"></p>
                    </div>
                    <button class="accordion sendFunds">Send to Treasurer</button>
                    <div class="panel sendFunds">
                        <p>Treasurer contact: 9*******</p>
                        <p><input type="text" placeholder="Value" name="fund"></p>
                        <p><input type="submit" class="submit send_fund" value="Send"></p>
                    </div>
                </div>
                <p id="title3">Edit User</p>
                <section id="contact">
                    <form method="post" enctype="multipart/form-data" onsubmit="return validateForm()" name="myForm">
                        <div id="intro" style="float: left;">
                            <p id="title1">Name:</p>
                            <p><input type="text" placeholder="Name" name="name"></p>
                            <p id="title1">Phone Number:</p>
                            <p><input type="text" placeholder="Phone Number" name="number"></p>
                            <p id="title1">City:</p>
                            <p><input type="text" placeholder="City" name="city"></p>
                            <p><input type="submit" class="submit save_editUser" value="Save" style="float: left;"></p>
                        </div>
                    </form>   
                </section>
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