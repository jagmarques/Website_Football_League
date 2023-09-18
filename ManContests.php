<?php

    session_start();
    
    if (!isset($_SESSION['logged']))
    {
        header('Location: logging.php');
        exit();
    }

    if (isset($_POST['Calendario'])){
        $contest_name= $_POST['contest1'];
        $_SESSION['contest_name'] =$contest_name;

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
                header('Location:Calendario.php');
            }
        }
        catch(Exception $e)
            {
                echo '<span id="title1" style="color:red;">Server error! Try later</span>';
                echo '<br /><p id="title1">Developer info: ' . $e . '</p>';
            }
    }
    
	
	if (isset($_POST['generate']))
    {
        $contest_name= $_POST['contest'];
		$_SESSION['contest_name'] =$contest_name;
		
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
				$sqlj="SELECT * FROM team WHERE contest_contest_name='$contest_name'";
				$result = $connection->query($sqlj);
				$teams = array();
				while(($row = $result->fetch_assoc())!=NULL){
					array_push($teams,$row['team_name']);
				}
				
				$num_teams= count($teams);
				if($num_teams>0){
					
				$sqlc="SELECT * FROM contest WHERE contest_name='$contest_name'";
				$resultc = mysqli_query($connection,$sqlc);
				$rowc = mysqli_fetch_assoc($resultc);
				$start = date_create($rowc['contest_date_start']);
				$end = date_create($rowc['contest_date_end']);
				$date_game=$start;
				$diff2 = date_diff($start,$end);
				$diff=$diff2->days;
				$min = 17;
				$max = 21;
				$minp = 2;
				$maxp = 5;
				if($num_teams % 2!=0){
					$push = array_push($teams, "0none0");
					$num_teams++;
				}
				$n2=($num_teams-1)/2;
				$n3=$num_teams-1;
				$aux=$start->format('Y-m-d');
				$add=($diff - ($diff % $n3)) / $n3;
				$addata="P".$add."D";
				for ($i=0;$i<$num_teams-1;$i++){
					echo "<br>"."data jornada:".$aux."<br>";
					$aux = date('Y-m-d');
					$d = new DateTime($aux);
					for($j=0;$j<$n2;$j++){
						if ($add!=0){
							$date_game->add(new DateInterval($addata));
						}
						$aux=$start->format('Y-m-d');
						$team1=$teams[$n2-$j];
						$team2=$teams[$n2+$j+1];
						$results[$team1][$i]=$team2;
						$results[$team2][$i]=$team1;
						if ($team1=="0none0" or $team2=="0none0"){//aqui a equipa tem folga logo nao se regista jogo
							echo $results[$team1][$i]."vs".$results[$team2][$i].";<br>";
						}
						else{//registar o jogo
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
									echo $results[$team1][$i]."vs".$results[$team2][$i]."<br>";
									$hour = rand( $min ,$max );
									$price= rand ($minp ,$maxp );
									$sql = "INSERT INTO game(price,game_date,game_hour,state,team_team_name,field_field_name,team_team_name1,contest_contest_name) values ('$price','$aux','$hour',1,'$team1','$location','$team2','$contest_name')";
									if ($connection->query($sql)) {
										echo '<p id="title1" style="color: green">New record created successfully</p>';
										header('Location: Calendario.php');
									} else {
										echo '<p style="tile1"> Error: ' . $sql . "</p><br>" . $connection->error;
									}
								}
							}
							catch(Exception $e)
							{
								echo '<span id="title1" style="color:red;">Server error! Try later</span>';
                                echo '<br /><p id="title1">Developer info: '.$e . '</p>';
							}
						}

					}
				}
				
				$update = "UPDATE contest SET state=1 where contest_name ='$contest_name'";
				
				if ($connection->query($update)) {
				
				} else {
					echo '<p style="tile1"> Error: ' . $update . "</p><br>" . $connection->error;
				}
                }else{
				    echo '<p id="title1">There are no Teams available</p>';
			}
             
            }
        }
        catch(Exception $e)
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
                        <a id="title2" href="ManTeams.php">TEAMS</a>
                    </li>
                    <li>
                        <a id="title2" href="ManContests.php" style="background-color: green; color: white">CONTESTS</a>
                    </li>
                    <li>
                        <a id="title2" href="ManGames.php">GAMES</a>
                    </li>
                </ul>
            </nav>

            <div id="firstboxText">
                <p id="title3" style="color: orange;">Pending Contests<a href="NewContest.php"><button id="createTeam" style="float: right">Create Contest</button></a></p>
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
        					$sql ="SELECT * FROM contest WHERE state=0";
        					if($sql!=NULL){
            					$result = mysqli_query($connection,$sql);
            					$resultCheck = mysqli_num_rows($result);
            					if($resultCheck>0){
									echo '<select name="contest">';
                                            while($row = mysqli_fetch_assoc($result)){
                                                echo '<option name="contest">'.$row['contest_name'] .'</option><button class="accordion">Info</button><div class="panel"><p>Number of Teams: '.$row['number_teams'].' Location: '.$row['location'].' Start: '.$row['contest_date_start'].' End: '.$row['contest_date_end'].'</p><div>';
                                            }
                                    echo '</select>';
            					}
                                else{
                                    echo '<p id="title1">There are no Contests available</p>';
                                }
        					}
							
                            $connection->close();
                        }
                    }
                    catch(Exception $e)
                    {
                        echo '<span id="title1" style="color:red;">Server error! Try later</span>';
                        echo '<br /><p id="title1">Developer info: ' . $e . '</p>';
                    }
				?>
				<input type="submit"  id="generateGames" name="generate" value="Generate Games"></input>
				</form>
                <p id="title3" style="color: green;">Hapenning Contests</p>
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
        					$sql ="SELECT * FROM contest where state=1;";
        					if($sql!=NULL){
            					$result = mysqli_query($connection,$sql);
            					$resultCheck = mysqli_num_rows($result);
            					if($resultCheck>0){
									echo '<select name="contest1">';
                                        while($row = mysqli_fetch_assoc($result)){
                                            echo '<option name="contest1">'.$row['contest_name'] . '</option><button class="accordion">Info</button> <div class="panel"><p>Number of Teams: '.$row['number_teams'].'</p><p> Location: '.$row['location'].'</p> Start: '.$row['contest_date_start'].' End: '.$row['contest_date_end'].'</p></div>';
                                        }
                                    echo '</select>';
            					}
                                else{
									echo '<p id="title1">There are no Contests available</p>';
                                }
        					}
                            $connection->close();
                        }
                    }
                    catch(Exception $e)
                    {
                        echo '<span id="title1" style="color:red;">Server error! Try later</span>';
                        echo '<br /><p id="title1">Developer info: ' . $e . '</p>';
                    }
				?>
            
            <input type="submit"   id="editGames" name="Calendario" value="Calendario"></input>
            </form>
                <p id="title3" style="color: red;">Finished Contests</p>
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
        					$sql ="SELECT * FROM contest WHERE number_teams=NULL;";//inventar condiºao para mostrar torneios acabados
        					if($sql!=NULL){
            					$result = mysqli_query($connection,$sql);
            					$resultCheck = mysqli_num_rows($result);
            					if($resultCheck>0){
                					echo '<select name="contest2">';
                                        while($row = mysqli_fetch_assoc($result)){
                                                echo '<option name="contest2">'.$row['contest_name'] . '</option><button class="accordion">Info</button><div class="panel"><p>Number of Teams: '.$row['number_teams'].'</p><p> Location: '.$row['location'].'</p> Start: '.$row['contest_date_start'].' End: '.$row['contest_date_end'].'</p></div>';
                                            }
                                    echo '</select>';
            					}
                                else{
                                    echo '<p id="title1">There are no Contests available</p>';
                                }
        					}
                            $connection->close();
                        }
                    }
                    catch(Exception $e)
                    {
                        echo '<span id="title1" style="color:red;">Server error! Try later</span>';
                        echo '<br /><p id="title1">Developer info: ' . $e . '</p>';
                    }
				?>
            </form>
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