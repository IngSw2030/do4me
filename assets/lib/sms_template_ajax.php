<?php  session_start();include(dirname(dirname(dirname(__FILE__))).'/objects/class_connection.php');include(dirname(dirname(dirname(__FILE__))).'/objects/class_sms_template.php');$database= new do4me_db();$conn=$database->connect();$database->conn=$conn;$sms_template = new do4me_sms_template();$sms_template->conn = $conn;if(isset($_POST['save_sms_template'])){    $sms_template->id = $_POST['id'];    $sms_template->sms_message = base64_encode($_POST['sms_messages']);    $updated = $sms_template->update_sms_template();}elseif(isset($_POST['save_sms_template_status'])){    $sms_template->id = $_POST['id'];    $sms_template->sms_template_status = $_POST['sms_template_status'];    $updated = $sms_template->update_sms_template_status();}elseif(isset($_POST['default_sms_content'])){    $sms_template->id = $_POST['id'];    $getdata = $sms_template->get_default_sms_template();    echo base64_decode($getdata);}?>