<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
/*
http://localhost/ATAK/ECHO_TEST/index.php
*/
$data = filter_input(INPUT_GET, 'data');
$data = urldecode($data);
if($data)
{
    $InitiateConnection = ' ['.date("Y-m-d H:i:sa").'] initiate Connection';
    $SocketConnection = fsockopen('127.0.0.1', 8087, $errno, $errstr);

    if (!$SocketConnection) {
        echo "$errstr ($errno)<br />\n";
    } else {
         fwrite($SocketConnection, $data.PHP_EOL);
         $PointerResult = '';
         $TTime = date("Y-m-d H:i:sa");
         if(!feof($SocketConnection))
         {
            $PointerResult = ' ['.date("Y-m-d H:i:sa").'] data sent! <br>';
            $Color= 'lime';
            $TResult = 'Success';
            $TData = 'XML';
         }else
         {
            $PointerResult =  ' ['.date("Y-m-d H:i:sa").'] something went wrong... <br>';
            $Color= 'red';
            $TResult = 'Fail';
            $TData = 'XML';
         }
         fclose($SocketConnection);
         $SocketClosed =  ' ['.date("Y-m-d H:i:sa").'] socket closed! <br>';
         $TaskCompleted =  ' ['.date("Y-m-d H:i:sa").'] Done! <br>';
    }
}
else
{
    $data = '<?xml version="1.0"?><event version="2.0" uid="TestSign" type="a-f-G-U-C" how="m-g" start="2021-03-30T10:31:41.042Z" time="2021-03-30T17:31:41.042Z" stale="2021-03-30T17:37:56.042Z"><detail><contact callsign="TestSign"/><__group name="Blue" role="Team Lead" /></detail><point le="9999999.0" ce="5.0" hae="217.88824764640728" lon="-0.665562" lat="54.019611" /></event>';
    $InitiateConnection ='';
    $PointerResult ='';
    $SocketClosed ='';
    $TaskCompleted ='';
    $Color ='';
    $TResult ='';
    $TTime ='';
    $TData ='';
}


?>
<!DOCTYPE html>
<html>
<head>
<title>ATAK API TEST</title>

<!-- Optional theme -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.5.2/darkly/bootstrap.min.css">

<!-- Jquery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>

<body>
<br>
<div class="container-fluid">

<div class="row">
<h1 class="col-md-12">ATAK ECHO TEST</h1>
</div>

<div class="row">
<h2 class="col-md-12">This is the testing ECHO for the ATAK interface</h2>
</div>
<div class="row">
<h3 class="col-md-12">C:\Software\xampp\htdocs\ATAK\ECHO_TEST\index.php</h3>
</div>

<div class="row">
<div class="col-lg-6">
<div class="bs-component">
<div class="form-group">
                    <label for="XMLtext">XML Data To Send:</label>
                    <textarea class="form-control" id="XMLtext" rows="8"><?php echo$data?></textarea>
                    <br>
                    <button id="SendXMLButton" type="button" onclick="SendXML()" class="btn btn-primary">Send XML Data</button>
                    <p id="InitiateConnection" style="margin:10px;"><?php echo$InitiateConnection?></p>
                    <p id="PointerResult" style="margin:10px;"><?php echo$PointerResult?></p>
                    <p id="SocketClosed" style="margin:10px;"><?php echo$SocketClosed?></p>
                    <p id="TaskCompleted" style="margin:10px;"><?php echo$TaskCompleted?></p>
                    <br>
                    <table class="table table">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Result</th>
                          <th scope="col">Time</th>
                          <th scope="col">Data</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th scope="row">1</th>
                          <td style="color:<?php echo$Color?>;"><?php echo$TResult?></td>
                          <td><?php echo$TTime?></td>
                          <td><?php echo$TData?></td>
                        </tr>
                      </tbody>
                    </table>

                </div>
        </div>
</div>



</div>




<script>
function SendXML(){
    //var data = '<?php //echo$data?>';
    var data = $("#XMLtext").val();
    if(data)
    {
        window.location.href = "http://localhost/ATAK/ECHO_TEST/index.php?data="+data;
        console.log("Data sent: "+data);
    }
    else
    {
        console.log("Failed no data");
        alert("Failed no data");
    } 
}
</script>
</body>
</html>
