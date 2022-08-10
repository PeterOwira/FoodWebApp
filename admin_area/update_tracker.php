<?php


if(isset($_POST['submit_tracker'])){
    $trackeredit = $_POST['order_stage'];

    if ($trackeredit==="Picked by courier") {
        $update_tracker = "update tracker set Picked=1 where order_id='$order_id'";
        $run_update_tracker = mysqli_query($con,$update_tracker);

$run_customer_order = mysqli_query($con,$update_customer_order);
    } elseif($trackeredit==="On the way") {
        $update_tracker = "update tracker set Transit=1 where order_id='$order_id'";
        $run_update_tracker = mysqli_query($con,$update_tracker);

    } elseif($trackeredit==="Ready for pickup") {
        $update_tracker = "update tracker set Pickup=1 where order_id='$order_id'";
        $run_update_tracker = mysqli_query($con,$update_tracker);
    }
    
}


?>