<meta charset="UTF-8">
<?php
session_start();
//1. เชื่อมต่อ database:
include('mysqlconnect.php');  //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี
//สร้างตัวแปรสำหรับรับค่าที่นำมาแก้ไขจากฟอร์ม
$test_id = $_GET["test_id"];
$status= $_GET["status"];
$comment= $_GET["comment"];
$testsend_edit= $_GET["testsend_edit"];
$exam_id = $_SESSION['exam_id'];
//ทำการปรับปรุงข้อมูลที่จะแก้ไขลงใน database

$sql = "UPDATE test_exam SET
status='$status' ,
comment='$comment' ,
testsend_edit= '$testsend_edit'
WHERE test_id='$test_id' ";

$result = mysqli_query($dbc, $sql) or die ("Error in query: $dbc " . mysqli_error());

mysqli_close($dbc); //ปิดการเชื่อมต่อ database

//จาวาสคริปแสดงข้อความเมื่อบันทึกเสร็จและกระโดดกลับไปหน้าฟอร์ม

if($result){
  echo "<script type='text/javascript'>";
  echo "alert('ส่งข้อเสนอแนะสำเร็จ');";
  echo "window.location = 'sendStatus.php?exam_id=$exam_id'; ";
  echo "</script>";
}
else{
  echo "<script type='text/javascript'>";
  echo "alert('Error back to Update again');";
  echo "</script>";
}
?>
