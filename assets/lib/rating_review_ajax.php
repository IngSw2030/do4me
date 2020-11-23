<?php  

include(dirname(dirname(dirname(__FILE__)))."/header.php");
include(dirname(dirname(dirname(__FILE__)))."/objects/class_connection.php");
include(dirname(dirname(dirname(__FILE__)))."/objects/class_adminprofile.php");
include(dirname(dirname(dirname(__FILE__)))."/objects/class_setting.php");
include(dirname(dirname(dirname(__FILE__))).'/objects/class_booking.php');
include(dirname(dirname(dirname(__FILE__)))."/objects/class_rating_review.php");

$con = new do4me_db();
$conn = $con->connect();
$rating_review = new do4me_rating_review();
$rating_review->conn = $conn;
$objadminprofile = new do4me_adminprofile();
$objadminprofile->conn = $conn;
$settings = new do4me_setting();
$settings->conn = $conn;
$booking= new do4me_booking();
$booking->conn=$conn;
if(isset($_POST['action']) && $_POST['action']=='rating_review'){
	$staff_ids_array = explode(",",$_POST['staff_id']);
	foreach($staff_ids_array as $staff_id){
		$rating_review->rating=$_POST['rating'];
		$rating_review->review=$_POST['review'];
		$rating_review->order_id=$_POST['order_id'];
		$rating_review->staff_id=$staff_id;  
		$rating_review->add_rating();
	}
}
?>