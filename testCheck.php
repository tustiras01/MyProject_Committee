<html lang="en">
<head>
  <title>พิจารณาข้อสอบ</title>
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
  // echo $_SESSION['pass'];
  // echo "OK";
  ?>

  <nav class="navbar navbar-default">
    <div class="container-fluid ">
      <div class="navbar-header navbar-right">
        <a class="navbar-brand" href="#">&nbsp;CES</a>
      </div>
      <ul class="nav navbar-nav">
        <li class=""><a href="committeeIndex.php">หน้าหลัก</a></li>
        <li class="active"><a href="testCheck.php">พิจารณาข้อสอบ</a></li>

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
            <div class="panel-heading w3-red">
              ตารางแสดงรายการข้อสอบที่ต้องพิจารณา
            </div>
            <div class="panel-body"  style="background-color:rgba(255, 255, 224, .45); width: 100%; height: 250px; overflow: auto;">
              <?php
              $sta = '';
              //1. เชื่อมต่อ database:  //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี
              $status = 'ส่งแล้ว';
              //2. query ข้อมูลจากตาราง tb_member:
              $query = "SELECT * FROM create_exam WHERE exam_status = '$status' and send_status = '$sta' ORDER BY exam_id asc" or die("Error:" . mysqli_error());
              //3.เก็บข้อมูลที่ query ออกมาไว้ในตัวแปร result .
              $result = mysqli_query($dbc, $query);
              //4 . แสดงข้อมูลที่ query ออกมา โดยใช้ตารางในการจัดข้อมูล:

              echo "<table class='table table-hover'>";
              //หัวข้อตาราง
              echo "<thead>
              <tr>

              <th width='10%'>รายวิชา</th>
              <th width='80%'>ชื่อข้อสอบ</th>
              <th width='5%'></th>
              <th width='5%'></th>

              </tr>
              </thead>
              <tbody>";

              while($row = mysqli_fetch_array($result)) {
                echo "<tr>";

                echo "<td><a style='color:red;'>" .$row["users_class_id"] .  "</a></td> ";
                echo "<td>" .$row["exam_name"] .  "</td> ";

                echo "<td><label><a href='sendStatus.php?exam_id=$row[0]' title='พิจารณา'>
                <img src = 'icon/heart.png' width=30 px>
                </label>
                </td>
                ";

                echo "<td><label>
                <a href='sendStatus_sd.php?exam_id=$row[0]' title='ส่งสถานะ'>
                <img src = 'icon/play-button.png' width=30 px></a>
                </label>
                </td>
                ";



                echo "</tr>";
              }
              echo "</tbody></table>";
              //5. close connection

              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container w3-animate-opacity">
      <div class="container-fluid">
        <div class="col-sm-offset-1 col-sm-10">
          <div class="panel">
            <div class="panel-heading w3-green">
              ตารางแสดงรายการข้อสอบที่พิจารณาแล้ว
            </div>
            <div class="panel-body"  style="width: 100%; height: 250px; overflow: auto;">
              <?php
              $sta = 'เรียบร้อย';
              //1. เชื่อมต่อ database:  //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี
              $status = 'ส่งแล้ว';
              //2. query ข้อมูลจากตาราง tb_member:
              $query = "SELECT * FROM create_exam WHERE exam_status = '$status' and send_status = '$sta' ORDER BY exam_id asc" or die("Error:" . mysqli_error());
              //3.เก็บข้อมูลที่ query ออกมาไว้ในตัวแปร result .
              $result = mysqli_query($dbc, $query);
              //4 . แสดงข้อมูลที่ query ออกมา โดยใช้ตารางในการจัดข้อมูล:

              echo "<table class='table table-hover'>";
              //หัวข้อตาราง
              echo "<thead>
              <tr>

              <th width='10%'>รายวิชา</th>
              <th width='70%'>ชื่อข้อสอบ</th>
              <th width='20%'>สถานะ</th>

              </tr>
              </thead>
              <tbody>";

              while($row = mysqli_fetch_array($result)) {
                echo "<tr>";

                echo "<td><a style='color:green;'>" .$row["users_class_id"] .  "</a></td> ";
                echo "<td>" .$row["exam_name"] .  "</td> ";
                echo "<td width='20%'>" ."<a style='color:green;'>พิจารณาแล้ว</a>" . "</td> ";

                echo "</tr>";
              }
              echo "</tbody></table>";
              //5. close connection
              mysqli_close($dbc);
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
  </html>
