<meta charset="UTF-8">
<?php
//1. เชื่อมต่อ database:
include('mysqlconnect.php');  //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี
//สร้างตัวแปรสำหรับรับค่าที่นำมาแก้ไขจากฟอร์ม
$exam_id = $_REQUEST["exam_id"];
$send_status = $_REQUEST["send_status"];

//ทำการปรับปรุงข้อมูลที่จะแก้ไขลงใน database

$sql = "UPDATE create_exam SET
send_status='$send_status'
WHERE exam_id='$exam_id' ";

$result = mysqli_query($dbc, $sql) or die ("Error in query: $dbc " . mysqli_error());

mysqli_close($dbc); //ปิดการเชื่อมต่อ database

//จาวาสคริปแสดงข้อความเมื่อบันทึกเสร็จและกระโดดกลับไปหน้าฟอร์ม

if($result){
  echo "<script type='text/javascript'>";
  echo "alert('ส่งสำเร็จ');";
  echo "window.location = 'testCheck.php'; ";
  echo "</script>";
}
else{
  echo "<script type='text/javascript'>";
  echo "alert('Error back to Update again');";
  echo "</script>";
}
?>
