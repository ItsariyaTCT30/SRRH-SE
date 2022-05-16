<?php 
session_start(); 
if (!isset($_SESSION['timeend'])){ 
    unset($_SESSION['timeend']);
    $endtime = time() + 10; 
    $_SESSION['timeend'] = $endtime; 
} 

($_SESSION['timeend'] - time()) < 0 ? $EndTime = 0 :  $EndTime = $_SESSION['timeend'] - time();

if($EndTime <= 0) { 
    unset($_SESSION['timeend']);
 
} 

?> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
คุณมีเวลา 3 ชั่วโมงในการชำระเงิน >> <span id="timer" style="color:red;"><?php echo $EndTime?></span> วินาที...

<script type="text/javascript"> 
var pastTime = <?php echo $EndTime;?>; 

function mycountdown(){ 
      if(pastTime > 0) { 
            pastTime -= 1; 
            document.getElementById('timer').innerHTML = pastTime; 
      } 
if(pastTime < 1) { 
    window.location="index.php"
      } 
} 
    if(pastTime >0){
        setInterval(mycountdown,1000); 
    }
</script>
