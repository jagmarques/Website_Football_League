<?php

    session_start();
    
    if (!isset($_SESSION['logged']))
    {
        header('Location: logging.php');
        exit();
    }

    if (isset($_POST['enrollteam']))
    {
        $team_name = $_POST['enroll'];
        $_SESSION['team_name']=$team_name;

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
                $user=$_SESSION['user_username'];
                $sql = "INSERT INTO player_team VALUES ('$user', '$team_name')";
                if($result = $connection->query($sql)){
                    echo '<p style="title1"> New record created successfully</p>';
                    header('Location: ManTeams.php');
                    echo '<p style="title1"> Error:' . $sql . "</p><br>" . $connection->error;
                }
            }
        }catch(Exception $e)
        {
            echo '<span id="title1" style="color:red;">Server error! Try later</span>';
            echo '<br /><p id="title1">Developer info: ' . $e . '</p>';
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
                    <a id="title1" href="ManTeams.php" style="background-color: black; color: white">HOME</a>
                </li>
            </ul>
        </nav>
    </header>

    <div id="container">
	

        <div id="firstbox">
            <nav>
                <ul>
                    <li>
                        <a id="title2" href="ManTeams.php" style="background-color: green; color: white">TEAMS</a>
                    </li>
                    <li>
                        <a id="title2" href="ManContests.php">CONTESTS</a>
                    </li>
                    <li>
                        <a id="title2" href="ManGames.php">GAMES</a>
                    </li>
                </ul>
            </nav>

            <div id="firstboxText">
                <p id="title3">My Teams</p>
                <?php
                    require_once "connect.php";
                    mysqli_report(MYSQLI_REPORT_STRICT);// throw errors, not warnings
                    try{
                        $connection = new mysqli($host, $db_user, $db_password, $db_name);
                        if ($connection->connect_errno != 0){
                            throw new Exception(mysqli_connect_errno());
                        }
                        else{
							$user = $_SESSION['user_username'];
        					$sql ="SELECT * from player_team where player_user_name ='$user'";
        					if($sql!=NULL){
            					$result = mysqli_query($connection,$sql);
								if($result!=NULL){
									$resultCheck = mysqli_num_rows($result);
									if($resultCheck!=NULL){
                                        echo '<select name=edit>';
                                        while($row = mysqli_fetch_assoc($result)){
                                            echo '<option name="edit">' . $row['team_team_name'] . '</option>';
                                        }
                                        echo'</select>';
									}
								}else{
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
               
                <div style="padding-top: 2vw; padding-bottom: 4vw;"><a href="NewTeam.php"><button id="createTeam">Create Team</button></a></div>
                <p id="title3">Other Teams</p>
                    <form method="post" enctype="multipart/form-data" onsubmit="return validateForm()" name="myForm">
                    <?php
                    require_once "connect.php";
                    mysqli_report(MYSQLI_REPORT_STRICT);// throw errors, not warnings
                    try{
                        $connection = new mysqli($host, $db_user, $db_password, $db_name);
                        if ($connection->connect_errno != 0){
                            throw new Exception(mysqli_connect_errno());
                        }
                        else{
							$user = $_SESSION['user_username'];
        					$sql ="SELECT * from player_team where team_team_name not in (select team_team_name from player_team where player_user_name = '$user')";
        					if($sql!=NULL){
            					$result = mysqli_query($connection,$sql);
								if($result!=NULL){
            					$resultCheck = mysqli_num_rows($result);
            					if($resultCheck>0){
                					echo '<select name=enroll>';
                                    while($row = mysqli_fetch_assoc($result)){
                                        echo '<option name="enroll">' . $row['team_team_name'] . '</option>';
                                    }
                                    echo '</select><a href="EnrollTeam.php"><input type="submit" id="enrollTeam" name="enrollteam" value="Enroll Team"></input></a>';
                                    }
            					}
                               
								else{
                                    echo '<p id="title1">No Teams available</p>';
                                }
								
        					}
                        }
                    }
                    catch(Exception $e)
                    {
                        echo '<span id="title1" style="color:red;">Server error! Try later</span>';
                        echo '<br /><p id="title1">Developer info: '.$e . '</p>';
                    }
				?>
                </form>
                </nav>
            </div>

        </div>
		
		<div id="lastbox">
            <div id="wrapper">

                <img id="user" src="images/user.png" alt="user" width="120">
                <p id="title4"><?php echo $_SESSION['user_username']?></p>
                <p id="title4">Email</p>
                <a href="mailto:****@****"><?php echo $_SESSION['user_email']?></a>
                <p id="title4">Phone Number</p>
                <p>
                    <?php 
                        if($_SESSION['user_phonenumber']==NULL){
                            echo '<p> No phone number available </p>';
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