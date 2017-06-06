<html lang="en">
<head>
  <title>สร้างชุดข้อสอบ</title>
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
  $test_id = $_GET["test_id"];
  //2. query ข้อมูลจากตาราง:
  $sql = "SELECT * FROM test_exam WHERE test_id='$test_id' ";
  $result = mysqli_query($dbc, $sql) or die ("Error in query: $sql " . mysqli_error());
  $row = mysqli_fetch_array($result);
  extract($row);
  ?>
  <nav class="navbar navbar-default">
    <div class="container-fluid ">
      <div class="navbar-header navbar-right">
        <a class="navbar-brand" href="#"> &nbsp;CES</a>
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
          <div class="panel panel-info">
            <div class="panel-heading w3-yellow">
              แสดงข้อสอบ <?php echo $test_name;?>
            </div>

            <div class="panel-body" style="background-color: rgba(255, 255, 224, .45);">
              <?php
              // echo "<td>" .$row["test_id"] .  "</td> ";
              echo "<td>" .$test_no . "." .  "</td> ";
              echo "<td>" .$test_name .  "</td> ";
              $image_name = $test_namepic;
              if(empty( $image_name )) {
                echo "<td></td>";

              } else {
                echo "<br /><td>". "<img src='../img/".$test_namepic."' width='600'>" . "</td> <br />";
              }
              echo "<br />&nbsp;&nbsp;&nbsp;<td>" . "1. " .$choiceA .  "</td> ";
              echo "<br />&nbsp;&nbsp;&nbsp;<td>" . "2. " .$choiceB .  "</td> ";
              echo "<br />&nbsp;&nbsp;&nbsp;<td>" . "3. " .$choiceC .  "</td> ";
              echo "<br />&nbsp;&nbsp;&nbsp;<td>" . "4. " .$choiceD .  "</td> ";
              echo "<br />&nbsp;&nbsp;&nbsp;<td>" . "เฉลย <u>" .$test_ans .  "</u></td><br><br> ";

              ?>

            </div>
          </div>
          <a href="sendStatus.php?exam_id=<?php echo $_SESSION['exam_id'];?>" style="color:orange;">
            ย้อนกลับ</a>
          </div>
        </div>
      </div>
      <div class="container w3-animate-opacity">
        <div class="container-fluid">
          <div class="col-md-offset-1 col-md-10">
              <div class="panel panel-warning">
                <div class="panel-heading w3-orange">
                  ข้อเสนอแนะ
                </div>
                <div class="panel-body" style="">
                  <br />
                  <form action="send_status_com_db.php" class="form-horizontal" name="from1" method="get" enctype="multipart/form-data" >
                    <div class="form-group">
                      <label class="col-sm-3 control-label">ปรับปรุง</label></label>
                      <div class="col-sm-8">
                        <input type="hidden" class="form-control" name="test_id" value="<?php echo $test_id; ?>" />
                        <input type="hidden" class="form-control" name="status" value="ปรับปรุง" />
                        <input type="hidden" class="form-control" name="testsend_edit" value="" />
                        <textarea rows="5" class="form-control" name="comment" placeholder="ชื่อชุดข้อสอบ" value="" required/></textarea>
                      </div>
                    </div>

                    <div class="form-group">
                      <div class=" col-sm-12">
                        <button type="submit" class="btn btn-warning col-sm-offset-9 col-md-2"
                        name="uploadComment" style="" value="submit">ส่ง</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
