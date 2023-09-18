<?php

session_start();
    
    if (!isset($_SESSION['logged']))
    {
        header('Location: logging.php');
        exit();
    }  
    if (isset($_POST['team_name']))
    {
        $team_name = $_POST['team_name'];
        $contest_name = $_POST['contest'];
        $_SESSION['input_name'] = $team_name;
        $_SESSION['contest_name'] = $contest_name;
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
                $sql = "INSERT INTO team(team_name, can_play, player_user_name, contest_contest_name) VALUES ('$team_name', FALSE, '".$_SESSION['user_username']. "','$contest_name')";
                $sqlp = "INSERT INTO player_team VALUES ('".$_SESSION['user_username']. "','$team_name')";

                $numberteams = "SELECT number_teams FROM contest WHERE contest_name='$contest_name'";
                $update = "UPDATE contest SET number_teams='$numberteams'+1";
                if ($connection->query($sql) && $connection->query($sqlp)) {
                    $numberteams = "SELECT number_teams FROM contest WHERE contest_name='$contest_name'";
                    $update = "UPDATE contest SET number_teams='$numberteams'+1";
                    mysqli_query($connection,$update);
                    echo '<p style="title1"> New record created successfully</p>';
                    header('Location: ManTeams.php');
                    echo '<p style="title1"> Error:' . $sql . "</p><br>" . $connection->error;
                } 
                /*
                else{
                    echo '<p id="title1">No Contests available</p>';
                }*/
            
            
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
                    <a id="title1" href="ManTeams.php" style="background-color: black; color: white">HOME</a>
                </li>
            </ul>
        </nav>
    </header>

    <div id="container">

        <div id="firstbox">

            <div id="firstboxText">
				<p id="title3">New Team</p>
                <form method="post" enctype="multipart/form-data" onsubmit="return validateForm()" name="myForm">
                    <div id="intro" style="float: left;">
                        <p id="title1">Name:</p>
                        <p><input type="text" placeholder="Name"  name="team_name" id="team_name" required/></p>
                        <p id="title1">Strategy:</p>
						  <select name="strategy" id="strategy" class ="form-control-sm">
							<option value=1>4-3-3</option>
							<option value=2>4-4-2</option>
							<option value=3>3-5-2</option>
							<option value=4>4-5-1</option>
							<option value=5>3-4-3</option>
						  </select>
                        <p id="title1">Contests:</p>
                        <p>
                            <?php
                            require_once "connect.php";
                            mysqli_report(MYSQLI_REPORT_STRICT);// throw errors, not warnings
                            try{
                                $connection = new mysqli($host, $db_user, $db_password, $db_name);
                                if ($connection->connect_errno != 0){
                                    throw new Exception(mysqli_connect_errno());
                                }
                                else{
                                    $sql ="SELECT * FROM contest where state=0;";
                                    if($sql!=NULL){
                                        $result = mysqli_query($connection,$sql);
                                        $resultCheck = mysqli_num_rows($result);
                                        if($resultCheck>0){
                                            echo '<select name="contest" id="contests">';
                                            while($row = mysqli_fetch_assoc($result)){
                                                echo '<option name="contest">'.$row['contest_name'] .'</option>';
                                            }
                                            echo '</select>';
                                        }
                                        else{
                                        echo '<p id="title1">No contests available</p>';
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
                        <p><input type="submit" name="insert" id="insert" class="submit save_newTeam" value="Save"></p>
                    </div>
                </form>       
            </div>

            <div id="goBackDiv"><a href="CapTeams.php"><button id="goBack">Go Back >></button></a></div>

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

</body>
</html>