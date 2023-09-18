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

            <div id="firstboxText" style="padding-bottom: 1vw;">
                <p id="title3">About</p>
                <p>
                    This project aims to create an online system that allows people interested in playing football from 11 to individually sign up for teams.
                </p>
                <p>
                    The system allows you to create teams, add teams, plan teams, create tournaments and a match schedule between the teams that have been created, and record the results, as well as view the standings.
                </p>
                <p>
                    The main purpose of the application is to ensure that regular games can be organized between amateur teams who have volunteered to play. To be able to guarantee that there will be games, that is, players who volunteer will not be prevented from playing because a colleague did not want to appear, it is necessary to take some measures that the application provides.
                </p>

                <br>
                <p id="title3">Developers</p>

                <p>
                    Dinis Costa nº 2016247605   
                </p>
                <p>
                    Esmaail Albarazi nº 2017281413 
                </p>
                <p> 
                    João Marques nº 2017225818
                </p>
                <p>
                    João Monteiro nº 2016244006
                </p>
            </div>  

        </div>
        
    </div>
    
</body>
</html>