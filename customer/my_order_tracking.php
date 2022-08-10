<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
	<link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">

<style type="text/css">

@import url('https://fonts.googleapis.com/css?family=Open+Sans&display=swap');

body{
	background-color: #eeeeee;font-family: 'Open Sans',serif
}

.container{
	margin-top:50px;margin-bottom: 50px
}

.card{
	position: relative;display: -webkit-box;display: -ms-flexbox;display: flex;-webkit-box-orient: vertical;-webkit-box-direction: normal;-ms-flex-direction: column;flex-direction: column;min-width: 0;word-wrap: break-word;background-color: #fff;background-clip: border-box;border: 1px solid rgba(0, 0, 0, 0.1);border-radius: 0.10rem
}

.card-header:first-child{
	border-radius: calc(0.37rem - 1px) calc(0.37rem - 1px) 0 0
}

.card-header{
	padding: 0.75rem 1.25rem;margin-bottom: 0;background-color: #fff;border-bottom: 1px solid rgba(0, 0, 0, 0.1)
}

.track{
	position: relative;background-color: #ddd;height: 7px;display: -webkit-box;display: -ms-flexbox;display: flex;margin-bottom: 60px;margin-top: 50px
}

.track .step{
	-webkit-box-flex: 1;-ms-flex-positive: 1;flex-grow: 1;width: 25%;margin-top: -18px;text-align: center;position: relative
}

.track .step.active:before{
	background: #FF5722
}

.track .step::before{
	height: 7px;position: absolute;content: "";width: 100%;left: 0;top: 18px
}

.track .step.active .icon{
	background: #ee5435;color: #fff
}

.track .icon{
	display: inline-block;width: 40px;height: 40px;line-height: 40px;position: relative;border-radius: 100%;background: #ddd
}

.track .step.active .text{
	font-weight: 400;color: #000
}

.track .text{
	display: block;margin-top: 7px
}

.itemside{
	position: relative;display: -webkit-box;display: -ms-flexbox;display: flex;width: 100%
}

.itemside .aside{
	position: relative;-ms-flex-negative: 0;flex-shrink: 0
}

.img-sm{
	width: 80px;height: 80px;padding: 7px
}

ul.row, ul.row-sm{
	list-style: none;padding: 0
}

.itemside .info{
	padding-left: 15px;padding-right: 7px
}

.itemside .title{
	display: block;margin-bottom: 5px;color: #212529
}

p{
	margin-top: 0;margin-bottom: 1rem
}

.btn-warning{
	color: #ffffff;background-color: #ee5435;border-color: #ee5435;border-radius: 1px
}

.btn-warning:hover{
	color: #ffffff;background-color: #ff2b00;border-color: #ff2b00;border-radius: 1px
}

.icon i{
padding-top:12.5px;
}



</style>


    <?php

session_start();

if(!isset($_SESSION['customer_email'])){

echo "<script>window.open('../checkout.php','_self')</script>";


}else {

include("includes/db.php");
include("includes/header.php");
include("functions/functions.php");
include("includes/main.php");

if(isset($_GET['order_id'])){

$order_id = $_GET['order_id'];

$get_order = "select * from customer_orders where order_id='$order_id' ";

$run_orders = mysqli_query($con,$get_order);

$row=mysqli_fetch_array($run_orders);

$ordertracking_status=$row['order_status'];

if($ordertracking_status=='pending'){

    $deliverytime ="Not Set";
    $order_status="Pending Order";
    // $order_status_class = "step";
    $confirmed_status="step";
    $picked_status="step";
    $transit_status="step";
    $pickup_status="step";
    $order_status_font ="fa fa-exclamation-triangle";
    
}
    else{
    
        $deliverytime ="40 min";
    $order_status_class = "step active";
$order_status_font ="fa fa-check";
$order_status="Picked by Courier";

$get_order_tracker="select * from tracker where order_id='$order_id' ";
$fetch_tracker=mysqli_query($con,$get_order_tracker);

$row_tracker=mysqli_fetch_array($fetch_tracker);

// echo "<pre>";
// print_r($row_tracker);
// echo "</pre>";

$picked=$row_tracker['Picked'];
$transit=$row_tracker['Transit'];
$pickup=$row_tracker['Pickup'];
$confirmed_order=$row_tracker['confrimed_order'];

// echo($confirmed_order);


if ($confirmed_order==1) {

    $confirmed_status = "step active";

} else {
    $confirmed_status = "step ";
}

if ($picked==1) {

    $picked_status = "step active";

} else {
    $picked_status = "step ";
}

if ($transit==1) {

    $transit_status = "step active";

} else {
    $transit_status = "step ";
}

if ($pickup==1) {

    $pickup_status = "step active";

} else {
    $pickup_status = "step ";
}

    
    }


}
}



?>


<div class="container">
    <article class="card">
        <header class="card-header"> My Order / Tracking </header>
        <div class="card-body">
            <h6>Order ID:<?php echo $order_id;?></h6>
            <article class="card">
                <div class="card-body row">
                    <div class="col"> <strong>Estimated Delivery time:</strong> <br><?php echo $deliverytime  ?> </div>
                    <div class="col"> <strong>Shipping BY:</strong> <br> Kukito, | <i class="fa fa-phone"></i> +25473456372 </div>
                    <div class="col"> <strong>Status:</strong> <br> <?php echo $order_status ?> </div>
        
                </div>
            </article>
            <div class="track">
                <div class="<?php echo $confirmed_status ?>"> <span class="icon"> <i class="<?php echo $order_status_font ?>"></i> </span> <span class="text">Order confirmed</span> </div>
                <div class="<?php echo $picked_status ?>"> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text"> <?php echo $order_status ?> </span> </div>
                <div class="<?php echo $transit_status ?>"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text"> On the way </span> </div>
                <div class="<?php echo $pickup_status ?>"> <span class="icon"> <i class="fa fa-box"></i> </span> <span class="text">Ready for pickup</span> </div>
            </div>
           
            <a href="my_account.php?my_orders" class="btn btn-warning" data-abc="true"> <i class="fa fa-chevron-left"></i> Back to orders</a>
        </div>
    </article>
</div>
