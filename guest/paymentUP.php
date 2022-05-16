
<?php
require_once ("../includes/initialize.php");
  if (!isset($_SESSION['GUESTID'])){
      redirect("index.php");
     }

 ?>

 
 
		<table>
			<tr>
			<!-- 	<td align="center"> 
				<img src="../images/images/5page-img1.png"  height="90px" style="-webkit-border-radius:5px; -moz-border-radius:5px;" alt="Image">
        		</td> -->
				<td width="87%" align="center">
				<!-- <h3 >Monbela Tourist Inn</h3> -->
				<h2>Up Load Payment Slip </h2>
                
                <form action="upload.php" method="post" enctype="multipart/form-data">
    Select Image File to Upload:
    <input type="file" name="file">
    <input type="submit" name="submit" value="Upload">
</form>
				</td>
			</tr>
		</table>
		<!-- <h2 class="modal-title" id="myModalLabel">Billing Details </h2> -->
		
 
<?php 

