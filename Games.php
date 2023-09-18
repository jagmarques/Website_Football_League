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
            <nav>
                <ul>
                    <li>
                        <a id="title2" href="index.php">TEAMS</a>
                    </li>
                    <li>
                        <a id="title2" href="Contests.php">CONTESTS</a>
                    </li>
                    <li>
                        <a id="title2" href="Games.php" style="background-color: green; color: white">GAMES</a>
                    </li>
                </ul>
            </nav>

            <div id="firstboxText">
                <p id="title3">Games</p>
				<?php
                    require_once "connect.php";
                    mysqli_report(MYSQLI_REPORT_STRICT);// throw errors, not warnings
                    try{
                        $connection = new mysqli($host, $db_user, $db_password, $db_name);
                        if ($connection->connect_errno != 0){
                            throw new Exception(mysqli_connect_errno());
                        }
                        else{
        					$sql ="SELECT * FROM game;";
        					if($sql!=NULL){
            					$result = mysqli_query($connection,$sql);
            					$resultCheck = mysqli_num_rows($result);
            					if($resultCheck>0){
                					while($row = mysqli_fetch_assoc($result)){
										echo '<nav id="contentTitle">' . $row['team_team_name'] . '<p style="title1"> VS </p>' . $row['team_team_name1'] . '<button class="accordion">Info</button>' . '<div class="panel"><p>Date: '. $row['game_date'] .' Hour: '. $row['game_hour'].'h</p> </div> </nav>';
									}
            					}
                                else{
                                    echo '<p id="title1">No Games available</p>';
                                }
        					}
                            $connection->close();
                        }
                    }
                    catch(Exception $e)
                    {
                        echo '<span id="title1" style="color:red;">Server error! Try later</span>';
                        echo '<br /><p id="title1">Developer info: '.$e . '</p>';
                    }
				?>
            </div>
        </div>

        <div id="lastbox">
            <form action="logging.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm()" name="myForm">
                <div id="intro">
                    <input type="email" placeholder="Email" name="email" required/></p>
                    <input type="password" placeholder="Password" name="pass" required/></p>
                    <input type="submit" class="submit login" value="Login">
                    <button id="registerButton"><a href="register.php">Register</a></button>
                </div>
            </form>
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