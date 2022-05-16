<!-- Display the countdown timer in an element
<p id="demo"></p>
<input type="text" id="datetimeminute" value="
<?php $date =  date_create('Y-m-d h:i:s');
// $date = date_create("2013-03-15");
// echo date_format(date('m d,Y H:i:s'), "m d,Y H:i:s");
echo date('Y-m-d h:i:s');
?>">

<?php
date_default_timezone_set("Asia/bangkok");
$timestamp = strtotime(date('h:i:s')) + 10800;
$time = date('H:i', $timestamp);
echo $time; //11:09
?>

<script>
    // Set the date we're counting down to
    var getdate = document.getElementById("datetimeminute").value;
    alert(getdate);
    var countDownDate = new Date(getdate).getTime();
    // countDownDate.setHours( countDownDate.getHours() + 3 );
    // Update the count down every 1 second
    var x = setInterval(function() {
        // Get today's date and time
        var now = new Date().getTime();
        // Find the distance between now and the count down date
        var distance = countDownDate - now;
        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Display the result in the element with id="demo"
        document.getElementById("demo").innerHTML = "คุณมีเวลา " + hours + "h " +
            minutes + "m " + seconds + "s " + "ในการชำระเงิน";

        // If the count down is finished, write some text
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("demo").innerHTML = "EXPIRED";
        }
    }, 1000);
</script> -->