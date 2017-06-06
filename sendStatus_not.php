<meta charset="UTF-8">
<?php
session_start();

$exam_id = $_SESSION['exam_id'];
//1. เชื่อมต่อ database:
include('mysqlconnect.php');  //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี
$test_id = $_GET["test_id"];
//echo $test_id;
$sql = "UPDATE test_exam SET status = 'ไม่ผ่าน' WHERE test_id = '$test_id'";
$result = mysqli_query($dbc, $sql) or die ("Error in query: $dbc " . mysqli_error());

mysqli_close($dbc); //ปิดการเชื่อมต่อ database

//จาวาสคริปแสดงข้อความเมื่อบันทึกเสร็จและกระโดดกลับไปหน้าฟอร์ม

if($result){
  echo "<script type='text/javascript'>";
  echo "alert('ไม่ผ่านการพิจารณา');";
  echo "window.location ='sendStatus.php?exam_id=$exam_id'; ";
  echo "</script>";
}
else{
  echo "<script type='text/javascript'>";
  echo "alert('Error back to Update again');";
  echo "</script>";
}
?>
