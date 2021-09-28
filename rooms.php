<?php

//get parameters
$roomname = $_GET['roomname'];

//connecting to database
include 'db_connect.php';

//ckeck whether room exist for chat or not
$sql = "SELECT * FROM `rooms` WHERE roomname = '$roomname'";

$result = mysqli_query($conn, $sql);
if ($result) {
    //check if room exists
    if (mysqli_num_rows($result) > 0) {
        $message = "This room does not exists. Please create new room";
        echo '<script language="javascript">';
        echo 'alert("' . $message . '");';
        echo 'window.location="http://localhost/ssjproject";';
        echo '</script>';
    }
} else {
    echo "Error : " . mysqli_error($conn);
};

?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <!-- Custom styles for this template -->
    <link href="css/product.css" rel="stylesheet">
<style>
body {
  margin: 0 auto;
  max-width: 800px;
  padding: 0 20px;
}

.container {
  border: 2px solid #dedede;
  background-color: #f1f1f1;
  border-radius: 5px;
  padding: 10px;
  margin: 10px 0;
}

.darker {
  border-color: #ccc;
  background-color: #ddd;
}

.container::after {
  content: "";
  clear: both;
  display: table;
}

.container img {
  float: left;
  max-width: 60px;
  width: 100%;
  margin-right: 20px;
  border-radius: 50%;
}

.container img.right {
  float: right;
  margin-left: 20px;
  margin-right:0;
}

.time-right {
  float: right;
  color: #aaa;
}

.time-left {
  float: left;
  color: #999;
}

.anyClass{
    height:350px;
    overflow-y: scroll;
}
</style>
</head>
<body>
<header class="site-header sticky-top py-1">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
            <div class="container-fluid">
                <!-- <a class="navbar-brand" href="#">Top navbar</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button> -->
                
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav me-auto mb-2 mb-md-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="#" tabindex="-1">Contact</a>
                        </li>
                    </ul>
                    <!-- <form class="d-flex">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form> -->
                </div>
            </div>
        </nav>
    </header>

<h2>Chat Messages - <?php echo $roomname ?></h2>

<div class="container">
    <div class="anyClass">
  
  </div>
</div>


<input type="text" class = "form-control" name = "usermsg" id="usermsg" placeholder="Add message">

    <button class = "btn btn-default" name="submitmsg" id="submitmsg">Send</button>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script type="text/javascript">

    //check for new message every 1 sec
setInterval(runFunction,1000);
function runFunction(){
    $.post("htcont.php", {room:'<?php echo $roomname ?>'},
    function(data,status){
        document.getElementsByClassName('anyClass')[0].innerHTML = data;
    }
    )
}



   // enter key to submit message
var input = document.getElementById("usermsg");


input.addEventListener("keyup", function(event) {
   if (event.keyCode === 13) {
        event.preventDefault();
        document.getElementById("submitmsg").click();
  }
});


    //if user submits the form

    $("#submitmsg").click(function(){
        var clientmsg = $("#usermsg").val();
        if(clientmsg){
        $.post("postmsg.php",{text:clientmsg, room: '<?php echo $roomname ?>' , ip: '<?php echo $_SERVER['REMOTE_ADDR']?>' },
        function(data,status){
            document.getElementsByClassName('anyClass')[0].innerHTML = data;});
        $("#usermsg").val("");
        return false;
        }

    });

    


    </script>
</body>
</html>
