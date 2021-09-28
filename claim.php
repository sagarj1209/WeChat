<?php

//getting value of post parameter
$room = $_POST['room'];

//checking for string size
if(strlen($room)>20 or strlen($room)<2){
    $message = "Please choose name between 2 to 20 characters";
    echo '<script language="javascript">';
    echo 'alert("'.$message.'");';
    echo 'window.location="http://localhost/ssjproject";';
    echo '</script>';
}
 //checking room name is alphanumeric or not
else if(!ctype_alnum($room)){
    $message = "Please choose alphanumeric room name";
    echo '<script language="javascript">';
    echo 'alert("'.$message.'");';
    echo 'window.location="http://localhost/ssjproject";';
    echo '</script>';
}

else{
    //connecting to database
    include 'db_connect.php';
}

//check if room already exists

$sql = "SELECT * FROM `rooms` WHERE roomname = '$room'";
$result = mysqli_query($conn,$sql);
if($result){
    if(mysqli_num_rows($result) > 0){
        $message = "Please choose differnt room . This room is already claimed";
        echo '<script language="javascript">';
        echo 'alert("'.$message.'");';
        echo 'window.location="http://localhost/ssjproject";';
        echo '</script>';
    }
    else{
        $sql = "INSERT INTO `rooms` (`roomname`) VALUES ('$room')";
        if(mysqli_query($conn, $sql)){
            $message = "Your room is ready to chat";
            echo '<script language="javascript">';
            echo 'alert("'.$message.'");';
            echo 'window.location="http://localhost/ssjproject/rooms.php?roomname= ' . $room. '";';
            echo '</script>';
        }
    }
}


?>