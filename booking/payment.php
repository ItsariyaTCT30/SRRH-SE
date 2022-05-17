<?php
date_default_timezone_set("Asia/bangkok");
if (!isset($_SESSION['dragonhouse_cart'])) {
  # code...
  redirect(WEB_ROOT.'index.php');
}

function createRandomPassword() {

    $chars = "abcdefghijkmnopqrstuvwxyz023456789";

    srand((double)microtime()*1000000);

    $i = 0;

    $pass = '' ;
    while ($i <= 7) {

        $num = rand() % 33;

        $tmp = substr($chars, $num, 1);

        $pass = $pass . $tmp;

        $i++;

    }

    return $pass;

}



 $confirmation = createRandomPassword();
$_SESSION['confirmation'] = $confirmation;
 
 $count_cart = count($_SESSION['dragonhouse_cart']);

if(isset($_POST['btnsubmitbooking'])){
  // $message = $_POST['message'];
  $file_name ="";
  if(isset($_FILES['image'])){
  $file_name = $_FILES['image']['name'];
  $file_size =$_FILES['image']['size'];
  $file_tmp =$_FILES['image']['tmp_name'];
  $file_type=$_FILES['image']['type'];
  $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
  
  $extensions= array("jpeg","jpg","png");
  
  if(in_array($file_ext,$extensions)=== false){
     $errors[]="extension not allowed, please choose a JPEG or PNG file.";
  }
  
  if($file_size > 2097152){
     $errors[]='File size must be excately 2 MB';
  }
  
  if(empty($errors)==true){
     move_uploaded_file($file_tmp,"uploads/".$file_name);
    //  echo "Success";
  }else{
     print_r($errors);
  }

  
if(!isset($_SESSION['GUESTID'])){

$sql = "SELECT * FROM `tblauto` WHERE `autoid`=1";
$mydb->setQuery($sql);
$res = $mydb->loadSingleResult();




$guest = New Guest();
$guest->GUESTID          = $res->start;
$guest->G_FNAME          = $_SESSION['name'];    
$guest->G_LNAME          = $_SESSION['last'];  
$guest->G_CITY           = $_SESSION['City'];
$guest->G_ADDRESS        = $_SESSION['address'] ;        
$guest->DBIRTH           = date_format(date_create($_SESSION['dbirth']), 'Y-m-d');   
$guest->G_PHONE          = $_SESSION['phone'];    
$guest->G_NATIONALITY    = $_SESSION['nationality'];          
$guest->G_COMPANY        = $_SESSION['company'];      
$guest->G_CADDRESS       = $_SESSION['caddress'];        
$guest->G_TERMS          = 1;    
$guest->G_EMAIL          = $_SESSION['cemail'];  
$guest->G_UNAME          = $_SESSION['username'];    
$guest->G_PASS           = sha1($_SESSION['pass']);    
$guest->ZIP              = $_SESSION['zip'];
$guest->create(); 


  $lastguest= $res->start;
   
$_SESSION['GUESTID'] =   $lastguest;

}
 
    $count_cart = count($_SESSION['dragonhouse_cart']);
  

    for ($i=0; $i < $count_cart  ; $i++) { 

 

            $reservation = new Reservation();
            $reservation->CONFIRMATIONCODE  = $_SESSION['confirmation'];
            $reservation->TRANSDATE         = date('Y-m-d h:i:s'); 
            $reservation->ROOMID            = $_SESSION['dragonhouse_cart'][$i]['dragonhouseroomid'];
            $reservation->ARRIVAL           = date_format(date_create( $_SESSION['dragonhouse_cart'][$i]['dragonhousecheckin']), 'Y-m-d');  
            $reservation->DEPARTURE         = date_format(date_create( $_SESSION['dragonhouse_cart'][$i]['dragonhousecheckout']), 'Y-m-d'); 
            $reservation->RPRICE            = $_SESSION['dragonhouse_cart'][$i]['dragonhouseroomprice'];  
            $reservation->GUESTID           = $_SESSION['GUESTID']; 
            $reservation->PRORPOSE          = 'Travel';
            $reservation->STATUS            = 'Pending';
            $reservation->SLIP            = $file_name;
            $reservation->create(); 

            
            @$tot += $_SESSION['dragonhouse_cart'][$i]['dragonhouseroomprice'];
            }

           $item = count($_SESSION['dragonhouse_cart']);

      $sql = "INSERT INTO `tblpayment` (`TRANSDATE`,`CONFIRMATIONCODE`,`PQTY`, `GUESTID`, `SPRICE`,`MSGVIEW`,`STATUS`,`SLIP`)
       VALUES ('" .date('Y-m-d h:i:s')."','" . $_SESSION['confirmation'] ."',".$item."," . $_SESSION['GUESTID'] . ",".$tot.",0,'Pending', '" . $file_name ."' )" ;
      $mydb->setQuery($sql);
      $mydb->executeQuery(); 


      $sql = "UPDATE `tblauto` SET `start` = `start` + 1 WHERE `autoid`=1";
      $mydb->setQuery($sql);
      $mydb->executeQuery(); 



  

            unset($_SESSION['dragonhouse_cart']);
            // unset($_SESSION['confirmation']);
            unset($_SESSION['pay']);
            unset($_SESSION['from']);
            unset($_SESSION['to']);
            $_SESSION['activity'] = 1;

            ?> 

<script type="text/javascript"> alert("Booking is successfully submitted!");</script>

            <?php
            
    redirect( WEB_ROOT."booking/");
  }

}



?>

 
 

 <div id="accom-title"  style="padding-top:50px ;"> 
   
<h4 class="text-right">คุณมีเวลา3ชั่วโมงในการจ่ายก่อนก่อนระบบจะทำการยกเลิก Order</h4>
    <div type="hidden"  class="pagetitle d-flex justify-content-between">   
            <h1 >Billing Details          
            </h1> 
            <?php 

if (!isset($_SESSION['timeend'])){ 
    unset($_SESSION['timeend']);
    $endtime = time() + 10;  // สำหรับปรับเวลา
    $_SESSION['timeend'] = $endtime; 
} 

($_SESSION['timeend'] - time()) < 0 ? $EndTime = 0 :  $EndTime = $_SESSION['timeend'] - time();

if($EndTime <= 0) { 
    unset($_SESSION['timeend']);
//session_destroy();    
} 

?> 
<input id="timer" type="hidden" style="color:red;" class="text-right" value="<?php echo $EndTime ?>" />
        <!-- Display the countdown timer in an element -->
        </div> 
  </div>
<script type="text/javascript"> 
var pastTime = <?php echo $EndTime;?>; 

function mycountdown(){ 
      if(pastTime > 0) { 
            pastTime -= 1; 
            document.getElementById('timer').innerHTML = pastTime; 
      } 
if(pastTime < 1) { 


            window.location = "clear_cart.php" 
      } 
} 
    if(pastTime >0){
        setInterval(mycountdown,1000); 
    }
</script>
            <!-- <h1 class="text-right" id=demo>Times</h1> -->
             <!-- <input type="hidden" id="date" value=""> -->
    
<div id="bread" >
   <ol style="background-color:orange;" class="breadcrumb">
      <li><a style="color:white;" href="<?php echo WEB_ROOT ;?>index.php">&nbsp;&nbsp; Home  \</a> </li>
      <li><a style="color:white;" href="<?php echo WEB_ROOT ;?>booking/"> &nbsp;&nbsp; Booking Cart  \</a></li>  
       <li style="color:white;" class="active">&nbsp;&nbsp; Booking Details</li>
   </ol> 
</div> 


<form action="index.php?view=payment" method="post"  name="personal"  enctype="multipart/form-data">
<!-- <form action="test.php" method="post"  name="personal" enctype="multipart/form-data"> -->

 
<div class="col-md-12" style="background-color:white;color:black;">

  <div class="row" style="color:black;">
    <div class="col-md-8 col-sm-4">
       <div class="col-md-12">
          <label>Name:</label>
          <?php echo $_SESSION['name'] . ' '. $_SESSION['last']; 
   echo $count_cart;
           ?>
        </div>
        <div class="col-md-12">
          <label>Address:</label>
          <?php echo isset($_SESSION['city']) ? $_SESSION['city']: ' '. ' ' . isset($_SESSION['address'])  ? $_SESSION['address'] : ' '; ?> 
        </div>
        <div class="col-md-12"> 
        <label>Phone #:</label>
         <?php echo $_SESSION['phone'] ; ?>
        </div>
    </div> 
    <div class="col-md-4 col-sm-2">
      <div class="col-md-12">
        <label>Transaction Date:</label>
       <?php echo date("m/d/Y") ; ?>
      </div>
       <div class="col-md-12">
        <label>Transaction Id:</label>
       <?php echo $_SESSION['confirmation']; ?>
      </div>
      
    </div>
  </div> 
  <br/>




<div class="row" >
  <div class="table-responsive" >
    <table class="table" style="color:black;" >
      <thead>
        <tr>
          <td>Room</td>
          <td>Arrival</td>
          <td>Departure</td>
          <td>Price</td>
          <td>Night(s)</td>
          <td>Subtotal</td>
        </tr>
      </thead> 
      <tbody>
<?php
$payable = 0;
if (isset( $_SESSION['dragonhouse_cart'])){ 
$count_cart = count($_SESSION['dragonhouse_cart']);


for ($i=0; $i < $count_cart  ; $i++) {  

  $query = "SELECT * FROM `tblroom` r ,`tblaccomodation` a WHERE r.`ACCOMID`=a.`ACCOMID` AND ROOMID=" . $_SESSION['dragonhouse_cart'][$i]['dragonhouseroomid'];
   $mydb->setQuery($query);
   $cur = $mydb->loadResultList(); 
    foreach ($cur as $result) { 


?>

      
        <tr>
          <td><?php echo  $result->ROOM.' '. $result->ROOMDESC; ?></td>
          <td><?php echo  date_format(date_create( $_SESSION['dragonhouse_cart'][$i]['dragonhousecheckin']),"m/d/Y"); ?></td>
          <td><?php echo  date_format(date_create( $_SESSION['dragonhouse_cart'][$i]['dragonhousecheckout']),"m/d/Y"); ?></td>
          <td><?php echo  ' &dollar;'. $result->PRICE; ?></td>
          <td><?php echo   $_SESSION['dragonhouse_cart'][$i]['dragonhouseday']; ?></td>
          <td><?php echo ' &dollar;'.   $_SESSION['dragonhouse_cart'][$i]['dragonhouseroomprice']; ?></td>
        </tr>
<?php
       $payable += $_SESSION['dragonhouse_cart'][$i]['dragonhouseroomprice'] ;
      }

    } 
     $_SESSION['pay'] = $payable;
 } 
 ?> 
      </tbody>
    </table>
  </div> 
</div>

 

    <div class="right"> 
      <h3 style="text-align: right;">Total: &dollar; <?php echo $_SESSION['pay'] ;?></h3>
    </div>
    <input class="btn" type="file" name="image" id=""  required >
    
    <br>
    <div class="">
       <button type="submit" class="button"  name="btnsubmitbooking">Submit Booking</button>
    </div>
  </div>   
  <img  style="width:300px; margin-left:40%;" src="./uploads/payment.jpg" alt="payment" />
</form>

 



