<?php 

if (!isset($_SESSION['dragonhouse_cart'])) {
  # code...
  redirect(WEB_ROOT.'index.php');
}



 ?> 
 <div style="background-color:#fff;padding-top: 50px;">
 <div style="background:#F78C14;padding-left:5px;padding-bottom:5px">
           <h1 style="display: inline-block;color:white"> Login</h1>
              <a style="display: inline-block;color:#fff" href="personalinfo.php" data-title=" Register New Guest" data-toggle="lightbox">  Register</a> 
              </div>
                      <form action="<?php echo  WEB_ROOT."login.php" ?>" method="post">
                        <div class="form-group">
                            <div class="" style="margin-top: 10px;"> 
                              <label class="control-label" for=
                              "Username">Username:</label> 
                                    <input style="border-radius: 0px 50px 50px 0px;"  id="username" name="username" placeholder="Username" type="text" class="form-control input"  style="width: 100%">  
                            </div> 
           
                            <div class="" style="margin-top: 10px;">
                              <label class="control-label" for= 
                              "pass">Password:</label> 
                               <input name="pass" style="border-radius: 0px 50px 50px 0px;"  id="pass" placeholder="Password" type="password" class="form-control input " style="width: 100%"> 
                            </div> 
                        </div>  
                        
                        <button type="submit" name="gsubmit" class="button">Sign In</button> 
                        </form>   
                   
 

<br>
 
</div>
 <?php
 

function listofbooking(){



$payable = 0;
if (isset( $_SESSION['dragonhouse_cart'])){ 
$count_cart = count($_SESSION['dragonhouse_cart']);

?>
      <!-- list -->
<div class="row">
<div class="col-md-4">

     <div style="overflow:scroll;  height:300px;">


<?php

for ($i=0; $i < $count_cart  ; $i++) {  

  $query = "SELECT * FROM `tblroom` r ,`tblaccomodation` a WHERE r.`ACCOMID`=a.`ACCOMID` AND ROOMID=" . $_SESSION['dragonhouse_cart'][$i]['dragonhouseroomid'];

  $mydb ->setQuery($query);
  $cur = $mydb -> loadResultList(); 
    foreach ($cur as $result) { 


?>             
      
        <div class="row"> 
          <div class="col-md-12">
             <div class="panel panel-default">
                <div class="panel-heading">
                <!-- <h4>Payment</h4> -->
                </div>
                <div class="panel-body">

                    <div class="col-md-12">
                      <label>Room:</label><br/>
                      <?php echo  $result->ROOM.' '. $result->ROOMDESC; ?>
                    </div>
                   
                    <div class="col-md-6">
                      <label>Arrival:</label>
                      <?php echo  date_format(date_create( $_SESSION['dragonhouse_cart'][$i]['dragonhousecheckin']),"m/d/Y"); ?>
                    </div> 

                    <div class="col-md-6">
                       <label>Departure:</label>
                      <?php echo  date_format(date_create( $_SESSION['dragonhouse_cart'][$i]['dragonhousecheckout']),"m/d/Y"); ?>
                    </div>   
                  
 
                      <div class="col-md-12" style="float:left;border-top:1px solid #000;">
                          <label>Summary</label> 
                      </div>
                
                      <div style="float:right">  

                          <div class="col-md-12"  >
                              <label>Price:</label>
                            <?php echo  ' &#8369 '. $result->PRICE; ?>
                         </div> 

                         <div class="col-md-12"  >
                              <label>Days:</label>
                            <?php echo   $_SESSION['dragonhouse_cart'][$i]['dragonhouseday']; ?>
                         </div> 

                         <div class="col-md-12" >
                              <label>Total:</label>
                            <?php echo ' &#8369 '.   $_SESSION['dragonhouse_cart'][$i]['dragonhouseroomprice']; ?>
                         </div> 

                      </div>    
                      
                 </div>

                 <div class="panel-footer">
                   
                 </div>
              </div>   

          </div>
        </div> 
  <?php 
    }

                      $payable += $_SESSION['dragonhouse_cart'][$i]['dragonhouseroomprice'] ;
  }
                      $_SESSION['pay'] = $payable;
}
?>
      <div class="col-md-12" >
      <div class="row">
          <label style="float:left">Overall Price</label> <h2 style="float:right"> &#8369 <?php echo   $_SESSION['pay'] ;?></h2> 
      </div>
        </div>


  </div>  
    
  </div>  
</div>
      <!-- end list -->
    

<?php 
}
 ?>

