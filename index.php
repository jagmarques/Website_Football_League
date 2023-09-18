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
                    <a id="title1" href="about.php">ABOUT</a>
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
                        <a id="title2" href="index.php" style="background-color: green; color: white">TEAMS</a>
                    </li>
                    <li>
                        <a id="title2" href="contests.php">CONTESTS</a>
                    </li>
                    <li>
                        <a id="title2" href="games.php">GAMES</a>
                    </li>
                </ul>
            </nav>

            <div id="firstboxText">
                <p id="title3">Teams</p>
				<?php
                    require_once "connect.php";
                    mysqli_report(MYSQLI_REPORT_STRICT);// throw errors, not warnings
                    try{
                        $connection = new mysqli($host, $db_user, $db_password, $db_name);
                        if ($connection->connect_errno != 0){
                            throw new Exception(mysqli_connect_errno());
                        }
                        else{
        					$sql ="SELECT * FROM team;";
        					if($sql!=NULL){
            					$result = mysqli_query($connection,$sql);
            					$resultCheck = mysqli_num_rows($result);
            					if($resultCheck>0){
                					while($row = mysqli_fetch_assoc($result)){
                                        $team_name=$row['team_name'];
                                        $sql1= "SELECT count(*) FROM player_team WHERE team_team_name='$team_name'";
                                        if($sql1!=NULL){
                                            $result1 = mysqli_query($connection,$sql1);
                                            $resultCheck1 = mysqli_num_rows($result1);
                                            if($resultCheck1>0){
                                                $row1 = mysqli_fetch_assoc($result1);
                                                $slot=15-$row1['count(*)'];
                                                echo '<nav id="contentTitle">' . $row['team_name'] . '<p style="title2"> Free Slots:' .$slot. '<a href="login.php"><button id="enrollTeam">Enroll</button></a></p></nav>';
                                            }
                                        }
                                    }
            					}
                                else{
                                    echo '<p id="title1">No Teams available</p>';
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
    
</body>
</html>