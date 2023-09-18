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
            
            <nav>
                <ul>
                    <li>
                        <a id="title2" href="CapTeams.php" style="background-color: green; color: white">TEAMS</a>
                    </li>
                    <li>
                        <a id="title2" href="CapContests.php">CONTESTS</a>
                    </li>
                    <li>
                        <a id="title2" href="CapGames.php">GAMES</a>
                    </li>
                </ul>
            </nav>

            <div id="firstboxText" style="padding-bottom: 0.8vw; padding-top: 0vw;">
                <p id="title3" style="padding-bottom: 2vw;">Team balance</p>
                <p id="title1">Choose the Player:</p>
                <p style="padding-bottom: 2vw"><select id = "players" onchange="myFunction()" style="width: 10vw; font-size: 1.1vw; padding: 0.8vw; border: 0.1vw solid black">
                    <option value="Player1">Player1</option>
                    <option value="Player2">Player2</option>
                    <option value="Player3">Player3</option>
                </select></p> 

                <p id="infoBalance"></p>

                <p id="title3" style="padding-bottom: 2vw;">Team balance in a Contest</p>
                <p id="title1">Choose the Player:</p>
                <p><select id = "players" onchange="myFunction2()" style="width: 10vw; font-size: 1.1vw; padding: 0.8vw; border: 0.1vw solid black">
                    <option value="Player1">Player1</option>
                    <option value="Player2">Player2</option>
                    <option value="Player3">Player3</option>
                </select></p> 
                <p id="title1">Choose the Contest:</p>
                <p><select id = "contests" onchange="myFunction2()" style="width: 10vw; font-size: 1.1vw; padding: 0.8vw; border: 0.1vw solid black">
                    <option value="Contest1">Contest1</option>
                    <option value="Contest2">Contest2</option>
                    <option value="Contest3">Contest3</option>
                </select></p> 

                <p id="infoBalance2"></p>

                <script>
                    function myFunction() 
                    {
                        var x = document.getElementById("players").value;
                        document.getElementById("infoBalance").innerHTML = x+ " with the contact 9******** "+ "has a balance of: ";
                    }
                </script>   
                <script>
                    function myFunction2() {
                        var x = document.getElementById("players").value;
                        var y = document.getElementById("contests").value;
                        document.getElementById("infoBalance2").innerHTML = x+ " with the contact 9******** "+"in the contest "+y+ " has a balance: ";
                    }
                </script>             
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