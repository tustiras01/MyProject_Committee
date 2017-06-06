<html lang="en">
<head>
  <title>ตรวจข้อสอบ-ส่งสถานะ</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <meta name="description" content="">
  <meta name="author" content="">

  <?php
  include("jscss.php");
  include("mysqlconnect.php");
  ?>

</head>
<body>
  <?php
  session_start();
  //echo $_SESSION['name'];
  // echo "OK";
  ?>
  <?php
  //1. เชื่อมต่อ database:
  //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี

  $exam_id = $_REQUEST["exam_id"];
  $_SESSION['exam_id'] = $exam_id;
  //2. query ข้อมูลจากตาราง:
  $sql = "SELECT * FROM create_exam WHERE exam_id='$exam_id' ";
  $result = mysqli_query($dbc, $sql) or die ("Error in query: $sql " . mysqli_error());
  $row = mysqli_fetch_array($result);
  extract($row);


  ?>

  <nav class="navbar navbar-default">
    <div class="container-fluid ">
      <div class="navbar-header navbar-right">
        <a class="navbar-brand" href="#">&nbsp;CES</a>
      </div>
      <ul class="nav navbar-nav">
        <li class="disabled"><a href="">หน้าหลัก</a></li>
        <li class="disabled"><a href="">พิจารณาข้อสอบ</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#" style="color:orange;">
          <span class="glyphicon glyphicon-credit-card"></span> <u><?php echo $_SESSION['type'];?></u>
        </a></li>
        <li><a href="#" style="color:#6699CC;">
          <span class="glyphicon glyphicon-book"></span> <u><?php echo $_SESSION['class'];?></u>&nbsp;
          <span class="glyphicon glyphicon-user"></span> <u><?php echo $_SESSION['name'];?></u>
        </a></li>
        <li><a href="../index.php" style="color:#990033;" class="w3-hover-red">
          <span class="glyphicon glyphicon-log-out"></span> Logout &nbsp;</a></li>
        </ul>
      </div>
    </nav>

    <div class="container w3-padding-16 w3-animate-opacity">
      <div class="container-fluid">
        <div class="col-sm-offset-1 col-sm-10">
          <div class="panel">
            <div class="panel-heading w3-green">
              ตารางแสดงรายการข้อสอบที่ผ่านการพิจารณา
            </div>
            <div class="panel-body">
              <form action="sendStatus_db.php" class="form-horizontal" name="from1" method="post" enctype="multipart/form-data" >
                <br /><div class="form-group">
                  <input type="hidden" class="form-control" name="exam_id" value="<?php echo $exam_id; ?>" />
                  <input type="hidden" class="form-control" name="send_status" value="<?php echo 'เรียบร้อย'; ?>" />

              </div>
              <?php
              //1. เชื่อมต่อ database:  //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี

              //2. query ข้อมูลจากตาราง tb_member:
              $query = "SELECT * FROM test_exam WHERE exam_id = $exam_id ORDER BY test_no asc" or die("Error:" . mysqli_error());
              //3.เก็บข้อมูลที่ query ออกมาไว้ในตัวแปร result .
              $result = mysqli_query($dbc, $query);
              //4 . แสดงข้อมูลที่ query ออกมา โดยใช้ตารางในการจัดข้อมูล:

              echo "<table class='table table-hover'>";
              //หัวข้อตาราง
              echo "<thead>
              <tr>

              <th>ที่</th>
              <th>โจทย์</th>
              <th>สถานะ</th>

              </tr>
              </thead>
              <tbody>";

              while($row = mysqli_fetch_array($result)) {
                echo "<tr>";
                echo "<td>" .$row["test_no"] .  "</td> ";
                echo "<td>" .$row["test_name"] .  "</td> ";
                echo "<td>" .$row["status"] .  "</td> ";


                echo "</tr>";
              }
              echo "</tbody></table>";
              //5. close connection
              mysqli_close($dbc);
              ?>
              <div class="form-group">
                <div class=" col-sm-12">
                  <button type="submit" class="btn btn-success col-sm-offset-8 col-md-3"
                  name="uploadStatus" style="" value="submit">ส่งสถานะ</button>
                </div>
              </div>
              </form>
              <a href="testCheck.php" style="color:orange;">
                ย้อนกลับ</a>
              </div>
            </div>
          </div>
        </div>
      </div>

    </body>
    </html>
